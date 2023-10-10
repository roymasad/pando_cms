<?php
//// Backend Administration Tool page for datadriven sites ////

// !!Protect all framework files with Zend Guard enconding & obfuscation b4 deploying online!!

// Coding by Roy Massaad

// PandoCMS 2012, Copyright Roy Massaad
// www.roymassaad.com

// Description:
// Main php file for everything admin related, it's the tools-script of the backend.
// the backend itself is the database data/structure and the many utility classes for the system
// the other main script for this system is the flash interface script that connects to the frontend.
// ps: look up that other main flash frontend script for its details.

// This is Object Oriented PhP design
// the only thing not OO is the php index entry.. (as per php 'standard')

// first, we set up proper includes
// always use require_once so prevent errors from multiple includes

// Csec is the core security and utility class 
// the php and asset folders should have NO read access to web clients for security reasons
require_once 'php/Csecurity.php';
require_once 'php/Cprojects.php';

error_reporting(E_ALL ^ E_NOTICE);

// First thing we do is check if any parameters were passed

// now before we proceed, let's make it clear how this script expects to receive parameter directives.
// the script will receive request 'guidlines' through $_get
// and forms, details and secure parameters through $_post
// so mainly the directives come from $_get and the details with $_post
// ps: this is a centralized script for the managment system
// the only 'extra' script files it will use are include php files that have the necessary custom classes
// to function. many of those classes will also be shared by the other main script of the system, mainly
// the script responsible for interfacing with flash clients who want to connect to the backend system

// ok, first do a simple count of the nb of parameters passed
$parameters1 = count($_POST);
$parameters2 = count($_GET);

// check out first default display grid (0,1,2), if not specificied manually then set it
if (isset($_GET['GRID'])) $_SESSION['GRID'] = Csec::sanitizer($_GET['GRID'], 'string');
elseif (!isset($_SESSION['GRID'])) $_SESSION['GRID'] = '1';

// all of the following sections will check for passed parameters and call appropriate classes and functions
// make sure to EXIT EACH SECTION so that the script wont fall back also to default welcome page mode!
// for parameters and dependant subparameters, NEST THE SECTIONS
// fist section is login, last section is welcome page, and the sections are seperated by a security check 
// the first group doesnt require cookie validations, while the latter all need a valid session cookie

// this first section will deal with login request parameters sent by a form submit
if ($_GET['LOGIN'] == 1) {
	
	// prepare our Csec core utility
	$securitas = new Csec();
  
  // try to log in with the supplied credentials
  // if successful we should have a valid cookie afterwards
  // Csec logmein sanitizes the data itself
  $securitas->logmeIn($_POST['user'], $_POST['pass']);
    
  
  // now refrain back to the main page with no arguments
  // this is done to refresh the cookies when they get read next
  
 	header('Location: '. $_SERVER['PHP_SELF']);
  
  //Debugging, this is a javascript version of forcing a page refresh, but this will refresh WITH the address arguments also
  //echo  "<SCRIPT LANGUAGE=\"JAVASCRIPT\" TYPE=\"TEXT/JAVASCRIPT\">";
	//echo  "location.reload();";
	//echo  "</SCRIPT>";
	
	exit;
   
    
}


// now, this nextsection makes a security check, any functions to process parameters behind it are NOT accessible if the cookie check fails
// only two parameter functions should run b4 this check (in this administrator php), one for login, and one for email commentbox validations

// so create a security object token
$mainSecuritas = new Csec();

// then check for a valid cookie

// MAIN SECURITY CHECK ///
// if no valid cookie is present, give the user the login page..
if (!$mainSecuritas->cookieChecker()) {

	// stream the login page using the static methods and constant of Csec
	Csec::rawStreamer(Csec::loginhtml);
	
	// also, check if this is a retry (with a previous login attempt in place)
	// if so append the login page with a an Error msg
	// this check is just for show and it doesnt affect security nor can be bypassed to gain access
	// all cookies have been encrypted with the Csec crypter
	
	if ($_COOKIE[Csec::encrypterL1('invalidlog')] == Csec::encrypterL1('true')) {
	echo "<center> <font color=\"red\"> <b> ERROR LOGIN IN </b> <font> </center>";
	// and reset the invalid cookie flag to default
	setcookie(Csec::encrypterL1('invalidlog'), Csec::encrypterL2('false'));
	}
		
	// and we're all done
	exit;
}


// this section deals with picture submitting/uploading system.
// so is the $_get main paramenter about uploading pictures ?
// if so are there any secondary parameters passed for the secondary picture subsystems?

// this system is now able to upload different file types to different systems and do the apropierate database entries
if ($_GET['UPLOAD'] == 1) {
	
	// first check to see if this is csv type upload instead of pix or vids
	
	if ($_GET['TYPE'] == 'CSV') { 
		
		$row = 1;
		$utility = Cprojects::getSingleton();
		
		// let's open the temp uploaded csv file and read it as comme delimeted
		if (($handle = fopen($_FILES['uploadedfile']['tmp_name'], "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    		
		    		//$num = count($data);
		        
		      	// skip the first headline headlines of the csv file (they are useless)
		      	if ($row > 2) {
		            
		            // set up a record, check and add, then loop til we do this to all file records
		            
								$newproject['name'] = $data[0];
								$newproject['description'] = $data[1];
								$newproject['type'] = $data[2];
								$newproject['area'] = $data[3];
								$newproject['project_year'] = $data[4];
								$newproject['completion_year'] = $data[5];
								$newproject['cost'] = $data[6];
								$newproject['ranking'] = $data[7];
								$newproject['client'] = $data[8];
								$newproject['authorship'] = $data[9];
								$newproject['associates'] = $data[10];
								$newproject['lead_architects'] = $data[11];
								$newproject['architects'] = $data[12];
								$newproject['engineers'] = $data[13];
								$newproject['interior_designers'] = $data[14];
								$newproject['lighting_list'] = $data[15];
								$newproject['materials_list'] = $data[16];
								$newproject['sustainability'] = $data[17];
								$newproject['3d'] = $data[18];
								$newproject['pix_icons'] = $data[19];
								$newproject['pix_images'] = $data[20];
								$newproject['pix_sketches'] = $data[21];
								$newproject['pix_perspectives'] = $data[22];
								$newproject['pix_models'] = $data[23];
								$newproject['pix_conceptpix'] = $data[24];
								$newproject['pix_sitepix'] = $data[25];
								$newproject['pix_animation'] = $data[26];
								$newproject['pix_boards'] = $data[27];
								$newproject['pix_plans'] = $data[28];
								$newproject['pdf_report'] = $data[29];
								$newproject['status'] = $data[30];
								$newproject['location'] = $data[31];
								$newproject['website'] = $data[32];
								$newproject['grid'] = $data[33];
								
								
								if ($newproject['name'] != "") $utility->addRecord( $newproject , Cprojects::projectstable);
		            
		        }
		        
		        $row++;
		        
		    }
		    fclose($handle);
		}
			
	echo "<body bgcolor=\"#ffffff\">";
	echo "<font color='black'>";
	echo 'done.';			
	
	exit;	
	}
	
	
	
	
	// let's check to which upload folder depending on upload file type
	// default upload folder
	if ($_GET['TYPE'] == 'PIX') $folder = Csec::projectpixFolder; 
	if ($_GET['TYPE'] == 'PIX') $table = Cprojects::pixtable;
	if ($_GET['TYPE'] == 'VIDEO') $folder = Csec::projectvideoFolder; 
	if ($_GET['TYPE'] == 'VIDEO') $table = Cprojects::videotable;
	if ($_GET['TYPE'] == 'PDF') $folder = Csec::projectpdfFolder; 
	if ($_GET['TYPE'] == 'PDF') $table = Cprojects::pdftable;
	if ($_GET['TYPE'] == 'PRESS') $folder = Csec::projectpixFolder; 
	if ($_GET['TYPE'] == 'PRESS') $table = Cprojects::presstable;
	if ($_GET['TYPE'] == 'PUBS') $folder = Csec::projectpixFolder; 
	if ($_GET['TYPE'] == 'PUBS') $table = Cprojects::publicationtable;
	if ($_GET['TYPE'] == 'PRESSPDF') $folder = Csec::projectpdfFolder; 
	if ($_GET['TYPE'] == 'PRESSPDF') $table = Cprojects::presstable;
	if ($_GET['TYPE'] == 'PUBSPDF') $folder = Csec::projectpdfFolder; 
	if ($_GET['TYPE'] == 'PUBSPDF') $table = Cprojects::publicationtable;
		
		
		
		// next get the values used to generate images+thungs from the original pix uploaded
		$utility = Cprojects::getSingleton();
				
		$find= null;
			
		$dbatom = $utility->searchRecords($find, Cprojects::settingtable);
			
		if (isset($dbatom)) $result = $dbatom->arraysResult(); 
		
		if (isset($dbatom)) $size['thmbsize'] = $result[0]['thumb_height'];
		if (isset($dbatom)) $size['imgsize'] = $result[0]['image_height'];
		
		
		$filecount = 0;
		foreach ($_FILES['uploadedfile']['name'] as $filename) {
		
		$filename= str_replace(" ","_",$filename);
		$tempfilename = $_FILES['uploadedfile']['tmp_name'][$filecount];
		

		
			
		// task it with saving the tmp uploaded file properly and checking format
		if ($_GET['TYPE'] == 'PIX') $final = Csec::uploadSaver($filename, $tempfilename, $folder, "jpg", $size);
		else $final = Csec::uploadSaver($filename, $tempfilename, $folder);
			
		// and check if it successed
			
		if ($final == 'failure') {
				
			// do whatever u want in case of failure
			echo 'Failure Uploading !';
			
			echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
				
			exit;
				
		}
		
		// timeto update the database according to which file type was uploaded and to what system
		
		
		
		
		
		if (($_GET['TYPE'] == 'PRESS') || ($_GET['TYPE'] == 'PUBS')) {
		
		$record['id'] =  Csec::sanitizer($_GET['ID'], 'string');
		$recordset['image_link'] = $final;
		
		$utility->updateRecord($record, $recordset, $table);
			
		
		}
		
		if (($_GET['TYPE'] == 'PRESSPDF') || ($_GET['TYPE'] == 'PUBSPDF')) {
		
		$record['id'] =  Csec::sanitizer($_GET['ID'], 'string');
		$recordset['hyper_link'] = $folder . '/' . $final;
		
		$utility->updateRecord($record, $recordset, $table);
			
		
		}
		
		else {
		
		$record = null;
		
		$record['project'] =  Csec::sanitizer($_GET['PROJECT'], 'string');
		$record['main_link'] = $final;
		if ($_GET['TYPE'] == 'PIX') $record['category'] =  Csec::sanitizer($_GET['CATEGORY'], 'string');
		
		$utility->addRecord($record, $table);
		
				
		
		/// sync the sortid with the newly created id field for pix
		// the sortid is a field used to give images changable sorting order by being a clone of the id field but that can be modified
		
		if ($_GET['TYPE'] == 'PIX'){
		
			$find = null;
				
			$find['project'] =  Csec::sanitizer($_GET['PROJECT'], 'string');
		        $find['main_link'] = $final;
				
			$dbatom = $utility->searchRecords($find, $table);
			
			$result = $dbatom->arraysResult(); 
			
			$record = null;
			$recordset = null;
		
			$record['id'] = $result[0]['id'];
			$recordset['sortid'] = $result[0]['id'];
			
			$utility->updateRecord($record, $recordset, $table);
		}
		
		
		
		
		}
		
		
		
		$filecount++;
		}
		
		
		if ($_GET['TYPE'] == 'PIX'){
		
			$record['category'] =  Csec::sanitizer($_GET['CATEGORY'], 'string');
			$record['project'] =  Csec::sanitizer($_GET['PROJECT'], 'string');
			//header('Location: admin.php?EDITPROJECTPIX=1&CATEGORY='.$record['category'].'&PROJECT='.$record['project']);
			header('Location: admin.php?EDITPROJECT=1&ID='.$record['project']);
						
		
		exit;
		
		}
		/*
		if (isset($_GET['TYPE']) && ($_GET['TYPE'] == 'PUBS')) {
		
			$record['id'] =  Csec::sanitizer($_GET['ID'], 'string');
			
			header('Location: admin.php?EDITPUBLICATIONS=1&EDITPUBSITEM=1&ID='.$record['id']);
		
		exit;
		
		}
		*/
		
		echo 'Finished Uploading !';
		
		echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
		
			
		// and we're all done
		exit;
	
	
}

// this section presents a welcome+user screen if parameter welcome = 1
if ($_GET['WELCOME'] == 1) {
	
	Csec::rawStreamer('welcome.html');	
	
	$utility = new Csec();
	
	$username = $utility->returnCookieUser();
	
	echo "<center><b><font size = '4' color=\"green\"> USER : </font></b>";
	
	echo "<b><font color=\"red\">".$username."</font></b></center>";
	
	echo "<br><center><img src='assets/sitepix/welcome.gif'></center>";	
		
	exit;
	
}

// simple footer section streamers
if ($_GET['FOOTER'] == 1) {

	Csec::rawStreamer('footer.html');
}

// populate the links on the side frame
// the main administrator L1 gets an extra link to administer the others
if ($_GET['SIDEFRAME'] == 1) {
	
	Csec::rawStreamer("style.css");
	
	echo "<body bgcolor=\"#d8d8d8\">";
	
	echo "<a class=\"leftmenu\" href='http://www.roymassaad.com' target='_blank'><img src=\"assets/sitepix/PandoCMS.jpg\" /></a>";
	
	echo "<b><a class=\"leftmenu\" href='admin.php?WELCOME=1' target='mainFrame'>-WELCOME !</a></b><br><br><br>";
	
	echo "<b><a class=\"leftmenu\" href='admin.php?FINDPROJECT=1&FINDPROJECTSUBMIT=1&GRID=0' target='mainFrame'>-LIST Projects</a></b><br>";
	
	echo "<b><a class=\"leftmenu\" href='admin.php?FINDPROJECT=1&GRID=0' target='mainFrame'>-FIND</a></b><br>";
		
	echo "<b><a class=\"leftmenu\" href='admin.php?EDITNAMES=1' target='mainFrame'>-EDIT NAMES</a></b><br>";
	

	echo "<b><a class=\"leftmenu\" href='admin.php?EDITPAGE=1&PAGE=ABOUT' target='mainFrame'>-ABOUT PG</a></b><br>";
	
	echo "<b><a class=\"leftmenu\" href='admin.php?EDITPAGE=1&PAGE=CONTACT' target='mainFrame'>-CONTACT PG</a></b><br>";
	
	echo "<b><a class=\"leftmenu\" href='admin.php?EDITPAGE=1&PAGE=TEAM' target='mainFrame'>-TEAM PG</a></b><br>";
	
	echo "<b><a class=\"leftmenu\" href='admin.php?EDITPAGE=1&PAGE=JOBS' target='mainFrame'>-JOBS PG</a></b><br>";
	
	echo "<b><a class=\"leftmenu\" href='admin.php?EDITPRESS=1' target='mainFrame'>-NEWS</a></b><br>";
	
	echo "<b><a class=\"leftmenu\" href='admin.php?EDITPUBLICATIONS=1' target='mainFrame'>-PRESS</a></b><br>";
	
	
	
	
	
	echo "<br>";
			
	// retrieve the moderator level from the last digit 'hidden' in garbage
	$level =	Csec::sanitizer(Csec::decrypterL2($_COOKIE[Csec::encrypterL1('garbage')]), 'string'); 	
	$level =  substr( $level, strlen($level)-1, 1 );
	
	// and show edit moderator link if we are Level 1
	if ($level == '1') { echo "<b><a class=\"leftmenu\" href='admin.php?EDITMOD=1' target='mainFrame'>-EDIT MOD </a></b><br>"; }

	echo "<b><a class=\"leftmenu\" href='admin.php?EDITSETTINGS=1' target='mainFrame'>-SETTINGS</a></b><br>";
	
	// echo the logout button, make it open 'atop' the frameset
	echo "<br><br><br><br><br><br><br><b><a class=\"leftmenu\" href='admin.php?LOGOUT=1' target='_top'>LOG OUT</a></b><br>";
	
	exit;

	
}

// this section is responsible for editing the settings section of the grid in the backend
if ($_GET['EDITSETTINGS'] == 1) {

	if ($_GET['SUBMIT'] == 1) {
	
	
		$utility = Cprojects::getSingleton();
	
		$set['mini_x_offset']=Csec::sanitizer($_POST['iminiX'], 'int');
		$set['mini_y_offset']=Csec::sanitizer($_POST['iminiY'], 'int');
		$set['column_offset']=Csec::sanitizer($_POST['iColumoff'], 'int');
		$set['grid_3d_offset_x']=Csec::sanitizer($_POST['iGridXoffset'], 'int');
		$set['grid_3d_offset_y']=Csec::sanitizer($_POST['iGridYoffset'], 'int');
		$set['grid_skew']=Csec::sanitizer($_POST['iGridskew'], 'int');
		$set['grid_xyz']=Csec::sanitizer($_POST['iGridxyz'], 'int');
		$set['grid_thumb_fade_delay']=Csec::sanitizer($_POST['iGriddelay'], 'float');
		$set['grid_thumb_zoom']=Csec::sanitizer($_POST['iGridzoom'], 'float');
		$set['grid_thumb_height']=Csec::sanitizer($_POST['iGridthumbH'], 'int');
		$set['grid_thumb_width']=Csec::sanitizer($_POST['iGridthumbW'], 'int');
		$set['image_height']=Csec::sanitizer($_POST['iImageheight'], 'int');
		$set['thumb_height']=Csec::sanitizer($_POST['iThumbheight'], 'int');
		$set['sort_alphab']=Csec::sanitizer($_POST['iSortAlphaB'], 'string');
		$set['sort_ranking']=Csec::sanitizer($_POST['iSortRanking'], 'string');
		$set['sort_budget']=Csec::sanitizer($_POST['iSortBudget'], 'string');
		$set['sort_area']=Csec::sanitizer($_POST['iSortArea'], 'string');
		$set['sort_type']=Csec::sanitizer($_POST['iSortType'], 'string');
		$set['sort_year']=Csec::sanitizer($_POST['iSortYear'], 'string');
		$set['grid_margin_left']=Csec::sanitizer($_POST['iGridLeft'], 'string');
		$set['grid_margin_top']=Csec::sanitizer($_POST['iGridTop'], 'string');
		$set['alphab_list']=Csec::sanitizer($_POST['iSortAlphaBDisplay'], 'string');
		$set['budget_list']=Csec::sanitizer($_POST['iSortBudgetDisplay'], 'string');
		$set['area_list']=Csec::sanitizer($_POST['iSortAreaDisplay'], 'string');
		
		$set['sort_price_design']=Csec::sanitizer($_POST['iSortPriceDesign'], 'string');
		$set['price_design_list']=Csec::sanitizer($_POST['iSortPriceDesignDISPLAY'], 'string');
		$set['sort_material_design']=Csec::sanitizer($_POST['iSortMaterialDesign'], 'string');
		$set['material_design_list']=Csec::sanitizer($_POST['iSortMaterialDesignDISPLAY'], 'string');
		$set['sort_volume_design']=Csec::sanitizer($_POST['iSortVolumeDesign'], 'string');
		$set['volume_design_list']=Csec::sanitizer($_POST['iSortVolumeDesignDISPLAY'], 'string');
		
		$set['sort_price_art']=Csec::sanitizer($_POST['iSortPriceArt'], 'string');
		$set['price_art_list']=Csec::sanitizer($_POST['iSortPriceArtDISPLAY'], 'string');
		$set['sort_material_art']=Csec::sanitizer($_POST['iSortMaterialArt'], 'string');
		$set['material_art_list']=Csec::sanitizer($_POST['iSortMaterialArtDISPLAY'], 'string');
		$set['sort_volume_art']=Csec::sanitizer($_POST['iSortVolumeArt'], 'string');
		$set['volume_art_list']=Csec::sanitizer($_POST['iSortVolumeArtDISPLAY'], 'string');
		
	
		$id['id'] = 1;
	
		$dbatom = $utility->updateRecord($id, $set, Cprojects::settingtable);
		
		
		header('Location: admin.php?EDITSETTINGS=1');
		//echo 'done.';	
	
		exit;
	}


	$utility = Cprojects::getSingleton();
		
	$find= null;
	
	$dbatom = $utility->searchRecords($find, Cprojects::settingtable);
	
	$result = $dbatom->arraysResult();
	
	
	
	$replacetable['xxx_miniXoffsetYYY']=$result[0]['mini_x_offset'];
	$replacetable['xxx_miniYoffsetYYY']=$result[0]['mini_y_offset'];
	$replacetable['xxx_ColumnoffsetYYY']=$result[0]['column_offset'];
	$replacetable['xxx_GridXoffsetYYY']=$result[0]['grid_3d_offset_x'];
	$replacetable['xxx_GridYoffsetYYY']=$result[0]['grid_3d_offset_y'];
	$replacetable['xxx_GridskewYYY']=$result[0]['grid_skew'];
	$replacetable['xxx_GridxyzYYY']=$result[0]['grid_xyz'];
	$replacetable['xxx_GriddelayYYY']=$result[0]['grid_thumb_fade_delay'];
	$replacetable['xxx_GridzoomYYY']=$result[0]['grid_thumb_zoom'];
	$replacetable['xxx_GridthumbHYYY']=$result[0]['grid_thumb_height'];
	$replacetable['xxx_GridthumbWYYY']=$result[0]['grid_thumb_width'];
	$replacetable['xxx_ImageheightYYY']=$result[0]['image_height'];
	$replacetable['xxx_ThumbheightYYY']=$result[0]['thumb_height'];
	$replacetable['xxx_SortAlphaBYYY']=$result[0]['sort_alphab'];
	$replacetable['xxx_SortRankingYYY']=$result[0]['sort_ranking'];
	$replacetable['xxx_SortBudgetYYY']=$result[0]['sort_budget'];
	$replacetable['xxx_SortAreaYYY']=$result[0]['sort_area'];
	$replacetable['xxx_SortTypeYYY']=$result[0]['sort_type'];
	$replacetable['xxx_SortYearYYY']=$result[0]['sort_year'];
	$replacetable['xxx_GridLeftYYY']=$result[0]['grid_margin_left'];
	$replacetable['xxx_GridTopYYY']=$result[0]['grid_margin_top'];
	$replacetable['xxx_SortAlphaBDisplayYYY']=$result[0]['alphab_list'];
	$replacetable['xxx_SortBudgetDisplayYYY']=$result[0]['budget_list'];
	$replacetable['xxx_SortAreaDisplayYYY']=$result[0]['area_list'];
	
	$replacetable['xxx_SortPriceDesignYYY']=$result[0]['sort_price_design'];
	$replacetable['xxx_SortPriceDesignDISPLAYYYY']=$result[0]['price_design_list'];
	$replacetable['xxx_SortMaterialDesignYYY']=$result[0]['sort_material_design'];
	$replacetable['xxx_SortMaterialDesignDISPLAYYYY']=$result[0]['material_design_list'];
	$replacetable['xxx_SortVolumeDesignYYY']=$result[0]['sort_volume_design'];
	$replacetable['xxx_SortVolumeDesignDISPLAYYYY']=$result[0]['volume_design_list'];
	
	$replacetable['xxx_SortPriceArtYYY']=$result[0]['sort_price_art'];
	$replacetable['xxx_SortPriceArtDISPLAYYYY']=$result[0]['price_art_list'];
	$replacetable['xxx_SortMaterialArtYYY']=$result[0]['sort_material_art'];
	$replacetable['xxx_SortMaterialArtDISPLAYYYY']=$result[0]['material_art_list'];
	$replacetable['xxx_SortVolumeArtYYY']=$result[0]['sort_volume_art'];
	$replacetable['xxx_SortVolumeArtDISPLAYYYY']=$result[0]['volume_art_list'];
	
	$replacetable['xxx_ActionURLYYY']='EDITSETTINGS=1&SUBMIT=1';
	
		
	Csec::streamer('settingsform.html', $replacetable);




	exit;
}


// this section is responsible for editting/adding/deleting press items from the backend
if ($_GET['EDITPRESS'] == 1) {


	if ($_GET['ADDPRESS'] == 1) {
	
	$utility = Cprojects::getSingleton();
			
	$add['info'] = Csec::sanitizer($_POST['iInfo'],'string');
	$add['title'] = Csec::sanitizer($_POST['iTitle'],'string');
	$add['date'] = Csec::sanitizer($_POST['iDate'],'string');
	$add['hyper_link'] = Csec::sanitizer($_POST['iHyperlink'],'string');
	
	if ($add['date'] == null) $add['date'] = date("Y-m-d");
	//if ($add['hyper_link'] == null) $add['hyper_link'] = "#";
		
	if ($add['info'] != "") $utility->addRecord( $add , Cprojects::presstable);
	
	echo 'Press Added ! ';
	
	exit;
	}

	if ($_GET['EDITPRESSITEM'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
	$find['id'] = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->searchRecords($find, Cprojects::presstable);
	
	$result = $dbatom->arraysResult();

		
	$replacetable['xxx_ActionURLYYY'] = 'EDITPRESS=1&PRESSSUBMIT=1&ID='.$find['id'];
	$replacetable['xxx_ActionYYY'] = 'EDIT';
	
	$replacetable['xxx_infoYYY'] = $result[0]['info'];
	$replacetable['xxx_titleYYY'] = $result[0]['title'];
	$replacetable['xxx_dateYYY'] = $result[0]['date'];
	$replacetable['xxx_hyperlinkYYY'] = $result[0]['hyper_link'];
	$replacetable['visibility:hidden']='visibility:visible';
	$replacetable['xxx_pressIDYYY'] = $find['id'];
	
		
	Csec::streamer('pressform.html', $replacetable);
	
	$replacetable['UPLOADOPTIONS'] = "TYPE=PRESSPDF&ID=".$find['id'];
	Csec::streamer('uploader.html', $replacetable);

	// present a go back button
	echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";	
	
	exit;
	}
	
	if ($_GET['PRESSSUBMIT'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
	$set['info'] = Csec::sanitizer($_POST['iInfo'],'string');
	$set['title'] = Csec::sanitizer($_POST['iTitle'],'string');
	$set['date'] = Csec::sanitizer($_POST['iDate'],'string');
	$set['hyper_link'] = Csec::sanitizer($_POST['iHyperlink'],'string');
	
	$Id['id'] = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->updateRecord($Id, $set, Cprojects::presstable);
	
	echo 'PRESS Edited ! ';
	
	
	exit;
	}
	
	
	if ($_GET['DELETEPRESS'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
		
	$Id = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->deleteRecordID($Id, Cprojects::presstable);
	
	echo 'PRESS Deleted ! ';
	
	
	exit;
	}
	
	
	
	
	$utility = Cprojects::getSingleton();
	
	$project2 = null;
	
	$dbatom = $utility->searchRecords($project2, Cprojects::presstable, 'date', 'false', 'DESC');
					
	$changes['EDIT']['command']='EDITPRESS=1&EDITPRESSITEM=1';
	$changes['EDIT']['style']='normal';
	$changes['EDIT']['icon']='editicon.jpg';
	$changes['DEL']['command']='EDITPRESS=1&DELETEPRESS=1';
	$changes['DEL']['style']='prompt';
	$changes['DEL']['icon']='deleteicon.jpg'; 
	
	
	$utility->printDBatom($dbatom , 'html', 1, $changes, $utility->nameheader);
	
		
	
	$replacetable['xxx_ActionYYY']='ADD';
	$replacetable['xxx_ActionURLYYY']='EDITPRESS=1&ADDPRESS=1';
	
	$replacetable['xxx_infoYYY']='';
	$replacetable['xxx_titleYYY']='';
	$replacetable['xxx_dateYYY']='';
	$replacetable['xxx_hyperlinkYYY']='';
	$replacetable['xxx_pictureYYY']='';
	
	
	Csec::streamer('pressform.html', $replacetable);
	
	
	exit;
}



// this section is responsible for editting/adding/deleting publication items from the backend
if ($_GET['EDITPUBLICATIONS'] == 1) {


	if ($_GET['ADDPUBS'] == 1) {
	
	$utility = Cprojects::getSingleton();
			
	$add['info'] = Csec::sanitizer($_POST['iInfo'],'string');
	$add['date'] = Csec::sanitizer($_POST['iDate'],'string');
	$add['hyper_link'] = Csec::sanitizer($_POST['iHyperlink'],'string');
	
		
	if ($add['info'] != "") $utility->addRecord( $add , Cprojects::publicationtable);
	
	echo 'Article Added ! ';
	
	exit;
	}

	if ($_GET['EDITPUBSITEM'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
	$find['id'] = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->searchRecords($find, Cprojects::publicationtable);
	
	$result = $dbatom->arraysResult();

		
	$replacetable['xxx_ActionURLYYY'] = 'EDITPUBLICATIONS=1&PUBSSUBMIT=1&ID='.$find['id'];
	$replacetable['xxx_ActionYYY'] = 'EDIT';
	
	$replacetable['xxx_infoYYY'] = $result[0]['info'];
	$replacetable['xxx_dateYYY'] = $result[0]['date'];
	$replacetable['xxx_hyperlinkYYY'] = $result[0]['hyper_link'];
	$replacetable['visibility:hidden']='visibility:visible';
	$replacetable['xxx_pubsIDYYY'] = $find['id'];
	
		
	Csec::streamer('pubsform.html', $replacetable);
	
	$replacetable['UPLOADOPTIONS'] = "TYPE=PUBSPDF&ID=".$find['id'];
	Csec::streamer('uploader.html', $replacetable);

	// present a go back button
	echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";	
	
	exit;
	}
	
	if ($_GET['PUBSSUBMIT'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
	$set['info'] = Csec::sanitizer($_POST['iInfo'],'string');
	$set['date'] = Csec::sanitizer($_POST['iDate'],'string');
	$set['hyper_link'] = Csec::sanitizer($_POST['iHyperlink'],'string');
	
	$Id['id'] = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->updateRecord($Id, $set, Cprojects::publicationtable);
	
	echo 'Article Edited ! ';
	
	
	exit;
	}
	
	
	if ($_GET['DELETEPUBS'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
		
	$Id = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->deleteRecordID($Id, Cprojects::publicationtable);
	
	echo 'Article Deleted ! ';
	
	
	exit;
	}
	
	
	
	
	$utility = Cprojects::getSingleton();
	
	$project2 = null;
	
	$dbatom = $utility->searchRecords($project2, Cprojects::publicationtable);
					
	$changes['EDIT']['command']='EDITPUBLICATIONS=1&EDITPUBSITEM=1';
	$changes['EDIT']['style']='normal';
	$changes['EDIT']['icon']='editicon.jpg';
	$changes['DEL']['command']='EDITPUBLICATIONS=1&DELETEPUBS=1';
	$changes['DEL']['style']='prompt';
	$changes['DEL']['icon']='deleteicon.jpg';
	
	
	$utility->printDBatom($dbatom , 'html', 1, $changes, $utility->nameheader);
	
		
	
	$replacetable['xxx_ActionYYY']='ADD';
	$replacetable['xxx_ActionURLYYY']='EDITPUBLICATIONS=1&ADDPUBS=1';
	
	$replacetable['xxx_infoYYY']='';
	$replacetable['xxx_dateYYY']='';
	$replacetable['xxx_hyperlinkYYY']='';
	$replacetable['xxx_pictureYYY']='';
	
	
	Csec::streamer('pubsform.html', $replacetable);
	
	
	exit;
}


// this section is responsible for allowing the admin to edit the front end pages that use CKeditor on the backend
// it does this by connecting the necessary parts together
if ($_GET['EDITPAGE'] == 1) {

	if ($_GET['SUBMIT'] == 1) {

		$utility = Cprojects::getSingleton();
		
		$page['name'] = Csec::sanitizer($_GET['PAGE'], 'string');
		//$html['htmltext'] = Csec::sanitizer($_POST['editor1'], 'string');
	
		$html['htmltext'] = $_POST['editor1'];
	
		//echo $html;
	
		$dbatom = $utility->updateRecord($page, $html, Cprojects::pagetable);
		
		echo 'done.';	
	
		exit;
	}

	$utility = Cprojects::getSingleton();
		
	$page['name'] = Csec::sanitizer($_GET['PAGE'], 'string');
	
	$dbatom = $utility->searchRecords($page, Cprojects::pagetable);
	
	$result = $dbatom->arraysResult();
	
	$replacetable['xxx_PageYYY']=$page['name'];
	$replacetable['PAGE=xxx_PageHTMLYYY']='';
	
	if ($result) $replacetable['PAGE=xxx_PageHTMLYYY'] = $result[0]['htmltext'];
		
	Csec::streamer('editpage.html', $replacetable);
	
	
	
	exit;
}



// are we processing a project ADD request ?
if ($_GET['ADDPROJECT'] == 1) {
	
	// are we gonna submit a csv file list of projects?
	if ($_GET['CSVLIST'] == 1) {
		
		// give them to option to upload a csv file
		$replacetable['UPLOADOPTIONS'] = "TYPE=CSV";
		Csec::streamer('uploader.html', $replacetable);
		
		// present a go back button
		echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
		
		exit;
	}
	
	
	// this this the submit stage ?
	if ($_GET['ADDPROJECTSUBMIT'] == 1) {
		
		$utility = Cprojects::getSingleton();
		
		$newproject['name'] = Csec::sanitizer($_POST['iName'], 'string');
		$newproject['status'] = Csec::sanitizer($_POST['iStatus'], 'string');
		$newproject['location'] = Csec::sanitizer($_POST['iLocation'], 'string');
		$newproject['description'] = Csec::sanitizer($_POST['iDescription'], 'string');
		$newproject['type'] = Csec::sanitizer($_POST['iType'], 'string');
		$newproject['area'] = Csec::sanitizer($_POST['iArea'], 'string');
		$newproject['volume'] = Csec::sanitizer($_POST['iVolume'], 'string');
		$newproject['project_year'] = Csec::sanitizer($_POST['iprojectYear'], 'string');
		$newproject['completion_year'] = Csec::sanitizer($_POST['icompletionYear'], 'string');
		$newproject['cost'] = Csec::sanitizer($_POST['iCost'], 'string');
		$newproject['ranking'] = Csec::sanitizer($_POST['iRanking'], 'string');
		$newproject['website'] = Csec::sanitizer($_POST['iWebsite'], 'string');
		$newproject['client'] = Csec::sanitizer($_POST['iClient'], 'string');
		$newproject['authorship'] = Csec::sanitizer($_POST['iAuthorship'], 'string');
		$newproject['associates'] = Csec::sanitizer($_POST['iAssociates'], 'string');
		$newproject['lead_architects'] = Csec::sanitizer($_POST['ileadArchitects'], 'string');
		$newproject['architects'] = Csec::sanitizer($_POST['iArchitects'], 'string');
		$newproject['engineers'] = Csec::sanitizer($_POST['iEnginners'], 'string');
		$newproject['interior_designers'] = Csec::sanitizer($_POST['iinteriorDesigners'], 'string');
		$newproject['lighting_list'] = Csec::sanitizer($_POST['ilighting'], 'string');
		$newproject['materials_list'] = Csec::sanitizer($_POST['imaterials'], 'string');
		$newproject['sustainability'] = Csec::sanitizer($_POST['isustainability'], 'string');
		$newproject['3d'] = Csec::sanitizer($_POST['i3d'], 'string');
		$newproject['pix_icons'] = Csec::sanitizer($_POST['iicons'], 'string');
		$newproject['pix_images'] = Csec::sanitizer($_POST['iimages'], 'string');
		$newproject['pix_sketches'] = Csec::sanitizer($_POST['isketches'], 'string');
		$newproject['pix_perspectives'] = Csec::sanitizer($_POST['iperspectives'], 'string');
		$newproject['pix_models'] = Csec::sanitizer($_POST['imodels'], 'string');
		$newproject['pix_conceptpix'] = Csec::sanitizer($_POST['iconcept'], 'string');
		$newproject['pix_sitepix'] = Csec::sanitizer($_POST['isite'], 'string');
		$newproject['pix_animation'] = Csec::sanitizer($_POST['ianimation'], 'string');
		$newproject['pix_boards'] = Csec::sanitizer($_POST['iboards'], 'string');
		$newproject['pix_plans'] = Csec::sanitizer($_POST['iplans'], 'string');
		$newproject['pdf_report'] = Csec::sanitizer($_POST['ireport'], 'string');
		$newproject['grid'] = Csec::sanitizer($_POST['iGrid'], 'string');
		
		// make sure at least a name is set
		if ($newproject['name'] == "") {echo '<br>Please choose at least a Name'; return;}
			
		$utility->addRecord( $newproject , Cprojects::projectstable);
		
		header('Location: admin.php?FINDPROJECT=1&FINDPROJECTSUBMIT=1&GRID='.$newproject['grid']);
		
		//echo "<body bgcolor=\"#ffffff\">";
		//echo "<font color='black'>";
		//echo 'done.';		
		exit;
	}
	// open up projectsform.html, processing it for ad/find/edit
	$replacetable['xxx_ActionYYY']='ADD';
	$replacetable['xxx_ActionURLYYY']='ADDPROJECT=1&ADDPROJECTSUBMIT=1';
	
	$replacetable['xxx_nameYYY']='';
	$replacetable['xxx_statusYYY']='';
	$replacetable['xxx_locationYYY']='';
	$replacetable['xxx_descriptionYYY']='';
	$replacetable['xxx_typeYYY']='';
	$replacetable['xxx_areaYYY']='';
	$replacetable['xxx_volumeYYY']='';
	$replacetable['xxx_projectYearYYY']='';
	$replacetable['xxx_completionYearYYY']='';
	$replacetable['xxx_costYYY']='';
	$replacetable['xxx_rankingYYY']='';
	$replacetable['xxx_websiteYYY']='';
	$replacetable['xxx_clientYYY']='';
	$replacetable['xxx_authorshipYYY']='';
	$replacetable['xxx_associatesYYY']='';
	$replacetable['xxx_leadArchitectsYYY']='';
	$replacetable['xxx_ArchitectsYYY']='';
	$replacetable['xxx_EngineersYYY']='';
	$replacetable['xxx_interiorDesignersYYY']='';
	$replacetable['xxx_lightingYYY']='';
	$replacetable['xxx_materialsYYY']='';
	$replacetable['xxx_sustainabilityYYY']='';
	$replacetable['xxx_3dYYY']='';
	$replacetable['xxx_imagesYYY']='';
	$replacetable['xxx_iconsYYY']='';
	$replacetable['xxx_sketchesYYY']='';
	$replacetable['xxx_perspectivesYYY']='';
	$replacetable['xxx_modelsYYY']='';
	$replacetable['xxx_conceptYYY']='';
	$replacetable['xxx_siteYYY']='';
	$replacetable['xxx_animationYYY']='';
	$replacetable['xxx_boardsYYY']='';
	$replacetable['xxx_plansYYY']='';
	$replacetable['xxx_reportYYY']='';
	$replacetable['xxx_gridYYY']=$_SESSION['GRID'];
	
	
	// this section populates the grouped names drop down boxs with values from the database
	$replacetable['xxx_listTypesYYY']=Cprojects::htmlnamedropbox('types');
	$replacetable['xxx_listNamesClientYYY']=Cprojects::htmlnamedropbox('Client');
	$replacetable['xxx_listNamesAuthorshipYYY']=Cprojects::htmlnamedropbox('Authorship');
	$replacetable['xxx_listNamesAssociatesYYY']=Cprojects::htmlnamedropbox('Associates');
	$replacetable['xxx_listNamesArchitectsYYY']=Cprojects::htmlnamedropbox('Architects');
	$replacetable['xxx_listNamesEngineersYYY']=Cprojects::htmlnamedropbox('Engineers');
	$replacetable['xxx_listNamesDesignersYYY']=Cprojects::htmlnamedropbox('Designers');
	$replacetable['xxx_listNamesLightingYYY']=Cprojects::htmlnamedropbox('Lighting');
	$replacetable['xxx_listNamesMaterialsYYY']=Cprojects::htmlnamedropbox('Materials');
	$replacetable['xxx_listNamesSustainabilityYYY']=Cprojects::htmlnamedropbox('Sustainability');
	$replacetable['xxx_listNames3dYYY']=Cprojects::htmlnamedropbox('3d');
	
	// this section displays relevant mini thumbnails in each appropriate section
	$pixcategories = array('icons', 'images', 'sketches', 'perspective', 'models', 'concept', 'site', 'boards', 'plans', 'construction', 'diagrams');
	
	foreach ($pixcategories as $category) {
	
		$namereplace = 'XXX'.$category.'Pix';
		
		$replacetable[$namereplace] = '';
	}
	
	
	// and stream it
	Csec::streamer('projectsform.html', $replacetable);
	
	//echo "<br><b><a href='admin.php?ADDPROJECT=1&CSVLIST=1' target='_self'>-ADD CSV LIST of Projects </a></b><br>";
	
	exit;
}

// are we processing a project FIND request ?
if ($_GET['FINDPROJECT'] == 1) {
	
	// did we submit the search ?
	if ($_GET['FINDPROJECTSUBMIT'] == 1) {
		
		$utility = Cprojects::getSingleton();
		
		$project ['name'] = Csec::sanitizer($_POST['iName'], 'string');
		$project ['status'] = Csec::sanitizer($_POST['iStatus'], 'string');
		$project ['location'] = Csec::sanitizer($_POST['iLocation'], 'string');
		$project ['description'] = Csec::sanitizer($_POST['iDescription'], 'string');
		$project ['type'] = Csec::sanitizer($_POST['iType'], 'string');
		$project ['area'] = Csec::sanitizer($_POST['iArea'], 'string');
		$project ['volume'] = Csec::sanitizer($_POST['iVolume'], 'string');
		$project ['project_year'] = Csec::sanitizer($_POST['iprojectYear'], 'string');
		$project ['completion_year'] = Csec::sanitizer($_POST['icompletionYear'], 'string');
		$project ['cost'] = Csec::sanitizer($_POST['iCost'], 'string');
		$project ['ranking'] = Csec::sanitizer($_POST['iRanking'], 'string');
		$project ['website'] = Csec::sanitizer($_POST['iWebsite'], 'string');
		$project ['client'] = Csec::sanitizer($_POST['iClient'], 'string');
		$project ['authorship'] = Csec::sanitizer($_POST['iAuthorship'], 'string');
		$project ['associates'] = Csec::sanitizer($_POST['iAssociates'], 'string');
		$project ['lead_architects'] = Csec::sanitizer($_POST['ileadArchitects'], 'string');
		$project ['architects'] = Csec::sanitizer($_POST['iArchitects'], 'string');
		$project ['engineers'] = Csec::sanitizer($_POST['iEnginners'], 'string');
		$project ['interior_designers'] = Csec::sanitizer($_POST['iinteriorDesigners'], 'string');
		$project ['lighting_list'] = Csec::sanitizer($_POST['ilighting'], 'string');
		$project ['materials_list'] = Csec::sanitizer($_POST['imaterials'], 'string');
		$project ['sustainability'] = Csec::sanitizer($_POST['isustainability'], 'string');
		$project ['3d'] = Csec::sanitizer($_POST['i3d'], 'string');
		$project ['pix_icons'] = Csec::sanitizer($_POST['iicons'], 'string');
		$project ['pix_images'] = Csec::sanitizer($_POST['iimages'], 'string');
		$project ['pix_sketches'] = Csec::sanitizer($_POST['isketches'], 'string');
		$project ['pix_perspectives'] = Csec::sanitizer($_POST['iperspectives'], 'string');
		$project ['pix_models'] = Csec::sanitizer($_POST['imodels'], 'string');
		$project ['pix_conceptpix'] = Csec::sanitizer($_POST['iconcept'], 'string');
		$project ['pix_sitepix'] = Csec::sanitizer($_POST['isite'], 'string');
		$project ['pix_animation'] = Csec::sanitizer($_POST['ianimation'], 'string');
		$project ['pix_boards'] = Csec::sanitizer($_POST['iboards'], 'string');
		$project ['pix_plans'] = Csec::sanitizer($_POST['iplans'], 'string');
		$project ['pdf_report'] = Csec::sanitizer($_POST['ireport'], 'string');
		$project ['grid'] = Csec::sanitizer($_SESSION['GRID'], 'string');
		
		
		// make a new array from the orginal, but where all empty fiels get removed
		// this is done so that the array can be processed by Cinvetory classes
		$project2 = null;
		foreach ($project as $k => $v) {
			
			if ($v != "") $project2[$k] = $v;
			
		}
		
		$result = $utility->searchRecords($project2, Cprojects::projectstable);
		
		$changes['EDIT']['command']='EDITPROJECT=1';
		$changes['EDIT']['style']='normal';
		$changes['EDIT']['icon']='editicon.jpg';
		$changes['DEL']['command']='DELETEPROJECT=1';
		$changes['DEL']['style']='prompt';
		$changes['DEL']['icon']='deleteicon.jpg';
				
		$utility->printDBatom($result, 'html', 1, $changes,$utility->projectheader, 9);
		
		echo '<center><br> <b>Result :<b>';
		echo ($result->maxIndex()+1).'</center>';
		
		
		
		echo "<br><br><br><b><a class=\"leftmenu\" href='admin.php?ADDPROJECT=1&GRID=".$_SESSION['GRID']."' target='mainFrame'>-ADD PROJECT</a></b>";
		
		exit;
	}
	
	
	// open up projectsform.html, processing it for ad/find/edit
	$replacetable['xxx_ActionYYY']='FIND';
	$replacetable['xxx_ActionURLYYY']='FINDPROJECT=1&FINDPROJECTSUBMIT=1&GRID='.$_SESSION['GRID'];
	
	$replacetable['xxx_nameYYY']='';
	$replacetable['xxx_statusYYY']='';
	$replacetable['xxx_locationYYY']='';
	$replacetable['xxx_descriptionYYY']='';
	$replacetable['xxx_typeYYY']='';
	$replacetable['xxx_areaYYY']='';
	$replacetable['xxx_volumeYYY']='';
	$replacetable['xxx_projectYearYYY']='';
	$replacetable['xxx_completionYearYYY']='';
	$replacetable['xxx_costYYY']='';
	$replacetable['xxx_rankingYYY']='';
	$replacetable['xxx_websiteYYY']='';
	$replacetable['xxx_clientYYY']='';
	$replacetable['xxx_authorshipYYY']='';
	$replacetable['xxx_associatesYYY']='';
	$replacetable['xxx_leadArchitectsYYY']='';
	$replacetable['xxx_ArchitectsYYY']='';
	$replacetable['xxx_EngineersYYY']='';
	$replacetable['xxx_interiorDesignersYYY']='';
	$replacetable['xxx_lightingYYY']='';
	$replacetable['xxx_materialsYYY']='';
	$replacetable['xxx_sustainabilityYYY']='';
	$replacetable['xxx_3dYYY']='';
	$replacetable['xxx_iconsYYY']='';
	$replacetable['xxx_imagesYYY']='';
	$replacetable['xxx_sketchesYYY']='';
	$replacetable['xxx_perspectivesYYY']='';
	$replacetable['xxx_modelsYYY']='';
	$replacetable['xxx_conceptYYY']='';
	$replacetable['xxx_siteYYY']='';
	$replacetable['xxx_animationYYY']='';
	$replacetable['xxx_boardsYYY']='';
	$replacetable['xxx_plansYYY']='';
	$replacetable['xxx_reportYYY']='';
	$replacetable['xxx_gridYYY']=$_SESSION['GRID'];
	
	// this section populates the grouped names drop down boxs with values from the database
	$replacetable['xxx_listTypesYYY']=Cprojects::htmlnamedropbox('types');
	$replacetable['xxx_listNamesClientYYY']=Cprojects::htmlnamedropbox('Client');
	$replacetable['xxx_listNamesAuthorshipYYY']=Cprojects::htmlnamedropbox('Authorship');
	$replacetable['xxx_listNamesAssociatesYYY']=Cprojects::htmlnamedropbox('Associates');
	$replacetable['xxx_listNamesArchitectsYYY']=Cprojects::htmlnamedropbox('Architects');
	$replacetable['xxx_listNamesEngineersYYY']=Cprojects::htmlnamedropbox('Engineers');
	$replacetable['xxx_listNamesDesignersYYY']=Cprojects::htmlnamedropbox('Designers');
	$replacetable['xxx_listNamesLightingYYY']=Cprojects::htmlnamedropbox('Lighting');
	$replacetable['xxx_listNamesMaterialsYYY']=Cprojects::htmlnamedropbox('Materials');
	$replacetable['xxx_listNamesSustainabilityYYY']=Cprojects::htmlnamedropbox('Sustainability');
	$replacetable['xxx_listNames3dYYY']=Cprojects::htmlnamedropbox('3d');
	
	// this section displays relevant mini thumbnails in each appropriate section
	$pixcategories = array('icons', 'images', 'sketches', 'perspective', 'models', 'concept', 'site', 'boards', 'plans', 'construction', 'diagrams');
	
	foreach ($pixcategories as $category) {
	
		$namereplace = 'XXX'.$category.'Pix';
		
		$replacetable[$namereplace] = '';
	}
	
	// and stream it
	Csec::streamer('projectsform.html', $replacetable);
	
	exit;
}

// are we processing an ad edit request ?
if ($_GET['EDITPROJECT'] == 1) {
	
	// did the user submit the edited record ?
	if ($_GET['EDITPROJECTSUBMIT'] == 1) {
		
		$utility = Cprojects::getSingleton();
		
		$id['id'] = Csec::sanitizer($_GET['ID'], 'string');
		
		$setproject['name'] = Csec::sanitizer($_POST['iName'], 'string');
		$setproject['status'] = Csec::sanitizer($_POST['iStatus'], 'string');
		$setproject['location'] = Csec::sanitizer($_POST['iLocation'], 'string');
		$setproject['description'] = Csec::sanitizer($_POST['iDescription'], 'string');
		$setproject['type'] = Csec::sanitizer($_POST['iType'], 'string');
		$setproject['area'] = Csec::sanitizer($_POST['iArea'], 'string');
		$setproject['volume'] = Csec::sanitizer($_POST['iVolume'], 'string');
		$setproject['project_year'] = Csec::sanitizer($_POST['iprojectYear'], 'string');
		$setproject['completion_year'] = Csec::sanitizer($_POST['icompletionYear'], 'string');
		$setproject['cost'] = Csec::sanitizer($_POST['iCost'], 'string');
		$setproject['ranking'] = Csec::sanitizer($_POST['iRanking'], 'string');
		$setproject['website'] = Csec::sanitizer($_POST['iWebsite'], 'string');
		$setproject['client'] = Csec::sanitizer($_POST['iClient'], 'string');
		$setproject['authorship'] = Csec::sanitizer($_POST['iAuthorship'], 'string');
		$setproject['associates'] = Csec::sanitizer($_POST['iAssociates'], 'string');
		$setproject['lead_architects'] = Csec::sanitizer($_POST['ileadArchitects'], 'string');
		$setproject['architects'] = Csec::sanitizer($_POST['iArchitects'], 'string');
		$setproject['engineers'] = Csec::sanitizer($_POST['iEnginners'], 'string');
		$setproject['interior_designers'] = Csec::sanitizer($_POST['iinteriorDesigners'], 'string');
		$setproject['lighting_list'] = Csec::sanitizer($_POST['ilighting'], 'string');
		$setproject['materials_list'] = Csec::sanitizer($_POST['imaterials'], 'string');
		$setproject['sustainability'] = Csec::sanitizer($_POST['isustainability'], 'string');
		$setproject['3d'] = Csec::sanitizer($_POST['i3d'], 'string');
		$setproject['pix_icons'] = Csec::sanitizer($_POST['iicons'], 'string');
		$setproject['pix_images'] = Csec::sanitizer($_POST['iimages'], 'string');
		$setproject['pix_sketches'] = Csec::sanitizer($_POST['isketches'], 'string');
		$newproject['pix_perspectives'] = Csec::sanitizer($_POST['iperspectives'], 'string');
		$setproject['pix_models'] = Csec::sanitizer($_POST['imodels'], 'string');
		$setproject['pix_conceptpix'] = Csec::sanitizer($_POST['iconcept'], 'string');
		$setproject['pix_sitepix'] = Csec::sanitizer($_POST['isite'], 'string');
		$setproject['pix_animation'] = Csec::sanitizer($_POST['ianimation'], 'string');
		$setproject['pix_boards'] = Csec::sanitizer($_POST['iboards'], 'string');
		$setproject['pix_plans'] = Csec::sanitizer($_POST['iplans'], 'string');
		$setproject['pdf_report'] = Csec::sanitizer($_POST['ireport'], 'string');
		$setproject['grid'] = Csec::sanitizer($_POST['iGrid'], 'string');
			
		// update based on Id
		$utility->updateRecord($id, $setproject, Cprojects::projectstable);
		
		
		header('Location: admin.php?EDITPROJECT=1&ID='.$id['id']);
		
		//echo "<body bgcolor=\"#ffffff\">";
		//echo "<font color='black'>";
		//echo 'done.';		
				
		exit;
		
	}
	
	$utility = Cprojects::getSingleton();
	
	$find['id'] = Csec::sanitizer($_GET['ID'], 'string');
	
	$dbatom = $utility->searchRecords($find, Cprojects::projectstable);
	
	$result = $dbatom->arraysResult();
	
	// open up projectsform.html, processing it for ad/find/edit
	$replacetable['xxx_ActionYYY']='EDIT';
	$replacetable['xxx_ActionURLYYY']='EDITPROJECT=1&EDITPROJECTSUBMIT=1&ID='.$result[0]['id'];
	
	$replacetable['xxx_nameYYY']=$result[0]['name'];
	$replacetable['xxx_statusYYY']=$result[0]['status'];
	$replacetable['xxx_locationYYY']=$result[0]['location'];
	$replacetable['xxx_descriptionYYY']=$result[0]['description'];
	$replacetable['xxx_typeYYY']=$result[0]['type'];
	$replacetable['xxx_areaYYY']=$result[0]['area'];
	$replacetable['xxx_volumeYYY']=$result[0]['volume'];
	$replacetable['xxx_projectYearYYY']=$result[0]['project_year'];
	$replacetable['xxx_completionYearYYY']=$result[0]['completion_year'];
	$replacetable['xxx_costYYY']=$result[0]['cost'];
	$replacetable['xxx_rankingYYY']=$result[0]['ranking'];
	$replacetable['xxx_websiteYYY']=$result[0]['website'];
	$replacetable['xxx_clientYYY']=$result[0]['client'];
	$replacetable['xxx_authorshipYYY']=$result[0]['authorship'];
	$replacetable['xxx_associatesYYY']=$result[0]['associates'];
	$replacetable['xxx_leadArchitectsYYY']=$result[0]['lead_architects'];
	$replacetable['xxx_ArchitectsYYY']=$result[0]['architects'];
	$replacetable['xxx_EngineersYYY']=$result[0]['engineers'];
	$replacetable['xxx_interiorDesignersYYY']=$result[0]['interior_designers'];
	$replacetable['xxx_lightingYYY']=$result[0]['lighting_list'];
	$replacetable['xxx_materialsYYY']=$result[0]['materials_list'];
	$replacetable['xxx_sustainabilityYYY']=$result[0]['sustainability'];
	$replacetable['xxx_3dYYY']=$result[0]['3d'];
	$replacetable['xxx_iconsYYY']=$result[0]['pix_icons'];
	$replacetable['xxx_imagesYYY']=$result[0]['pix_images'];
	$replacetable['xxx_sketchesYYY']=$result[0]['pix_sketches'];
	$replacetable['xxx_perspectivesYYY']=$result[0]['pix_perspectives'];
	$replacetable['xxx_modelsYYY']=$result[0]['pix_models'];
	$replacetable['xxx_conceptYYY']=$result[0]['pix_conceptpix'];
	$replacetable['xxx_siteYYY']=$result[0]['pix_sitepix'];
	$replacetable['xxx_animationYYY']=$result[0]['pix_animation'];
	$replacetable['xxx_boardsYYY']=$result[0]['pix_boards'];
	$replacetable['xxx_plansYYY']=$result[0]['pix_plans'];
	$replacetable['xxx_reportYYY']=$result[0]['pdf_report'];
	$replacetable['xxx_gridYYY']=$result[0]['grid'];
	
	$replacetable['xxx_projectYYY']=$result[0]['id'];
	
	// this section populates the grouped names drop down boxs with values from the database
	$replacetable['xxx_listTypesYYY']=Cprojects::htmlnamedropbox('types');
	$replacetable['xxx_listNamesClientYYY']=Cprojects::htmlnamedropbox('Client');
	$replacetable['xxx_listNamesAuthorshipYYY']=Cprojects::htmlnamedropbox('Authorship');
	$replacetable['xxx_listNamesAssociatesYYY']=Cprojects::htmlnamedropbox('Associates');
	$replacetable['xxx_listNamesArchitectsYYY']=Cprojects::htmlnamedropbox('Architects');
	$replacetable['xxx_listNamesEngineersYYY']=Cprojects::htmlnamedropbox('Engineers');
	$replacetable['xxx_listNamesDesignersYYY']=Cprojects::htmlnamedropbox('Designers');
	$replacetable['xxx_listNamesLightingYYY']=Cprojects::htmlnamedropbox('Lighting');
	$replacetable['xxx_listNamesMaterialsYYY']=Cprojects::htmlnamedropbox('Materials');
	$replacetable['xxx_listNamesSustainabilityYYY']=Cprojects::htmlnamedropbox('Sustainability');
	$replacetable['xxx_listNames3dYYY']=Cprojects::htmlnamedropbox('3d');
	
	// this section displays relevant mini thumbnails in each appropriate section
	$pixcategories = array('icons', 'images', 'sketches', 'perspective', 'models', 'concept', 'site', 'boards', 'plans', 'construction', 'diagrams');
	
	foreach ($pixcategories as $category) {
	
		$findpix['project'] = $result[0]['id'];
		$findpix['category'] = $category;
		$namereplace = 'XXX'.$category.'Pix';
		
		$pixresult = $utility->searchRecords($findpix, Cprojects::pixtable, 'sortid');
		
		if (isset($pixresult)) { 
		
				
		$replacetable[$namereplace] = $utility->printDBatom($pixresult , 'htmlpixmini', 1);
		
		} else $replacetable[$namereplace] = '';
	}
	

		
	
	$replacetable['visibility:hidden']='visibility:visible';
	
	
		
	// and stream it
	Csec::streamer('projectsform.html', $replacetable);
	
	// present links to edit sub tables of project for this particular Id
	
	//echo "<br> <a href='admin.php?EDITPROJECTPIX=1&PROJECT=".$result[0]['id']."'>EDIT</a> Pictures";

	
	// add delete button, with javascript confirmation
	echo "<br><br><br><b><a onclick=\"return confirm('Confirm?')\" href=\"admin.php?DELETEPROJECT=1&ID=".$result[0]['id']."\" >DELETE</a></b>";
	
	// simple no javascript delete: echo "<br><br><br><b><a href='admin.php?DELETEPROJECT=1&ID=".$result[0]['Id']."'>DELETE</a></b>";
		
	// present a go back button
	//echo "<BR><BR><a href='javascript: history.go(-1)'>[Go Back]</a>";	
		
	exit;
	
	
}

// are we processing a project pix list ?
if ($_GET['EDITPROJECTPIX'] == 1) {

	// this section is responsible for the swaping image sort order (its a simple swap function using the sortid field)
	if ($_GET['SWAPPIX'] == 1) {

		$sid1 = Csec::sanitizer($_GET['ID'], 'int');
		$sid2 = Csec::sanitizer($_GET['ID2'], 'int');
		
		$utility = Cprojects::getSingleton();
		
		$utility->swapFields($sid1,$sid2,Cprojects::pixtable);
		
		echo 'Finished Swapping! refresh when you go back';
		
		echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
		
		
		exit;
	}
	
	// this section is responsible for the editing legend
	if ($_GET['LEGEND'] == 1) {

		$sid1 = Csec::sanitizer($_GET['ID'], 'int');
		$text = Csec::sanitizer($_GET['TEXT'], 'string');
		
		$utility = Cprojects::getSingleton();
		
		$id['id'] = $sid1;
		$setproject['legend'] = $text;
		
		// update based on Id
		$utility->updateRecord($id, $setproject, Cprojects::pixtable);
		
		
		echo 'Finished editing! refresh when you go back';
		
		echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
		
		
		exit;
	}
	
	
	// delete a pix based on id in her table
	if ($_GET['DELETEPROJECTPIX'] == 1) {
		
		
		$utility = Cprojects::getSingleton();
		
		$id = Csec::sanitizer($_GET['ID'], 'string');
		
		// locate and delete the file itself
		$search['id'] = $id;
		$atom = $utility->searchRecords($search,Cprojects::pixtable);
		
		$result = $atom->arraysResult();
		@unlink(Csec::projectpixFolder.'/'.$result[0]['main_link']);
		@unlink(Csec::projectpixFolder.'/thumbs/'.$result[0]['main_link']);
		
		
		// locate and delete the database link to the file
		
		$utility->deleteRecordID($id,Cprojects::pixtable);
		
		$record['category'] =  $result[0]['category'];
		$record['project'] =  $result[0]['project'];
		header('Location: admin.php?EDITPROJECTPIX=1&CATEGORY='.$record['category'].'&PROJECT='.$record['project']);
		
		
		//echo "<body bgcolor=\"#ffffff\">";
		//echo "<font color='black'>";
		//echo 'done.';	
		
		//echo "<BR><BR><a href='javascript: history.go(-2)'>[Go Back]</a>";
		
		exit;
	}
	
	// initialize, find and list fully rigged ;)
	$utility = Cprojects::getSingleton();
	
	$find['project'] = Csec::sanitizer($_GET['PROJECT'], 'string');
	$find['category'] = Csec::sanitizer($_GET['CATEGORY'], 'string');
	
	
		
	$result = $utility->searchRecords($find, Cprojects::pixtable, 'sortid');
	
	$changes['DEL']['command']='EDITPROJECTPIX=1&DELETEPROJECTPIX=1';
	$changes['DEL']['style']='prompt';
	$changes['DEL']['icon']='deleteicon.jpg';
	$changes['SORT']['command']='#';
	$changes['SORT']['style']='input';
	$changes['SORT']['icon']='sorticon.jpg';
	
	$changes['LEGEND']['command']='#';
	$changes['LEGEND']['style']='legend';
	$changes['LEGEND']['icon']='editicon.jpg';
	
	if (isset($result)) {
	
		$arrayresult = $result->arraysResult();
		
		$pixheader[0] = '';
		$pixheader[1] = $arrayresult[0]['category']; 
		$pixheader[2] = '';
		$pixheader[3] = '';
		$pixheader[4] = 'Order';
		
				
		$utility->printDBatom($result, 'htmlpix', 1, $changes, $pixheader);
	
	}
	
	echo '<br><br><br>';
	
	// give them a customized option to upload
	$replacetable['UPLOADOPTIONS'] = "TYPE=PIX&CATEGORY=".$find['category']."&PROJECT=".$find['project'];
	Csec::streamer('uploader.html', $replacetable);
	
	// present a go back button
	//echo "<BR><BR><a href='javascript: history.go(-1)'>[Go Back]</a>";
	//echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
	
	echo "<BR><BR><a href='admin.php?EDITPROJECT=1&ID=".$find['project']."'>[Go Back]</a>";

	
	exit;
}


// update project pdf
if ($_GET['EDITPROJECTPDF'] == 1) {

	
	// delete a pix based on id in her table
	if ($_GET['DELETEPROJECTPDF'] == 1) {
		
		
		$utility = Cprojects::getSingleton();
		
		$id = Csec::sanitizer($_GET['ID'], 'string');
		
		// locate and delete the file itself
		$search['id'] = $id;
		$atom = $utility->searchRecords($search,Cprojects::pdftable);
		
		$result = $atom->arraysResult();
		@unlink(Csec::projectpdfFolder.'/'.$result[0]['main_link']);
				
		
		// locate and delete the database link to the file
		
		$utility->deleteRecordID($id,Cprojects::pdftable);
		
		echo "<body bgcolor=\"#ffffff\">";
		echo "<font color='black'>";
		echo 'done.';	
		
		echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
		
		exit;
	}
	
	

	$utility = Cprojects::getSingleton();

	// default entry point just present an upload form
	$find['project'] = Csec::sanitizer($_GET['PROJECT'], 'string');
	
	
	$result = $utility->searchRecords($find, Cprojects::pdftable);
	
	$changes['DEL']['command']='EDITPROJECTPDF=1&DELETEPROJECTPDF=1';
	$changes['DEL']['style']='prompt';
	$changes['DEL']['icon']='deleteicon.jpg';
	
	
	if (isset($result)) {
	
		$arrayresult = $result->arraysResult();
		
				
		$utility->printDBatom($result, 'html', 1, $changes);
	
	}
	
	
	
	$replacetable['UPLOADOPTIONS'] = "TYPE=PDF&PROJECT=".$find['project'];
	Csec::streamer('uploader.html', $replacetable);
	
	
	
	// present a go back button
	echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
	
	exit;

}




// update project pdf
if ($_GET['EDITPROJECTVIDEO'] == 1) {

	
	// delete a pix based on id in her table
	if ($_GET['DELETEPROJECTVIDEO'] == 1) {
		
		
		$utility = Cprojects::getSingleton();
		
		$id = Csec::sanitizer($_GET['ID'], 'string');
		
		// locate and delete the file itself
		$search['id'] = $id;
		$atom = $utility->searchRecords($search,Cprojects::videotable);
		
		$result = $atom->arraysResult();
		@unlink(Csec::projectvideoFolder.'/'.$result[0]['main_link']);
				
		
		// locate and delete the database link to the file
		
		$utility->deleteRecordID($id,Cprojects::videotable);
		
		echo "<body bgcolor=\"#ffffff\">";
		echo "<font color='black'>";
		echo 'done.';	
		
		echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
		
		exit;
	}
	
	

	$utility = Cprojects::getSingleton();

	// default entry point just present an upload form
	$find['project'] = Csec::sanitizer($_GET['PROJECT'], 'string');
	
	
	$result = $utility->searchRecords($find, Cprojects::videotable);
	
	$changes['DEL']['command']='EDITPROJECTVIDEO=1&DELETEPROJECTVIDEO=1';
	$changes['DEL']['style']='prompt';
	$changes['DEL']['icon']='deleteicon.jpg';
	
	
	if (isset($result)) {
	
		$arrayresult = $result->arraysResult();
		
				
		$utility->printDBatom($result, 'html', 1, $changes);
	
	}
	
	
	
	$replacetable['UPLOADOPTIONS'] = "TYPE=VIDEO&PROJECT=".$find['project'];
	Csec::streamer('uploader.html', $replacetable);
	
	
	
	// present a go back button
	echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
	
	exit;

}


// are we processing a project delete request ?
if ($_GET['DELETEPROJECT'] == 1) {

	
	$utility = Cprojects::getSingleton();
		
	$id['id'] = Csec::sanitizer($_GET['ID'], 'string');
	
	$result = $utility->deleteRecordID($id['id'], Cprojects::projectstable);
	
	$find['project']=$id['id'];
		
	$atom = $utility->searchRecords($find,Cprojects::pixtable);
		
	if (isset($atom)) {	
		$result = $atom->arraysResult();
		@unlink(Csec::projectpixFolder.'/'.$result[0]['main_link']);
		@unlink(Csec::projectpixFolder.'/thumbs/'.$result[0]['main_link']);
	
		// locate and delete the database link to the file
		
		$utility->deleteRecordID($find,Cprojects::pixtable);
	}
	
	
	
	echo "<body bgcolor=\"#ffffff\">";
	echo "<font color='black'>";
	echo 'PROJECT DELETED.';
	
	exit;
	
}



// are we processing a project name list ?
if ($_GET['EDITNAMES'] == 1) {
	
	// are we submitting a new list
	if ($_GET['EDITANAME'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
	$find['id'] = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->searchRecords($find, Cprojects::nametable);
	
	$result = $dbatom->arraysResult();

		
	$replacetable['xxx_ActionURLYYY'] = 'EDITNAMES=1&EDITNAMESUBMIT=1&ID='.$find['id'];
	$replacetable['xxx_nameYYY'] = $result[0]['name'];
	$replacetable['xxx_teamYYY'] = $result[0]['team'];
	$replacetable['xxx_ActionYYY'] = 'EDIT';
	
		
	Csec::streamer('namesform.html', $replacetable);

	
	exit;
	}
	
	
	if ($_GET['EDITNAMESUBMIT'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
	$set['name'] = Csec::sanitizer($_POST['iName'],'string');
	$set['team'] = Csec::sanitizer($_POST['iTeam'],'string');
	
	$Id['id'] = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->updateRecord($Id, $set, Cprojects::nametable);
	
	//echo 'Name Edited ! ';
	
	header('Location: admin.php?EDITNAMES=1');
	
	exit;
	}
	
	
	if ($_GET['DELETEANAME'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
		
	$Id = Csec::sanitizer($_GET['ID'],'int');
	
	$dbatom = $utility->deleteRecordID($Id, Cprojects::nametable);
	
	echo 'Name Deleted ! ';
	
	
	exit;
	}
	
	
	if ($_GET['ADDANAME'] == 1) {
	
	$utility = Cprojects::getSingleton();
	
		
	$add['name'] = Csec::sanitizer($_POST['iName'],'string');
	$add['team'] = Csec::sanitizer($_POST['iTeam'],'string');
	
		
	if ($add['name'] != "") $utility->addRecord( $add , Cprojects::nametable);
	
	//echo 'Name Added ! ';
	header('Location: admin.php?EDITNAMES=1');
	
	exit;
	}
	
	
	
	$utility = Cprojects::getSingleton();
	
	$project2 = null;
	
	$dbatom = $utility->searchRecords($project2, Cprojects::nametable);
					
	$changes['EDIT']['command']='EDITNAMES=1&EDITANAME=1';
	$changes['EDIT']['style']='normal';
	$changes['EDIT']['icon']='editicon.jpg';
	$changes['DEL']['command']='EDITNAMES=1&DELETEANAME=1';
	$changes['DEL']['style']='prompt';
	$changes['DEL']['icon']='deleteicon.jpg';  
	
	
	$utility->printDBatom($dbatom , 'html', 1, $changes, $utility->nameheader);
	
	
	echo '<center><form method="post" action="admin.php?EDITNAMES=1&ADDANAME=1" name="form1" target="_self" id="form1">

	<input type="text" name="iName" size="50"  value="">
	
	<select id="iTeam" name="iTeam">
        <option>Client</option>
        <option>Authorship</option>
        <option>Associates</option>
	<option>Architects</option>
	<option>Engineers</option>
	<option>Designers</option>
	<option>Lighting</option>
	<option>Materials</option>
	<option>Sustainability</option>
	<option>3d</option>
       	</select>
	
	<input type="submit" name="Submit" value="ADD">
	</form></center>';
	
	
	
	
	exit;
}








// this section is responsible for the press pix section
if ($_GET['EDITPRESSPIX'] == 1) {

	
	// delete a pix based on id in her table
	if ($_GET['DELETEPRESSPIX'] == 1) {
		
		
		$utility = Cprojects::getSingleton();
		
		$id = Csec::sanitizer($_GET['ID'], 'string');
		
		// locate and delete the file itself
		$search['id'] = $id;
		$atom = $utility->searchRecords($search,Cprojects::presstable);
		
		$result = $atom->arraysResult();
		@unlink(Csec::projectpixFolder.'/'.$result[0]['image_link']);
				
		
		// locate and delete the database link to the file
		$find['id']= $id;
		$set['image_link'] = "";
		
		$utility->updateRecord($find, $set, Cprojects::presstable);
		
		echo "<body bgcolor=\"#ffffff\">";
		echo "<font color='black'>";
		echo 'done.';	
		
		echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
		
		exit;
	}
	
	

	$utility = Cprojects::getSingleton();

	// default entry point just present an upload form
	$find['id'] = Csec::sanitizer($_GET['ID'], 'string');
	
	$result = $utility->searchRecords($find, Cprojects::presstable);
	
	$changes['DEL']['command']='EDITPRESSPIX=1&DELETEPRESSPIX=1&ID='.$find['id'];
	$changes['DEL']['style']='prompt';
	$changes['DEL']['icon']='deleteicon.jpg';
	
	
	if (isset($result)) {
	
		$arrayresult = $result->arraysResult();
		
		if ($arrayresult[0]['image_link']) $utility->printDBatom($result, 'html', 1, $changes);
	
	}
	
	
	
	$replacetable['UPLOADOPTIONS'] = "TYPE=PRESS&ID=".$find['id'];
	Csec::streamer('uploader.html', $replacetable);
	
	
	echo '<br><b>Recommend image size for press : Width:330+ Height:117 <b>';
	// present a go back button
	echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
	
	exit;

}


// this section is responsible for the publications pix section
if ($_GET['EDITPUBSPIX'] == 1) {

	
	// delete a pix based on id in her table
	if ($_GET['DELETEPUBSPIX'] == 1) {
		
		
		$utility = Cprojects::getSingleton();
		
		$id = Csec::sanitizer($_GET['ID'], 'string');
		
		// locate and delete the file itself
		$search['id'] = $id;
		$atom = $utility->searchRecords($search,Cprojects::publicationtable);
		
		$result = $atom->arraysResult();
		@unlink(Csec::projectpixFolder.'/'.$result[0]['image_link']);
				
		
		// locate and delete the database link to the file
		$find['id']= $id;
		$set['image_link'] = "";
		
		$utility->updateRecord($find, $set, Cprojects::publicationtable);
		
		echo "<body bgcolor=\"#ffffff\">";
		echo "<font color='black'>";
		echo 'done.';	
		
		echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
		
		exit;
	}
	
	

	$utility = Cprojects::getSingleton();

	// default entry point just present an upload form
	$find['id'] = Csec::sanitizer($_GET['ID'], 'string');
	
	$result = $utility->searchRecords($find, Cprojects::publicationtable);
	
	$changes['DEL']['command']='EDITPUBSPIX=1&DELETEPUBSPIX=1&ID='.$find['id'];
	$changes['DEL']['style']='prompt';
	$changes['DEL']['icon']='deleteicon.jpg';
	
	
	if (isset($result)) {
	
		$arrayresult = $result->arraysResult();
		
		if ($arrayresult[0]['image_link']) $utility->printDBatom($result, 'html', 1, $changes);
	
	}
	
	
	
	$replacetable['UPLOADOPTIONS'] = "TYPE=PUBS&ID=".$find['id'];
	Csec::streamer('uploader.html', $replacetable);
	
	
	
	// present a go back button
	echo "<BR><BR><a href='".$_SERVER['HTTP_REFERER']."'>[Go Back]</a>";
	
	exit;

}




// are we processing a moderator edit request?
if ($_GET['EDITMOD'] == 1) {
		
	// are we updating it with a form submit?
	if ($_GET['EDITMODSUBMIT'] == 1) {
		
		$utility = new Csec();
	
		// get the new form data using post
		$newmod['username'] = $_POST['iUsername'];
		$newmod['password'] = $_POST['iPassword'];
		$newmod['email'] = $_POST['iEmail'];
		
		// and submit them
		// note setL2moderator() sanitizes data internally
		$utility->setL2moderator($newmod);
		
		echo "<body bgcolor=\"#ffffff\">";
		echo "<font color='black'>";
		echo 'done.';		
		exit;
	}
	
	$utility = new Csec();
	
	$result = $utility->getL2moderator();
		
	// open up modform.html, processing it for ad/find/edit
	$replacetable['xxx_UsernameYYY'] = $result['username'];
	$replacetable['xxx_PasswordYYY'] = $result['password'];
	$replacetable['xxx_EmailYYY'] = $result['email'];
		
	// and stream it
	Csec::streamer('modform.html', $replacetable);
		
	exit;
}

// did we receive a logout parameter request?
// if so delete the cookie and present the logout screeen
if ($_GET['LOGOUT'] == 1) {
	
	$utility = new Csec();
	
	$utility->logmeOut();
	
	Csec::rawStreamer('logout.html');
	
	exit;
		
	
}


// to reach this section, it means that the client has a valid cookie and it not specify any paramenters
// so we present him with a welcome frameset ;)

Csec::rawStreamer('frameset.html');	

?>
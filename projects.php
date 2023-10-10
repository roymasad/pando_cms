<?php

// Coding by Roy Massaad

// PandoCMS 2012, Copyright Roy Massaad
// www.roymassaad.com

// php file responsible for the projects page

$page['name'] = Csec::sanitizer($_GET['PROJECT'], 'string');


echo '<div >';
	
	// warm up the framework
	$utility = Cprojects::getSingleton();
		
	$dbatom = $utility->searchRecords($page, Cprojects::projectstable);
	
	
	$projectresult = $dbatom->arraysResult();
	
	
	$find['project']= $projectresult [0]['id'];
	
	$find2['project']= $find['project'];  
	
	// sort image tabs by categories who have the most images in them first
	$ImgList = array();
	

	$find2['category'] = "images";
	$dbatom = $utility->searchRecords($find2, Cprojects::pixtable);
	if (isset($dbatom)) $ImgList['images'] = count($dbatom->DBarray); //else $ImgList['images'] = 0;
	
	
	$find2['category'] = "site";
	$dbatom = $utility->searchRecords($find2, Cprojects::pixtable);
	if (isset($dbatom)) $ImgList['site'] = count($dbatom->DBarray); //else $ImgList['site'] = 0;
	
	$find2['category'] = "sketches";
	$dbatom = $utility->searchRecords($find2, Cprojects::pixtable);
	if (isset($dbatom)) $ImgList['sketches'] = count($dbatom->DBarray); //else $ImgList['sketches'] = 0;

	//array_multisort($ImgList, SORT_ASC);
	
	function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? 1 : -1;
	}
	
		
	
	// test and see if the project has data in the images/animation sections
	
	if ($_GET['CATEGORY']) $find['category'] = Csec::sanitizer($_GET['CATEGORY'], 'string');
	//else $find['category'] = "images";
	else $find['category'] = reset(array_keys($ImgList));
	
	
	
	// if you find a section, display its contents
	// in the case of the image sections, we set up coinslider
	if ($find['category'] != 'animation') {
		$dbatom = $utility->searchRecords($find, Cprojects::pixtable, 'sortid');
		
		
		if (isset($dbatom)) $pixresult = $dbatom->arraysResult();
		else $pixresult = null;
		
		
		echo '<ul class="projectinfo" style="padding:0px; margin:0px">';
		
		echo '<li class="projectinfo" style="list-style:none; width:1240px !important;">';
		echo '<div id="coin-slider" >';
		
		
		if ($pixresult) {
			foreach ($pixresult as $kk) {
			
				$extra = null;
				$mainbits = null;
				$extrabits = null;
				
				
				
				foreach ($kk as $k => $v) {
				
				
			
				if (($k =='legend') && ($v != null)) $extrabits = '<span>'.$v.'</span>';
				if (($k =='legend') && ($v == null)) $extrabits = '<span>&nbsp;</span>';
				
				if ($k =='main_link') $mainbits = '<img title="" alt="architecture beirut lebanon" src="'.Csec::projectpixFolder.$v.'" >';
				
				}
				
				$extra = $mainbits . $extrabits;
				
				echo $extra;
			
			}
		}
		
		echo '<div id="dummy" ></div>';
		echo '</div>';
		
		
		echo '</li>';
	
	}
	
	// in the case of the image sections, we set up flowplayer
	if ($find['category'] == 'animation') {
	
	
	$find33['project'] = $find['project'];
	$dbatom = $utility->searchRecords($find33, Cprojects::videotable);
	if (isset($dbatom)) {
	
	$pdfresult = $dbatom->arraysResult();
	
		echo '<li class="projectinfo">';
		
		if ($_GET['video']) $replacetable['xxx_videonameYYY']=Csec::projectvideoFolder.Csec::sanitizer($_GET['video'], 'string');
		
		else $replacetable['xxx_videonameYYY']=Csec::projectvideoFolder.$pdfresult[0]['main_link'];
		
		Csec::streamer('player.html', $replacetable);

		echo '</li>';
	
	}
	echo '</ul>';
	
	$counter = 1;
	foreach ( $pdfresult as $vid) {
	
	echo '<div style="float:left; padding-left:10px;"><a href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=animation&amp;video='.$vid['main_link'].'">'.$counter.'</a></div>';
	
	
	$counter++;
	
	}
	echo '<br>';
	
	
	
	}
		

	// we set up the matching submenu buttons under the images/videos for the relevant available groups
	// we also set up bold selection logic and space and such
	echo '<li style="float:left;padding:5px; list-style:none" ><div style="float:left;padding:0px;"><ul style="position:relative; left:3px; padding:0px; margin:0px">';
	
		
	foreach ($ImgList as $key => $value) {

		$find2['category'] = "images";
		$dbatom = $utility->searchRecords($find2, Cprojects::pixtable);
		if (isset($dbatom) && $key == "images") {
		
			if ($find['category'] == 'images') echo '<li class="menui" style="border-right:none"><b><a class="menu33" href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=images">IMAGES</a></b></li>';
		
			else echo '<li class="menui" style="border-right:none; width:63px; left:-8px;"><a class="menu33" href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=images">IMAGES</a></li>';
			
			
		
		}
	
	
	}
	
	foreach ($ImgList as $key => $value) {
	

		
		$find2['category'] = "sketches";
		$dbatom = $utility->searchRecords($find2, Cprojects::pixtable);
		if (isset($dbatom) && $key == "sketches") {

			if ($find['category'] == 'sketches') echo '<li class="menui" style="border-right:none"><b><a class="menu33" href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=sketches" >SKETCHES</a></b></li>';
			
			else echo '<li class="menui" style="border-right:none; width:75px"><a class="menu33" href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=sketches" >SKETCHES</a></li>';
			
			
			
		}
		
		
		$find2['category'] = "site";
		$dbatom = $utility->searchRecords($find2, Cprojects::pixtable);
		if (isset($dbatom) && $key == "site") {
		
			if ($find['category'] == 'site') echo '<li class="menui" style="border-right:none"><b><a class="menu33" href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=site">SITE</a></b></li>';
			
			else echo '<li class="menui" style="border-right:none; width:38px"><a class="menu33" href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=site">SITE</a></li>';
			
			
			
		}
		


	}
	
	
	$find3['project'] = $find['project'];
	$dbatom = $utility->searchRecords($find3, Cprojects::videotable);
	if (isset($dbatom)) {
	
	$pdfresult = $dbatom->arraysResult();
	
		if ($find['category'] == 'animation') echo '<li class="menui" style="border-right:none"><b><a class="menu33" href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=animation">ANIMATION</a></b></li>';
	
		else echo '<li class="menui" style="border-right:none; width:81px"><a class="menu33" href="index.php?PROJECT='.$page['name'].'&amp;CATEGORY=animation">ANIMATION</a></li>';

	
	}
	

	$find3['project'] = $find['project'];
	$dbatom = $utility->searchRecords($find3, Cprojects::pdftable);
	if (isset($dbatom)) {
	
	$pdfresult = $dbatom->arraysResult();
	
		echo '<li class="menui" style="border-right:none; width:34px"><a class="menu33" href="'.Csec::projectpdfFolder.$pdfresult[0]['main_link'].'">PDF</a></li>';
	
	}
	
	
	
	echo '</ul></div></li>';
	
	
	
	// here we setup the layout to display the data of the project
	// from general info to collapsable details
	echo '<li style="position: absolute; width:550;  left:0px; list-style:none; margin-top:20px;">';
	

	echo '<ul class="projectinfo" style="padding:0px; margin:0px;">';
	echo '<li class="projectinfo" style="position:relative ; top:0px"><font style="font-size:12px">';
	echo '<b>'.$projectresult [0]['name'].'</b>-';
	for ($i = 0; $i < $projectresult [0]['ranking']; $i++) { echo '<font color=black>*</font>'; }
	for ($i = 0; $i < 5-$projectresult [0]['ranking']; $i++) { echo '<font color=#CCCCCC>*</font>'; }
	echo '-'.$projectresult [0]['project_year'].'-';
	
	if ($projectresult [0]['grid'] == 0) echo $projectresult [0]['area'].'m2-'; else echo $projectresult [0]['volume'].'-';
	
	echo $projectresult [0]['cost'].'$-'.$projectresult [0]['type'];
	
	
	echo '</font></li>';
	echo '<li class="projectinfo" style="position:relative ; top:-10px"><font style="font-size:12px">';
	echo '<b>Description:</b> '. $projectresult [0]['description'];
	echo '</font></li>';
	echo '</ul>';
	
	
	
	echo '<div style="width:1000px; position:relative ; top:-10px" id="clickmore"> <font id="detailsid" lang="bold" style="padding:10px; font-family: Verdana; font-size:12; font-weight:bold;">Details..</font> <br>';
	
	echo '<div id="clickmoreinfo">';
	
	echo '<ul style="padding-left:0px">';
	

	
	if ($projectresult [0]['website']) {
	echo '<li style="float:none ; width:300px ;" class="projectinfo2">';
	echo '<b>Website &nbsp; : &nbsp;<a style="top:0px !important;" target="_blank" href="http://'.$projectresult [0]['website'].'">'.$projectresult [0]['website'].'</a></b>';
	echo '</li>'; }
	
	echo '</ul>';
	
	echo '<ul style="padding-left:0px">';


	echo '<li class="projectinfo2">';
	echo '<b>FAVORITE&nbsp;</b> ';
	
	for ($i = 0; $i < $projectresult [0]['ranking']; $i++) { echo '<font color=black>*</font>'; }
	for ($i = 0; $i < 5-$projectresult [0]['ranking']; $i++) { echo '<font color=#CCCCCC>*</font>'; }
	
	echo '</li>';
	
	echo '<li class="projectinfo2">';
	echo '<b>YEAR &nbsp;</b> '. $projectresult [0]['project_year'];
	echo '</li>';
	
	echo '<li class="projectinfo2">';
	echo '<b>COMPLETION YEAR &nbsp;</b> '. $projectresult [0]['completion_year'];
	echo '</li>';
	
	echo '<li class="projectinfo2">';
	echo '<b>COST &nbsp;</b> '. $projectresult [0]['cost'];
	echo '</li>';
	
	echo '<li class="projectinfo2">';
	echo '<b>TYPE &nbsp;</b> '. $projectresult [0]['type'];
	echo '</li>';
	
	if ($projectresult [0]['grid'] == 0)
	{
	echo '<li class="projectinfo2">';
	echo '<b>SIZE &nbsp;</b> '. $projectresult [0]['area'].'m2';
	echo '</li>';
	}
	else
	{
	echo '<li class="projectinfo2">';
	echo '<b>SIZE &nbsp;</b> '. $projectresult [0]['area'].'m2';
	echo '</li>';
	}
	
	
	
	echo '<li class="projectinfo2" >';
	echo '<b>CLIENT NAME &nbsp;</b> '. $projectresult [0]['client'];
	echo '</li>';
	
	echo '<li class="projectinfo2" style="float:none;"></li>';
	
	echo '</ul>';
	
	echo '<ul style="width:50px; list-style:none;"><li>&nbsp;</li></ul>';
	
	echo '<ul style="width:900px; position:relative ; top:-20px" ><li style="width:50px; float:none;" class="projectinfo2"><b>TEAM</b></li>';
	
	
	if ($projectresult [0]['architects']) {
	echo '<li class="projectinfo3">';
	echo '<b>ARCHITECTS &nbsp;</b> '. $projectresult [0]['architects'];
	echo '</li>';}
	
	if ($projectresult [0]['engineers']) {
	echo '<li class="projectinfo3">';
	echo '<b>ENGINEERS &nbsp;</b> '. $projectresult [0]['engineers'];
	echo '</li>';}
	
	
	if ($projectresult [0]['3d']) {
	echo '<li class="projectinfo3">';
	echo '<b>3D &nbsp;</b> '. $projectresult [0]['3d'];
	echo '</li>';}
	
	echo '</ul>';
	

	
	echo '</div>';

	echo '</div>';
	
	
	echo '</li>';
	echo '</ul>';
	
	$find= null;
	
	$dbatom = $utility->searchRecords($find, Cprojects::settingtable);
	
	$gridresult = $dbatom->arraysResult();
		
	// and we set up the javascript jquery code for the animation/selection
	// special note taking to the trick used to keep tab of the bold/normal status of the 'detail's button by saving this data in the lang attribute of a font tag
	echo '<script type="text/javascript">
	$(document).ready(function() {
	$("#coin-slider").coinslider( { spw: 1, sph: 1, height:'.$gridresult[0]['image_height'].' } );
	$("#clickmoreinfo").slideToggle(0);
	});
	
	$("#clickmore").click(function() {
	  $("#clickmoreinfo").slideToggle("slow");
	  
	  
	  if ($("#detailsid").attr("lang")=="bold") {$("#detailsid").attr("style", "padding:10px; font-family: Verdana; font-size:12; font-weight:normal;"); $("#detailsid").attr("lang", "normal");}
	  else {$("#detailsid").attr("style", "padding:10px; font-family: Verdana; font-size:12; font-weight:bold;"); $("#detailsid").attr("lang", "bold");}
	});
		
	
	
	$("#clickmore").hover(function() {

	$(this).css("cursor","pointer");
	}, function() {
	$(this).css("cursor","auto");
	});
	
	
	
	</script>';
		
	
	
		
echo '</div>';





?>
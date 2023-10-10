<?php
//// Cprojects class include file ////

// !!Protect all framework files with Zend Guard enconding & obfuscation b4 deploying online!!

// Coding by Roy Massaad

// PandoCMS 2012, Copyright Roy Massaad
// www.roymassaad.com

// contains classes Cprojects that inherits from Cinvenroty

// Summary of Class methods API
//		__construct()
//		__destruct()
//		getSingleton()
//		searchRecords()
// 		printDBatom()
//		addRecord()
//		deleteRecord()
//		deleteRecordID()
//		updateRecord()



require_once 'php/Cinventory.php';

require_once 'php/Csecurity.php';


// Class Cstores, deals with the database of stores and its tables
// it manipulates the data in the database and gives back control to the caller system, 
// usually a parameter parsing system higher up (with user forms and such..)
class Cprojects extends Cinventory {
	
		// list of constants that this class houses
		const projectstable = 'projects';
		const pixtable = 'images';
		const nametable = 'names';
		const pagetable = 'pages';
		const settingtable = 'settings';
		const pdftable = 'pdfs';
		const videotable = 'videos';
		const presstable = 'press';
		const publicationtable = 'publications';
		
		public $projectheader = array();
		public $nameheader = array();

						
		// this static variable keeps track of the unique class instance
		private static $instance = null;
		
		// the contrustor, will enforce SINGLETON model
		// BECAUSE IT IS PRIVATE, it's UNCALLABLE with new()
		private function __construct() 
		{  
			// these are the built in headers used for displaying the relavant table headers on printDBatom function calls
			// ps there order is important
			$this->projectheader[0] = 'Nb';
			$this->projectheader[1] = '';
			$this->projectheader[2] = '';
			$this->projectheader[3] = 'Name';
			$this->projectheader[4] = 'Desc';
			$this->projectheader[5] = 'Type';
			$this->projectheader[6] = 'Size';
			$this->projectheader[8] = 'compYear';
			$this->projectheader[9] = 'Cost';
			$this->projectheader[10] = 'Rank';
			$this->projectheader[11] = 'Client';
			$this->projectheader[15] = 'Archs';
			$this->projectheader[16] = 'Enginr';
			$this->projectheader[22] = '';
			$this->projectheader[23] = '';
			$this->projectheader[24] = '';
			$this->projectheader[25] = '';
			$this->projectheader[26] = '';
			$this->projectheader[27] = '';
			$this->projectheader[28] = '';
			$this->projectheader[29] = '';
			$this->projectheader[30] = '';
			$this->projectheader[31] = '';
			$this->projectheader[32] = '';
			$this->projectheader[33] = 'S';
			$this->projectheader[34] = 'L';
			$this->projectheader[35] = 'URL';
			$this->projectheader[35] = 'GRID';
	
			$this->nameheader[0] = 'Nb';

		
		}
		
		// deconstructor, works to complement the singleton rule
		// clear instance variable on destroy
		public function __destruct() { self::$instance = null; }
		
		
		// this static class function is responsible for creating the singleton instance
		// since the default constructor isnt callable cuz we set it to private.
		public static function getSingleton() {
			
			// create a new singleton only if the class static instance variable is null
			if (self::$instance == null) {
				
				self::$instance = new Cprojects ();
				
				return self::$instance;
				
			}
			
		}


		// this function is responsbile for swapping field values between rows (used to provide simple image sorting capabilies)
		public function swapFields($sortid1,$sortid2,$table) {
		
			
			$DButility = new Csec();
			
			try { $DButility->DBconnector(Csec::defaultDBhost, Csec::defaultDBuser , Csec::defaultDBpass , Csec::defaultDBdatabse ); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
 			
 			$DButility->DBresult = mysqli_query($DButility->DBhandle, 'UPDATE '.$table.' SET sortid = -1 WHERE sortid = '.$sortid2);
 				
 			$DButility->DBresult = mysqli_query($DButility->DBhandle, 'UPDATE '.$table.' SET sortid = '.$sortid2.' WHERE sortid = '.$sortid1);
			$DButility->DBresult = mysqli_query($DButility->DBhandle, 'UPDATE '.$table.' SET sortid = '.$sortid1.' WHERE sortid = -1');
			
  			
 			//echo 'done swapping';
		
			return;
		}



		// Stores searcher
		// this functions gets passed a 1D dbatom argument as a search criteria
		// it returns an indexed list of found 2d dbatom elements or null.
		// if u want to READ a single record in database, USE THIS ALSO.
		// if u want to read everything in the table, pass an empty array/variable.
		// the second argument defines with subsection to look in
		
		// the similar paramater allows you to to a 'like' sql search, instead of the default 'is' search
		public function searchRecords($dbatom_arg, $table, $sortby = 'id', $similar='false', $orderas= 'ASC') {
		
			// new utility function for connecting to the database
			$DButility = new Csec();
			
			
			// connect with the guest read only settings
			try { $DButility->DBconnector(Csec::defaultDBhost, Csec::defaultDBuser , Csec::defaultDBpass , Csec::defaultDBdatabse ); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
 				
 			 				
 			// do a select-from-where (search basically)
 			$sql = 'select * from '.$table.' where';
 			
 			// if $dbatom has any search criteria, parse them
			// if not (else) just select everything
			if (isset($dbatom_arg)) {
			
			// now we are gonna concatenate the search criteria strings using $sql2
			foreach ($dbatom_arg as $key => $value) {
				
							if (($key == 'name' && $table_arg == 'projects') || ($similar=='true'))
							{$sql2 = $sql2.' '.$key.' like '."'%".$value."%' and";}
							else
							{$sql2 = $sql2.' '.$key.' = '."'".$value."' and";}
			}
			
			// we take off the last trailing 'and'
			$sql2 = substr( $sql2, 0, strlen($sql2)-3 );
			
			// and we append them to the original $sql select template
			// in essence by now we should have a normal but procedurally generated select statement
			// that reflects the search criteria that was passed on by the parameters
			$sql = $sql.$sql2;
			
			} else $sql = 'select * from '.$table; // // if else just select everything
			
			$sql = $sql.' order by '.$sortby.' '.$orderas;
			

			// do a query now
			$DButility->DBresult = mysqli_query($DButility->DBhandle, $sql); //or die(mysql_error());  
			
			// check for result nb
			$rows = mysqli_num_rows($DButility->DBresult);	
  			
  
  		// if we got results move on
  		if ($rows) {
		
  			
  			// create a new atom object that we are gonna return
  			$result = new DBatom();
  			
  			// fetch the results one record at a time and append them to the dbatom object list
  			while($record = mysqli_fetch_array($DButility->DBresult, MYSQLI_ASSOC)) {
  			
  				$result->addRecord($record);
  			
  			}
  			
  			// finally return a result
  			return $result;
  			
  		}
			
			// if the function finds nothing it will return a null
			
		}
		
		// used to dynamically populate an html dropbox with group names of types of projects
		public static function htmlnamedropbox( $mode='default') {
			
				
				
				if ($mode=='types') {
				
					if (self::$instance == null) $utility = Cprojects::getSingleton();
					else $utility = self::$instance;
					
					$find= null;
					
					$result = '<option>-----------------</option>';
					
					$dbatom = $utility->searchRecords($find, Cprojects::settingtable);
					
					$gridresult = $dbatom->arraysResult();
	
					$sort_chunks = explode(',' , $gridresult [0]['sort_type']);
				
					foreach ($sort_chunks as $chunk) {
					
						$result .= '<option>'.$chunk.'</option>';
					}
				
				
					return $result;
				}
				
				if (self::$instance == null) $utility = Cprojects::getSingleton();
				else $utility = self::$instance;
					
				if ($mode=='default') $find = null;
				else $find['team'] = $mode;
				
				
				
				$result = '<option>----------------------------------</option>';
	
				$dbatom = $utility->searchRecords($find, Cprojects::nametable);				
				
				if (isset($dbatom)) {
				
					foreach ($dbatom->arraysResult() as $kk ) {
					
					foreach ($kk as $k => $v) {
							
							if ($k=='name') $result .= '<option>'.$v.'</option>';
							
						}
					
					
					}
				
					
				}
				
				return $result;
				
				
				
				
		}
		
		
		
		// this function will echo the contents of DBatom list
		// first option specifies the format, 1=raw, 2=html table, 3=flash readable
		// second option is whether to output the index value or not.
		// other more custom class print functions could supplement this
		// $extra is used to speficy what extra edit command to embed in the html string
		// $extra two is the readable friendly name for the command
		public function printDBatom($dbatom_arg, $option, $option_i, $changes = null, $header = null, $maxfields=999) {
			
			
			// proceed only if $dbatom_arg is actually an atom object and not null (from a null search)
			if (!$dbatom_arg) return;
			
			// raw?
			if ($option == 'raw') {
				
				// loop through the 2d array
				foreach ($dbatom_arg->arraysResult() as $kk ) {
	
					// print 1 value per line in a long list
					foreach ($kk as $k => $v) {
						
						// dont print the Id field if specified not to
						if ($option_i == 0 && $k == 'id') continue;
						echo $v.'<br>';
					}
				}
				return;	
			}
			
			// html ?
			
			
			// this is used by the backend for generic display of database search results in a table format for display
			if ($option == 'html') {
				
				echo '<script src="javascripts/sorttable.js" type="text/javascript"></script>';
				
				// prepare table tags
				Csec::rawStreamer("style.css");

				
				echo "<br><br><center><table border='1' class='dbatom sortable'>";
				
				$fields = 0;
				// print passed table header
				if (isset($header)) foreach ($header as $kk) { $fields++; if ($fields > $maxfields+2) break; echo '<td style="background-color:#DDDDDD"><b>'.$kk.'</b></td>'; }
				

				$counter = null;
				
				// loop through the 2d array
				foreach ($dbatom_arg->arraysResult() as $kk ) {
					
					echo '<tr>';
					$extra = null;
					$counter++;
					$fields = 0;
					foreach ($kk as $k => $v) {
					
					
						$fields++;
						if ($fields > $maxfields) break;
						
												
						if ($k == 'id' && isset($changes)) 
						{
						echo '<td>'.$counter.'</td>'; // dont print out id field, instead prepare buttons and print a counter index first
								
								
								foreach ($changes as $arg => $val) {
								
									
									
									if ($changes[$arg]['style'] == 'prompt') $extra = $extra."<td ><b><a href='admin.php?".$val['command']."&ID=".$v."' onclick=\"return confirm('Confirm?')\"><img src='".Csec::assetsFolder.'/sitepix/'.$val['icon']."'/></a></b></td>";
									
									else $extra = $extra."<td ><b><a href='admin.php?".$val['command']."&ID=".$v."'><img src='".Csec::assetsFolder.'/sitepix/'.$val['icon']."'/></a></b></td>";
									
								}
								echo $extra;
								
						} else echo '<td style="background-color:#EEEEEE">'.$v.'</td>';
					}
					
					
					echo '</tr>';
				}
				
				echo '</table></center>';
				return;	
			}
			
			
			
			// this section will output simple mini thumbs of project images (used in the backend UI with category for display)
			// this is used by the backend
			if ($option == 'htmlpixmini') {
			
				$result = '<div>';
				
				foreach ($dbatom_arg->arraysResult() as $kk ) {

				$result .= '<img style="float:left; padding:5px; height:40px" src="'.Csec::projectpixFolder.'thumbs/'.$kk['main_link'].'">';	
					
				}
				
				$result .= '</div>';
				
				return $result;	
				
			}
			
			
			
			
			// this section will produce the image listing boxes with optional commands (such as delete/add/etc)
			// $changes defines what are the optional dynamic commands to generate
			// this is used by the backend
			if ($option == 'htmlpix') {
				

				
				// prepare table tags
				Csec::rawStreamer("style.css");

				
				echo "<br><br><center><table border=\"1\" class=\"dbatom\">";

				// print passed table header
				foreach ($header as $kk) echo '<td style="background-color:#DDDDDD"><b>'.$kk.'</b></td>';
				

				$counter = null;
				
				// loop through the 2d array
				foreach ($dbatom_arg->arraysResult() as $kk ) {
					
					echo '<tr>';
					$extra = null;
					$counter++;
					foreach ($kk as $k => $v) {
						
												
						if ($k == 'id' && isset($changes)) 
						{
						echo '<td>'.$counter.'</td>'; // dont print out id field, instead prepare buttons and print a counter index first
								
								
								foreach ($changes as $arg => $val) {
								
									
									if ($changes[$arg]['style'] == 'legend') $extra = $extra."<td ><b><a href='".$val['command']."' onclick='editLegend(".$v.")'><img src='".Csec::assetsFolder.'/sitepix/'.$val['icon']."'/></a></b></td>";
									
									elseif ($changes[$arg]['style'] == 'prompt') $extra = $extra."<td ><b><a href='admin.php?".$val['command']."&ID=".$v."' onclick=\"return confirm('Confirm?')\"><img src='".Csec::assetsFolder.'/sitepix/'.$val['icon']."'/></a></b></td>";
									
									elseif ($changes[$arg]['style'] != 'input') $extra = $extra."<td ><b><a href='admin.php?".$val['command']."&ID=".$v."'><img src='".Csec::assetsFolder.'/sitepix/'.$val['icon']."'/></a></b></td>";
								}
								
								
						} 
						
						elseif ($k == 'sortid' && isset($changes))  {
						
							foreach ($changes as $arg => $val) {
							
							if ($changes[$arg]['style'] == 'input') $extra = $extra."<td ><b><a href='".$val['command']."' onclick='swapSid(".$v.")'><img src='".Csec::assetsFolder.'/sitepix/'.$val['icon']."'/></a></b></td>";
							
							else echo '<td style="background-color:#EEEEEE">'.$v.'</td>';
							
							}
						
						}
						
						
						
						else  { 
							
							if ($k == 'main_link') echo '<td style="background-color:#EEEEEE; max-width: 175px;"><img src='.Csec::projectpixFolder.'thumbs/'.$v.' ></td>';
							else echo '<td style="background-color:#EEEEEE">'.$v.'</td>';
						
						
							}
					}
					
					echo $extra;
					echo '</tr>';
				}
				
				echo '</table></center>';
				
				echo '<script type="text/javascript">
				function swapSid( id1) {
					
				  	var id2 = prompt("swap with which Sort Id?");
				  	if (id2 == null) return;
				  	self.location="admin.php?EDITPROJECTPIX=1&SWAPPIX=1&ID="+id1+"&ID2="+id2; 
					
				}
				
				function editLegend( id1) {
					
				  	var TEXT = prompt("Enter New Legend Text");
				  	if (TEXT == null) return;
				  	self.location="admin.php?EDITPROJECTPIX=1&LEGEND=1&ID="+id1+"&TEXT="+TEXT; 
					
				}
				
				
				</script>';
				
				
				return;	
			}
			
			
			// this section is responsible for generating the small ifram press widget for the frontend
			if ($option == 'htmlpress') {
			
				$counter = 0;
				
				$newresult = array_reverse($dbatom_arg->arraysResult());
				
				echo '<ul style="list-style: none; padding:0px; margin:0px; border:0px; display: inline">';
				foreach ($newresult as $kk ) {
				
				$counter += 1;
				
				echo '<li class="newsfeed" style="border:0px ; padding:0px; margin:0px; ">';
				echo '<ul style="list-style: none; padding:0px; margin:0px; display: inline">';
				echo '<li style="margin-right:10px; display: inline"><div style="width: 330px; height: auto; overflow: hidden;">';
				if ($kk['hyper_link']) echo '<a style="text-decoration:none; color:black" target="_blank" href="http://'.$kk['hyper_link'].'">';
				else echo '<a style="text-decoration:none; color:black">';
				echo '<img style="width:330px; " src="pix/'.$kk['image_link'].'"></div></li>';
				echo '</a>';
				echo '<li style="margin-right:10px; font-size:12;width:330px;"><b>'.$kk['title'].'</b></li>';
				echo '<li style="margin-right:10px; font-size:12;">'.$kk['date'].'</li>';
				echo '</ul>';
				
				echo '<ul style="list-style: none; padding:0px; margin:0px;">';
				//echo '<br> <li style="margin-right:10px; padding-bottom:10px; min-height:75px;">'.$kk['info'].'</li>';
				echo '<br> <li style="margin-right:10px; padding-bottom:0px; min-height:0px;">'.'</li>';
				
				echo '</ul>';
				echo '</li>';
				
				if ($counter >=10) break;
				
				}
				echo '<ul>';
				
				
				
				echo '
				
				<script>
					var i = window.setInterval( function(){ 
							  

							
							var last = $(".newsfeed:last");
							last.prependTo(last.parent());
							
							var first = $(".newsfeed:first");
							first.css("opacity","0");
							first.css("margin-top","-200");
							
							
							first.animate({
								opacity: 1,
								"margin-top": 0,
							  }, 500, function() {
								// Animation complete.
							});
							
							  
							  
					 }, 10000 );
				
				</script>
				';
			
			}
			
			// and this section is responsible for generating the full page press section for the frontend
			if ($option == 'htmlpressW') {
			
						
				if ($changes == "DESC")	$newresult = array_reverse($dbatom_arg->arraysResult());
				else $newresult = $dbatom_arg->arraysResult();
				
				echo '<ul style="list-style: none; padding:0px; margin:0px; border:0px; width: 560px;">';
				foreach ($newresult as $kk ) {
				
				echo '<li style="border-bottom:0px grey solid; padding:0px; margin:0px; ">';
				
				echo '<ul style="list-style: none; padding:0px; margin:0px;">';
				echo '<li style="margin-right:10px; font-size:12;">'.$kk['date'].'</li>';
				echo '<li style="margin-right:10px; font-size:12;"><b>'.$kk['title'].'</b></li>';
				
				echo '<li style=" margin-right:10px; margin-top:10px"><div >';
				
				if ($kk['hyper_link']) echo '<a style="text-decoration:none; color:black" target="_blank" href="http://'.$kk['hyper_link'].'">';
				else echo '<a style="text-decoration:none; color:black">';
				echo '<img style=" height:300px;" src="pix/'.$kk['image_link'].'"></div></li>';
				echo '</a>';
				
				echo '</ul>';
				
				echo '<ul style="list-style: none; padding:0px; margin:0px;">';
				echo '<li style="margin-right:10px; padding-bottom:20px; ">'.$kk['info'].'</li>';
				echo '</ul>';
				
				echo '</li>';
				
				}
				echo '<ul>';
			
			}
			
			// and this section generates the publications section on the frontend with proper layour
			if ($option == 'htmlpubs') {
			
					
				if ($changes == "DESC")	$newresult = array_reverse($dbatom_arg->arraysResult());
				else $newresult = $dbatom_arg->arraysResult();
				
				
				echo '<ul style="list-style: none; padding:0px; margin:0px; margin-left:-30px; ">';
				foreach ($newresult as $kk ) {
				
				echo '<li style="float:left; padding-right:50px; padding-left:0px;">';
				echo '<a style="text-decoration:none; color:black" target="_blank" href="'.$kk['hyper_link'].'">';
				echo '<ul style="list-style: none;">';
				echo '<li><img style="float:left;" src="pix/'.$kk['image_link'].'"></li>';
				echo '<li style="font-size:12;"><center><b>'.$kk['info'].'</b><br>'.$kk['date'].'</center></li>';
				
				
				echo '</ul>';
				echo '</a>';
				echo '</li>';
				}
				echo '<ul>';
			
			}
			
			
			
		}
				
		// stores adder
		// this function adds the associative array record_arg into the database dllink
		// this is the generic adder. other custom ones supplement it
		public function addRecord($record_arg, $table) {
			
			// new utility function for connecting to the database
			$DButility = new Csec();
			
			// connect with the guest read write settings
			try { $DButility->DBconnector(Csec::defaultDBhost, Csec::defaultDBuser, Csec::defaultDBpass, Csec::defaultDBdatabse); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
 			
 				 				
 			// do an inset into (fields) values (values)
 			// take the table name from the class constant value
 			$sql = 'insert into '.$table.' ';
			
			// now we are gonna concatenate the search criteria strings using $sql2
			foreach ($record_arg as $key => $value) {
				
							$sql2 = $sql2.$key.', ';
							
							$sql3 = $sql3."'".$value."'".', ';
			}
			
			// we take off the last trailing ', '
			$sql2 = substr( $sql2, 0, strlen($sql2)-2 );
			$sql3 = substr( $sql3, 0, strlen($sql3)-2 );
			
			// and we append them to the original $sql template
			// in essence by now we should have a normal but procedurally generated select statement
			// that reflects the search criteria that was passed on by the parameters
			$sql = $sql.'('.$sql2.') values ('.$sql3.')';
			
			// do an add 
			$DButility->DBresult = mysqli_query($DButility->DBhandle, $sql); //or die(mysql_error());  
			
			// will return false if unsuccessful
  		return $DButility->DBresult;
  			
  					
		}
		
		// this function removes sotres records from the database dllink based on dbatom
		// dbatom here is used as like a search criteria like in search()
		// this is the generic deleter. other custom ones supplement it
		public function deleteRecord($dbatom_arg, $table) {
			
			// new utility function for connecting to the database
			$DButility = new Csec();
			
			// connect with the guest read write settings
			try { $DButility->DBconnector(Csec::defaultDBhost, Csec::defaultDBuser, Csec::defaultDBpass, Csec::defaultDBdatabse); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
 				
 				
 				 				
 			// do a delete-from-where (search delete basically)
 			// take the table name from the class constant value
 			$sql = 'delete from '.$table.' where';
			
				
			// now we are gonna concatenate the search criteria strings using $sql2
			foreach ($dbatom_arg as $key => $value) {
				
							$sql2 = $sql2.' '.$key.' = '."'".$value."' and";
			}
			
			// we take off the last trailing 'and'
			$sql2 = substr( $sql2, 0, strlen($sql2)-3 );
			
			// and we append them to the original $sql template
			// in essence by now we should have a normal but procedurally generated select statement
			// that reflects the search criteria that was passed on by the parameters
			$sql = $sql.$sql2;
			
			
			
			// do a query now
			$DButility->DBresult = mysqli_query($DButility->DBhandle, $sql); //or die(mysql_error());
			
			// will return false if unsuccessful
  		return $DButility->DBresult;
			
		}
		
		// this function removes ad records from the database based on ID nb
		public function deleteRecordID($arg, $table) {
			
			// new utility function for connecting to the database
			$DButility = new Csec();
			
			// connect with the guest read write settings
			try { $DButility->DBconnector(Csec::defaultDBhost, Csec::defaultDBuser, Csec::defaultDBpass, Csec::defaultDBdatabse); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
 				
				
 				
 			// do a delete-from-where (search delete basically)
 			// take the table name from the class constant value
 			$sql = 'delete from '.$table.' where id='.$arg;
			
			// do a query now
			$DButility->DBresult = mysqli_query($DButility->DBhandle, $sql); //or die(mysql_error());
			
			// will return false if unsuccessful
  		return $DButility->DBresult;
			
		}
		
		// this function updates records in the database
		// it uses $dbatom_criteria as the criteria for the record/s to change like in search()
		// and $dbatom_newdata houses the new data.
		public function updateRecord($dbatom_criteria, $dbatom_newdata, $table) {
			
			// new utility function for connecting to the database
			$DButility = new Csec();
			
			// connect with the guest read write settings
			try { $DButility->DBconnector(Csec::defaultDBhost, Csec::defaultDBuser, Csec::defaultDBpass, Csec::defaultDBdatabse); }
 				catch (Exception $e) { echo $e->getMessage(); exit; }
 			

 				
 			// do an update into (fields) values (values)
 			// take the table name from the class constant value
 			$sql = 'update '.$table.' ';
			
			
			// this is for the SET section of the update string
			foreach ($dbatom_newdata as $key => $value) {
				
							$sql2 = $sql2.$key."='".$value."', ";
			}
			
			// this is for the WHERE section of the update string
			foreach ($dbatom_criteria as $key => $value) {
				
							$sql3 = $sql3.$key."='".$value."' and ";
			}
			
			// we take off the last trailing ', '
			$sql2 = substr( $sql2, 0, strlen($sql2)-2 );
			$sql3 = substr( $sql3, 0, strlen($sql3)-4 );
			
			// and we append them to the original $sql template
			// in essence by now we should have a normal but procedurally generated select statement
			// that reflects the search criteria that was passed on by the parameters
			$sql = $sql.'set '.$sql2.' where '.$sql3;
				
			// do an update 
			$DButility->DBresult = mysqli_query($DButility->DBhandle, $sql); //or die(mysql_error());  
			
			// will return false if unsuccessful
  		return $DButility->DBresult;


			
		}
	
		
		
}
























?>
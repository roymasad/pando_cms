<?php



// this php file is responsible for displaying relevant website pages apart from the default grid and projects page

$page['name'] = Csec::sanitizer($_GET['PAGE'], 'string');
$searchsubmit = Csec::sanitizer($_GET['SUBMIT'], 'int');


// all pages edited by ckeditor in the backend i handled the same way here
if (($page['name'] == "about") || ($page['name'] == "contact") || ($page['name'] == "team") || ($page['name'] == "jobs")) {


	echo '<div style="margin-left:11px; width:600">';
	
	if ($page['name'] == "contact") Csec::rawStreamer('map1.html');	
	
	$utility = Cprojects::getSingleton();
		
	$dbatom = $utility->searchRecords($page, Cprojects::pagetable);
	
	$result = $dbatom->arraysResult();
	
	if ($result) echo $result[0]['htmltext'];
		
	echo '</div>';
	
	exit;
}


// seperate handling logic for publications
if ($page['name'] == "press") {

	$utility = Cprojects::getSingleton();
	
	$project2 = null;
	
	$dbatom = $utility->searchRecords($project2, Cprojects::publicationtable, 'date', 'false','DESC');
	
	$sort = Csec::sanitizer($_GET['SORT'], 'string');
	
	
	if ($sort == "DESC") $utility->printDBatom($dbatom , 'htmlpubs', 1, 'DESC');
	else $utility->printDBatom($dbatom , 'htmlpubs', 1);

	exit;
}

// & similat seperate handling logic for news
if ($page['name'] == "news") {

	echo '<div style="margin-left:15px; width:800">';
	//echo '<b>news</b><br><br>';
	
	$utility = Cprojects::getSingleton();
	
	$project2 = null;
	
	$dbatom = $utility->searchRecords($project2, Cprojects::presstable, 'date', 'false', 'DESC');
	
	$sort = Csec::sanitizer($_GET['SORT'], 'string');
	
	if ($sort == "DESC") $utility->printDBatom($dbatom , 'htmlpressW', 1, 'DESC');
	else $utility->printDBatom($dbatom , 'htmlpressW', 1);
	
	
	echo '</div>';
	exit;
}

// this is the search logic section, biggest of of the group
if ($page['name'] == "search") {

	// are we submitting a search result? if so trim input, search and output
	if ($searchsubmit == 1) {
	
	$utility = Cprojects::getSingleton();
	$project = null;
	$find= null;
	$dbatom = $utility->searchRecords($find, Cprojects::settingtable);
	$gridresult = $dbatom->arraysResult();
	$delay = $gridresult [0]['grid_thumb_fade_delay'];
	
	// set criterias them if only they are sent
	if ($_POST[iQuickSearch]) $project ['name'] = Csec::sanitizer($_POST[iQuickSearch], 'string');
	if ($_POST[iSearchYear]) $project ['project_year'] = Csec::sanitizer($_POST[iSearchYear], 'string');
	if ($_POST[iSearchBudget]) $project ['cost'] = Csec::sanitizer($_POST[iSearchBudget], 'string');
	if ($_POST[iSearchType]) $project ['type'] = Csec::sanitizer($_POST[iSearchType], 'string');
	if ($_POST[iSearchStatus]) $project ['status'] = Csec::sanitizer($_POST[iSearchStatus], 'string');
	
	
	echo '<div style="position:absolute; left:10px">';

	// reset variable (not sure this is really necessary in this section)
	//$project2 = null;
	//foreach ($project as $k => $v) {
		
		//if ($v != "") $project2[$k] = $v;
		
	//}

	// search
	$dbatom= $utility->searchRecords($project, Cprojects::projectstable, 'id', 'true');

	if (isset($dbatom)) $result = $dbatom->arraysResult();
	
	$projetcount = null;
	
	// and display results in a modified grid logic system
	echo '<b> Results </b><br>';
	foreach ($result as $k) {
	
		
		// find the proper picture thumbnail for this project in the grid
		$findpic['project'] = $k['id'];
		$findpic['category'] = 'icons';
						
		$thmbresult = $utility->searchRecords($findpic, Cprojects::pixtable);
		
		if (isset($thmbresult)) {
		
		$thmbpix = $thmbresult ->arraysResult();
		$thmbpic = 'thumbs/'.$thmbpix[0]['main_link'];
		
		}
		
		// output grid unit
		echo "<div class='gridthmbresult' title='".$k['name']."' style=' position: absolute; top:".(($gridresult[0]['grid_thumb_height']+10)*$projetcount+50)."px ; left:15px ; width:".$gridresult[0]['grid_thumb_height']."px ;height:".($gridresult[0]['grid_thumb_height']*0.6)."px ; '><a href='index.php?PROJECT=".$k['name']."' >";
		echo "<img style='border:3px solid gray; width: ".$gridresult[0]['grid_thumb_height']."; height: ".($gridresult[0]['grid_thumb_height']*0.6)."; opacity: 0.3;' id='project".$projetcount."' src='".Csec::projectpixFolder.$thmbpic."'>";
		echo "</a></div>";

		echo '<div style="position:absolute; width:600px; top:'.(($gridresult[0]['grid_thumb_height']+10)*$projetcount+100).'; left:120px"><a href="index.php?PROJECT='.$k['name'].'" >';
		echo '<b>'.$k['name'].'</b>-';
		for ($i = 0; $i < $k['ranking']; $i++) { echo '<font color=black>*</font>'; }
		for ($i = 0; $i < 5-$k['ranking']; $i++) { echo '<font color=#CCCCCC>*</font>'; }
		echo '-'.$k['project_year'].'-'.$k['area'].'m2-'.$k['cost'].'$-'.$k['type'];
		echo '</a></div>';
	
		// echo the relevant javascript code to handle the animation and such
		echo "<script> 
			
			$('#project".$projetcount."').animate({ width: '50%', height: '50%', opacity: 0 }, 0);
			$('#project".$projetcount."').animate({ width: '100%', height: '100%', opacity: 1 }, (Math.random()*".($delay*500).")+500);
				
			
			$('#project".$projetcount."').mouseover(function() {
			
			if( $(this).is(':animated') ) return;

			//$(this).animate({ width: '".$gridresult[0]['grid_thumb_zoom']."%', height: '".$gridresult[0]['grid_thumb_zoom']."%'}, 250);
			$(this).animate({ width: '".($gridresult[0]['grid_thumb_height']*($gridresult[0]['grid_thumb_zoom']/100))."px', height: '".($gridresult[0]['grid_thumb_height']*($gridresult[0]['grid_thumb_zoom']/100)*0.6)."px'}, 250);
			  
			});
			
			$('#project".$projetcount."').mouseout(function() {
			

			$(this).animate({ width: '100%', height: '100%'}, 250);
			  
			});
			
			
			</script>";
			
			
		$projetcount++;
	
	
	}


	

	echo '</div>';
	exit;
	}

	echo '<div style="position:absolute; left:0px">';
	
	$replacetable['xxx_listTypesYYY']=Cprojects::htmlnamedropbox('types');

	$replacetable['xxx_listTypesYYY'] = str_replace('<option>-----------------</option>','<option></option>',$replacetable['xxx_listTypesYYY']);
	
	//Csec::rawStreamer('search.html');
	Csec::streamer('search.html', $replacetable);
	
	echo '</div>';

	exit;
}





?>
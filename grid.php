<?php

	// Coding by Roy Massaad

	// PandoCMS 2012, Copyright Roy Massaad
	// www.roymassaad.com

	//this php file is responsible for the complex 3d grid system 
	// from extracting data to calculating the pseudo postion of grid units to their display and cross browser compatibility
	
	// set up the floating press iframe box
	echo '<div id="iframediv"><iframe frameBorder="0" scrolling="no" style="position:absolute; z-index:999; top:-135px; left:950px; height:850px; width:400px; border-width: 0px; padding:0px; margin:0px; background-color: transparent;" src="press.php"></iframe></div>';
	
	echo '<div id="gridImage" style="position:absolute; opacity : 0.5 ;left: 120px; top: 20px ; width:667px ; height: 630px ;"></div>';

	
	// check out first default display grid (0,1,2), if not specificied manually then set it
	if (isset($_GET['GRIDNB'])) $_SESSION['GRIDNB'] = Csec::sanitizer($_GET['GRIDNB'], 'string');
	elseif (!isset($_SESSION['GRIDNB'])) $_SESSION['GRIDNB'] = '0';
	
	// check out first default display mode (2d/3d), if not specificied manually then set it
	if (isset($_GET['GMODE'])) $_SESSION['GMODE'] = Csec::sanitizer($_GET['GMODE'], 'string');
	elseif (!isset($_SESSION['GMODE'])) $_SESSION['GMODE'] = '3D';
	
	
	
	// then check out display sorting mode on all 3 axis, if not specificied manually then set them
	// sp get and store the sorting criterias for the 3 axis
	if (isset($_GET['Ysort'])) $_SESSION['Ysort'] = Csec::sanitizer($_GET['Ysort'], 'string');
	elseif (!isset($_SESSION['Ysort'])) $_SESSION['Ysort'] = 'year';
	
	if (isset($_GET['Xsort'])) $_SESSION['Xsort'] = Csec::sanitizer($_GET['Xsort'], 'string');
	elseif (!isset($_SESSION['Xsort'])) $_SESSION['Xsort'] = 'alphab';
	
	if (isset($_GET['Zsort'])) $_SESSION['Zsort'] = Csec::sanitizer($_GET['Zsort'], 'string');
	elseif (!isset($_SESSION['Zsort'])) $_SESSION['Zsort'] = 'rank';
	

	// in 2d mode we always collapse the z axis	
	if ($_SESSION['GMODE'] == '2D') $_SESSION['Zsort'] = null;
	// in 1d mode we always collapse the z+x axises
	if ($_SESSION['GMODE'] == '1D') {$_SESSION['Zsort'] = null; $_SESSION['Xsort'] = null;}  
	
	
	// mini box to select actual grid 0,1,2
	echo '<div style="position : absolute ; top:-20px ; left:10px;  z-index:1001; " >';
	
	if ($_SESSION['GRIDNB'] == '0') echo '<div ><b><a style="font-size:120%" href="index.php?GRIDNB=0" class="sortbox">Projects</a></b></div>';	else echo '<div  ><a  style="font-size:120%" href="index.php?GRIDNB=0" class="sortbox">Projects</a></div>';	
	echo '</div>';	
	

	
	// mini box to select 2d 3d grid modes
	echo '<div id="selector3d" style="position : absolute ; top:0px ; left:10px;  z-index:1001" >';
	
	if ($_SESSION['GMODE'] == '1D') echo '<div style="float:left" ><b><a href="index.php?GMODE=1D" class="sortbox">1D</a></b></div>';	else echo '<div style="float:left" ><a href="index.php?GMODE=1D" class="sortbox">1D</a></div>';	
	echo '<div style="float:left" >&nbsp;</div>' ;	if ($_SESSION['GMODE'] == '2D') echo '<div style="float:left" ><b><a href="index.php?GMODE=2D" class="sortbox">2D</a></b></div>';	else echo '<div style="float:left" ><a href="index.php?GMODE=2D" class="sortbox">2D</a></div>';	
	echo '<div style="float:left" >&nbsp;</div>' ;	if ($_SESSION['GMODE'] == '3D') echo '<div style="float:left" ><b><a href="index.php?GMODE=3D" class="sortbox">3D</a></b></div>';	else echo '<div style="float:left" ><a href="index.php?GMODE=3D" class="sortbox">3D</a></div>';	
	echo '</div>';	
	if ($_SESSION['GMODE'] == '3D') echo '<div><img src="3d_grid.jpg" style="position:absolute; z-index:-1; margin-left:73px; opacity: 0.5"></div>';	if ($_SESSION['GMODE'] == '2D') echo '<div><img src="2d_grid.jpg" style="position:absolute; z-index:-1; margin-left:73px; opacity: 0.5"></div>';	if ($_SESSION['GMODE'] == '1D') echo '<div><img src="1d_grid.jpg" style="position:absolute; z-index:-1; margin-left:73px; opacity: 0.5"></div>';	
	
	
	
	// display the 3 small sorting boxes for each axis
	// with logic to bold select them and unselect other selected criterias in other boxes
	
	echo '<div style="position : absolute ; top:100px ; left:10px; z-index:1001" >';
	
	if ($_SESSION['Ysort'] == 'year') echo '<div><b><a href="index.php?Ysort=year" class="sortbox">YEAR</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'year') || ($_SESSION['Zsort'] == 'year')) echo '<div><a href="index.php?Ysort=year" style="color:#CCCCCC;" class="sortbox">YEAR</a></div>';
	else echo '<div><a href="index.php?Ysort=year" class="sortbox">YEAR</a></div>';
	
	if ($_SESSION['Ysort'] == 'alphab') echo '<div><b><a href="index.php?Ysort=alphab" class="sortbox">ALPHAB</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'alphab') || ($_SESSION['Zsort'] == 'alphab')) echo '<div><a href="index.php?Ysort=alphab" style="color:#CCCCCC;" class="sortbox">ALPHAB</a></div>';
	else echo '<div><a href="index.php?Ysort=alphab" class="sortbox">ALPHAB</a></div>';
	
	$budgetString = "BUDGET";
	if ($_SESSION['GRIDNB'] == 0) $budgetString  = "BUDGET"; else $budgetString  = "PRICE";
	
	if ($_SESSION['Ysort'] == 'budget') echo '<div><b><a href="index.php?Ysort=budget" class="sortbox">'.$budgetString.'</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'budget') || ($_SESSION['Zsort'] == 'budget')) echo '<div><a href="index.php?Ysort=budget" style="color:#CCCCCC;" class="sortbox">'.$budgetString.'</a></div>';
	else echo '<div><a href="index.php?Ysort=budget" class="sortbox">'.$budgetString.'</a></div>';
	
	
	
	if ($_SESSION['GRIDNB'] == 0)
	{
	if ($_SESSION['Ysort'] == 'size') echo '<div><b><a href="index.php?Ysort=size" class="sortbox">AREA</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'size') || ($_SESSION['Zsort'] == 'size')) echo '<div><a href="index.php?Ysort=size" style="color:#CCCCCC;" class="sortbox">AREA</a></div>';
	else echo '<div><a href="index.php?Ysort=size" class="sortbox">AREA</a></div>';
	
	if ($_SESSION['Ysort'] == 'type') echo '<div><b><a href="index.php?Ysort=type" class="sortbox">TYPE</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'type') || ($_SESSION['Zsort'] == 'type')) echo '<div><a href="index.php?Ysort=type" style="color:#CCCCCC;" class="sortbox">TYPE</a></div>';
	else echo '<div><a href="index.php?Ysort=type" class="sortbox">TYPE</a></div>';
	}
	
	

	
	
	if ($_SESSION['Ysort'] == 'rank') echo '<div><b><a href="index.php?Ysort=rank" class="sortbox" style="font-size:110%; font-family:Arial">***</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'rank') || ($_SESSION['Zsort'] == 'rank')) echo '<div><a href="index.php?Ysort=rank" style="color:#CCCCCC;" class="sortbox">***</a></div>';
	else echo '<div><a href="index.php?Ysort=rank" class="sortbox">***</a></div>';
	
	
	echo '</div>';
	
	
	if ($_SESSION['GMODE'] == '3D') {
	echo '<div style="position : absolute ; top:620px ; left:810px; z-index:1001" >';
	
	if ($_SESSION['Zsort'] == 'year') echo '<div><b><a href="index.php?Zsort=year" class="sortbox">YEAR</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'year') || ($_SESSION['Ysort'] == 'year')) echo '<div><a href="index.php?Zsort=year" style="color:#CCCCCC;" class="sortbox">YEAR</a></div>';
	else echo '<div><a href="index.php?Zsort=year" class="sortbox">YEAR</a></div>';
	
		
	if ($_SESSION['Zsort'] == 'budget') echo '<div><b><a href="index.php?Zsort=budget" class="sortbox">'.$budgetString.'</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'budget') || ($_SESSION['Ysort'] == 'budget')) echo '<div><a href="index.php?Zsort=budget" style="color:#CCCCCC;" class="sortbox">'.$budgetString.'</a></div>';
	else echo '<div><a href="index.php?Zsort=budget" class="sortbox">'.$budgetString.'</a></div>';
	
	if ($_SESSION['Zsort'] == 'alphab') echo '<div><b><a href="index.php?Zsort=alphab" class="sortbox">ALPHAB</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'alphab') || ($_SESSION['Ysort'] == 'alphab')) echo '<div><a href="index.php?Zsort=alphab" style="color:#CCCCCC;" class="sortbox">ALPHAB</a></div>';
	else echo '<div><a href="index.php?Zsort=alphab" class="sortbox">ALPHAB</a></div>';
	
	
	if ($_SESSION['GRIDNB'] == 0)
	{	
	if ($_SESSION['Zsort'] == 'size') echo '<div><b><a href="index.php?Zsort=size" class="sortbox">AREA</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'size') || ($_SESSION['Ysort'] == 'size')) echo '<div><a href="index.php?Zsort=size" style="color:#CCCCCC;" class="sortbox">AREA</a></div>';
	else echo '<div><a href="index.php?Zsort=size" class="sortbox">AREA</a></div>';
	
	if ($_SESSION['Zsort'] == 'type') echo '<div><b><a href="index.php?Zsort=type" class="sortbox">TYPE</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'type') || ($_SESSION['Ysort'] == 'type')) echo '<div><a href="index.php?Zsort=type" style="color:#CCCCCC;" class="sortbox">TYPE</a></div>';
	else echo '<div><a href="index.php?Zsort=type" class="sortbox">TYPE</a></div>';
	}
	
	

	
	if ($_SESSION['Zsort'] == 'rank') echo '<div><b><a href="index.php?Zsort=rank" class="sortbox" style="font-size:110%; font-family:Arial">***</a></b></div>';
	elseif (($_SESSION['Xsort'] == 'rank') || ($_SESSION['Ysort'] == 'rank')) echo '<div><a href="index.php?Zsort=rank" style="color:#CCCCCC;" class="sortbox">***</a></div>';
	else echo '<div><a href="index.php?Zsort=rank" class="sortbox">***</a></div>';
	
	echo '</div>';
	}
	
	
	if (($_SESSION['GMODE'] == '3D') || ($_SESSION['GMODE'] == '2D')) {

	echo '<div style="position : absolute ; top:100px ; left:810px; z-index:1001" >';
	
	if ($_SESSION['Xsort'] == 'year') echo '<div><b><a href="index.php?Xsort=year" class="sortbox">YEAR</a></b></div>';
	elseif (($_SESSION['Zsort'] == 'year') || ($_SESSION['Ysort'] == 'year')) echo '<div><a href="index.php?Xsort=year" style="color:#CCCCCC;" class="sortbox">YEAR</a></div>';
	else echo '<div><a href="index.php?Xsort=year" class="sortbox">YEAR</a></div>';
	
	if ($_SESSION['Xsort'] == 'alphab') echo '<div><b><a href="index.php?Xsort=alphab" class="sortbox">ALPHAB</a></b></div>';
	elseif (($_SESSION['Zsort'] == 'alphab') || ($_SESSION['Ysort'] == 'alphab')) echo '<div><a href="index.php?Xsort=alphab" style="color:#CCCCCC;" class="sortbox">ALPHAB</a></div>';
	else echo '<div><a href="index.php?Xsort=alphab" class="sortbox">ALPHAB</a></div>';
	
	if ($_SESSION['Xsort'] == 'budget') echo '<div><b><a href="index.php?Xsort=budget" class="sortbox">'.$budgetString.'</a></b></div>';
	elseif (($_SESSION['Zsort'] == 'budget') || ($_SESSION['Ysort'] == 'budget')) echo '<div><a href="index.php?Xsort=budget" style="color:#CCCCCC;" class="sortbox">'.$budgetString.'</a></div>';
	else echo '<div><a href="index.php?Xsort=budget" class="sortbox">'.$budgetString.'</a></div>';
	
	
	if ($_SESSION['GRIDNB'] == 0)
	{
	if ($_SESSION['Xsort'] == 'size') echo '<div><b><a href="index.php?Xsort=size" class="sortbox">AREA</a></b></div>';
	elseif (($_SESSION['Zsort'] == 'size') || ($_SESSION['Ysort'] == 'size')) echo '<div><a href="index.php?Xsort=size" style="color:#CCCCCC;" class="sortbox">AREA</a></div>';
	else echo '<div><a href="index.php?Xsort=size" class="sortbox">AREA</a></div>';
		
	if ($_SESSION['Xsort'] == 'type') echo '<div><b><a href="index.php?Xsort=type" class="sortbox">TYPE</a></b></div>';
	elseif (($_SESSION['Zsort'] == 'type') || ($_SESSION['Ysort'] == 'type')) echo '<div><a href="index.php?Xsort=type" style="color:#CCCCCC;" class="sortbox">TYPE</a></div>';
	else echo '<div><a href="index.php?Xsort=type" class="sortbox">TYPE</a></div>';
	}
	
	

	
	if ($_SESSION['Xsort'] == 'rank') echo '<div><b><a href="index.php?Xsort=rank" class="sortbox" style="font-size:110%; font-family:Arial">***</a></b></div>';
	elseif (($_SESSION['Zsort'] == 'rank') || ($_SESSION['Ysort'] == 'rank')) echo '<div><a href="index.php?Xsort=rank" style="color:#CCCCCC;" class="sortbox">***</a></div>';
	else echo '<div><a href="index.php?Xsort=rank" class="sortbox">***</a></div>';
	
	echo '</div>';
	}
	

	// get the settings values of the grid 
	$utility = Cprojects::getSingleton();

	$find= null;
	
	$dbatom = $utility->searchRecords($find, Cprojects::settingtable);
	
	$gridresult = $dbatom->arraysResult();

	
	// then get all projects for a certain grid
	//$findprojects = null;
	
	$findprojects['grid'] = $_SESSION['GRIDNB'];
	
	$dbatom = $utility->searchRecords($findprojects , Cprojects::projectstable);
	
	$projectslist = $dbatom->arraysResult();
	
	// add stuff here
	$steps = $gridresult[0]['grid_xyz'];


// now sort the projects on the grid by giving them each an x/y/z in their proper range
// the calculation will be done based on the sorting groups in settings and correct to visually match
// there is a lot of conditional tests in this section
foreach($projectslist as &$project){


	if ($_SESSION['Xsort'] == 'size') {
	
		$sort = $gridresult [0]['sort_area'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['area']) break;
			$position++;
		}
	
	$project['x'] = $position-1;
	
	}
	
	if ($_SESSION['Xsort'] == 'year') {
	
		$sort = $gridresult [0]['sort_year'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['project_year']) break;
			$position++;
		}
	
	$project['x'] = $position-1;
	
	}
	
	if ($_SESSION['Xsort'] == 'type') {
	
		$sort = $gridresult [0]['sort_type'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if (strtoupper(trim($chunk)) > strtoupper(trim($project['type']))) break;
			$position++;
		}
	
	
	$project['x'] = $position-1;
	
	}
	
	if ($_SESSION['Xsort'] == 'rank') {
	
		$sort = $gridresult [0]['sort_ranking'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['ranking']) break;
			$position++;
		}
	
	$project['x'] = $position-1;
	
	}
	
	if ($_SESSION['Xsort'] == 'budget') {
		
		if ( $_SESSION['GRIDNB'] == 0) $sort = $gridresult [0]['sort_budget'];
		if ( $_SESSION['GRIDNB'] == 1) $sort = $gridresult [0]['sort_price_design'];
		if ( $_SESSION['GRIDNB'] == 2) $sort = $gridresult [0]['sort_art_design'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['cost']) break;
			$position++;
		}
	
	$project['x'] = $position-1;
	
	}
	
	if ($_SESSION['Xsort'] == 'alphab') {
	
		$sort = $gridresult [0]['sort_alphab'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if (strtoupper($chunk) > strtoupper($project['name'])) break;
			$position++;
		}
	
	$project['x'] = $position-1;
	
	}
	
	//
	if (($_SESSION['Xsort'] == 'material') && ($_SESSION['GRIDNB'] == 1)){
	
		$sort = $gridresult [0]['sort_material_design'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if (strtoupper($chunk) > strtoupper($project['materials_list'])) break;
			$position++;
		}
	
	$project['x'] = $position-1;
	
	}
	

	
	if ($_SESSION['Ysort'] == 'size') {
	
		$sort = $gridresult [0]['sort_area'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['area']) break;
			$position++;
		}
	
	$project['y'] = $position-1;
	
	}
	
	if ($_SESSION['Ysort'] == 'year') {
	
		$sort = $gridresult [0]['sort_year'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['project_year']) break;
			$position++;
		}
	
	$project['y'] = $position-1;
	
	}
	
	if ($_SESSION['Ysort'] == 'type') {
	
		$sort = $gridresult [0]['sort_type'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if (strtoupper(trim($chunk)) > strtoupper(trim($project['type']))) break;
			$position++;
		}
	
	$project['y'] = $position-1;
	
	}
	
	if ($_SESSION['Ysort'] == 'rank') {
	
		$sort = $gridresult [0]['sort_ranking'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['ranking']) break;
			$position++;
		}
	
	$project['y'] = $position-1;
	
	}
	
	if ($_SESSION['Ysort'] == 'budget') {
	
		if ( $_SESSION['GRIDNB'] == 0) $sort = $gridresult [0]['sort_budget'];
		if ( $_SESSION['GRIDNB'] == 1) $sort = $gridresult [0]['sort_price_design'];
		if ( $_SESSION['GRIDNB'] == 2) $sort = $gridresult [0]['sort_art_design'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['cost']) break;
			$position++;
		}
	
	$project['y'] = $position-1;
	
	}
	
	if ($_SESSION['Ysort'] == 'alphab') {
	
		$sort = $gridresult [0]['sort_alphab'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if (strtoupper($chunk) > strtoupper($project['name'])) break;
			$position++;
		}
	
	$project['y'] = $position-1;
	
	}
	


	
	if ($_SESSION['Zsort'] == 'size') {
	
		$sort = $gridresult [0]['sort_area'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['area']) break;
			$position++;
		}
	
	$project['z'] = $position-1;
	
	}
	
	if ($_SESSION['Zsort'] == 'year') {
	
		$sort = $gridresult [0]['sort_year'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['project_year']) break;
			$position++;
		}
	// inverse sorting
	
	//$project['z'] = ($gridresult[0]['grid_xyz']+1)-$position;
	
	$project['z'] = ($gridresult[0]['grid_xyz']+1)-($position-1);
	
	
	}
	
	if ($_SESSION['Zsort'] == 'type') {
	
		$sort = $gridresult [0]['sort_type'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if (strtoupper(trim($chunk)) > strtoupper(trim($project['type']))) break; 
			$position++;
		}
	
	$project['z'] = $position-1;
	
	}
	
	if ($_SESSION['Zsort'] == 'rank') {
	
		$sort = $gridresult [0]['sort_ranking'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['ranking']) break;
			$position++;
		}
	
	$project['z'] = $position-1;
	
	}
	
	if ($_SESSION['Zsort'] == 'budget') {
	
		if ( $_SESSION['GRIDNB'] == 0) $sort = $gridresult [0]['sort_budget'];
		if ( $_SESSION['GRIDNB'] == 1) $sort = $gridresult [0]['sort_price_design'];
		if ( $_SESSION['GRIDNB'] == 2) $sort = $gridresult [0]['sort_art_design'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if ($chunk > $project['cost']) break;
			$position++;
		}
	
	$project['z'] = $position-1;
	
	}
	
	if ($_SESSION['Zsort'] == 'alphab') {
	
		$sort = $gridresult [0]['sort_alphab'];
		
		$sort_chunks = explode(',' , $sort);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			if (strtoupper($chunk) > strtoupper($project['name'])) break;
			$position++;
		}
	
	$project['z'] = $position-1;
	
	
	}
	
	
	
	if ($project['x'] <= 0) $project['x'] = 1;
	if ($project['y'] <= 0) $project['y'] = 1;
	if ($project['z'] <= 0) $project['z'] = 1;
	
	if ($project['x'] > $gridresult[0]['grid_xyz']) $project['x'] = $gridresult[0]['grid_xyz'];
	if ($project['y'] > $gridresult[0]['grid_xyz']) $project['y'] = $gridresult[0]['grid_xyz'];	
	if ($project['z'] > $gridresult[0]['grid_xyz']) $project['z'] = $gridresult[0]['grid_xyz'];
	
	//check if its 2d sorting mode and collapse on z
	if ($_SESSION['GMODE'] == '2D') $project['z'] = 1;
	if ($_SESSION['GMODE'] == '1D') { $project['z'] = 1; $project['x'] = 1;	}


}

// get grid settings we previously saved

	$Layer = 0;
	$projetcount = 0;
	$delay = $gridresult [0]['grid_thumb_fade_delay'];

	$miniXoffset = $gridresult [0]['mini_x_offset'];
	$miniYoffset = $gridresult [0]['mini_y_offset'];
	$Xoffset = 0;
	$Yoffset = 0;
	
	$width = ($gridresult[0]['grid_xyz']-1) * $gridresult [0]['mini_x_offset'];




// next draw dynamic guides for each axis, depending on settings and what is selected in the drop boxes
// also take into account 2d/3d more and that some draw guides display different text than the ones they use for sorting calculations
if (($_SESSION['GMODE'] == '3D') || ($_SESSION['GMODE'] == '2D')) {

	if ($_SESSION['Xsort'] == 'size') $sort = $gridresult [0]['area_list'];
	if ($_SESSION['Xsort'] == 'rank') $sort = $gridresult [0]['sort_ranking'];
	
	if ( $_SESSION['GRIDNB'] == 0 && $_SESSION['Xsort'] == 'budget') $sort = $gridresult [0]['budget_list'];
	if ( $_SESSION['GRIDNB'] == 1 && $_SESSION['Xsort'] == 'budget') $sort = $gridresult [0]['price_design_list'];
	if ( $_SESSION['GRIDNB'] == 2 && $_SESSION['Xsort'] == 'budget') $sort = $gridresult [0]['price_art_list'];
	
	if ($_SESSION['Xsort'] == 'alphab') $sort = $gridresult [0]['alphab_list'];
	if ($_SESSION['Xsort'] == 'year') $sort = $gridresult [0]['sort_year'];
	if ($_SESSION['Xsort'] == 'type') $sort = $gridresult [0]['sort_type'];
	

	$sort_chunks = explode(',' , $sort);
	
	$position = 1;
	foreach ($sort_chunks as $chunk) {
	
	
		//if ($_SESSION['GMODE'] == '3D') {$topoffset = 750; $leftoffset = 225; }
		if ($_SESSION['GMODE'] == '3D') {$topoffset = 170; $leftoffset = 475; }
		if ($_SESSION['GMODE'] == '2D') {$topoffset = 380; $leftoffset = 375; }
		
		$column = ($gridresult[0]['grid_xyz']-$position)*$gridresult[0]['column_offset'];
	
		echo '<div id="guideX-'.$position.'" class="guidesX" style="top: '.($topoffset-$column+10).'; left:'.($leftoffset+$Xoffset+($position*$miniXoffset)-($width/2)).'" >'.$chunk.'</div>';
		$position++;
	
	}
	
}

if ($_SESSION['Ysort'] == 'size') $sort = $gridresult [0]['area_list'];
if ($_SESSION['Ysort'] == 'rank') $sort = $gridresult [0]['sort_ranking'];

if ( $_SESSION['GRIDNB'] == 0 && $_SESSION['Ysort'] == 'budget') $sort = $gridresult [0]['budget_list'];
if ( $_SESSION['GRIDNB'] == 1 && $_SESSION['Ysort'] == 'budget') $sort = $gridresult [0]['price_design_list'];
if ( $_SESSION['GRIDNB'] == 2 && $_SESSION['Ysort'] == 'budget') $sort = $gridresult [0]['price_art_list'];

if ($_SESSION['Ysort'] == 'alphab') $sort = $gridresult [0]['alphab_list'];
if ($_SESSION['Ysort'] == 'year') $sort = $gridresult [0]['sort_year'];
if ($_SESSION['Ysort'] == 'type') $sort = $gridresult [0]['sort_type'];

		
	$sort_chunks = explode(',' , $sort);
	
	//the sorting on the Y axis is reversed
	
	$position = $gridresult[0]['grid_xyz']+1;
	$position2 = 1;
	foreach ($sort_chunks as $chunk) {
	
		echo '<div id="guideY-'.$position2.'" class="guidesY" style="left: 15; top:'.(170+$Yoffset+($position*$miniYoffset)).'" >'.$chunk.'</div>';
		$position2++;
		$position--;
	
	}

if ($_SESSION['GMODE'] == '3D') {

	
	if ($_SESSION['Zsort'] == 'size') $sort = $gridresult [0]['area_list'];
	if ($_SESSION['Zsort'] == 'rank') $sort = $gridresult [0]['sort_ranking'];
	
	if ( $_SESSION['GRIDNB'] == 0 && $_SESSION['Zsort'] == 'budget') $sort = $gridresult [0]['budget_list'];
	if ( $_SESSION['GRIDNB'] == 1 && $_SESSION['Zsort'] == 'budget') $sort = $gridresult [0]['price_design_list'];
	if ( $_SESSION['GRIDNB'] == 2 && $_SESSION['Zsort'] == 'budget') $sort = $gridresult [0]['price_art_list'];

	if ($_SESSION['Zsort'] == 'alphab') $sort = $gridresult [0]['alphab_list'];
	if ($_SESSION['Zsort'] == 'year')  $sort = $gridresult [0]['sort_year']; 
	if ($_SESSION['Zsort'] == 'type') $sort = $gridresult [0]['sort_type'];
	
			
		$sort_chunks = explode(',' , $sort);
		
		//inverse the guides& sorting if he are sorting year on the z axis
		if ($_SESSION['Zsort'] == 'year') $sort_chunks = array_reverse($sort_chunks);
		
		$position = 1;
		foreach ($sort_chunks as $chunk) {
		
			echo '<div id="guideZ-'.$position.'" class="guidesZ" style="top: '.(785-($position)*$gridresult[0]['grid_3d_offset_y']).'; left:'.(780+($position*$gridresult[0]['grid_3d_offset_x'])-($width/2)).'" >'.$chunk.'</div>';
			$position++;
		
		}
}

// set up the javascript DOM entry point
// ps: its not used for now	
echo '
	    <script type="text/javascript">
			$(document).ready(function(){
				
			});
	    </script>
	    
	    ';


	// this is the main section responsible for drawing the grid based on the dynamic settings of the backend
	// note its a pseudo 3d grid so there are offset calculations and transformation ones and animation code also and it supports features such as 'stacking' projects with same x,y,z values on the axis
	// ps: please note that cssSandpaper was used to provide transformations that work on both normal browsers and that useless Internet explorer (check js include files and css files)

	if ($_SESSION['GMODE'] != '3D') $gridresult [0]['grid_margin_left'] += 150;
	
	
	echo "<div style='position: absolute; margin-left: ".$gridresult [0]['grid_margin_left']."px; margin-top:".$gridresult [0]['grid_margin_top']."px'>";
	
	// this section is only used in better to automatically fill the entire grid with fake units to see how they would display
	if ($_GET['fill']==true) {
		//$projectslist = array();
		$cc = 0;
		for($zz = 1 ; $zz <= $gridresult[0]['grid_xyz']; $zz++){
		
		for($yy = 1 ; $yy <= $gridresult[0]['grid_xyz']; $yy++){
		
		for($xx = 1 ; $xx <= $gridresult[0]['grid_xyz']; $xx++){
		
		$projectslist[$cc]['x'] = $xx;
		$projectslist[$cc]['y'] = $yy;
		if ($_SESSION['GMODE'] == '3D') $projectslist[$cc]['z'] = $zz;
		if ($_SESSION['GMODE'] == '2D') $projectslist[$cc]['z'] = 1;
		if ($_SESSION['GMODE'] == '1D') {$projectslist[$cc]['z'] = 1; $projectslist[$cc]['x'] = 1;}
		
		$projectslist[$cc]['name'] = $xx.'-'.$yy.'-'.$zz;
		
		$cc++;
		}
		
		}
		
		}
		
	}
	
	
	// set up the stacking array to detect when some project units stack on top of each other on the grid
	$stackgrid = array();
	
	// go through each project and display it according to its x/y/z value (which were calculated previously)
	foreach ($projectslist as $gridproject) {
	
	$Count = $gridproject['z'];
	$i = ($gridresult[0]['grid_xyz']-$gridproject['y'])+1;
	$ii = $gridproject['x'];
	
	if (isset($stackgrid[$Count][$i][$ii])) $stackgrid[$Count][$i][$ii] += 1; else $stackgrid[$Count][$i][$ii] = 0;
	

	
	$stackoffset = $stackgrid[$Count][$i][$ii] * 7;
	

			$columOffset = $gridresult [0]['column_offset'] * ($gridproject['x'] - 1);
			
			$Layer = 100 - $gridproject['z'];
			
			
			
			$Xoffset = $gridresult [0]['grid_3d_offset_x'] * ($gridproject['z'] - 1);
			$Yoffset = ($gridresult [0]['grid_3d_offset_y'] * ($gridproject['z'] - 1))*(-1);
			
			
			
			// find the proper picture thumbnail for this project in the grid
			$findpic['project'] = $gridproject['id'];
			$findpic['category'] = 'icons';
			
							
			$thmbresult = $utility->searchRecords($findpic, Cprojects::pixtable);
			
			if (isset($thmbresult)) {
			
			$thmbpix = $thmbresult ->arraysResult();
			
			$thmbpic = 'thumbs/'.$thmbpix[0]['main_link'];
			
			}
			
			if ($_GET['fill']==true) $thmbpic = "tile".$Count.".jpg";
						
			
			$projectxyz = $ii.'-'.$gridproject['y'].'-'.$Count.'-';
			$projetcount++;
			
			$safeProjectName = urlencode($gridproject['name']);
			
			echo "<div class='gridthmb' title='".$gridproject['name']."' style=' position: absolute; z-index:".$Layer."; top:".($Yoffset+$columOffset+$stackoffset+($i*$miniYoffset))."px ; left:".($Xoffset-$stackoffset+($ii*$miniXoffset)-($width/2))."px; width:".$gridresult[0]['grid_thumb_height']."px ; height:".($gridresult[0]['grid_thumb_height']*0.6)."px ; '><a href='index.php?PROJECT=".$safeProjectName."' ><img alt='".$gridproject['name']."' style='border:3px solid gray; width: ".$gridresult[0]['grid_thumb_height']."; height: ".($gridresult[0]['grid_thumb_height']*0.6)."; opacity: 1.0;' id='project-".$projectxyz.$projetcount."' src='".Csec::projectpixFolder.$thmbpic."'></a></div>";
		
			
			
			// and generate the correspondign javascript jquery code for the animations
			echo "<script type='text/javascript'> 
			
			$('#project-".$projectxyz.$projetcount."').animate({ width: '50%', height: '50%', opacity: 0 }, 0);
			$('#project-".$projectxyz.$projetcount."').animate({ width: '100%', height: '100%', opacity: 1 }, (Math.random()*".($delay*500).")+500);
				
			
			$('#project-".$projectxyz.$projetcount."').mouseover(function() {
			
			if( $(this).is(':animated') ) return;

			
			$(this).css('border-style','solid');
			$(this).css('border-width','4px');
			$(this).css('border-color','black');
			
			
			$(this).animate({ width: '".($gridresult[0]['grid_thumb_height']*($gridresult[0]['grid_thumb_zoom']/100))."px', height: '".($gridresult[0]['grid_thumb_height']*($gridresult[0]['grid_thumb_zoom']/100)*0.6)."px'}, 250);
			
			var brokenstring = $(this).attr('id').split('-');

			$('#guideX-'+brokenstring[1]).css('font-weight', 'bold');
			$('#guideY-'+brokenstring[2]).css('font-weight', 'bold');
			$('#guideZ-'+brokenstring[3]).css('font-weight', 'bold');
			
			});
			
			$('#project-".$projectxyz.$projetcount."').mouseout(function() {
			
			$(this).css('border-style','none');
			
			$(this).animate({ width: '100%', height: '100%'}, 250);
			
			var brokenstring = $(this).attr('id').split('-');

			$('#guideX-'+brokenstring[1]).css('font-weight', 'normal');
			$('#guideY-'+brokenstring[2]).css('font-weight', 'normal');
			$('#guideZ-'+brokenstring[3]).css('font-weight', 'normal');
		
			
			$('#guideX-'+brokenstring[1]).mouseenter( function() {	$(this).css('font-weight', 'bold');		}, function(){});
			$('#guideY-'+brokenstring[2]).mouseenter( function() {	$(this).css('font-weight', 'bold');		}, function(){});
			$('#guideZ-'+brokenstring[3]).mouseenter( function() {	$(this).css('font-weight', 'bold');		}, function(){});
			
			$('#guideX-'+brokenstring[1]).mouseout( function() {	$(this).css('font-weight', 'normal');		}, function(){});
			$('#guideY-'+brokenstring[2]).mouseout( function() {	$(this).css('font-weight', 'normal');		}, function(){});
			$('#guideZ-'+brokenstring[3]).mouseout( function() {	$(this).css('font-weight', 'normal');		}, function(){});
			  
			});
			
			
			</script>";
			
			

		
	}
	
	echo "</div>";
	
	function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
	
	
?>
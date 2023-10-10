<html>
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" >

<script type="text/javascript" src="javascripts/jquery.min.js"></script>
<script type="text/javascript" src="javascripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="javascripts/jquery.nicescroll.js"></script>


</head>

<body style="background-color:white; padding:0px; margin:0px; border:0px;">

<div id ="niceScroller1" style="height: 850px;">

<?php
	//simply output the press mini feed for the floating iframe
	
	
	
	require_once 'php/Csecurity.php';
	require_once 'php/Cprojects.php';

	$utility = Cprojects::getSingleton();
	
	$project2 = null;
	
	$dbatom = $utility->searchRecords($project2, Cprojects::presstable, 'date', 'false','DESC');
	
	$utility->printDBatom($dbatom , 'htmlpress', 1);



?>
</div>

<script type="text/javascript">

$(document).ready(

  function() { 

    $("#niceScroller1").niceScroll({styler:"fb", cursorcolor:"#000" , cursoropacitymin: 0.1, cursoropacitymax: 0.5, cursorwidth : 2  });

  }

);
</script>

</body>
<html>
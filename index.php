<?php

session_start();

require_once 'php/Csecurity.php';
require_once 'php/Cprojects.php';

error_reporting(E_ALL ^ E_NOTICE);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<TITLE>Pando CMS</TITLE>
<LINK REL="SHORTCUT ICON" HREF="favicon.ico">
<META NAME="author" CONTENT="Roy Massaad">
<META NAME="description" CONTENT="">
<META NAME="KEYWORDS" CONTENT="">
<META NAME="robots" CONTENT="all">
<META http-equiv="Content-Type" content="text/html; charset=UTF-8"> 



<link rel="stylesheet" href="css/style.css" type="text/css" >
<link rel="stylesheet" href="css/coin-slider-styles.css" type="text/css" >

<?php
	// insert dynamically calculated styles
	$utility = Cprojects::getSingleton();
	
	$find= null;
	$dbatom = $utility->searchRecords($find, Cprojects::settingtable);
	$gridresult = $dbatom->arraysResult();
	$delay = $gridresult [0]['grid_thumb_fade_delay'];
	
	echo "<style type=\"text/css\">";
	echo "div.gridthmbresult{ -sand-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); -webkit-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); -moz-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); -ms-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); -o-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5);  }";
	echo "div:hover.gridthmbresult{ position: absolute; z-index:1000 !important; }";
	
	echo "div.gridthmb{ -sand-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); -webkit-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); -moz-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); -ms-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); -o-transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); transform: skew(0deg,".$gridresult[0]['grid_skew']."deg) scale(0.5,0.5); }";
	echo "div:hover.gridthmb{ position: absolute; z-index:1000 !important; }";
	
	echo "</style>";
	
	$utility->__destruct();
	$utility = null;
	unset($utility);
	
?>


<script type="text/javascript" src="javascripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="javascripts/EventHelpers.js"></script>
<script type="text/javascript" src="javascripts/cssQuery-p.js"></script>
<script type="text/javascript" src="javascripts/sylvester.js"></script>
<script type="text/javascript" src="javascripts/cssSandpaper.js"></script>
<script type="text/javascript" src="javascripts/coin-slider.js"></script>
<script type="text/javascript" src="javascripts/jquery.nicescroll.js"></script>


</head>

<body style="background-color:white">

<?php

// include the relevant php sections

echo "<div style='position : absolute ; float:left ; background-color: transparent ; width:1000px ; height:70px ; margin-left : 55px ; top: 50px;'>";  include("menuleft.php") ; echo "</div>";
echo "<div style='float:right ; background-color: transparent; width:200px ; height:150px ; margin-right : 50px'>"; include("menuright.php") ; echo "</div>";


if ($_GET['PAGE'] != null) {echo "<div style='position : absolute ; background-color: transparent ;    top: 125px ; margin-left : 50px'>"; include("pages.php") ; echo "</div>";}
else if ($_GET['PROJECT'] != null) {echo "<div style='position : absolute ; background-color: transparent ; top: 125px ; margin-left : 50px'>"; include("projects.php") ; echo "</div>";}
else { 

echo "<div style='position : absolute ; background-color: transparent ; width:1000px;  top: 175px ; margin-left : 50px'>"; 
include("grid.php") ;

echo '</div><div style="position:absolute; top:900px; left:70px" ><a style="color:grey; font-size:9px" href="http://www.roymassaad.com" target="_blank">Programing by Roy Massaad</a></div><div style="position:absolute; top:900px; left:70px" >&nbsp;</div>'; 

echo '<div id="facebook"><a href="https://www.facebook.com" target="_blank"><img src="facebook.png"/></a></div>'; 
echo '<div id="instagram"><a href="http://instagram.com" target="_blank"><img src="instagram.png"/></a></div>'; 

}


?>

</body>
</html>
<?php


// set up top menu, and set in bold selected menu page
echo '<div style="float:left" >';

echo '<div style="float:left;"><ul class="menu2" style="padding:0px; margin-left:3px; padding-top:0px; margin-top:10px;" >';

if ($_GET['PAGE'] == null) echo '<li style="width:60px" class="menu"><b><a class="menu3f" href="index.php">HOME</a></b></li>';
else echo '<li style="width:60px" class="menu"><a class="menu3f" href="index.php">HOME</a></li>';


if ($_GET['PAGE'] == 'about') echo '<li style="width:73px" class="menu"><b><a class="menu3f" href="index.php?PAGE=about" >ABOUT</a></b></li>';
else echo '<li style="width:73px" class="menu"><a class="menu3f" href="index.php?PAGE=about" >ABOUT</a></li>';


if ($_GET['PAGE'] == 'contact') echo '<li style="width:79px;" class="menu" ><b><a class="menu3f" href="index.php?PAGE=contact">CONTACT</a></b></li>';
else echo '<li style="width:79px;" class="menu" ><a class="menu3f" href="index.php?PAGE=contact">CONTACT</a></li>';


if ($_GET['PAGE'] == 'news') echo '<li style="width:65px" class="menu"><b><a class="menu3f" href="index.php?PAGE=news">NEWS</a></b></li>';
else echo '<li style="width:65px" class="menu"><a class="menu3f" href="index.php?PAGE=news">NEWS</a></li>';


if ($_GET['PAGE'] == 'press') echo '<li style="width:73px;border-right:none;" class="menu"><b><a class="menu3f" href="index.php?PAGE=press" >PRESS</a></b></li>';
else echo '<li style="width:73px;border-right:none;" class="menu"><a class="menu3f" href="index.php?PAGE=press" >PRESS</a></li>';


if ($_GET['PAGE'] == 'search') echo '<li style="width:77px" class="menu"><b><a class="menu3f" href="index.php?PAGE=search">SEARCH</a></b></li>';
else echo '<li style="width:77px" class="menu"><a class="menu3f" href="index.php?PAGE=search">SEARCH</a></li>';


if ($_GET['PAGE'] == 'jobs') echo '<li style="width:155px" class="menu"><b><a class="menu3f" href="index.php?PAGE=jobs">JOB OPPORTUNITIES</a></b></li>';
else echo '<li style="width:155px" class="menu"><a class="menu3f" href="index.php?PAGE=jobs">JOB OPPORTUNITIES</a></li>';



echo '</ul></div>';

echo '</div>';

?>
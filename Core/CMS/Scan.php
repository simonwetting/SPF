<?php
include_once "../Conf.php";
include_once $Dir."Core/Libraries/Debug.php";
include_once $Dir."Core/Libraries/Properties.php";
//Authentication
/*Code*/

//Scan for modules
$Modules = array_diff( scandir("../"), array(".", "..") );

//Create array th holds the properteis of each module
$Module_info=array();
foreach($Modules as $Module_name){}
?>
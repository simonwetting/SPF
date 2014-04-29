<?php
function sp($Var){
	echo "<p>".$Var."</p>";
}
function spA($Array){
	$n=0;
	foreach($Array as $Var){
		echo "<p>".$n++."=\"".$Var."\"</p>";
	}
}
function space(){
	echo "<br>";	
}

//Add libraries
include "../Libraries/MySQL/Functions.php";

//Get PageName
$PageName = $_GET['p'];

//Get page settings
$Link = MySQL_open_connection($User, $Pass, $DB);
$Array = MySQL_get_array("Pages", "*", "Name='".$PageName."'");
mysql_close($Link);

//Create associative array for settings
$Temp = explode(";", $Array['Settings']);
$Settings = array();
foreach($Temp as $Value){
	//Split value and variable name
	$Variable = explode("=", $Value);
	//Asign value to $Settings['Variablename']
	$Settings[$Variable[0]] = $Variable[1];
}

//Create array for modules
$Modules = explode(";", $Array['Modules']);

//Load modules
foreach($Modules as $Module){
	include "../../Modules/".$Module."/Load.php";
}

//Include main file
include "../../".$Array['Path'];
?>
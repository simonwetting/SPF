<?php
function sp($Var){
	echo "<p>".$Var."</p>";
}
function spA($Array){
	$n=0;
	foreach($Array as $Var){
		echo "<p>".$n++."=".$Var."</p>";
	}
}
function space(){
	echo "<br>";	
}
//Add libraries
include "../Libraries/MySQL/Functions.php";

//Get PageName
$PageName=$_GET['p'];

//Get page settings
MySQL_open_connection($User, $Pass, $DB);
$Array=MySQL_get_array("Pages", "*", "Name='".$PageName."'");
spA($Array);
?>
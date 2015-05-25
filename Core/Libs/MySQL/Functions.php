<?php
//Load configuration file
include_once "../../Conf.php";

//Connect to Database
function MySQL_open_connection($User, $Pass, $DB){
	$Link = mysql_connect("localhost",$User, $Pass);
	@mysql_select_db($DB) or die( "Unable to select Database");
	return $Link;
}
//Creates 2 dimensional Array of Data selected in DB
function MySQL_get_array($Table, $Collumn, $Condition){
	$Query = "SELECT ".$Collumn." FROM `".$Table."`";
	if(isset($Condition)){$Query = $Query." WHERE ".$Condition;}
	$Data = mysql_Query($Query) or die(mysql_error());
	$Array = mysql_fetch_Array($Data);
	return $Array;
}

//Executes MySQL Query
function mySQL_tools_execute($Query){
	mysql_Query($Query) or die(mysql_error());
}
PFN(__FILE__);
?>
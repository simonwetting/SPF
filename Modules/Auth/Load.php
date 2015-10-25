<?php
PFN(__FILE__);
//Set Authentication status
$GLOBALS['AuthStatus']=1;

//set cookies
//setcookie("Username", "simonwetting", time() + 3600);
//setcookie("Hash", "0ef7c9abc70d7ce70f4010487b9c6d75", time() + 3600);
//setcookie("Session", "78e8f23efb2b4a667836c1ee4ffed4d3", time() + 3600);

//Authenticate user
if(!isset($_COOKIE["Username"])){$GLOBALS['AuthStatus']=0;}
else{
	//connect to DB
	include "Core/Conf/MySQL.php";
	$Link = MySQL_open_connection($User, $Pass, $DB);
	
	//Check if Username exists
	$Temp = MySQL_get_array("Users", "Username", "Username='".$_COOKIE["Username"]."'");
	if($Temp[0]!=$_COOKIE["Username"]){
		$GLOBALS['AuthWhy'] = "Username incorrect!"; $GLOBALS['AuthStatus']=0;}
	unset($Temp);
	
	//Check Hash
	$Temp = MySQL_get_array("Users", "Hash", "Username='".$_COOKIE["Username"]."'");
	if($Temp[0]!=$_COOKIE["Hash"]){
		$GLOBALS['AuthWhy'] = "Hash incorrect!"; $GLOBALS['AuthStatus']=0;}
	unset($Temp);
	
	//Check Session
	$Temp = MySQL_get_array("Users", "Session", "Username='".$_COOKIE["Username"]."'");
	if($Temp[0]!=$_COOKIE["Session"]){
		$GLOBALS['AuthWhy'] = "Session incorrect!"; $GLOBALS['AuthStatus']=0;}
	unset($Temp);
	//Check IP
	$Temp = MySQL_get_array("Users", "IP", "Username='".$_COOKIE["Username"]."'");
	if($Temp[0]!=$_SERVER['REMOTE_ADDR']){
		$GLOBALS['AuthWhy'] = "IP incorrect!"; $GLOBALS['AuthStatus']=0;}
	unset($Temp);
}


DB_MSG($GLOBALS['AuthWhy']);
DB_MSG($_SERVER['REMOTE_ADDR']);
?>
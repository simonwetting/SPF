<?php
//Change working directory for SPF
//chdir($Directory);

//Set debugger on/off
$Debug=0;

//Include Core Files
include_once "Core/Libs/Debug.php";
include_once "Core/Conf/MySQL.php";
include_once "Core/Libs/MySQL/Functions.php";
include_once "Core/Libs/Var/Locations.php";

//Get PageName
if(!isset($_GET['p'])){echo "No page chosen";}
$PageName = $_GET['p'];

//Connect to DB
$Link = MySQL_open_connection($User, $Pass, $DB);

//Check if page exists
$Temp = MySQL_get_array("Pages", "Name", "Name='".$PageName."'");
if($Temp[0]!=$PageName){echo "Page does not exist!";}
unset($Temp);

//Get info for page
$Page_info = MySQL_get_array("Pages", "*", "Name='".$PageName."'");
mysql_close($Link);

DB_MSG("Loading Settings...");
//Create associative array for settings
$Temp = explode(";", $Page_info['Settings']);
$Settings = array();
foreach($Temp as $Value){
	//Split value and variable name
	$Variable = explode("=", $Value);
	//Asign value to $Settings['Variablename']
	$Settings[$Variable[0]] = $Variable[1];
}
unset($Temp);

DB_MSG("Loading Modules...");
//Create array for modules
$Modules = explode(";", $Page_info['Modules']);

//Load modules
foreach($Modules as $Module){
	//Split modulename and variables
	$Module = explode("?", $Module);
	//Assign variables to its own array
	$Module_Settings = explode(":", $Module[1]);
	//Assign modulename to it's own variable
	$Module = $Module[0];
	//Load module
	$Path = getcwd()."/Modules/".$Module."/Load.php";
	if(file_exists($Path)){
		foreach($Module_Settings as $Temp){
			$Variable = explode("=", $Temp);
			$GLOBALS[$Module][$Variable[0]] = $Variable[1];
		}
		include $Path;
	}
	else{echo '<script>alert("Module \"'.$Module.'\" doesn\'t exist")</script>';}
}

//Include main file
DB_MSG("Loading Page...");
include getcwd()."/Content/".$Page_info['Path'];

DB_MSG("<b>Finished executing without crashing</b>");
?>
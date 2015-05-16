<?php
chdir("C:\xampp\htdocs\SPF\Core\Loader\");
//Load configuration file
include_once "../Conf.php";
//Add libraries
include_once $Dir."Core/Libraries/MySQL/Functions.php";
include_once $Dir."Core/Libraries/Debug.php";

//Get PageName
if(!isset($_GET['p'])){echo "No page chosen";}
$PageName = $_GET['p'];

$Link = MySQL_open_connection($User, $Pass, $DB);
//Check if page exists
$Temp = MySQL_get_array("Pages", "Name", "Name='".$PageName."'");
if($Temp[0]!=$PageName){echo "Page does not exist!";}
unset($Temp);

//Get info for page
$Page_info = MySQL_get_array("Pages", "*", "Name='".$PageName."'");
mysql_close($Link);

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
	$Path = "../../Modules/".$Module."/Load.php";
	if(file_exists($Path)){
		include $Path;
		foreach($Module_Settings as $Temp){
			$Variable = explode("=", $Temp);
			$GLOBALS[$Module][$Variable[0]] = $Variable[1];
		}
	}
	else{echo '<script>alert("Module \"'.$Module.'\" doesn\'t exist")</script>';}
}

//Include main file
include "../../".$Page_info['Path'];
?>
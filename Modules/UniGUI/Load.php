<?php
PFN(__FILE__);
$GLOBALS['UniGui_Style'];
//Check if style is selected, if not choose default style
if(!isset($GLOBALS['UniGUI']['Style'])){$GLOBALS['UniGui_Style']="Default";}
else $GLOBALS['UniGui_Style']=$GLOBALS['UniGUI']['Style'];

//Set variables
$Unigui_Dir="Modules/UniGUI/";
$UniGUI_Style_Loc=$Unigui_Dir."Styles/".$GLOBALS['UniGui_Style'].".css";
$GLOBALS['UniGui_Styles_Dir']="Modules/UniGUI/Styles/";

//Load UniGui_Style
echo '<link rel="stylesheet" href="'.$UniGUI_Style_Loc.'">';

//Create function UniGUI_Insert
function UniGUI_Insert($Element, $Settings=null){
	$Path=$GLOBALS['UniGui_Styles_Dir'].$GLOBALS['UniGui_Style']."/".$Element.".php";
	//Create associative array for settings
	if(isset($Settings)){
		$Temp = explode(";", $Settings);
		$GLOBALS[$Element.'_Settings'] = array();
		foreach($Temp as $Value){
			//Split value and variable name
			$Variable = explode("=", $Value);
			//Asign value to $Settings['Variablename']
			$GLOBALS[$Element.'_Settings'][$Variable[0]] = $Variable[1];
		}
	}
	//Only load module when status=True
	//if($GLOBALS[$Element.'_Settings']['Status']==1){include $Path;}
	//Ignore whether status is True
	include $Path;
}
?>
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

function spDA($TDArray){
	$m=0;
	foreach($TDArray as $Array){
		sp($m++."=\"".$Array."\"");
	}
}

function space(){
	echo "<br>";	
}

function PFN($Filename){
	if($GLOBALS["Debug"]==1){sp("included: ".$Filename);
	}
}
function DB_MSG($Msg){
		if($GLOBALS["Debug"]==1){sp($Msg);}
	}

PFN(__FILE__);
?>
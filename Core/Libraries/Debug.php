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
?>
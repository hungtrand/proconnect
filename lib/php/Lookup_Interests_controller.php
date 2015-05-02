<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Lookup_Interests.php";

$Lookup = new Lookup_Interests();   

if ($Lookup->load()) {
	$interests = $Lookup->getData(); 
	echo json_encode($interests);
} else {
	echo $Lookup->err;
}
?>
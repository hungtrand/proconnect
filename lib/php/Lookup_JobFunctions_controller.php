<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Lookup_JobFunctions.php";

$Lookup = new Lookup_JobFunctions();   

if ($Lookup->load()) {
	$jobs = $Lookup->getData(); 
	echo json_encode($jobs);
} else {
	echo $Lookup->err;
}
?>
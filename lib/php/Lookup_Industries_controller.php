<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Lookup_Industries.php";

$Lookup = new Lookup_Industries();   

if ($Lookup->load()) {
	$industries = $Lookup->getData(); 
	echo json_encode($industries);
} else {
	echo $Lookup->err;
}
?>
<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/Lookup_CitiesManager.php";

$statecode;
if (isset($_POST['StateCode'])) $statecode = $_POST['StateCode'];
else echo "Must specify StateCode"; die();

$cm = new Lookup_CitiesManager();

$cm->loadByState($statecode);

echo json_encode($cm->getData());

?>
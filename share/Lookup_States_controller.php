<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/Lookup_StatesManager.php";

$sm = new Lookup_StatesManager();
$sm->load();

echo json_encode($sm->getData());

?>
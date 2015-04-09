<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug

require_once __DIR__. "/../../lib/php/sqlConnection.php";
require_once __DIR__. "/../../lib/php/classes/Account.php";
require_once __DIR__. "/../../lib/php/classes/User.php";

// checking if logged in

session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out.';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['USERID'];
if (!$User = new USER($uid)) {
	echo "The Id is not in the database";
	die();
}


	$usersummary = null;

	if(isset($_POST['summary'])){
		$usersummary = trim($_POST['summary']);
	}

	try{
		$summ = new User($uid);
		$summ->setSummary($usersummary);
		$summ->update();

	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}

?>
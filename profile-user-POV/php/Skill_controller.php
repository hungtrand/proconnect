<?php
error_reporting(E_ALL);//debuger
ini_set("display_errors", 1);//debuger

require_once __DIR__. "/../../lib/php/sqlConnection.php";
require_once __DIR__. "/../../lib/php/classes/Account.php";
require_once __DIR__. "/../../lib/php/classes/User.php";
require_once __DIR__. "/../../lib/php/classes/Skill.php";

// checking if logged in
/*
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
*/

	$skillname = null;
	$endrosements = 0;
	$orderPosition = 0;

	if(isset($_POST['skill'])){
		$skillname = trim($_POST['skill']);
	}
	if(isset($_POST['endrosements'])){
		$endrosements = trim($_POST['endrosements']);
	}
	if(isset($_POST['orderPositions'])){
		$orderPosition = trim($_POST['orderPosition']);
	}

	try{
		
		$sk = new skill();
		$sk->setUserID($uid);
		$sk->setSkillName($skillname);
		$sk->setEndorsements($endrosements);
		$sk->setOrderPosition($orderPosition);
		$sk->save();


	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}

?>
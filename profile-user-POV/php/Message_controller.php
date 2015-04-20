<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
	require_once __DIR__."/../../lib/php/sqlConnection.php";
	require_once __DIR__."/../../lib/php/classes/Message.php";
	require_once __DIR__."/../../lib/php/classes/User.php";
	require_once __DIR__."/../../lib/php/classes/MessageManager.php";

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
/*
$uid = 7; // debug
$msID=1;  //debug */

$mode = "exit";
$msID = -1;
$sub = "Hellow PHP";
$body = "What is wrong with my code!!";
$creator = 0;

if(isset($_POST['MESSAGEID'])){
	$msid = (int)$_POST['MESSAGEID'];
}

if(isset($_POST['remove']) && $msID > 0){
	$mode = 'delete';
}elseif($msID > 0 ){
	$mode = 'edit';
}elseif($msID == 0){
	$mode = 'insert';
}

if(isset($_POST['SUBJECT'])){
	$sub = trim($_POST['SUBJECT']);
}
if(isset($_POST['BODY'])){
	$body = trim($_POST['BODY']);
}

try{
	switch ($mode) {
	 	
	case 'delete':
	$msg = new Message();
	if($msg->load($msID) == true){
		$msg->delete();
		echo json_encode(['success'=>1]);
	}else{
		echo "Cannot delete this Message! It is no longer in the System!";
	}
	break;
	case 'edit':
	$msg = new Message();
	if($msg->load($msID) == true){
		$msg->setSubject($sub);
		$msg->setBody($body);
		$msg->update();
		echo json_encode(['success' =>1]);
	}else{
		echo "Cannot Update! This Message no longer exists in System!";
	}
	break;
	case 'insert':
	$msg = new Message();
		$msg->setCreator($uid);
		$msg->setSubject($sub);
		$msg->setBody($body);
		$msg->save();
		echo json_encode(json_encode($msg->getData()));
		break;
		default:
			echo "What are you trying to do?";
			die();
			break;
		}
}catch(Exception $e){
	echo $e->getMessage();
	die();
}

?>
<?php
error_reporting(E_ALL); //Debug
ini_set("display_errors", 1); //Debug
	require_once __DIR__."/../../lib/php/sqlConnection.php";
	require_once __DIR__."/../../lib/php/classes/Notification.php";
	require_once __DIR__."/../../lib/php/classes/User.php";
	require_once __DIR__."/../../lib/php/classes/NotificationView.php";
	require_once __DIR__."/../../lib/php/classes/NotificationManager.php";

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

	$urID = -1;
	$notiViewID = -1;
	$mode = "exit";
	$notiID = -1;

	if(isset($_POST['USERID']){
		$urID = (int)$_POST['USERID'];
	}

	if(isset($_POST['NotificationViewID'])){
		$notiViewID = (int)$_POST['NotificationViewID'];
	}

	if(isset($_POST['NotificationID'])){
		$notiID = (int)$_POST['NotificationID'];
	}

	if(isset($_POST['remove']) && $notiViewID > 0){
		$mode = 'delete';
	}elseif($notiViewID > 0) {
		$mode = 'edit';
	}elseif($notiViewID == 0){
		$mode = 'insert';
	}

	try{
		switch($mode){
			case "delete":
			$notiView = new NotificationView();
			if($notiView->load($notiViewID) == true){
				$notiView->delete();
				echo json_encode(['success' => 1]);
			} else{
				echo "Cannot delete. Record not Found!";
			}
			break;
			case "edit":  //where we set as read.
			$notiView = new NotificationView();
			if($notiView->load($notiViewID) == true){
				//$notiView->
				echo "The table cannot be edit!";
			}
			break;

			case "insert":
			$notiView = new NotificationView();
			$notiView->setNotificationID();
			$notiView->setUserID();
			$notiView->save();

		}

	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}



?>
<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug

require_once __DIR__. "/../../lib/php/sqlConnection.php";
require_once __DIR__. "/../../lib/php/classes/Account.php";
require_once __DIR__. "/../../lib/php/classes/User.php";
require_once __DIR__. "/../../lib/php/classes/Notification.php";

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
	$message = null;
	$type = null;
	$Assocuser = null;
	$notcid = -1; //initialize notification ID 
	$mode = "exit"; // initialize the mode :
	if(isset($_POST['NotificationID'])){
		$noticid = (int)$_POST['NotificationID'];
	}
	if(isset($_POST['remove']) && $notcid > 0){
		$mode = 'delete'; 
	}elseif($notcid > 0){
		$mode = 'edit';
	}elseif($notcid == 0){
		$mode = 'insert';
	}
	

	if(isset($_POST['Message'])){
		$message = trim($_POST['Message']);
	}

	if(isset($_POST['Type'])){
		$type = trim($_POST['Type']);
	}

	try{
		switch ($mode) {
			case 'delete':
				$noti = new Notification(); //create new notification
				if($noti->load($notcid) == true){
					$noti->delete();
					echo json_encode(['success'=>1]);
				} else{
					echo "Cannot delete. This notification is no longer exists!";
				}
				break;
			case 'edit':
				$noti = new Notification();
				if($noti->load($notcid) == true){
					$noti->setMessage($message);
					$noti->setType($type);
					$noti->update();
					echo json_encode(['success' => 1]);
				}else{
					echo "Cannot Update! This data is not exists!";
				}
				break;

			case 'insert':
				$noti = new Notification();
					$noti->setUserID($uid);
					$noti->setMessage($message);
					$noti->setType($type);
					$noti->save();
					echo json_encode(json_encode($noti->getData()));
				break;
			default:
				echo "What are you trying to do?";
				die();
				break;
		}
		
	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}



?>
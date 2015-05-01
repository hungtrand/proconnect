<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Feed.php";
require_once __DIR__."/../../lib/php/classes/Feed2User.php";
require_once __DIR__."/../../lib/php/classes/UserConnectionManager.php";
require_once __DIR__."/Feed_view.php";

/// Check if logged in
if (isset($_POST['Username']) && isset($_POST['Password'])) {
	$login = $_POST['Username'];
	$password = $_POST['Password'];
	$accAdm = new AccountAdmin();

	$acc = $accAdm->getAccount($login, $password);
	$uid = $acc->getUserID();
} else {
	session_start();
	$home = 'Location: ../../';
	if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
		//header($home);
		echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
		die();
	}

	$uid = $UData['USERID'];
}

// $uid = 7;
if (!$User = new USER($uid)) {
	echo "The Id is not in the database";
	die();
}

$F2UID = -1; 
$mode = "exit";
// testing  
// $uid = 3;

if (isset($_POST['F2UID'])) {
	$F2UID = (int)$_POST['F2UID'];
}
if(isset($_POST['Action'])) {
	$mode = $_POST['Action'];
}

if ($F2UID < 1) {
	echo "Missing parameters.";
	die();
}

try {
	switch($mode) {
		case "Like":
			$f2u = new Feed2User();
		//	var_dump($exp->getData());
			if($f2u->load($F2UID) == true){
				$f2u->setLiked(true);
				$f2u->update();

				echo json_encode(['success'=>1]);
			} else {
				echo "Cannot save. Record no longer exists.";
			}
		break;
		case "Comment":
			/*$feed = new Feed();
			
			
			if ($feed->update()) {
				
				
				$view = new Feed_view();
				$view->load($f2u);
				echo json_encode($view->getView());
			} else {
				echo "Failed to save new feed. ".$feed->err;
			};*/
		break;
		default:
			echo "Unknown action.";
			die();
		break;
	}
	
} catch(Exception $e){
	echo $e->getMessage();
	die();
}
?>
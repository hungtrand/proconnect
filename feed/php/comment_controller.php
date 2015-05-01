<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/FeedComment.php";
require_once __DIR__."/../../lib/php/classes/Feed.php";
require_once __DIR__."/../../lib/php/classes/UserConnectionManager.php";
require_once __DIR__."/../../lib/php/classes/Notification.php";
require_once __DIR__."/../../lib/php/classes/NotificationView.php";
require_once __DIR__."/Comment_view.php";

// Check if logged in
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

$CommentID = -1; 
$FeedID = -1;
// testing  
// $uid = 3;

if (isset($_POST['CommentID'])) {
	$CommentID = (int)$_POST['CommentID'];
}
if (isset($_POST['FeedID'])) {
	$FeedID = (int)$_POST['FeedID'];
}

$mode = "exit";

if ($FeedID < 0 || $CommentID < 0) {
	echo "Missing parameters.";
	die();
} elseif ($CommentID == 0) {
	$mode = 'insert';
}

try {
	switch($mode) {
		case "insert":
			$CommentMsg = trim($_POST['CommentMessage']);
			$comment = new FeedComment();
			$comment->setFeedID($FeedID);
			$comment->setUserID($uid);
			$comment->setComment($CommentMsg);

			if ($comment->save()) {
				// Create new notification 
				$notif = new Notification();
				$notif->setUserID($uid);
				$notif->setType("FeedComment");
				$notif->setMessage($User->getName()." commented on your post.");
				$notif->save();

				// send notification to original poster
				$feed = new Feed($FeedID);

				$notifView = new NotificationView();
				$notifView->setUserID($feed->getCreator());
				$notifView->setNotificationID($notif->getID());
				$notifView->save();

				$view = new Comment_view();
				$view->load($comment);
				echo json_encode($view->getView());
			} else {
				echo "Failed to save new comment. ".$comment->err;
			};
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
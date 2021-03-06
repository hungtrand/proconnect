<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Message.php";
require_once __DIR__."/../../lib/php/classes/UserConnectionManager.php";
require_once __DIR__."/../../lib/php/classes/MessageViewManager.php";
require_once __DIR__."/Messages_view.php";

/**
*	MailActions_controller - execute actions requests from client side
*	including sending new message, archive a message or delete a message
**/

//////// check if user signed in //////////
//////// either by session or by Username and Password [POST params]/////
if (isset($_POST['Username']) && isset($_POST['Password'])) {
	$login = $_POST['Username'];
	$password = $_POST['Password'];
	$accAdm = new AccountAdmin();

	$acc = $accAdm->getAccount($login, $password);
	$uid = $acc->getUserID();
} else {
	session_start();
	if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
		//header($home);
		echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
		die();
	}

	$uid = $UData['USERID'];
}
//////////// End of signin validation /////////////

//$uid = 10;
if (!$User = new User($uid) || !isset($_POST['Action'])) {
	echo 'Missing parameters. Require: user signin, action.';
	die();
}
// 
// $User = new User(7); // For Testing
$action = $_POST['action'];

switch ($action) {
	////////////////////////////////////////////////////////
	// action to send a new messagge and set who can view //
	////////////////////////////////////////////////////////	
	case 'send':
		if (!isset($_POST['UserID']) || !isset($_POST['Subject']) 
			|| !isset($_POST['Message'])) {
			echo 'Missing parameter(s). Require: UserID, Subject, Message.';
			die();
		}

		$recipients = explode(', ', trim($_POST['UserID']));
		$subject = trim($_POST['Subject']);
		$message = trim($_POST['Message']);

		// save the message it self first
		$msg = new Message();
		$msg->setSubject($subject);
		$msg->setBody($message);
		$msg->setCreator($uid);
		$msg->save();

		// save a MessageView instance for creator // outbox message
		$msgv = new MessageView();
		$msgv->setMessageID($msg->getID());
		$msgv->setUserID($uid);
		$msgv->setIsCreator(true);
		$msgv->setRead(true);
		$msgv->setArchived(false);
		$msgv->setDeleted(false);
		$msgv->save();

		// save a MessageView for recipient // send message
		foreach ($recipients as $recip) {
			if (!is_numeric($recip)) continue;
			$recip = (int) $recip;
			if (!$recipient = new User($recip)) continue;

			$msgv = new MessageView();
			$msgv->setMessageID($msg->getID());
			$msgv->setUserID($recip);
			$msgv->setIsCreator(false);
			$msgv->setRead(false);
			$msgv->setArchived(false);
			$msgv->setDeleted(false);
			$msgv->save();
		}

		echo json_encode(["success"=>1]);
	break;

	////////////////////////////////////////////////////////
	// action to archive message, not related to previous actions
	////////////////////////////////////////////////////////
	case 'archive':
		if (!isset($_POST['messageID'])) {
			echo 'Missing parameters. Require message ID.';
			die();
		}

		$strMessageViewIDs = trim($_POST['messageID']);
		$MessageViewIDs = explode(', ', $strMessageViewIDs);

		foreach($MessageViewIDs as $MessageViewID) {
			if (!$msg = new MessageView((int)$MessageViewID)) continue;

			$msg->setArchived(true);
			if (!$msg->update()) {
				echo "An error occurred while updating your data.";
				die();
			}
		}
		
		echo json_encode(["success"=>1]);
	break;

	////////////////////////////////////////////////////////
	// action to delete message, not related to previous actions
	////////////////////////////////////////////////////////
	case 'delete';
		if (!isset($_POST['messageID'])) {
			echo 'Missing parameters. Require message ID.';
			die();
		}

		$strMessageViewIDs = trim($_POST['messageID']);
		$MessageViewIDs = explode(', ', $strMessageViewIDs);

		foreach($MessageViewIDs as $MessageViewID) {
			if (!$msg = new MessageView((int)$MessageViewID)) continue;

			$msg->setDeleted(true);
			if (!$msg->update()) {
				echo "An error occurred.";
				die();
			}
		}
		
		echo json_encode(["success"=>1]);
	break;

	case 'recover':
		if (!isset($_POST['messageID'])) {
			echo 'Missing parameters. Require message ID.';
			die();
		}

		$strMessageViewIDs = trim($_POST['messageID']);
		$MessageViewIDs = explode(', ', $strMessageViewIDs);

		foreach($MessageViewIDs as $MessageViewID) {
			if (!$msg = new MessageView((int)$MessageViewID)) continue;

			$msg->setDeleted(false); //recover from delete
			$msg->setArchived(false); //recover from archive 
										//NOTE: A message can only be in 1 category at a time, but this will cover both cases
			if (!$msg->update()) {
				echo "An error occurred.";
				die();
			}
		}
		
		echo json_encode( ["success"=>1] );
	break;

	case 'burn':
		if (!isset($_POST['messageID'])) {
			echo 'Missing parameters. Require message ID.';
			die();
		}

		$strMessageViewIDs = trim($_POST['messageID']);
		$MessageViewIDs = explode(', ', $strMessageViewIDs);

		foreach($MessageViewIDs as $MessageViewID) {
			if (!$msg = new MessageView((int)$MessageViewID)) continue;

			if (!$msg->delete()) {
				echo "An error occurred.";
				die();
			}
		}
		
		echo json_encode(["success"=>1]);
	break;
	default:
	echo 'Unknown action.';
}

?>
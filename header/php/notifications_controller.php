<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Message.php";
require_once __DIR__."/../../lib/php/classes/Notification.php";
require_once __DIR__."/../../lib/php/classes/MessageViewManager.php";
require_once __DIR__."/../../lib/php/classes/ConnectionManager.php";
require_once __DIR__."/../../lib/php/classes/NotificationViewManager.php";

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

// $uid = 10;
if (!$User = new User($uid)) {
	header($home);
	die();
}

try {
	$counts = array("messages" => 0, "notification" => 0, "new-connection" => 0);
	
	$count = 0;
	$inbox = new MessageViewManager($User);
	if ($count = $inbox->getUnreadCount()) {
		$counts['messages'] = $count;
	}

	$count = 0;
	$notif = new NotificationViewManager($User);
	if ($count = $notif->getUnreadCount()) {
		$counts['notification'] = $count;
	}

	$count = 0;
	$connMan = new ConnectionManager($User);
	if ($count = $connMan->getPendingCount()) {
		$counts['new-connection'] = $count;
	}

	// echo "\n".json_encode($inbox->getData())."\n"; // debug only
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

echo json_encode($counts);

?>
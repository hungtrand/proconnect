<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Connection.php";
require_once __DIR__."/../../lib/php/classes/Notification.php";
require_once __DIR__."/../../lib/php/classes/NotificationView.php";

/**
*	NewConnection_controller - Add a new connection to current logged in user
*/

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

	$uid = (int)$UData['USERID'];
}

//$uid = 10;
if (!$User = new User($uid)) {
	//header($home);
	die();
}

//$User = new User(10); // For Testing
if (isset($_POST['UserID'])) {
	$CUserID = (int)$_POST['UserID'];
	$CUser = new User($CUserID);
} else if (isset($_GET['UserID'])) {
	$CUserID = (int)$_GET['UserID'];
	$CUser = new User($CUserID);
}
//$CUser = new User(7);
if (!isset($CUser)) {
	echo "User not found";
	die();
}

// if a connection id is passed here, then accept connection instead of creating new one

// Create new connection // send invite
try {
	// test if connection exists
	$conn = new Connection();
	if ($conn->loadByUsers($uid, $CUserID)) {
		if ($conn->getAccepted()) {
			echo "Already Connected";
			die();
		} else if (isset($_GET['accept'])) {
			$conn->setAccepted(true);
			if ($conn->update()) {
				$notif = new Notification();
				$notif->setUserID($CUserID);
				$notif->setType("Connection");
				$notif->setMessage($User->getName()." accepted your invitation.");
				$notif->save();

				$notifView = new NotificationView();
				$notifView->setUserID($CUserID);
				$notifView->setNotificationID($notif->getID());
				$notifView->save();
				
				echo json_encode(['success'=>1]);
			} else {
				echo "Could not accept the invitation to connect.";
			}

			die();
		}
	};

	$conn = new Connection();
	$conn->setInitUserID($uid);
	$conn->setTargetUserID($CUserID);
	$conn->setAccepted(false);
	
	if($conn->save()) {
		echo json_encode(['success'=>1]);
	};

	echo $conn->err;
	//echo "\n".json_encode($conns)."\n";
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

?>
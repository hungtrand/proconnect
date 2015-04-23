<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Connection.php";

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
}
//$CUser = new User(7);
if (!isset($CUser)) {
	echo "User not found";
	die();
}

try {
	// test if connection exists
	$conn = new Connection();
	if (!$conn->loadByUsers($uid, $CUserID)) {
		echo "Not Connected";
	}

	if ($conn->delete()) {
		echo json_encode(['success'=>1]);
		die();
	}

	echo $conn->err;
	//echo "\n".json_encode($conns)."\n";
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

?>
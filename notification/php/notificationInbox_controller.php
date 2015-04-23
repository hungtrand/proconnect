<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Notification.php";
require_once __DIR__."/../../lib/php/classes/NotificationViewManager.php";
require_once __DIR__."/NotificationInbox_view.php";

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
if (!$User = new User($uid)) {
	header($home);
	die();
}
// 
// $User = new User(7); // For Testing
if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;

$rowsaPage = 20;

try {
	$inbox = new NotificationViewManager($User);
	$inbox->loadPage($page, $rowsaPage);
	$notifs = $inbox->getAll();

	$view = new NotificationInbox_view();
	$view->load($notifs);
	$data = $view->getView();

	//echo "\n".json_encode($inbox->getData())."\n".$inbox->err; // debug only
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

if ($data) echo json_encode($data);
else echo "End of results.";

?>
<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/AccountAdmin.php";
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/UserConnectionManager.php";
require_once __DIR__."/Connections_view.php";

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

if (!$User = new User($uid)) {
	header($home);
	die();
}

//$User = new User(10); // For Testing
if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;

$rowsaPage = 10;
$filter = "";

if (isset($_POST['filter'])) {
	$filter = trim($_POST['filter']);
}

try {
	$uc = new UserConnectionManager($User);
	if ($filter == 'pending') {
		$uc->loadPending($page, $rowsaPage);
	} else {
		$uc->loadPage($page, $rowsaPage);
	}

	$conns = $uc->getAll();

	$view = new Connections_view();
	$view->loadUserConnections($conns);
	$data = $view->getView();

	//echo "\n".json_encode($conns)."\n";
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

if ($data) echo json_encode($data);
else echo "End of results.";

?>
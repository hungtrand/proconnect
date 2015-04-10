<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/UserConnectionManager.php";
require_once __DIR__."/Connections_view.php";

// Check if logged in
session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['USERID'];
//$uid = 10;
if (!$User = new User($uid)) {
	header($home);
	die();
}

//$User = new User(10); // For Testing
if (isset($_POST['page'])) $page = $_POST['page'];
else $page = 1;

$rowsaPage = 10;

try {
	$uc = new UserConnectionManager($User);
	$uc->loadPage($page, $rowsaPage);
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
else echo "You don't have any connection in your network.";

?>
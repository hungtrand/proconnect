<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/ProfileManager.php";
require_once __DIR__."/UserCard_view.php";

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
	header($home);
	die();
}

//$User = new User(10); // For Testing
if (isset($_POST['keywords'])) $keywords = $_POST['keywords'];
else $keywords = "";

if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;

$keywords = explode(" ", $keywords);

$rowsaPage = 30;

try {
	$pm = new ProfileManager();
	$profiles = [];
	if (!$pm->loadBySearch($keywords, $page, $rowsaPage)) {
		echo "No results found.";
		die();
	};
	//var_dump($pm->getData()); // Debug
	$profiles = $pm->getAll();
//echo var_dump($keywords).var_dump($page).var_dump($rowsaPage);

	$view = new UserCard_view();
	$view->load($uid, $profiles);
	$data = $view->getView();

	//echo "\n".json_encode($am->getData())."\n";
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

if ($data) echo json_encode($data);
else echo "No Results Found.";

?>
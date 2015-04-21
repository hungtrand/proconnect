<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/ProfileManager.php";
require_once __DIR__."/UserCard_view.php";

// Check if logged in
session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

// Check if data valid or still exists in the database
$uid = (int)$UData['USERID'];

if (!$User = new User($uid)) {
	header($home);
	die();
}
/*$uid = 7;
$User = new User($uid);*/ // For Testing
if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;

$rowsaPage = 10;

try {
	$pm = new ProfileManager();
	$profiles = [];
	if (!$pm->loadSuggestionsByCommon($uid, $page, $rowsaPage)) {
		//echo $pm->err; // debug
		echo "No results found.";
		die();
	};
	//echo $pm->err."!!!\n";
	//var_dump($pm->getData()); // Debug
	$profiles = $pm->getAll();

	$view = new UserCard_view();
	$view->load($profiles);
	$data = $view->getView();

	//echo "\n".json_encode($am->getData())."\n";
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

if ($data) echo json_encode($data);
else echo "No Results Found.";

?>
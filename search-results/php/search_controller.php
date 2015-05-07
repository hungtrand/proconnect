<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/ProfileManager.php";
require_once __DIR__."/../../connections/php/UserCard_view.php";

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
if (isset($_POST['searchKey'])) $keywords = $_POST['searchKey'];
else $keywords = "";

if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;

$EduFilters  = null;
if (is_array($_POST['ao-education'])) 
	$EduFilters = $_POST['ao-education'];
elseif (isset($_POST['ao-education'])) {
	$EduFilters = [$_POST['ao-education']]; // still array, but array of 1
}

$SchFilters  = null;
if (is_array($_POST['ao-school'])) 
	$SchFilters = $_POST['ao-school'];
elseif (isset($_POST['ao-school'])) {
	$SchFilters = [$_POST['ao-school']]; // still array, but array of 1
}

if (strlen($keywords) == 0) {
	$keywords = [''];
} else {
	$keywords = explode(" ", $keywords);
}

$rowsaPage = 10;

try {
	$pm = new ProfileManager();
	if (is_array($EduFilters)) $pm->setFiltersByEducation($EduFilters);
	if (is_array($SchFilters)) $pm->setFiltersBySchool($SchFilters);

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
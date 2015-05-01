<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/AccountAdmin.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";

$redirectURL = '';
if (isset($_POST['Username']) && isset($_POST['Password'])) {
	$login = $_POST['Username'];
	$password = $_POST['Password'];
} elseif (isset($argv[1]) && isset($argv[2])) {
	$login = $argv[1]; // for testing
	$password = $argv[2]; // for testing
} elseif (isset($_GET['Username']) && isset($_GET['Password'])) {
	$login = $_GET['Username'];
	$password = $_GET['Password'];

	$redirectURL = '/feed/';
} else {
	echo "Invalid Inputs.";
	die();
}

$accAdm = new AccountAdmin();
$acc = $accAdm->getAccount($login, $password);

if ($acc) {
	// SIGNED IN, LOG LASTLOGIN
	$acc->setLastLogin();
	$acc->update();
	
	$user = new Profile($acc->getUserID());

	session_start();

	$_SESSION['__USERDATA__'] = json_encode($user->getData());
	echo $_SESSION['__USERDATA__'];

	$FullName = $user->getName();
	$ProfileImage = "/image/user_img.png";
	if (strlen(trim($user->getProfileImage())) > 0) {
		$ProfileImage = '/users/'.$user->getID().'/images/'.$user->getProfileImage();
	}
	
	setcookie("__USER_FULL_NAME__", $FullName, time()+60*60*24*365, '/');
	setcookie("__USER_PROFILE_IMAGE__", $ProfileImage, time()+60*60*24*365, '/');

	if (strlen($redirectURL) > 0) {
		header('Location: '.$redirectURL);
	}
} else {
	echo $accAdm->err."\n";
	echo "Account not found.";
}

?>

<?php
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/AccountAdmin.php";
require_once __DIR__."/../../lib/php/classes/User.php";

if (isset($_POST['Username']) && isset($_POST['Password'])) {
	$login = $_POST['Username'];
	$password = $_POST['Password'];
} elseif (isset($argv[1]) && isset($argv[2])) {
	$login = $argv[1]; // for testing
	$password = $argv[2]; // for testing
} else {
	echo "Invalid Inputs.";
	die();
}

$accAdm = new AccountAdmin();
$acc = $accAdm->getAccount($login, $password);

if ($acc) {
	$user = new User($acc->get('UserID'));

	session_start();

	$_SESSION['__USERDATA__'] = json_encode($user->getData());
	echo $_SESSION['__USERDATA__'];
} else {
	echo "Account not found.";
}

?>
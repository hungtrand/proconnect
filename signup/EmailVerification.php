<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once "../lib/php/sqlConnection.php";
require_once '../lib/php/classes/AccountAdmin.php';

$Email = $_GET['Email'];
$VerificationKey = $_GET['VerificationKey'];

$admin = new AccountAdmin();
$acc = $admin->verifyAccount($Email, $VerificationKey);

if ($acc) {
	$user = new User($acc->getUserID());

	session_start();

	$_SESSION['__USERDATA__'] = json_encode($user->getData());
	header( 'Location: setup.php');
} else {
	echo $admin->err;
	echo "Could not find the account associated with the provided link.";
}
?>
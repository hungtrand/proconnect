<?php
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/AccountAdmin.php";
require_once __DIR__."/../../lib/php/classes/User.php";

$test = false;
if (isset($argv[1]) && isset($argv[2]) 
	&& isset($argv[3]) && isset($argv[4])) {
	$Email = $argv[1];
	$Username = $argv[1];
	$Password = $argv[2];
	$FirstName = $argv[3];
	$LastName = $argv[4];
	$test = true;
}

if ((isset($_POST['first']) && isset($_POST['last']) 
	&& isset($_POST['email']) && isset($_POST['password']))) {

	$Email = $_POST['email'];
	$Username = $_POST['email'];
	$Password = $_POST['first'];
	$FirstName = $_POST['last'];
	$LastName = $_POST['password'];
} elseif (!$test) {
	echo "Cannot sign up. Missing information.";
	die();
}

$accAdm = new AccountAdmin();
$acc = ['Email'=>$Email, 'Password'=>$Password,
		'Username'=>$Username, 'FirstName'=>$FirstName,
		'LastName'=>$LastName];


if ($accAdm->signup($acc)) {
	echo 'success';
} else {
	echo 'fail';
}

?>
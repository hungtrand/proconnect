<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__.'/../../lib/php/classes/AccountAdmin.php';

	if(!isset($_GET['Email']) || !isset($_GET['ForgotPasswordKey'])) {
		echo "Please find the correct link in your email to reset the password!!";
		die();
	}

	$AccountAdmin = new AccountAdmin();
	$temp = $AccountAdmin->VerifyForgotPasswordKey($_GET['Email'], $_GET['ForgotPasswordKey']);

	if($temp){
		header("Location: ../resetPassword.php?Email=".$_GET['Email']);
		session_start();

		$_SESSION['__ForgotPasswordKey__'] = $_GET['ForgotPasswordKey'];
	} else{
		echo "Error sending Email!";
	}


?>
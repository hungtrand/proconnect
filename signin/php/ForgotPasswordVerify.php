<?php
require_once "../sqlConnection.php";
require_once _DIR_.'/../../lib/php/classes/AccountAdmin.php';

	if(!$_GET['Email'] || !$_GET['PasswordKey']) {
		echo "You're supposed to click on the right link!!";
		die();
	}

	$AccountAdmin = new AccountAdmin();
	$temp = $AccountAdmin->VerifyForgotPasswordKey($_GET['Email'], $_GET['PasswordKey']);

	if($temp){
		header("Location: http: /../");

	} else{
		echo "Error sending Email!";
	}


?>
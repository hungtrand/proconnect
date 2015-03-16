<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__.'/../../lib/php/classes/AccountAdmin.php';

	if(!isset($_POST['Email']) || !isset($_POST['ForgotPasswordKey']) || !isset($_POST['newPassword']) ) {
		echo "Insufficent information. Please try to update your password again with the provided link from your email.";
		die();
	}

	$Email = trim($_POST['Email']);
	$ForgotPasswordKey = trim($_POST['ForgotPasswordKey']);
	$newPassword = trim($_POST['newPassword']);

	$AccountAdmin = new AccountAdmin();
	$temp = $AccountAdmin->UpdatePassword($Email, $ForgotPasswordKey, $newPassword);

	if($temp){
		echo json_encode(["success"=>1]);
		$_SESSION['__ForgotPasswordKey__'] = null;
	} else{
		echo $AccountAdmin->err;
	}


?>
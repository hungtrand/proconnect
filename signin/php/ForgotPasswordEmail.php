<?php
	error_reporting(E_ALL); // debug
    ini_set("display_errors", 1); // debug
    require_once __DIR__."/../../lib/php/sqlConnection.php";
	require_once __DIR__.'/../../lib/php/classes/AccountAdmin.php';

	if(!isset($_POST['Email'])) {
		echo "You're supposed to send me an email!!";
		die();
	}

	$AccountAdmin = new AccountAdmin();
	$temp = $AccountAdmin->ForgotPassword($_POST['Email']);

	if($temp){
		echo json_encode(["result"=>"success", "message"=>"Email to reset password has been sent."]);
	} else{
		echo "Error sending Email!";
	}


?>
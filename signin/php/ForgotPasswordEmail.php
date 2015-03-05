<?php

require_once _DIR_.'/../../lib/php/classes/AccountAdmin.php';

	if(!$_POST['Email']) {
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
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

require_once __DIR__.'/../lib/php/sqlConnection.php';
require_once __DIR__.'/../lib/php/classes/AccountAdmin.php';

if (!isset($_GET['VerificationKey'])) {
	echo "Invalid request.";
	die();
}

$VerificationKey = $_GET['VerificationKey'];
$Email = $_GET['Email'];

$admin = new AccountAdmin();
if ($admin->verifyAccount($Email, $VerificationKey)) {
	header('Location: ../profile-user-POV/profile-user-POV.html#Verified' ) ;
} else {
	header('Location: ../index.html#VerficationFailed');
}
?>
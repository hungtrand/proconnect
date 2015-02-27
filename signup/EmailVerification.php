<?php
require_once __DIR__.'/../lib/php/sqlConnection.php';
require_once __DIR__.'/../lib/php/classes/AccountAdmin.php';

if ( $_GET['VerificationKey'] && $_GET])

$VerificationKey = $_GET['VerificationKey'];
$Email = $_GET['Email'];

$admin = new AccountAdmin();
if ($admin->verifyAccount($Email, $VerificationKey)) {
	echo 'success';
} else {
	echo 'Could not verify account.';
}
?>
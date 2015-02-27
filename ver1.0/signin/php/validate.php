<?php
require_once "../../lib/php/classes/AccountAdmin.php";

$login = $_POST['Username'];
$password = $_POST['Password'];

$AccAdm = new AccountAdmin();
$isValid = $AccAdm->validateAccount($login, $password);

if ($isValid) {
	
}

?>
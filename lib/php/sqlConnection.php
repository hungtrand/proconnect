<?php 
function connect($database) {
	$username = "root";
	$password = "Duy440";//"sce#@294";

	$conn = new PDO('mysql:host=127.0.0.1;dbname='.$database, $username, $password);

	return $conn;
}
?>
<?php 
function connect($database) {
	$username = "cl21-admin-d35";
	$password = "quriousdesigns";

	$conn = new PDO('mysql:host=79.170.40.230;dbname='.'cl21-admin-d35', $username, $password);

	return $conn;
}
?>
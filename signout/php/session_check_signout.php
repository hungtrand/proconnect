<?php
	session_start();
	$signout = 'Location: /signout/php/session_signout.php';
	
	if (!isset($_SESSION['__USERDATA__'])) {
		header($signout);
		die();
	}
?>
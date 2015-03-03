<?php
	session_start();
	$profile = 'Location: /profile-user-POV/'; // user profile page
	$loggedInBefore = 'Location: /signin/';
	
	if (isset($_SESSION['__USERDATA__'])) {
		header($profile);
		die();
	} elseif (isset($_COOKIE['__USER_FULL_NAME__']) && $_SERVER['REQUEST_URI'] == "/") {
		header($loggedInBefore);
		die();
	}
?>
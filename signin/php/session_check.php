<?php
	session_start();
	$profile = 'Location: /profile-user-POV/'; // user profile page
	
	if (isset($_SESSION['__USERDATA__']) && is_array($_SESSION['__USERDATA__'])) {
		header($profile);
		die();
	}
?>
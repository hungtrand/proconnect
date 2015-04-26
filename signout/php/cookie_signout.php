<?php
	unset($_COOKIE['__USER_FULL_NAME']);
	unset($_COOKIE['__USER_PROFILE_IMAGE__']);
	setcookie('__USER_FULL_NAME__', null, -1, '/');
	setcookie('__USER_PROFILE_IMAGE__', null, -1, '/');

	header ('Location: ../../');
?>
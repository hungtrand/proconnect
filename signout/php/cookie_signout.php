<?php
	unset($_COOKIE['__USER_FULL_NAME']);
	setcookie('__USER_FULL_NAME__', null, -1, '/');

	header ('Location: ../../');
?>
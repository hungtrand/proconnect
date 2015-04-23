<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/Profile_view.php";

// Check if logged in
session_start();
$home = 'Location: ../../';
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	//header($home);
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['USERID'];
if (!$User = new User($uid)) {
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

// $User = new User(10); // For Testing
if (isset($_POST['editing'])) {
	$editing = $_POST['editing'];
}

$mode = "exit";

if ($editing) {
	$mode = "edit";
}

try {
	switch ($mode) {
		case "edit":
			$summary = '';

			// acquiring data
			if (isset($_POST["summary"]))
				$summary = $_POST["summary"];

			$User->setSummary($summary);

			if ($User->update()) {
				echo json_encode(['success'=>1]);
			} else {
				$User->err;
			};

			
		break;
		default:
			echo "What are you trying to do?";
			die();
		break;
	}
	
} catch(Exception $e){
	echo $e->getMessage();
	die();
}
?>
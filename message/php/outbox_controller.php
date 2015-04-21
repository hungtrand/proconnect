<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Message.php";
require_once __DIR__."/../../lib/php/classes/MessageViewManager.php";
require_once __DIR__."/Messages_view.php";

// Check if logged in
session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['USERID'];
//$uid = 10;
if (!$User = new User($uid)) {
	header($home);
	die();
}
// 
// $User = new User(7); // For Testing
if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;

$rowsaPage = 20;

try {
	$outbox = new MessageViewManager($User);
	$outbox.setMailbox('outbox');
	$outbox->loadPage($page, $rowsaPage);
	$messages = $outbox->getAll();

	$view = new Messages_view();
	$view->load($messages);
	$data = $view->getView();

	// echo "\n".json_encode($outbox->getData())."\n"; // debug only
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

if ($data) echo json_encode($data);
else echo "End of results.";

?>
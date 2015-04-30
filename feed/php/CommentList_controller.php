<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/AccountAdmin.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Feed.php";
require_once __DIR__."/../../lib/php/classes/FeedComment.php";
require_once __DIR__."/../../lib/php/classes/FeedCommentManager.php";
require_once __DIR__."/CommentList_view.php";

// Check if logged in
if (isset($_POST['Username']) && isset($_POST['Password'])) {
	$login = $_POST['Username'];
	$password = $_POST['Password'];
	$accAdm = new AccountAdmin();

	$acc = $accAdm->getAccount($login, $password);
	$uid = $acc->getUserID();
} else {
	session_start();
	$home = 'Location: ../../';
	if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
		//header($home);
		echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
		die();
	}

	$uid = $UData['USERID'];
}

if (!$User = new User($uid)) {
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

if (!isset($_POST['FeedID'])) {
	echo "Feed Not Found.";
	die();
}

$FeedID = (int) $_POST['FeedID'];

//$User = new User(10); // For Testing
if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;
$rowsaPage = 10;

$afterID = '';
if (isset($_POST['afterID'])) $afterID = (int)$_POST['afterID'];

try {
	$feed = new Feed($FeedID);
	$fcm = new FeedCommentManager($feed);

	if (is_numeric($afterID))
		$fcm->loadNewer($afterID);
	else
		$fcm->loadPage($page, $rowsaPage);
	
	$comments = $fcm->getAll();

	$view = new CommentList_view();
	$view->load($comments);
	$data = $view->getView();

	// echo "\n".$fcm->err."\n".json_encode($fcm->getData())."\n";
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

if ($data) echo json_encode($data);
else echo "End of results.";

?>
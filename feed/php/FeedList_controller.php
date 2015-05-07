<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/AccountAdmin.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Feed.php";
require_once __DIR__."/../../lib/php/classes/Feed2UserManager.php";
require_once __DIR__."/../../lib/php/classes/vw_FeedManager.php";
require_once __DIR__."/FeedList_view.php";

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

//$User = new User(10); // For Testing
if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;
$rowsaPage = 12;

if (isset($_POST['afterID'])) $afterID = (int)$_POST['afterID'];
if (isset($_POST['Interest'])) $Interest = trim($_POST['Interest']);

try {
	$fum = new Feed2UserManager($User);

	if (is_numeric($afterID))
		$fum->loadNewer($afterID);
	elseif (strlen($Interest)) {
		$fim = new vw_FeedManager($User);
		$fim->load($page, $rowsaPage, $Interest);
	}
	else
		$fum->loadPage($page, $rowsaPage);
	
	if (strlen($Interest)) {
		$feeds = $fim->getAll();

		$view = new FeedList_view();
		$view->loadFeeds($feeds);
		$data = $view->getView();
	} else {
		$feeds = $fum->getAll();

		$view = new FeedList_view();
		$view->load($feeds);
		$data = $view->getView();
	}
	

	// echo "\n".json_encode($fum->getData())."\n";
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

if ($data) echo json_encode($data);
else echo "End of results.";

?>
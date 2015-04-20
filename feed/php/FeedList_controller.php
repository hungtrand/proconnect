<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Feed.php";
require_once __DIR__."/../../lib/php/classes/Feed2UserManager.php";
require_once __DIR__."/FeedList_view.php";

// Check if logged in
/*session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['USERID'];*/
$uid = 7;
if (!$User = new User($uid)) {
	header($home);
	die();
}

//$User = new User(10); // For Testing
if (isset($_POST['page'])) $page = (int)$_POST['page'];
else $page = 1;
$rowsaPage = 10;

if (isset($_POST['afterID'])) $afterID = (int)$_POST['afterID'];

try {
	$fum = new Feed2UserManager($User);

	if (is_numeric($afterID))
		$fum->loadNewer($afterID);
	else
		$fum->loadPage($page, $rowsaPage);
	
	$feeds = $fum->getAll();

	$view = new FeedList_view();
	$view->load($feeds);
	$data = $view->getView();

	// echo "\n".json_encode($fum->getData())."\n";
} catch (Exception $e) {
	echo $e->getMessage();

	die();
}

if ($data) echo json_encode($data);
else echo "End of results.";

?>
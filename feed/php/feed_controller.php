<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Feed.php";
require_once __DIR__."/../../lib/php/classes/Feed2User.php";
require_once __DIR__."/../../lib/php/classes/UserConnectionManager.php";
require_once __DIR__."/Feed_view.php";

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

// $uid = 7;
if (!$User = new USER($uid)) {
	echo "The Id is not in the database";
	die();
}

$ImageURL = '';
$ExternalLink = '';
$InternalLink = '/profile-public-POV/?UserID='.$uid;
$ContentMessage = '';
$YouTubeID = '';
$FeedID = -1; 
// testing  
// $uid = 3;

if (isset($_POST['FeedID'])) {
	$FeedID = (int)$_POST['FeedID'];
}
if(isset($_POST['YouTubeURL'])) {
	$ExternalLink = trim($_POST['YouTubeURL']);
	parse_str( parse_url( $ExternalLink, PHP_URL_QUERY ), $qStringsArr );
	$YouTubeID = $qStringsArr['v'];
}
if(isset($_POST['ContentMessage'])){
	$Content= trim($_POST['ContentMessage']);
}
if(isset($_POST['ImageURL'])) {
	$ImageURL = trim($_POST['ImageURL']);
}

$mode = "exit";

if ($FeedID > 0) {
	$mode = "edit";
} elseif ($FeedID == 0) {
	$mode = 'insert';
}

try {
	switch($mode) {
		case "edit":
			$feed = new Feed();
		//	var_dump($exp->getData());
			if($feed->load($FeedID) == true){
				
				$feed->update();

				echo json_encode(['success'=>1]);
			} else {
				echo "Cannot save. Record no longer exists.";
			}
		break;
		case "insert":
			$feed = new Feed();
			$feed->setContent($Content);
			$feed->setImageURL($ImageURL);
			$feed->setExternalURL($YouTubeID);
			$feed->setInternalURL($InternalLink);
			$feed->setCreator($uid);
			$feed->setType('normal');
			
			if ($feed->save()) {
				$ucm = new UserConnectionManager($User);
				$connections = $ucm->getAll();

				$f2u = new Feed2User();
				$f2u->setFeedID($feed->getID());
				$f2u->setUserID($uid);
				$f2u->setStatus("SELF");
				$f2u->save();

				foreach ($connections as $conn) {
					$f2u = new Feed2User();
					$f2u->setFeedID($feed->getID());
					$f2u->setUserID($conn->getConnectionUserID());
					$f2u->setStatus("NEW");
					$f2u->save();
				}
				
				$view = new Feed_view();
				$view->load($f2u);
				echo json_encode($view->getView());
			} else {
				echo "Failed to save new feed. ".$feed->err;
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
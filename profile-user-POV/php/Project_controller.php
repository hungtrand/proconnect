<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Project.php";
require_once __DIR__."/Project_view.php";

session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out.';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['USERID'];
if (!$User = new USER($uid)) {
	echo "The Id is not in the database";
	die();
}

$name = "";
$url = "";
$description = "";
$ProjectID = -1;

//$uid = $UData[3];

if (isset($_POST['ProjectID'])) {
	$ProjectID = (int)$_POST['ProjectID'];
}
if(isset($_POST['project-name'])) {
	$name = trim($_POST['project-name']);
}
if(isset($_POST['project-url'])){
	$url= trim($_POST['project-url']);
}
if(isset($_POST['project-description'])){
	$description = trim($_POST['project-description']);
}

$mode = "exit";

if (isset($_POST['remove']) && $ProjectID > 0) {
	$mode = "delete";
} elseif ($ProjectID > 0) {
	$mode = "edit";
} elseif ($ProjectID == 0) {
	$mode = 'insert';
}

try {
	switch($mode) {
		case "delete":
			$proj = new Project();
			if($proj->load($ProjectID) == true){
				
				$proj->delete();
				echo json_encode(['success'=>1]);
			
			} else {
				echo "Cannot delete. Record no longer exists.";
			}
		break;
		case "edit":
			$proj = new Project();
		//	var_dump($proj->getData());
			if($proj->load($ProjectID) == true){
				$proj->setProjectTitle($name);
				$proj->setProjectURL($url);
				$proj->setDescription($description);
				$proj->update();
				
				echo json_encode(['success'=>1]);
			} else {
				echo "Cannot save. Record no longer exists.";
			}
		break;
		case "insert":
			$proj = new Project();
			$proj->setUserID($uid);
			$proj->setProjectTitle($name);
			$proj->setProjectURL($url);
			$proj->setDescription($description);
			$proj->save();

			$view = new Project_view();
			$view->load($proj);
			echo json_encode(json_encode($view->getView()));
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
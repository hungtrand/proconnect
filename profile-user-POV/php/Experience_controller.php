<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Experience.php";
require_once __DIR__."/Experience_view.php";

// checking if logged in
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

$title = null;
$compName= null;
$location = null;
$startmonth= 0;
$startyear=0;
$endmonth=0;
$endyear= 0;
$status= false;
$description = null;
$expid = -1; 
// testing  
// $uid = 3;

if (isset($_POST['ExpID'])) {
	$expid = (int)$_POST['ExpID'];
}
if(isset($_POST['position-title'])) {
	$title = trim($_POST['position-title']);
}
if(isset($_POST['company-name'])){
	$compName= trim($_POST['company-name']);
}
if(isset($_POST['company-location'])) {
	$location = trim($_POST['company-location']);
}
if(isset($_POST['work-start-month'])) {
	$startmonth= trim($_POST['work-start-month']);
}
if(isset($_POST['work-start-year'])) {
	$startyear = trim($_POST['work-start-year']);
}
if(isset($_POST['work-end-month'])) {
	$endmonth = trim($_POST['work-end-month']);
}
if(isset($_POST['work-end-year'])) {
	$endyear = trim($_POST['work-end-year']);
}
if(isset($_POST['work-present'])){
	$status= true;
} 
if(isset($_POST['experience-description'])) {
	$description = trim($_POST['experience-description']);
}

$mode = "exit";

if (isset($_POST['remove']) && $expid > 0) {
	$mode = "delete";
} elseif ($expid > 0) {
	$mode = "edit";
} elseif ($expid == 0) {
	$mode = 'insert';
}

try {
	switch($mode) {
		case "delete":
			$exp = new Experience();
			if($exp->load($expid) == true){
				
				$exp->delete();
				echo json_encode(['success'=>1]);
			
			} else {
				echo "Cannot delete. Record no longer exists.";
			}
		break;
		case "edit":
			$exp = new Experience();
		//	var_dump($exp->getData());
			if($exp->load($expid) == true){
				$exp->setTitle($title);
				$exp->setCompanyName($compName);
				$exp->setLocation($location);
				$exp->setStartMonth($startmonth);
				$exp->setStartYear($startyear);
				$exp->setEndMonth($endmonth);
				$exp->setEndYear($endyear);
				$exp->setDescription($description);
				
				$exp->update();
				
				echo json_encode(['success'=>1]);
			} else {
				echo "Cannot save. Record no longer exists.";
			}
		break;
		case "insert":
			$exp = new Experience();
			$exp->setUserID($uid);
			$exp->setTitle($title);
			$exp->setCompanyName($compName);
			$exp->setLocation($location);
			$exp->setStartMonth($startmonth);
			$exp->setStartYear($startyear);
			$exp->setEndMonth($endmonth);
			$exp->setEndYear($endyear);
			$exp->setDescription($description);
			$exp->save();	

			$view = new Experience_view();
			$view->load($exp);
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
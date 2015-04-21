<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Education.php";
require_once __DIR__."/Education_view.php";


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
/*$uid = 7; // debug
$eduid=4;  //debug */

$name = null;
$degree = null;
$study = null;
$grade = 0;
$start = 0;
$end = 0;
$activity = null;
$description = null;
$eduid = -1; 

$mode = "exit";
//$uid = $UData[3];

if (isset($_POST['EduID'])) {
	$eduid = (int)$_POST['EduID'];
}
if(isset($_POST['school-name'])) {
	$name = trim($_POST['school-name']);
}
if(isset($_POST['degree'])){
	$degree= trim($_POST['degree']);
}
if(isset($_POST['field-of-study'])) {
	$study = trim($_POST['field-of-study']);
}
if(isset($_POST['grade'])) {
	$grade= trim($_POST['grade']);
}
if(isset($_POST['school-year-started'])) {
	$start = trim($_POST['school-year-started']);
}
if(isset($_POST['school-year-ended'])){
	$end = trim($_POST['school-year-ended']);
} 
if(isset($_POST['activities'])) {
	$activity = trim($_POST['activities']);
}
if(isset($_POST['education-description'])){
	$description = trim($_POST['education-description']);
}

if (isset($_POST['remove']) && $eduid > 0) {
	$mode = "delete";
} elseif ($eduid > 0) {
	$mode = "edit";
} elseif ($eduid == 0) {
	$mode = 'insert';
}


try{
	

	switch($mode) {
		case "delete":
			$educ = new Education();
			if($educ->load($eduid) == true){
				//var_dump($educ->getData());
				$educ->delete();
				echo json_encode(['success'=>1]);
			
			} else {
				echo "Cannot delete. Record no longer exists.";
			}
		break;
		case "edit":
			$educ = new Education();
			if($educ->load($eduid) == true){
				$educ->setSchool($name);
				$educ->setDegree($degree);
				$educ->setFieldOfStudy($study);
				$educ->setActivities($activity);
				$educ->setGPA($grade);
				$educ->setYearStart($start);
				$educ->setYearEnd($end);
				$educ->setDescription($description);
				$educ->update();

				//echo $educ->err;
				echo json_encode(['success'=>1]);
			} else {
				echo "Cannot save. Record no longer exists.";
			}
		break;
		case "insert":
			$educ = new Education();
			$educ->setUserID($uid);
			$educ->setSchool($name);
			$educ->setDegree($degree);
			$educ->setFieldOfStudy($study);
			$educ->setActivities($activity);
			$educ->setGPA($grade);
			$educ->setYearStart($start);
			$educ->setYearEnd($end);
			$educ->setDescription($description);

			$educ->save();

			$view = new Education_view();
			$view->load($educ);
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
<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Education.php";


// checking if logged in
session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out.';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['EDUID'];
if (!$User = new Education($uid)) {
	echo "The Id is not in the database";
	die();
}

	$name = null;
	$degree = null;
	$study = null;
	$grade = 0;
	$start = 0;
	$end = 0;
	$activity = null;
	$description = null;
	//$uid = $UData[3];
	


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

	try{
		$educ = new Education($uid);
		//var_dump($educ->getData());
		
		$educ->setSchool($name);
		$educ->setDegree($degree);
		$educ->setFieldOfStudy($study);
		$educ->setActivities($activity);
		$educ->setGPA($grade);
		$educ->setYearStart($start);
		$educ->setYearEnd($end);
		$educ->setDescription($description);
		$educ->update();
		
		//$educ->save();
		$eduData = $educ->getData();
		
		//
		//var_dump($eduData);
		
		return true;

	
	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}







?>


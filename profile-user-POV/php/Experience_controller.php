<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Experience.php";

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
	$id = 0;
	
	// testing  
	// $uid = 3;


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
	

	try{
		$exp = new Experience();
	//	var_dump($exp->getData());
		if($exp->load($id) == true){
		$exp = new Experience($id);
		$exp->setTitle($title);
		$exp->setCompanyName($compName);
		$exp->setLocation($location);
		$exp->setStartMonth($startmonth);
		$exp->setStartYear($startyear);
		$exp->setEndMonth($endmonth);
		$exp->setEndYear($endyear);
		$exp->setDescription($description);
		
		$exp->update();
		
		} else {
			
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
			return true;
		}
	// testing	
	//	$expData = $exp->getData();
	//	var_dump($expData);
		
	

	
	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}







?>


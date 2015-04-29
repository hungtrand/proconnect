<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Job.php";


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
['JOBID', 'JOBLOCATION', 'JOBTITLE', 'INDUSTRY', 'COMPANYNAME', 'COMPANYDESCRIPTION', 'EXPERIENCE', 'SPECIALSKILL',
									'EMPLOYMENTTYPE', 'JOBHIRING', 'PREFERENCELOCATION', 'PREFERENCEINDUSTRY', 'PREFERENCEJOBTYPE', 'USERID'];
	$jobhiring = null;
	$joblocation = null;
	$jobtitle = null;
	$industry = null;
	$companyname = null;
	$description = null;
	$experience = null;
	$skill = null;
	$employmenttype = null;
	$preferencelocation = null;
	$perferenceindustry = null;
	$perferenceJobType = null;
	
	$id = 0; 
	//$uid = $UData[3];


	if(isset($_POST['jobhiring'])) {
		$jobhiring = trim($_POST['jobhiring']);
	}
	if(isset($_POST['joblocation'])){
		$joblocation= trim($_POST['joblocation']);
	}
	if(isset($_POST['jobtitle'])) {
		$jobtitle = trim($_POST['jobtitle']);
	}
	if(isset($_POST['industry'])) {
		$industry= trim($_POST['industry']);
	}
	if(isset($_POST['companyname'])) {
		$companyname = trim($_POST['companyname']);
	}
	if(isset($_POST['description'])){
		$description = trim($_POST['description']);
	} 
	if(isset($_POST['experience'])) {
		$experience = trim($_POST['experience']);
	}
	if(isset($_POST['skill'])){
		$skill = trim($_POST['skill']);
	}
	if(isset($_POST['employmenttype'])) {
		$employmenttype= trim($_POST['employmenttype']);
	}
	if(isset($_POST['preferencelocation'])) {
		$preferencelocation= trim($_POST['preferencelocation']);
	}
	if(isset($_POST['preferenceindustry'])) {
		$preferenceindustry= trim($_POST['preferenceindustry']);
	}
	if(isset($_POST['preferenceJobType'])) {
		$preferenceJobType= trim($_POST['preferenceJobType']);
	}


	try{


		$job = new Job();
		if($job->load($id) == true){
			$job = new Job($id);
		//var_dump($job->getData());
		
		$job->setJobhiring($jobhiring);
		$job->setJobLocation($joblocation);
		$job->setJobTitle($jobtitle);
		$job->setIndustry($);
		$job->setCompanyName($grade);
		$job->setCompanyDescription($start);
		$job->setExperience($end);
		$job->setSpecialSkill($description);
		$job->setEmploymentType($jobhiring);
		$job->setPreferenceLocation($jobhiring);
		$job->setPreferenceIndustry($jobhiring);
		$job->setPreferenceJobType($jobhiring);
		
		$job->update();
		die();
		}
		else {
		
		$job = new Job();
		$job->setUserID($uid);
		$job->setJobhiring($jobhiring);
		$job->setJobLocation($joblocation);
		$job->setJobTitle($jobtitle);
		$job->setIndustry($);
		$job->setCompanyName($grade);
		$job->setCompanyDescription($start);
		$job->setExperience($end);
		$job->setSpecialSkill($description);
		$job->setEmploymentType($jobhiring);
		$job->setPreferenceLocation($jobhiring);
		$job->setPreferenceIndustry($jobhiring);
		$job->setPreferenceJobType($jobhiring);
		
		
		

		$job->save();
		//$job = $job->getData();
		
		//
		//var_dump($job);
		
		return true;
		}
	
	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}







?>


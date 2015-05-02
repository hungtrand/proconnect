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
									'EMPLOYMENTTYPE', 'JOBHIRING', 'PREFERENCELOCATION', 'PREFERENCEINDUSTRY', 'PREFERENCEJOBTYPE', 'USERID', 'DATECREATED', 'JOBDESCRIPTION', 'JOBFUNCTION'
									, 'REDIRECTEMAIL', 'REDIRECTSITE'];
	
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
	$jobfunction = null;
	$jobdescription = null;
	$redirectemail = null;
	$redirectsite = null;
	
	$id = 0; 
	//$uid = $UData[3];


	if(isset($_POST['JOBHIRING'])) {
		$jobhiring = trim($_POST['JOBHIRING']);
	}
	if(isset($_POST['JOBLOCATION'])){
		$joblocation= trim($_POST['JOBLOCATION']);
	}
	if(isset($_POST['JOBTITLE'])) {
		$jobtitle = trim($_POST['JOBTITLE']);
	}
	if(isset($_POST['INDUSTRY'])) {
		$industry= trim($_POST['INDUSTRY']);
	}
	if(isset($_POST['COMPANYNAME'])) {
		$companyname = trim($_POST['COMPANYNAME']);
	}
	if(isset($_POST['COMPANYDESCRIPTION'])){
		$description = trim($_POST['COMPANYDESCRIPTION']);
	} 
	if(isset($_POST['EXPERIENCE'])) {
		$experience = trim($_POST['EXPERIENCE']);
	}
	if(isset($_POST['SPECIALSKILL'])){
		$skill = trim($_POST['SPECIALSKILL']);
	}
	if(isset($_POST['EMPLOYMENTTYPE'])) {
		$employmenttype= trim($_POST['EMPLOYMENTTYPE']);
	}
	if(isset($_POST['PREFERENCELOCATION'])) {
		$preferencelocation= trim($_POST['PREFERENCELOCATION']);
	}
	if(isset($_POST['PREFERENCEINDUSTRY'])) {
		$preferenceindustry= trim($_POST['PREFERENCEINDUSTRY']);
	}
	if(isset($_POST['PREFERENCEJOBTYPE'])) {
		$preferenceJobType= trim($_POST['PREFERENCEJOBTYPE']);
	}
	if(isset($_POST['JOBDESCRIPTION'])){
		$jobdescription = trim($_POST['JOBDESCRIPTION']);
	}
	if(isset($_POST['JOBFUNCTION'])){
		$jobfunction = trim($_POST['JOBFUNCTION']);
	}

	if(isset($_POST['REDIRECTEMAIL'])){
		$redirectemail = trim($_POST['REDIRECTEMAIL']);
	}
	if(isset($_POST['REDIRECTSITE'])){
		$redirectsite = trim($_POST['REDIRECTSITE']);
	}


	try{


		$job = new Job();
		if($job->load($id) == true){
			$job = new Job($id);
		//var_dump($job->getData());
		
		$job->setJobhiring($jobhiring);
		$job->setJobLocation($joblocation);
		$job->setJobTitle($jobtitle);
		$job->setIndustry($industry);
		$job->setCompanyName($companyname);
		$job->setCompanyDescription($description);
		$job->setExperience($experience);
		$job->setSpecialSkill($skill);
		$job->setEmploymentType($employmenttype);
		$job->setPreferenceLocation($preferencelocation);
		$job->setPreferenceIndustry($preferenceindustry);
		$job->setPreferenceJobType($preferenceJobType);
		$job->setJobDescription($jobDescription);
		$job->setJobFunction($jobfunction);
		$job->setRedirectEmail($redirectemail);
		$job->setRedirectSite($redirectsite);
		
		$job->update();
		die();
		}
		else {
		
		$job = new Job();
		$job->setUserID($uid);
		$job->setJobhiring($jobhiring);
		$job->setJobLocation($joblocation);
		$job->setJobTitle($jobtitle);
		$job->setIndustry($industry);
		$job->setCompanyName($companyname);
		$job->setCompanyDescription($description);
		$job->setExperience($experience);
		$job->setSpecialSkill($skill);
		$job->setEmploymentType($employmenttype);
		$job->setPreferenceLocation($preferencelocation);
		$job->setPreferenceIndustry($preferenceindustry);
		$job->setPreferenceJobType($preferenceJobType);
		$job->setJobDescription($jobDescription);
		$job->setJobFunction($jobfunction);
		$job->setRedirectEmail($redirectemail);
		$job->setRedirectSite($redirectsite);
		

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


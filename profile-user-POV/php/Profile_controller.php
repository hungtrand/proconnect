<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/EducationManager.php";
require_once __DIR__."/../../lib/php/classes/ExperienceManager.php";
require_once __DIR__."/../../lib/php/classes/ProjectManager.php";
require_once __DIR__."/../../lib/php/classes/SkillManager.php";
require_once __DIR__."/Profile_view.php";

// Check if logged in
session_start();
$home = 'Location: ../../';
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	//header($home);
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['USERID'];
if (!$User = new User($uid)) {
	header($home);
	die();
}

//$User = new User(10); // For Testing

// get all info for profile
$Acc = new Account();
$Acc->loadByUserID($User->getID());

$ExpMgr = new ExperienceManager($User);
$AllExp = $ExpMgr->getAll();

$EduMgr = new EducationManager($User);
$AllEdu = $EduMgr->getAll();

$ProjMgr = new ProjectManager($User);
$AllProj = $ProjMgr->getAll();

$SkillMgr = new SkillManager($User);
$AllSkills = $SkillMgr->getAll();

// Start Producing View here
$view = new Profile_View();
$view->loadPersonalInfo($User, $Acc);
$view->loadExperience($AllExp);
$view->loadProjects($AllProj);
$view->loadEducation($AllEdu);	

echo json_encode($view->getView());
?>
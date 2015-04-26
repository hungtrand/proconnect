<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/EducationManager.php";
require_once __DIR__."/../../lib/php/classes/ExperienceManager.php";
require_once __DIR__."/../../lib/php/classes/ProjectManager.php";
require_once __DIR__."/../../lib/php/classes/SkillManager.php";
require_once __DIR__."/../../lib/php/classes/UserConnectionManager.php";
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
	echo 'Session Timed Out. <a href="/signin/">Sign back in</a>';
	die();
}

//$User = new User(10); // For Testing
if (!isset($_POST['UserID'])) {
	echo "Invalid Request";
	die();
}

$targetUID = $_POST['UserID'];

if (!$targetUser = new User($targetUID)) {
	echo 'User Not Found.';
	die();
}


// get all info for profile
$Acc = new Account();
$Acc->loadByUserID($targetUser->getID());

$ExpMgr = new ExperienceManager($targetUser);
$AllExp = $ExpMgr->getAll();

$EduMgr = new EducationManager($targetUser);
$AllEdu = $EduMgr->getAll();

$ProjMgr = new ProjectManager($targetUser);
$AllProj = $ProjMgr->getAll();

$SkillMgr = new SkillManager($targetUser);
$AllSkills = $SkillMgr->getAll();

$conn = new Connection();
$connStatus = "Not Connected";
if ($conn->loadByUsers($uid, $CUserID)) {
	if ($conn->getAccepted()) $connStatus = "Connected";
	else $connStatus = "Invitation Pending.";
}


// Start Producing View here
$view = new Profile_View();
$view->loadPersonalInfo($targetUser, $Acc);
$view->loadExperience($AllExp);
$view->loadProjects($AllProj);
$view->loadEducation($AllEdu);
$view->setConnectionStatus($connStatus);	

echo json_encode($view->getView());
?>
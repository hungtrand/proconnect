<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Job.php";
require_once __DIR__."/../../lib/php/classes/UserConnectionManager.php";
require_once __DIR__."/../../lib/php/classes/Notification.php";
require_once __DIR__."/../../lib/php/classes/NotificationView.php";

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

$JobTitle = isset($_POST['JobTitle']) ? $_POST['JobTitle'] : '';
$CompanyName= isset($_POST['CompanyName']) ? $_POST['CompanyName'] : '';
$ContactInfo= isset($_POST['ContactInfo']) ? $_POST['ContactInfo'] : '';
$JobDescription= isset($_POST['JobDescription']) ? $_POST['JobDescription'] : '';
$SkillDescription= isset($_POST['SkillDescription']) ? $_POST['SkillDescription'] : '';
$CompanyDescription= isset($_POST['CompanyDescription']) ? $_POST['CompanyDescription'] : '';
$EmploymentType= isset($_POST['EmploymentType']) ? $_POST['EmploymentType'] : '';
$Experience= isset($_POST['Experience']) ? $_POST['Experience'] : '';+
$JobFunctions= isset($_POST['JobFunctions']) ? $_POST['JobFunctions'] : '';
$Industries= isset($_POST['Industries']) ? $_POST['Industries'] : '';
$isHiring = true;

$JobID = -1;

if (isset($_POST['JobID'])) {
	$JobID = (int)$_POST['JobID'];
}

$mode = "exit";

if ($JobID > 0) {
	$mode = "edit";
} elseif ($JobID == 0) {
	$mode = 'insert';
}

try {
	switch($mode) {
		case "edit":
			$job = new Job();
		//	var_dump($exp->getData());
			if($job->load($JobID) == true){
				
				$job->update();

				echo json_encode(['success'=>1]);
			} else {
				echo "Cannot save. Record no longer exists.";
			}
		break;
		case "insert":

			$job = new Job();
			$job->setJobTitle($JobTitle);
			$job->setCompanyName($CompanyName);
			$job->setContactInfo($ContactInfo);
			$job->setJobDescription($JobDescription);
			$job->setSpecialSkill($SkillDescription);
			$job->setCompanyDescription($CompanyDescription);
			$job->setEmploymentType($EmploymentType);
			$job->setExperience($Experience);
			$job->setJobFunction($JobFunctions);
			$job->setIndustry($Industries);
			$job->setJobHiring($isHiring);
			
			if ($job->save()) {
				$ucm = new UserConnectionManager($User);
				$connections = $ucm->getAll();

				// Create new notification 
				$notif = new Notification();
				$notif->setUserID($uid);
				$notif->setType("NewJobPosting");
				$notif->setMessage($User->getName()." posted a new job.");
				$notif->save();

				foreach ($connections as $conn) {
					$notifView = new NotificationView();
					$notifView->setUserID($conn->getConnectionUserID());
					$notifView->setNotificationID($notif->getID());
					$notifView->save();
				}

				echo json_encode(['success'=>1]);
			} else {
				echo "Failed to save new job. ".$job->err;
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
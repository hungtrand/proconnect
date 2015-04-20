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
require_once __DIR__."/../../lib/php/classes/Profile.php";
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

// $User = new User(10); // For Testing
$editing = false;
if (isset($_POST['editing'])) {
	$editing = $_POST['editing'];
}

$mode = "exit";

if ($editing) {
	$mode = "edit";
} else {
	$mode = 'load';
}

try {
	switch ($mode) {
		case "edit":
			$firstname = '';
			$lastname = '';
			$middleintial = '';
			$emailaddress = '';
			$altemailaddress = '';
			$phonetype = 'Home';
			$country = '';
			$zipcode = '';
			$countryname = '';
			$postalcode = '';
			$address = '';

			// acquiring data
			if (isset($_POST["first-name"]))
				$firstname = $_POST["first-name"];
			if (isset($_POST["last-name"]))
				$lastname = $_POST["last-name"];
			if (isset($_POST["middle-initial"]))
				$middleintial = $_POST["middle-initial"];
			if (isset($_POST["email-address"]))
				$emailaddress = $_POST["email-address"];
			if (isset($_POST["alt-email-address"]))
				$altemailaddress = $_POST["alt-email-address"];
			if (isset($_POST["phone-number"]))
				$phonenumber = $_POST["phone-number"];
			if (isset($_POST["phone-type"]))
				$phonetype = $_POST["phone-type"];
			if (isset($_POST["inlineRadioOptions-country"]))
				$country = $_POST["inlineRadioOptions-country"];
			if (isset($_POST["zipcode"]))
				$zipcode = $_POST["zipcode"];
			if (isset($_POST["country-name"]))
				$countryname = $_POST["country-name"];
			if (isset($_POST["postal-code"]))
				$postalcode = $_POST["postal-code"];
			if (isset($_POST["address"]))
				$address = $_POST["address"];
			// End of data acquiring

			// validate first
			if (!($firstname && $lastname && $emailaddress)) {
				echo "Some fields are required.";
				die();
			}

			if (strtolower($country) != 'united states') {
				$country = $countryname;
				$zipcode = $postalcode;
			}


			// Start updating
			$Acc = new Account();
			$Acc->loadByUserID($User->getID());
			$Acc->setEmail($emailaddress);
			$Acc->setEmail_Alt($altemailaddress);

			$User->setName($firstname, $lastname, $middleintial);
			$User->setPhone($phonenumber, $phonetype);
			$User->setAddress($address, '', '', $zipcode, $country);

			if ($Acc->update() && $User->update()) {
				$profile = new Profile($User->getID());
				$_SESSION['__USERDATA__'] = json_encode($profile->getData());

				echo json_encode(['success'=>1]);
			} else {
				echo $Acc->err ."\n<br />\n" . $User->err;
			};

			
		break;
		case "load":
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
			$view->loadSkills($AllSkills);	

			echo json_encode($view->getView());
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
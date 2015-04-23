<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Experience.php";
require_once __DIR__."/../../lib/php/classes/Education.php";

// Check if logged in
session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out.';
	die();
}

// Check if data valid or still exists in the database
$uid = $UData['USERID'];
if (!$User = new User($uid)) {
	header($home);
	die();
}

//$User = new User(10); // For Testing

// Update personal info first
$Country = null;
if (isset($_POST['country'])) $Country = trim($_POST['country']);
$Zip = null;
if (isset($_POST['zip'])) $Zip = trim($_POST['zip']);
$Address = null;
if (isset($_POST['address'])) $Address = trim($_POST['address']);
$Postal = null;
if (isset($_POST['postal-code'])) $Postal = trim($_POST['postal-code']);
$Phone = null;
if (isset($_POST['phonenumber'])) $Phone = trim($_POST['phonenumber']);
$EmploymentStatus = null;
if (isset($_POST['EmploymentStatus'])) $EmploymentStatus = trim($_POST['EmploymentStatus']);
$JobTitle = null;
if (isset($_POST['jobTitle'])) $JobTitle = trim($_POST['jobTitle']);
$Company = null;
if (isset($_POST['company'])) $Company = trim($_POST['company']);
$recJobTitle = null;
if (isset($_POST['MostRecentJobTitle'])) $recJobTitle = trim($_POST['MostRecentJobTitle']);
$recCompany = null;
if (isset($_POST['MostRecentCompany'])) $recCompany = trim($_POST['MostRecentCompany']);
$startYearSeeker = null;
if (isset($_POST['start-year-seeker'])) $startYearSeeker = trim($_POST['start-year-seeker']);
$endYearSeeker = null;
if (isset($_POST['end-year-seeker'])) $sendYearSeeker = trim($_POST['end-year-seeker']);
$School = null;
if (isset($_POST['school'])) $School = trim($_POST['school']);
$startYearStudent = null;
if (isset($_POST['start-year-student'])) $startYearStudent = trim($_POST['start-year-student']);
$endYearStudent = null;
if (isset($_POST['end-year-student'])) $endYearStudent = trim($_POST['end-year-student']);


try {
	$User->setAddress($Address, null, null, $Zip, $Country);
	$User->setPhone($Phone);
	$User->setEmploymentStatus($EmploymentStatus);
	$User->update();

	// update depending on employment status
	switch ($EmploymentStatus) {
		case "employed":
			$exp = new Experience();
			$exp->setTitle($JobTitle);
			$exp->setCompanyName($Company);
			$exp->setUserID($uid);

			$exp->save();
		break;
		case "looking":
			$exp = new Experience();
			$exp->setTitle($recJobTitle);
			$exp->setCompanyName($recCompany);
			$exp->setStartYear($startYearSeeker);
			$exp->setEndYear($endYearSeeker);
			$exp->setUserID($uid);

			$exp->save();
		break;
		case "student":
			$edu = new Education();
			$edu->setSchool($School);
			$edu->setYearStart($startYearStudent);
			$edu->setYearEnd($endYearStudent);
			$edu->setUserID($uid);

			$edu->save();
		break;
		default:
	}
} catch (Exception $e) {
	echo $e->getMessage();
	echo $User->err;
	echo $exp->err;
	echo $edu->err;

	die();
}

echo json_encode(["success"=>1]);

?>
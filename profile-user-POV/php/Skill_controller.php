<?php
// error_reporting(E_ALL);//debuger
// ini_set("display_errors", 1);//debuger

require_once __DIR__. "/../../lib/php/sqlConnection.php";
require_once __DIR__. "/../../lib/php/classes/Account.php";
require_once __DIR__. "/../../lib/php/classes/User.php";
require_once __DIR__. "/../../lib/php/classes/Skill.php";
require_once __DIR__. "/../../lib/php/classes/SkillManager.php";

// checking if logged in

session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out.';
	die();
}
$uid = $UData['USERID'];

// $uid = 7;
// Check if data valid or still exists in the database

if (!$User = new USER($uid)) {
	echo "The Id is not in the database";
	die();
}

	$skills = [];
	$endrosements = 0;
	$orderPosition = 0;
	$skillid = -1;
	$mode = "exit";

	if(isset($_POST['skill'])){
		$skills = json_decode(trim($_POST['skill']));
	}
	if(isset($_POST['remove']) && $skillid > 0){
		$mode = 'delete';
	} elseif($skillid > 0){
		$mode = 'edit';
	}elseif($skillid == 0){
		$mode = 'insert';
	}
	try{		
		// This for loop update endorsement and insert a new skill if not exists
		foreach ($skills as $skillname=>$nEndorse) {
			$sk = new Skill(); 

			// if skill exists then update number of endorsement
			if ($sk->loadBySkillName($uid, $skillname)) {
				$sk->setEndorsements($nEndorse);
				$sk->update();
			} else { // else add new skill to database
				$sk->setUserID($uid);
				$sk->setSkillName($skillname);
				$sk->setEndorsements($nEndorse);
				$sk->setOrderPosition(1);
				$sk->save();
			}
		}
		
		// check database to see what skills was not passed and delete them
		$skm = new SkillManager($User);
		$dbSkills = $skm->getAll();
		foreach($dbSkills as $objSkill) {
			$skillname = $objSkill->getSkillName();
			if (array_key_exists($skillname, $skills)) continue;

			$objSkill->delete();
		}

		echo json_encode(['success'=>1]);
	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}
?>
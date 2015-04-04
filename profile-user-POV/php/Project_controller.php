<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Project.php";



// checking if logged in
session_start();
if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
	echo 'Session Timed Out.';
	die();
}

// Check if data valid or still exists in the database
$id = $UData['PROJECTID'];
if (!$User = new Project($id)) {
	echo "The Id is not in the database";
	die();
}

	$name = null;
	$url = null;
	$description = null;

	//$uid = $UData[3];
	


	if(isset($_POST['project-name'])) {
		$name = trim($_POST['project-name']);
	}
	if(isset($_POST['project-url'])){
		$url= trim($_POST['project-url']);
	}
	
	if(isset($_POST['project-description'])){
		$description = trim($_POST['project-description']);
	}

	try{


		$proj = new Project();
		//var_dump($proj->getData());
		if($proj->load($id)){
			$proj = new Project($id);
			$proj->setProjectTitle($name);
			$proj->setProjectURL($url);
			$proj->setDescription($description);
			$proj->update();
			die();
		}
		$proj = new Project();
		$proj->setProjectTitle($name);
		$proj->setProjectURL($url);
		$proj->setDescription($description);
		$proj->save();
		return true;


		//var_dump($proj->getdata());
		
		//$educ->save();
		//$eduData = $educ->getData();
		
		//
		//var_dump($eduData);
		


	
	} catch(Exception $e){
		echo $e->getMessage();
		die();
	}







?>


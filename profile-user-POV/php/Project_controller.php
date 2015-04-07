<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug

require_once __DIR__."/../../lib/php/sqlConnection.php";
require_once __DIR__."/../../lib/php/classes/Account.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/../../lib/php/classes/Project.php";



// Put in user Id in order to insert the new row into the sql table. 



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

	$name = null;
	$url = null;
	$description = null;
	$id = 0;
	
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
		if($proj->load($id) == true){
			$proj = new Project($id);
			$proj->setProjectTitle($name);
			$proj->setProjectURL($url);

			$proj->setDescription($description);
			$proj->update();
			//$ps = $proj->getData();
			//var_dump($ps);
			die();
		}
		else {
		$proj = new Project();
		$proj->setUserID($uid);
		$proj->setProjectTitle($name);
		$proj->setProjectURL($url);
		$proj->setDescription($description);
		$proj->save();

		//$p = $proj->getData();
		//echo $proj->err;
		//var_dump($p);
		return true;
		}

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


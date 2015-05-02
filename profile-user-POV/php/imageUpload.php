<?php 
	//error_reporting(E_ALL); // debug
	//ini_set("display_errors", 1); // debug
	require_once __DIR__."/../../lib/php/sqlConnection.php";
	require_once __DIR__."/../../lib/php/classes/User.php";
	require_once __DIR__."/../../lib/php/classes/Profile.php";
	require_once __DIR__."/../../lib/php/utils.php";

	session_start();
	if (!$UData = json_decode($_SESSION['__USERDATA__'], true)) {
		echo 'Session Timeout.';
		die();
	}

	// Check if data valid or still exists in the database
	$uid = $UData['USERID'];
	if (!$User = new USER($uid)) {
		echo "The Id is not in the database";
		die();
	}

	define("USER_DIR", __DIR__."/../../users/".$uid."/");
	define("UPLOAD_DIR", USER_DIR."images/");

	// check if directory exists else create it
	if(!is_dir(USER_DIR)) {
	    mkdir(USER_DIR);
	}

	if(!is_dir(UPLOAD_DIR)) {
	    mkdir(UPLOAD_DIR);
	}

	// 1. Check if any image was transferred at all, if not exit
	if (empty($_FILES["inputProfileImage"]))
	{
		$rs = '<div class="label label-danger">No File Received.</div>';
		echo $rs;
		exit();
	}

	$imgFile = $_FILES["inputProfileImage"];

	// 2. Check if any error occurred during the transfer
	if ($imgFile["error"] !== UPLOAD_ERR_OK)
	{
		$rs = '<div class="label label-danger">An error occured during transfer.</div>';
		echo $rs;
		exit();		
	}

	// 3. Validate: remove any special characters in the file name
	$FileName = preg_replace("/[^A-Z0-9._-]/i", "_", $imgFile["name"]);

	// 4. Check if file already exists
	$i = 0;
	$parts = pathinfo($FileName);
	/*while (file_exists(UPLOAD_DIR . $FileName))
	{
		$i++;
        $FileName = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	}*/

	// Upload to the product images folder
	$success = compress_image($imgFile["tmp_name"], UPLOAD_DIR.$FileName, 75);
    /*$success = move_uploaded_file($imgFile["tmp_name"],
        UPLOAD_DIR . $FileName);*/

    if ($success) { 
    	$filePath = '/users/'.$uid.'/images/'. $FileName;
    	$rs = '<div class="label label-success">File Successfully Uploaded.</div>';
    	$rs .= '<input type="hidden" id="uploadedFile" value="'. $filePath . '" />';
    	
    	// set proper permissions on the new file
    	chmod(UPLOAD_DIR . $FileName, 0775);
    	$User->setProfileImage($FileName);
    	$User->update();

    	$profile = new Profile($User->getID());
		$_SESSION['__USERDATA__'] = json_encode($profile->getData());
		setcookie("__USER_FULL_NAME__", $profile->getName(), time()+60*60*24*365, '/');
		setcookie("__USER_PROFILE_IMAGE__", $filePath, time()+60*60*24*365, '/');
    } else {
    	$rs = '<div class="label label-danger">Unable to save file.</div>';
    }
 	
 	echo $rs;
?>
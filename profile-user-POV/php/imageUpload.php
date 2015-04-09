<?php 
	define("IMAGES_DIR", "../../library/images/products/");
	define("UPLOAD_DIR", IMAGES_DIR);

	// 1. Check if any image was transferred at all, if not exit
	if (empty($_FILES["ProfileImage"]))
	{
		$rs = '<div class="label label-danger">No File Received.</div>';
		echo $rs;
		exit();
	}

	$imgFile = $_FILES["ProfileImage"];

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
	while (file_exists(IMAGES_DIR . $FileName))
	{
		$i++;
        $FileName = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	}

	// Upload to the product images folder
    $success = move_uploaded_file($imgFile["tmp_name"],
        UPLOAD_DIR . $FileName);

    if ($success) { 
    	$rs = '<div class="label label-success">File Successfully Uploaded.</div>';
    	$rs .= '<input type="hidden" id="uploadedFile" value="' . $FileName . '" />';
    	
    	// set proper permissions on the new file
    	chmod(UPLOAD_DIR . $FileName, 0644);
    } else {
    	$rs = '<div class="label label-danger">Unable to save file.</div>';
    }
 	
 	echo $rs;
?>
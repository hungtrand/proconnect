<?php
	if($_POST["userID"] == 123) {
		$data = array("messages" => 1,
					"notification" => 2, 
					"new-connection" => 0);  //expected return data for notification numbers
	} else if($_POST["userID"] == 1234) {
		$data = array("user-name" => "name", 
					"user-url" => "userID", 	// <------ I'm guessing we're going to use the userID and slap it onto the url and redirect the user to the public profile page
					"user-img-url" => "/image/user_img.png",
					"option-snippet" => "company origin|school origin|message subject",
					"message" => "about 100 characters",
					"date" => "Feb 10");  // <------ date should be within 2 months i guess, we dont need to display stuff that is more than 2 months old 
	} else {
		$data = array("wtf" => $_POST["userID"]);
	}
	echo json_encode($data);
?>
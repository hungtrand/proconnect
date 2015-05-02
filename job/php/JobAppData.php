<?php
	//fake data
	$data = [	
				"user" =>
				[
					"userID" => "1",
					"userName" => "bruce wayne",
					"userEmploymentStatus" => "Employed, Superhero",
					"userEmploymentLocation" => "Gotham City",
					"userEmailAddress" => "bruce.wayne@DC.com"
				]
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>
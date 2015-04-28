<?php
	//fake data
	$data = [	
				"industry0" =>
				[
					"industryID" => "0",
					"industryValue" => "Choose..."
				],
				"industry1" => 
				[	//this entry should always be present and have static key name
					"industryID" => "1",
					"industryValue" => "Accounting"
				],
				"industry2" =>
				[
					"industryID" => "2",
					"industryValue" => "Software Engineering"
				],
				"industry3" =>
				[
					"industryID" => "3",
					"industryValue" => "Web Development"
				],
				"industry4" =>
				[
					"industryID" => "4",
					"industryValue" => "Super Hero"
				]
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>

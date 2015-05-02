<?php
	//fake data
	$data = [	
				"country0" =>
				[
					"countryID" => "0",
					"countryValue" => "Country..."
				],
				"country1" => 
				[	//this entry should always be present and have static key name
					"countryID" => "1",
					"countryValue" => "USA"
				],
				"country2" =>
				[
					"countryID" => "2",
					"countryValue" => "Marvel Universe"
				],
				"country3" =>
				[
					"countryID" => "3",
					"countryValue" => "DC Universe"
				],
				"country4" =>
				[
					"countryID" => "4",
					"countryValue" => "My Universe"
				]
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>

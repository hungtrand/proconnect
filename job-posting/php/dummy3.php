<?php
	//fake data
	$data = [	
				"jobFunc0" =>
				[
					"jobFuncID" => "0",
					"jobFuncValue" => "Choose..."
				],
				"jobFunc1" => 
				[	//this entry should always be present and have static key name
					"jobFuncID" => "1",
					"jobFuncValue" => "Accounting/ Auditing"
				],
				"jobFunc2" =>
				[
					"jobFuncID" => "2",
					"jobFuncValue" => "Coding"
				],
				"jobFunc3" =>
				[
					"jobFuncID" => "3",
					"jobFuncValue" => "Developing"
				],
				"jobFunc4" =>
				[
					"jobFuncID" => "4",
					"jobFuncValue" => "Saving People"
				]
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>

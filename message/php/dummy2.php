<?php
	//fake data
	$data = [	
	
				"message1" => 
				[	//this entry should always be present and have static key name
					"sender-name" => "John", //<-------- RECENTLY ADDED
					"sender-message" => "fake"
				],
				"message2" =>
				[
					"sender-name" => "Quoc",
					"sender-message" => "It Works!"
				],
				"message3" =>
				[
					"sender-name" => "proconect-admin",
					"sender-message" => "Welcome!"
				],
				"message4" =>
				[
					"sender-name" => "confirmation",
					"sender-message" => "These are the messages for your outbox"
				]
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>

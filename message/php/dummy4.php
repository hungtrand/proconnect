<?php
	//fake data
	$data = [	
	
				"message1" => 
				[	//this entry should always be present and have static key name
					"sender-name" => "John", //<-------- RECENTLY ADDED
					"sender-href" => "https://www.google.com/",
					"message-subject" => "baseball",
					"message-time" => "January 5, 2015, 7:45 AM",
					"sender-message" => "fake"
				],
				"message2" =>
				[
					"sender-name" => "Quoc",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "pitching",
					"message-time" => "February 5, 2015, 7:45 PM",
					"sender-message" => "It Works!"
				],
				"message3" =>
				[
					"sender-name" => "proconect-admin",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "batting",
					"message-time" => "March 5, 2015, 12:45 AM",
					"sender-message" => "Welcome!"
				],
				"message4" =>
				[
					"sender-name" => "confirmation",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "dugout",
					"message-time" => "April 5, 2015, 12:45 PM",
					"sender-message" => "These are the messages for your Trash"
				]
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>

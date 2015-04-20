<?php
	//fake data
	$data = [	
	
				"message1" => 
				[	//this entry should always be present and have static key name
					"messageID" => "1",
					"sender-ID" => "1",
					"sender-picture" =>"http://crackberry.com/sites/crackberry.com/files/styles/large/public/topic_images/2013/ANDROID.png?itok=xhm7jaxS",
					"sender-name" => "John", //<-------- RECENTLY ADDED
					"sender-href" => "https://www.google.com/",
					"message-subject" => "baseball",
					"message-time" => "January 5, 2015, 7:45 AM",
					"sender-message" => "fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake fake",
					"total-messages" => "11"
				],
				"message2" =>
				[
					"messageID" => "2",
					"sender-ID" => "2",
					"sender-picture" =>"http://crackberry.com/sites/crackberry.com/files/styles/large/public/topic_images/2013/ANDROID.png?itok=xhm7jaxS",
					"sender-name" => "Quoc",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "pitching",
					"message-time" => "February 5, 2015, 7:45 PM",
					"sender-message" => "It Works!",
					"total-messages" => "11"
				],
				"message3" =>
				[
					"messageID" => "3",
					"sender-ID" => "3",
					"sender-picture" => "http://www.clipartbest.com/cliparts/aie/Gr9/aieGr9Li4.jpeg",
					"sender-name" => "Batman",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "batting",
					"message-time" => "March 5, 2015, 12:45 AM",
					"sender-message" => "Welcome!",
					"total-messages" => "11"
				],
				"message4" =>
				[
					"messageID" => "4",
					"sender-ID" => "4",
					"sender-picture" => "http://images.clipartpanda.com/superman-logo-MiLdjjeia.jpeg",
					"sender-name" => "Superman",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "dugout",
					"message-time" => "April 5, 2015, 12:45 PM",
					"sender-message" => "These are the messages for your Archive",
					"total-messages" => "11"
				],
				"message5" =>
				[
					"messageID" => "5",
					"sender-ID" => "5",
					"sender-picture" => "http://images.superherostuff.com/image-stickglsymbl-primary-watermark.jpg",
					"sender-name" => "Green Lantern",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "dugout",
					"message-time" => "April 5, 2015, 12:45 PM",
					"sender-message" => "These are the messages for your Inbox",
					"total-messages" => "11"
				],
				"message6" =>
				[
					"messageID" => "6",
					"sender-ID" => "6",
					"sender-picture" => "https://coalescecreative.files.wordpress.com/2011/05/the_flash_logo.jpg",
					"sender-name" => "The Flash",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "dugout",
					"message-time" => "April 5, 2015, 12:45 PM",
					"sender-message" => "These are the messages for your Inbox",
					"total-messages" => "11"
				],
				"message7" =>
				[
					"messageID" => "7",
					"sender-ID" => "7",
					"sender-picture" => "http://www.freelogovectors.net/wp-content/uploads/2014/05/Spider-man-logo2.jpg",
					"sender-name" => "Spiderman",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "dugout",
					"message-time" => "April 5, 2015, 12:45 PM",
					"sender-message" => "These are the messages for your Inbox",
					"total-messages" => "11"
				],
				"message8" =>
				[
					"messageID" => "8",
					"sender-ID" => "8",
					"sender-picture" => "http://imgs.tuts.dragoart.com/how-to-draw-iron-man-easy_1_000000011939_3.png",
					"sender-name" => "Iron Man",
					"sender-href" => "https://www.google.com/",
					"message-subject" => "dugout",
					"message-time" => "April 5, 2015, 12:45 PM",
					"sender-message" => "These are the messages for your Inbox",
					"total-messages" => "11"
				]
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>

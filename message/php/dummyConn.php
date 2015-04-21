<?php
	//fake data
	$data = [	
	
				"user1" => 
				[	//this entry should always be present and have static key name
					"userID" => "1",
					"user-picture" =>"http://crackberry.com/sites/crackberry.com/files/styles/large/public/topic_images/2013/ANDROID.png?itok=xhm7jaxS",
					"user-name" => "John", //<-------- RECENTLY ADDED
					"user-href" => "https://www.google.com/",
					"user-job-title" => "Engineer"
				],
				"user2" =>
				[
					"userID" => "2",
					"user-picture" =>"http://crackberry.com/sites/crackberry.com/files/styles/large/public/topic_images/2013/ANDROID.png?itok=xhm7jaxS",
					"user-name" => "Quoc",
					"user-href" => "https://www.google.com/",
					"user-job-title" => "Engineer"
				],
				"user3" =>
				[
					"userID" => "3",
					"user-picture" => "http://www.clipartbest.com/cliparts/aie/Gr9/aieGr9Li4.jpeg",
					"user-name" => "Batman",
					"user-href" => "https://www.google.com/",
					"user-job-title" => "Superhero"
				],
				"user4" =>
				[
					"userID" => "4",
					"user-picture" => "http://images.clipartpanda.com/superman-logo-MiLdjjeia.jpeg",
					"user-name" => "Superman",
					"user-href" => "https://www.google.com/",
					"user-job-title" => "Superhero"
				],
				"user5" =>
				[
					"userID" => "5",
					"user-picture" => "http://images.superherostuff.com/image-stickglsymbl-primary-watermark.jpg",
					"user-name" => "Green Lantern",
					"user-href" => "https://www.google.com/",
					"user-job-title" => "Superhero"
				],
				"user6" =>
				[
					"userID" => "6",
					"user-picture" => "https://coalescecreative.files.wordpress.com/2011/05/the_flash_logo.jpg",
					"user-name" => "The Flash",
					"user-href" => "https://www.google.com/",
					"user-job-title" => "Superhero"
				],
				"user7" =>
				[
					"userID" => "7",
					"user-picture" => "http://www.freelogovectors.net/wp-content/uploads/2014/05/Spider-man-logo2.jpg",
					"user-name" => "Spiderman",
					"user-href" => "https://www.google.com/",
					"user-job-title" => "Superhero"
				],
				"user8" =>
				[
					"userID" => "8",
					"user-picture" => "http://imgs.tuts.dragoart.com/how-to-draw-iron-man-easy_1_000000011939_3.png",
					"user-name" => "Iron Man",
					"user-href" => "https://www.google.com/",
					"user-job-title" => "Superhero"
				]
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>

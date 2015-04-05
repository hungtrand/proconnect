<?php
	//fake data
	$data = [	
				"personalInfo" => [	//this entry should always be present and have static key name
					"first-name" => "fake",
					"last-name" => "fake",
					"middle-initial" => "f",
					"email-address" => "fake@fake.fake",
					"alt-email-address" => "fake@fake.fake",
					"phone-number" => "fake",
					"phone-number-type" => "home",
					"user-address" => ["country-input"=>"fake country","zipcode-input"=>"fake zip code", "postal-code-input"=>"fake postal code","address-input"=>"fake address"],
					"summary" => "fakeasdasdasdqhk3fjk2qejklfqkl;"
				],
				"experiences" => [
					[
						"position-title" => "Position Title XYA",
						"company-name" => "Company Name XYA",
						"company-location" => "Location XYA",
						"work-start-month" => "9",
						"work-start-year" => "2012",
						"work-end-month" => "",
						"work-end-year" => "",
						"work-present" => "current",
						"experience-description" => "something something something really long"
						],
					[
						"position-title" => "place holder",
						"company-name" => "Company Name",
						"company-location" => "Location",
						"work-start-month" => "9",
						"work-start-year" => "2012",
						"work-end-month" => "10",
						"work-end-year" => "2013",
						"work-present" => "",
						"experience-description" => "DESCRIPTION something something something really long"
						]
				],
				"skill" => [
					"skill" => "3", //skill title => "endorsement number, empty string is default"
					"skillssssssss" => "3",
					"ski" => "3",
					"skillasdasdasdwq asdasdasd" => "",
					"skilla" => "3",
					"skills" => "3",
					"skilld" => "3",
					"skillq" => "3",
					"skillh" => "3"
					],
				// "skill" => "",

				"projects" => [
						[
							"project-name" => "ProConnects",
							"project-url" => "URLasdasd",
							"team-member" =>  [
								"You" => [
									//default icon
									"icon-URL" => "https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_30x30_v1.png",
									"direct-URL" => "", //url to the user if any
									"snipet" => "some smart guy"//snipet of member, e.g. job title, title, etc
								],
								"some other member's name" => [
									"icon-URL" => "http://vignette2.wikia.nocookie.net/farmville/images/d/da/38x38-icon.png/revision/latest?cb=20120530023501",
									"direct-URL" =>"google.com", //direct user to the user profile page
									"snipet" => "some smart guy"//snipet of member, e.g. job title, title, etc
								]
							],
							"project-description" => "asdasdasdasdasdasdasdasdasdasdasdas"
						],
						[
							"project-name" => "ProConnecta",
							"project-url" => "",
							"team-member" => [ //default should be the user themself "You"
									// "You" => [
									// 	//default icon
									// 	"icon-URL" => "https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_30x30_v1.png",
									// 	"direct-URL" => "", //url to the user if any
									// 	"snipet" => "some smart guy"//snipet of member, e.g. job title, title, etc
									// ]
								],
							"project-description" => "asdasdasdasasdasdasdasddasd"
						]
					],
				"education" => [
							[
								"school-name" => "Some value",
								"degree" => "Bachelor of Science (BS)",
								"field-of-study" => "Computer Science",
								"grade" => "SHIT",
								"school-year-started" => "2011",
								"school-year-ended" => "",
								"activities" => "asdasdasdasda",
								"education-description" => "asdasdasdasdasda"
							],
							[
								"school-name" => "Some value",
								"degree" => "Bachelor of Science (BS)",
								"field-of-study" => "Computer Science",
								"grade" => "SHIT",
								"school-year-started" => "2011",
								"school-year-ended" => "2016",
								"activities" => "asdasdasdasdasdasd",
								"education-description" => "asdasdasdasdasdasdas"
							]
					],
				// "extraInfo" => [			//any extra info e.g.team member picture url,may be added here
				// 	"team-member-icon-URL" => //
			];

	print_r( json_encode($data) );
	// echo "hello from server";
?>
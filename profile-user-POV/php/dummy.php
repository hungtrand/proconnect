<?php
	//fake data
	$data = [
				"personalInfo" => [
					"userFirst" => "fake",
					"userLast" => "fake",
					"userMI" => "f",
					"userEmail" => "fake@fake.fake",
					"userAltEmail" => "fake@fake.fake",
					"userPhoneNumber" => "fake",
					"userPhoneNumberType" => "fake",
					"userAddress" => "need to be added later",
					"userSummary" => "fake"
				],
				"experiences" => [
					[
						"position-title" => "Position Title",
						"company-name" => "Company Name",
						"company-location" => "Location",
						"work-start-month" => "September",
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
						"work-start-month" => "September",
						"work-start-year" => "2012",
						"work-end-month" => "October",
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
							"project-name" => "ProConnect",
							"project-url" => "URL",
							"team-member" =>  [
								"Member name" => [
									//default icon
									"icon-URL" => "http://vignette2.wikia.nocookie.net/farmville/images/d/da/38x38-icon.png/revision/latest?cb=20120530023501",
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
							"project-name" => "ProConnect",
							"project-url" => "",
							"team-member" => [ //default is an empty array
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
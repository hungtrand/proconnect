/*
 * RETURNS NOTHING. BUT WILL THROW AN ERROR IF ANY FIELD IS WRONG	
 */
var FormValidator = (function(){

	function wordCount(message) {
		var regex = /\s+/gi;
		var counter = message.trim().replace(regex, ' ').split(' ').length;
		return counter;
	}

	function compareYear(year1, year2) {
		if(parseInt(year1) < parseInt(year2)) {
			return false;
		}
		else {
			return true;
		}
	}

	function compareMonth(month1, month2) {
		if(parseInt(month1) < parseInt(month2)) {
			return false;
		}
		else {
			return true;
		}
	}

	function compareDate(month1, month2, year1, year2) {
		if(compareYear(year1, year2) === false) {
			return false;
		}
		else {
			if(compareMonth(month1, month2) === false)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}

	function IsName(name) {
		var regex =/^[a-zA-Z0-9 ,.'-]+$/i;
		if(!regex.test(name)) {
		   	return false;
		}else{
		   	return true;
		}
	}

	function IsWord(word) {
		var regex = /^[a-zA-Z0-9 ,.']+$/i;
		if(!regex.test(word)) {
			return false;
		}
		else {
			return true;
		}
	}

	function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
    }

    function IsNumber(number) {
    	var regex = /^[0-9]+$/;
    	if(!regex.test(number)) {
    		return false;
    	}
    	else {
    		return true;
    	}
    }
			
	function IsZipcode(zipcode) {
		var regex =/^\d{5}$/;
		if(!regex.test(zipcode)) {
			return false;
		}else{
			return true;
		}
	}

	function IsPhoneNumber(phoneNum) {
		var regex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		if(!regex.test(phoneNum)) {
			return false; 
		} else {
			return true;
		}
	}

	function IsPostalCode(code) {
		var regex = /^\b\d{5}(-\d{4})?\b$/;
		if(!regex.test(code)) {
			return false; 
		} else {
			return true;
		}
	}

	function IsMonth(monthIn){
		// var month = new Array();
		// month[0] = "January";
		// month[1] = "February";
		// month[2] = "March";
		// month[3] = "April";
		// month[4] = "May";
		// month[5] = "June";
		// month[6] = "July";
		// month[7] = "August";
		// month[8] = "September";
		// month[9] = "October";
		// month[10] = "November";
		// month[11] = "December";

		if(!(monthIn >= 0) && !(monthIn < 12) ) {
			return false;
		} else {
			return true;
		}
	}
	return {
		validateForm: function(jQFormEle) {
			var formName = jQFormEle.parent("div").attr("id");
			var data = jQFormEle.serializeObject();
			console.log(data);
			switch(formName){
				case "user-info-edit":
					if(IsName(data['first-name']) === false){
						throw "Invalid First Name.";
					}

					if(IsName(data['last-name']) === false) {
						throw "Invalid Last Name."
					}

					if(data['middle-initial'] != '' && IsName(data['middle-initial']) === false) {
						throw "Invalid Middle Initial."
					}

					if(IsEmail(data['email-address']) === false) {
						throw "Invalid Email.";
					}


					if(data['alt-email-address'] !== '' && IsEmail(data["alt-email-address"]) === false) {
						throw "Invalid Alternate Email.";
					}

					if(data['phone-number'] != '' && IsPhoneNumber(data['phone-number']) === false) {
						throw "Invalid Phone Number";
					}
					
					if (data['inlineRadio2-country'] === 'United States') {
						if(data['zipcode'] != '' && IsPostalCode(data['zipcode']) === false) {
							throw "Invalid Zipcode";
						}
							// if($("#country-name-input").val() == ""){
							// 	throw "Enter country.";
							// }
							// if($("#postal-code-input").val()== ""){
							// 	throw "Enter postal code.";
							// }
					} else {
						if(data['postal-code'] != '' && IsPostalCode(data['postal-code']) === false) {
							throw "Invalid Postal Code";
						}
							// 	$("#country-name-input").val("United States");
							// 	//console.log($("#country-name-input").val());
							// if($("#zipcode-input").val()== ""){
							// 	//throw "Enter zipcode.";
							// }
							// else{
							// 	if(IsZipcode($("#zipcode-input").val()) === false) {
							// 		throw "Invalid Zipcode.";
							// 	}
							// }
					}
				break;
				case "summary-edit":
					if(wordCount(data['summary']) > 1000) {
						throw "Maximum amount of characters have been reached." + wordCount($("#summary-textarea").val());
					}
				break;
				case "skills-endorsements-edit":
					if($("#skill-list-edit li").length >= 50) {
						throw "You have reached the limit for adding skills.";
					}
				break;//first-name-input
				case "experience-edit":
					//console.log("experience-edit");

					if(IsMonth(data["work-start-year"]) === false) {
						throw "Invalid Start Year.";
					}

					if(IsNumber(data["work-end-year"]) === false) {
						throw "Invalid End Year.";
					}

					if(data['work-present'] != 'current') {
						if(compareDate(data["work-start-month"], data["work-end-month"], data["work-start-year"], data["work-end-year"])) {
							throw "Invalid Date Range";
						}
					}

					
				break;
				case "project-edit":
					//console.log("project-edit");

					if(wordCount($("#project-description").val()) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount($("#project-description").val());
					}

				break;
				case "education-edit":
					//console.log("education-edit");

					if(IsWord($("#school-name").val()) === false) {
						throw "Invalid School Name";
					}

					if(IsWord($("#degree").val()) === false) {
						throw "Invalid Degree Name";
					}

					if(IsWord($("#field-of-study").val()) === false) {
						throw "Invalid Field Of Study Name";
					}

					if(IsWord($("#grade").val()) === false) {
						throw "Invalid Grade Name";
					}

					if(compareYear($("#school-year-started").val(), $("#school-year-ended").val())) {
						throw "Invalid Date Organization";
					}

					if(wordCount($("#activities").val()) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount($("#project-description").val());
					}

					if(wordCount($("#education-description").val()) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount($("#project-description").val());
					}
				break;
			}
		
		}
	}
		
})();
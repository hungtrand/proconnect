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
		return parseInt(year1) <= parseInt(year2);
	}

	function compareMonth(month1, month2) {
		if(parseInt(month1) > parseInt(month2)) {
			return false;
		}
		else {
			return true;
		}
	}

	function compareDate(startMonth, endMonth, startYear, endYear) {
		if(compareYear(startYear, endYear) === false) {
			return false;
		}
		else {
			if(startYear === endYear) {
				if(compareMonth(startMonth, endMonth) === false)
				{
					return false;
				}
				else
				{
					return true;
				}
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
				// begin user info edit
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
				break; //end user info edit
				// begin summary edit
				case "summary-edit":
					if(wordCount(data['summary']) > 1000) {
						throw "Maximum amount of characters have been reached." + wordCount(data['summary']);
					}
				break; //end summary edit
				//begin skills endorsements edit
				case "skills-endorsements-edit":
					if($("#skill-list-edit li").length >= 50) {
						throw "You have reached the limit for adding skills.";
					}
				break;//end skills endorsement edit
				//begin experience edit
				case "experience-edit":
					if(IsMonth(data["work-start-month"]) === false) {
						throw "Invalid Start Year.";
					}

					if(IsNumber(data["work-start-year"]) === false) {
						throw "Invalid End Year.";
					}

					if(data['work-present'] != 'current') {
						if(compareDate(data["work-start-month"], data["work-end-month"], data["work-start-year"], data["work-end-year"]) === false) {
							throw "Invalid Date Range";
						}
					}
				break; //end skills endorsement edit
				//begin project edit
				case "project-edit":
					if(wordCount(data['project-description']) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount($("#project-description").val());
					}
				break; //end project edit
				//begin education edit
				case "education-edit":
					//console.log("education-edit");

					if(IsWord(data["school-name"]) === false) {
						throw "Invalid School Name";
					}

					if(data["degree"] !== "" && IsWord(data["degree"]) === false) {
						throw "Invalid Degree Name";
					}

					if(data["field-of-study"] !== "" && IsWord(data["field-of-study"]) === false) {
						throw "Invalid Field Of Study Name";
					}

					if(data["grade"] !== "" && IsWord(data["grade"]) === false) {
						throw "Invalid Grade Name";
					}

					if(data["school-year-started"] !== "-" && data["school-year-ended"] !== "-" && compareYear(data["school-year-started"], data["school-year-ended"]) === false) {
						throw "Invalid Date Organization";
					}

					if(data["activities"] !== "" && wordCount(data["activities"]) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount(data["activities"]);
					}

					if(data["education-description"] !== "" && wordCount(data["education-description"]) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount(data["education-description"]);
					}
				break; //end education edit
			}
		
		}
	}
		
})();
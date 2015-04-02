$(document).ready(function(){
	var country_options = $(".country-option");
	 for(var i = 0; i<country_options.length; i++){
	     country_options[i].addEventListener("click",function(){
	     	var value = this.value;
			if(value == "United States"){
				$("#zipcode-group").show();
				$("#other-country-group").hide();
			}
			else{
				$("#zipcode-group").hide();
				$("#other-country-group").show();
			}
		});
	}
	
	var signup_options = $(".signup-option");
	for(var i = 0; i<signup_options.length; i++){
	    signup_options[i].addEventListener("click",function(){
	     	var value = this.value;
	 		if(value == "employed"){
				$("#employedSelection").show();
				$("#jobSeekerSelection").hide();
				$("#studentSelection").hide();
		 	} else if(value == "looking"){
				$("#employedSelection").hide();
				$("#jobSeekerSelection").show();
				$("#studentSelection").hide();
		 	} else if(value == "student"){
				$("#employedSelection").hide();
				$("#jobSeekerSelection").hide();
				$("#studentSelection").show();
			} else {
				$("#employedSelection, #jobSeekerSelection, #studentSelection").hide();
			}
	    });
	}

});

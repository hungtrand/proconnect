$(document).ready(function(){
		
	// create an instance of the StatesCitiesList
	 var sl = new StatesCitiesList();

	 // use getView method to get the html and append anywhere you want
	 $('#test').html(sl.getView());

	 // if you just want the data for the states just call method getStates()
	 states = sl.getStates();
	 console.log(states);

	 // if you want data for the cities in json format for a particular state
	 // you can call method getCities() like this:
	 // method getCities() take two parameter, the state you want and a callback
	 // function than you want to execute after the cities data come back from ajax
	 sl.getCities('SC', function(cities_json) {
		console.log(cities_json);
	 });
	 
	var country_options = $(".country-option");
	 for(var i = 0; i<country_options.length; i++){
	     country_options[i].addEventListener("click",function(){
	     	var value = this.value;
			if(value == "United States"){
				$(".us-group").show();
				$(".other-country-group").hide();
			}
			else{
				$(".us-group").hide();
				$(".other-country-group").show();
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

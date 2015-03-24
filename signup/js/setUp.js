$(document).ready(function(){
		$("#country").change(function(){
			var value = this.value;
			if(value == "United States"){
				$("#zipcode-group").show();
				$("#postalcode-group").hide();
			}
			else{
				$("#zipcode-group").hide();
				$("#postalcode-group").show();
			}
		});

	var signup_options = $(".signup-option");
	 for(var i = 0; i<signup_options.length; i++){
	     signup_options[i].addEventListener("click",function(){
	     	var value = this.value;
	 	 if(value == "employed"){
			 $("#employedSelection").show();
			 $("#jobSeekerSelection").hide();
			 $("#studentSelection").hide();
	 	}
	 	 if(value == "looking"){
			 $("#employedSelection").hide();
			 $("#jobSeekerSelection").show();
			 $("#studentSelection").hide();
	 	}
	 	else if(value == "student"){
			 $("#employedSelection").hide();
			 $("#jobSeekerSelection").hide();
			 $("#studentSelection").show();
			}
	    });
	 }
});

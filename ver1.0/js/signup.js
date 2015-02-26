(function() {
	var employed = document.getElementById("employedSelection");
	var jobseeker= document.getElementById("jobSeekerSelection");	
	var student = document.getElementById("studentSelection");
	
	var signup_options = document.getElementsByClassName("signup-option");
	
	function showOption(value){
		 if(value == "employed"){
			employed.style.display = "";
			jobseeker.style.display = "none";
			student.style.display = "none";
		}
		 if(value == "looking"){
			employed.style.display = "none";
			jobseeker.style.display = "";
			student.style.display = "none";
		}
		else if(value == "student"){
			employed.style.display = "none";
			jobseeker.style.display = "none";
			student.style.display = "";
			}
	};
	for(var i; i<signup_options.length; i++){
	signup_options[i].addEventListener("click",showOption(this.value));
	}
	/*
	signup_options[0].addEventListener("click",showOption(signup_options[0].value));
	signup_options[1].addEventListener("click",showOption(signup_options[1].value));
	signup_options[2].addEventListener("click",showOption(signup_options[2].value));
	*/

})();
(function() {
	var employed = document.getElementById("employedSelection");
	var jobseeker= document.getElementById("jobSeekerSelection");	
	var student = document.getElementById("studentSelection");
	
	window.div_OnOff =function (value){
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
})();
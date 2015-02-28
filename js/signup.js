$(document).ready(function() {
	var employed = document.getElementById("employedSelection");
	var jobseeker= document.getElementById("jobSeekerSelection");	
	var student = document.getElementById("studentSelection");
	$("#employed-btn").attr('checked', true).trigger('click');
	//validate the form as employed by default
	validateEmployed();
	//show options by usertype
	var signup_options = document.getElementsByClassName("signup-option");	
	function showOption(){

		var value = this.value;
		
		 if(value == "employed"){
			employed.style.display = "";
			jobseeker.style.display = "none";
			student.style.display = "none";						 
			//input validation
			validateEmployed();					
		}
		 if(value == "looking"){
			employed.style.display = "none";
			jobseeker.style.display = "";
			student.style.display = "none";
			//input validation
			validateJobseeker();
		}
		else if(value == "student"){
			employed.style.display = "none";
			jobseeker.style.display = "none";
			student.style.display = "";
			//input validation
			validateStudent();
			}
	};

	for(var i = 0; i<signup_options.length; i++){
	    signup_options[i].addEventListener("click",showOption);
	}
	
});

function validateEmployed() {
	 $("#submit").click(function(){
		  //clear previous error box 
		  $('#country').css({"border": ""});
		  $('#zipcode').css({"border": ""});
		  $('#jobTitle').css({"border": ""});
		  $('#company').css({"border": ""});
		  $('#industry').css({"border": ""});
		  
		  var country= $('#country').val();
		  var zipcode = $('#zipcode').val();
		  var jobTitle= $('#jobTitle').val();
		  var company = $('#company').val();
		  var industry = $('#industry').val();
				
			if(country== ""){
			   $('#country').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select country");
			   $(".alert").show();
			   return false;
			}
			
			if(zipcode== ""){
			   $('#zipcode').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter zipcode");
			   $(".alert").show();
			   return false;
			}
			if(IsZipcode(zipcode)==false){
				$('#zipcode').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter valid zipcode");
				$(".alert").show();
				$('#last').val("");
				return false;
			}
			if(jobTitle== ""){
			   $('#jobTitle').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter job title");
			   $(".alert").show();
			   return false;
			}
			if(company==""){
				$('#company').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter company");
				$(".alert").show();
				return false;
			}
			if(industry== ""){
			   $('#industry').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select Industry");
			   $(".alert").show();
			   return false;
			}
			$(".alert").hide();
	  });
}

function validateJobseeker() {
	 $("#submit").click(function(){
		  //clear previous error box 
		  $('#country').css({"border": ""});
		  $('#zipcode').css({"border": ""});
		  $('#recentJobTitle').css({"border": ""});
		  $('#recentCompany').css({"border": ""});
		  $('#industry-looking').css({"border": ""});
		  $('#start-yearpicker-looking').css({"border": ""});
		  $('#end-yearpicker-looking').css({"border": ""});
		  
		  var country= $('#country').val();
		  var zipcode = $('#zipcode').val();
		  var jobTitle= $('#recentJobTitle').val();
		  var company = $('#recentCompany').val();
		  var industry = $('#industry-looking').val();
		  var startYear = $('#start-yearpicker-looking').val();
		  var endYear = $('#end-yearpicker-looking').val();
				
			if(country== ""){
			   $('#country').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select country");
			   $(".alert").show();
			   return false;
			}
			
			if(zipcode== ""){
			   $('#zipcode').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter zipcode");
			   $(".alert").show();
			   return false;
			}
			if(IsZipcode(zipcode)==false){
				$('#zipcode').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter valid zipcode");
				$(".alert").show();
				$('#last').val("");
				return false;
			}
			if(jobTitle== ""){
			   $('#recentJobTitle').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter most recent job title");
			   $(".alert").show();
			   return false;
			}
			if(company==""){
				$('#recentCompany').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter most recent company");
				$(".alert").show();
				return false;
			}
			if(industry== ""){
			   $('#industry-looking').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select Industry");
			   $(".alert").show();
			   return false;
			}
			if(startYear== ""){
			   $('#start-yearpicker-looking').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select start year");
			   $(".alert").show();
			   return false;
			}
			if(endYear== ""){
			   $('#end-yearpicker-looking').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select end year");
			   $(".alert").show();
			   return false;
			}
			if(startYear> endYear){
			   $('#end-yearpicker-looking').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("end year has to be later than start year");
			   $(".alert").show();
			   return false;
			}
			$(".alert").hide();
	  });
}
function validateStudent() {
	 $("#submit").click(function(){
		  //clear previous error box 
		  $('#country').css({"border": ""});
		  $('#zipcode').css({"border": ""});
		  $('#school').css({"border": ""});
		  $('#start-yearpicker-student').css({"border": ""});
		  $('#end-yearpicker-student').css({"border": ""});
		  $('#age').css({"border": ""});
		  
		  var country= $('#country').val();
		  var zipcode = $('#zipcode').val();
		  var school= $('#school').val();
		  var startYear = $('#start-yearpicker-student').val();
		  var endYear = $('#end-yearpicker-student').val();		  
				
			if(country== ""){
			   $('#country').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select country");
			   $(".alert").show();
			   return false;
			}
			
			if(zipcode== ""){
			   $('#zipcode').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter zipcode");
			   $(".alert").show();
			   return false;
			}
			if(IsZipcode(zipcode)==false){
				$('#zipcode').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter valid zipcode");
				$(".alert").show();
				$('#last').val("");
				return false;
			}
			if(school== ""){
			   $('#school').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter your school");
			   $(".alert").show();
			   return false;
			}
			if(startYear== ""){
			   $('#start-yearpicker-student').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select start year");
			   $(".alert").show();
			   return false;
			}
			if(endYear== ""){
			   $('#end-yearpicker-student').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please select end year");
			   $(".alert").show();
			   return false;
			}
			if(startYear> endYear){
			   $('#end-yearpicker-student').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("end year has to be later than start year");
			   $(".alert").show();
			   return false;
			}
			if(!$("#age").is(":checked")){
			   $('#age').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("User has to be at least 18 years or older");
			   $(".alert").show();
			   return false;
			}
			$(".alert").hide();
	  });
}
function IsZipcode(zipcode) {
	var regex = /[0-9]{5}/ ;
	if(!regex.test(zipcode)) {
	   return false;
	}else{
	   return true;
	}
}
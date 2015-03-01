$(document).ready(function() {
      $(".alert").hide();
	  
	  //show alert if any field is empty or email is in invalid form
	  $("#signin-btn").click(function(){
		  
		  $('#email-login').css({"border": ""});
		  $('#password-login').css({"border": ""});
			
          var email= $('#email-login').val();
          var password = $('#password-login').val();
		  
		//clear password field every time submit 
		  $('#password-login').val("");
		  
            if(email== ""){
			   $('#email-login').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter your email address");
			   $(".alert").show();
			   $('#email-login').val("");
               return false;
            }
            if(IsEmail(email)==false){
                $('#email-login').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter a valid email address ");
				$(".alert").show();
				$('#email-login').val("");
                return false;
            }
            if(password==""){
				$(".alert").text("Please enter password");
                $('#password-login').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").show();
                return false;
            }
			$(".alert").hide();
	  });
	  
	  //show alert if any field is empty or in invalid form
	  $("#signup-btn").click(function(){
		  
		  $('#first').css({"border": ""});
		  $('#last').css({"border": ""});
		  $('#email').css({"border": ""});
		  $('#password').css({"border": ""});
		  
		  var first= $('#first').val();
          var last = $('#last').val();
          var email= $('#email').val();
          var password = $('#password').val();
		  
		//clear password field every time resubmit 
		  $('#password').val("");
		  
			if(first== ""){
			   $('#first').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter your first name");
			   $(".alert").show();
               return false;
            }
			if(IsName(first)==false){
                $('#first').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter valid first name");
				$(".alert").show();
				$('#first').val("");
                return false;
            }
			if(last== ""){
			   $('#last').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter your last name");
			   $(".alert").show();
               return false;
            }
			if(IsName(first)==false){
                $('#last').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter valid last name");
				$(".alert").show();
				$('#last').val("");
                return false;
            }
            if(email== ""){
			   $('#email').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter your email address");
			   $(".alert").show();
               return false;
            }
            if(IsEmail(email)==false){
                $('#email').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter a valid email address ");
				$(".alert").show();
				$('#email').val("");
                return false;
            }
            if(password==""){
				$('#password').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter password");
				$(".alert").show();
                return false;
            }
			if(IsPassword(password)==false){
                $('#password').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("password has to be 6-20 in length ");
				$(".alert").show();
                return false;
            }
			$(".alert").hide();
	  });
});
	  function IsName(name) {
        var regex =/^[a-z ,.'-]+$/i;
        if(!regex.test(name)) {
           return false;
        }else{
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
	  	  function IsPassword(password) {
        var regex = /^.{6,20}$/;
        if(!regex.test(password)) {
           return false;
        }else{
           return true;
        }
      }
>>>>>>> 5e0e04521a89f6b71396c703e87f1b7bc8e7f568

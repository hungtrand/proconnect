$(document).ready(function() {
      $(".alert").hide();
	  
	  //show alert if any field is empty or email is in invalid form
	  $(".btn").click(function(){
		  
		  $('#inputEmail.form-control').css({"border": ""});
		  $('#inputPassword.form-control').css({"border": ""});
			
          var email= $('#inputEmail').val();
          var password = $('#inputPassword').val();
		  
		//clear password field every time submit 
		  $('#inputPassword').val("");
            if(email== ""){
			   $('#inputEmail.form-control').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			   $(".alert").text("Please enter your email address");
			   $(".alert").show();
			   $('#inputEmail').val("");
               return false;
            }
            if(IsEmail(email)==false){
                $('#inputEmail.form-control').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").text("Please enter a valid email address ");
				$(".alert").show();
				$('#inputEmail').val("");
                return false;
            }
            if(password== ""){
				$(".alert").text("Please enter password");
                $('#inputPassword.form-control').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				$(".alert").show();
                return false;
            }
	  });
});

      function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
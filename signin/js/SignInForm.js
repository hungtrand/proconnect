function SignInForm(SignInForm) {
	this.theForm = SignInForm;
	this.EmailInput = SignInForm.find('#email-login');
	this.PasswordInput = SignInForm.find('#password-login');
	this.SubmitBtn = SignInForm.find('#signin-btn');
	this.Alert = SignInForm.find('.alert');
	this.waitingGif = '<img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/>';

	this.init();
}

SignInForm.prototype = {
	constructor: SignInForm,

	init: function() {
		var that = this;

		that.theForm.on('submit', function(e) {
			e.preventDefault();
			if (!that.validate()) return false;
			
			that.Alert.html(that.waitingGif);
			that.Alert.show();
			that.signin();
		});
	},

	signin: function() {
		var that = this;

		$.ajax({
			url: that.theForm.prop('action'),
			type: 'POST',
			data: that.theForm.serialize()
		})
		.done(function(response) {
			try {
				var json = $.parseJSON(response);

				that.Alert.toggleClass('alert-danger', false)
				.toggleClass('alert-success', true)
				.text('Signed In Successfully.');

				window.location.href = "/profile-user-POV/";
			} catch (err) {
				that.Alert.text(response + err.message);
				// window.location.href = "signin/#failed";
			}
			
		})
		.fail(function(msg) {
			that.Alert.text(msg);
		});
		
	},

	validate: function() {
		var that = this;

		that.reset();

		var email= that.EmailInput.val();
		var password = that.PasswordInput.val();
	  
        if(email == ""){
			that.EmailInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.EmailInput.focus();
			that.Alert.text("Please enter your email address");
			that.Alert.show();

			return false;
        }

        if(IsEmail(email) == false){
	        that.EmailInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
	        that.EmailInput.focus();
			that.Alert.text("Please enter a valid email address ");
			that.Alert.show();

	        return false;
        }

        if(password == ""){
			that.Alert.text("Please enter password");
            that.PasswordInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
            that.PasswordInput.focus();
			that.Alert.show();

            return false;
        }

		that.Alert.hide();
		return true;

		function IsEmail(email) {
	        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	        if(!regex.test(email)) {
	           return false;
	        }else{
	           return true;
	        }
	    }
	}, 

	reset: function() {
		var that = this;
		//clear previous error box
		that.EmailInput.css({"border": ""});
		that.PasswordInput.css({"border": ""});
		that.Alert.html('');
	}
}
function SignUpForm(SignUpForm) {
	this.theForm = SignUpForm;
	this.EmailInput = SignUpForm.find('#email');
	this.FirstInput = SignUpForm.find('#first');
	this.LastInput = SignUpForm.find('#last');
	this.PasswordInput = SignUpForm.find('#password');
	this.ConfPasswordInput = SignUpForm.find('#confpassword');
	this.Alert = SignUpForm.find('.alert');
	this.waitingGif = '<img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/>';
	this.activeError = false;

	this.init();
}

SignUpForm.prototype = {
	constructor: SignUpForm,

	init: function() {
		var that = this;
		that.theForm.on('submit', function(e) {
			e.preventDefault();
			if (!that.validate()) return false;
			
			that.Alert.html(that.waitingGif);
			that.Alert.show();
			that.signup();
		});

		that.FirstInput.on('keyup', function(e) { that.reset(); });
		that.LastInput.on('keyup', function(e) { that.reset(); });
		that.EmailInput.on('keyup', function(e) { that.reset(); });
		that.PasswordInput.on('keyup', function(e) { that.reset(); });
		that.ConfPasswordInput.on('keyup', function(e) { that.reset(); });
	},

	signup: function() {
		var that = this;

		$.ajax({
			url: that.theForm.prop('action'),
			type: 'POST',
			data: {
				"first": that.FirstInput.val().trim(),
				"last": that.LastInput.val().trim(),
				"email": that.EmailInput.val().trim(),
				"password": that.PasswordInput.val()
			}
		})
		.done(function(response) {
			try {
				var json = $.parseJSON(response);

				that.Alert.toggleClass('alert-danger', false)
				.toggleClass('alert-success', true)
				.text('Signed Up Successfully.');

				window.location.href = "/signup/email-confirmation.html";
			} catch (err) {
				that.Alert.text(response);
				return false;
			}
			
		})
		.fail(function(msg) {
			that.Alert.text(msg);
		});
	},

	validate: function() {
		var that = this;

		that.reset();

		var first= that.FirstInput.val().trim();
		var last = that.LastInput.val().trim();
		var email= that.EmailInput.val().trim();
		var password = that.PasswordInput.val(); 
		var confpassword = that.ConfPasswordInput.val();

		if(first== "" || IsName(first)==false){
		    that.FirstInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.Alert.text("Please enter valid first name");
			that.Alert.show();
			that.FirstInput.val("");

		    return false;
		}

		if(last== "" || IsName(first)==false){
		    that.LastInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.Alert.text("Please enter valid last name");
			that.Alert.show();
			that.LastInput.val("");

		    return false;
		}

		if(email== "" || IsEmail(email)==false){
		    that.EmailInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.Alert.text("Please enter a valid email address ");
			that.Alert.show();
			that.EmailInput.val("");

		    return false;
		}

		if(password=="" || IsPassword(password)==false){
		    that.PasswordInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.Alert.text("Password has to be 6-20 in length ");
			that.Alert.show();
			that.PasswordInput.val("");

		    return false;
		}

		if (password !== confpassword) {
			that.ConfPasswordInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.Alert.text("The passwords don't match. Please type again. ");
			that.PasswordInput.val("");

			return false;
		}

		return true;

		function IsName(name) {
		var regex =/^[a-z ,.'-]+$/i;
			if(!regex.test(name)) {
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

		if (that.activeError) return;
		//clear previous error box
		that.FirstInput.css({"border": ""});
		that.LastInput.css({"border": ""});
		that.EmailInput.css({"border": ""});
		that.PasswordInput.css({"border": ""});
		that.ConfPasswordInput.css({"border": ""});
		that.Alert.html('');
		that.Alert.hide();
		that.activeError = false;
	}
}
function ForgotPasswordForms(form) {
	this.theForm = form;
	//console.log(this.theForm);
	this.EmailInput = form.find('#email-login');
	this.SubmitBtn = form.find('#continue-btn');
	this.Alert = form.find('.alert');
	this.waitingGif = '<img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/>';
	this.activeError = false;

	this.init();
}

ForgotPasswordForms.prototype = {
	constructor: this,

	init: function() {
		var that = this;

		that.theForm.on('submit', function(e) {
			e.preventDefault();
			if (!that.validate()) { 
				this.activeError = true;
				return false;
			}
			
			that.Alert.html(that.waitingGif);
			that.Alert.show();
			that.submit();
		});

		that.EmailInput.on('keyup', function(e) { that.reset(); });
	},

	submit: function() {
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
				.text('Please check your email for instructions to reset your password.');
			} catch (err) {
				that.Alert.text(response);
				//that.Alert.append(err.message);
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

		if (that.activeError) return;
		//clear previous error box
		that.EmailInput.css({"border": ""});
		that.Alert.html('');
		that.Alert.hide();
		that.activeError = false;
	}
}
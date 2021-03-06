function ResetPasswordForms(form) {
	this.theForm = form;
	this.NewPasswordInput = form.find("#newPassword");
	this.ConfirmPasswordInput = form.find('#passwordConfirm');
	this.SubmitBtn = form.find('#signin-btn');
	this.Alert = form.find('.alert');
	this.waitingGif = '<img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/>';
	this.activeError = false;

	this.init();
}

ResetPasswordForms.prototype = {
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

		that.NewPasswordInput.on('keyup', function(e) { that.reset(); });
		that.ConfirmPasswordInput.on('keyup', function(e) { that.reset(); });
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
				console.log(json['success']);
				if (json['success'] == 1) {
					that.Alert.toggleClass('alert-danger', false)
					.toggleClass('alert-success', true)
					.text('Password updated. Redirecting...');

					setTimeout(function() {
						window.location.href = "/signin/";
					}, 1000);
				} else {
					that.Alert.toggleClass('alert-success', false)
					.toggleClass('alert-danger', true)
					.text('Failed to update password.');
				}
			} catch (err) {
				//console.log(err);
				that.Alert.text(response);
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

		var newPassword = that.NewPasswordInput.val();
		var confirmPassword = that.ConfirmPasswordInput.val();
	  
        if(newPassword == ""){
			that.NewPasswordInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.NewPasswordInput.focus();
			that.Alert.text("Please enter new password");
			that.Alert.show();

			return false;
        }


        if(confirmPassword == ""){
			that.Alert.text("Please confirm password");
            that.ConfirmPasswordInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
            that.ConfirmPasswordInput.focus();
			that.Alert.show();

            return false;
        }

        if (newPassword != confirmPassword) {
        	that.Alert.text("Password fields do not match.");
            that.ConfirmPasswordInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
            that.ConfirmPasswordInput.focus();
			that.Alert.show();

            return false;
        }

		that.Alert.hide();
		return true;

	}, 

	reset: function() {
		var that = this;

		if (that.activeError) return;
		//clear previous error box
		that.NewPasswordInput.css({"border": ""});
		that.ConfirmPasswordInput.css({"border": ""});
		that.Alert.html('');
		that.Alert.hide();
		that.activeError = false;
	}
}
function SetUpForm(SetUpForm) {
	this.theForm = SetUpForm;
	this.CountryInput = SetUpForm.find('#country');
	this.ZipcodeInput = SetUpForm.find('#zipcode');
	this.PostalInput = SetUpForm.find('#postal-code');
	this.AddressInput = SetUpForm.find('#address');
	this.PhonenumberInput = SetUpForm.find('#phonenumber');
	this.JobTitleInput = SetUpForm.find('#jobTitle');
	this.CompanyInput = SetUpForm.find('#company');
	this.RecentJobTitleInput = SetUpForm.find('#recentJobTitle');
	this.RecentCompanyInput = SetUpForm.find('#recentCompany');
	this.StartYearSeekerInput = SetUpForm.find('#start-yearpicker-seeker');
	this.EndYearSeekerInput = SetUpForm.find('#end-yearpicker-seeker');
	this.SchoolInput = SetUpForm.find('#school');
	this.StartYearStudentInput = SetUpForm.find('#start-yearpicker-student');
	this.EndYearStudentInput = SetUpForm.find('#end-yearpicker-student');
	this.Alert = SetUpForm.find('.alert');
	this.waitingGif = '<img src="../image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/>';
	this.activeError = false;
	
	this.init();
}

SetUpForm.prototype = {
	constructor: SetUpForm,

	init: function() {
		var that = this;
		that.theForm.on('submit', function(e) {
			e.preventDefault();
			if (!that.validate()) return false;
			
			that.Alert.html(that.waitingGif);
			that.Alert.show();
		//	that.signup();
		});

		that.CountryInput.on('keyup', function(e) { that.reset(); });
		that.ZipcodeInput.on('keyup', function(e) { that.reset(); });
		that.PostalInput.on('keyup', function(e) { that.reset(); });
		that.AddressInput.on('keyup', function(e) { that.reset(); });
		that.PhonenumberInput.on('keyup', function(e) { that.reset(); });
	},

	/*signup: function() {
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
	},*/

	validate: function() {
		var that = this;

		that.reset();

		var country= that.CountryInput.val();
		var zipcode = that.ZipcodeInput.val();
		var postal= that.PostalInput.val();
		var address = that.AddressInput.val(); 
		var phonenumber = that.PhonenumberInput.val();

		if(country!= "United States"){
			if(postal== ""){
				that.PostalInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter Postal Code ");
				that.Alert.show();
				that.PostalInput.val("");

				return false;
			}
		}
		else{
			if(zipcode== "" || IsZipcode(zipcode)==false){
				that.ZipcodeInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter valid Zip Code");
				that.Alert.show();
				that.ZipcodeInput.val("");

				return false;
			}
		}
		if(address==""){
		    that.AddressInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.Alert.text("Please enter address ");
			that.Alert.show();
			that.AddressInput.val("");

		    return false;
		}

		if (phonenumber=="" || IsPhonenumber(phonenumber)==false) {
			that.PhonenumberInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			that.Alert.text("Please enter valid phone number ");
			that.PhonenumberInput.val("");

			return false;
		}

		return true;

		function IsZipcode(zipcode) {
		var regex =/^\d{5}$/;
			if(!regex.test(zipcode)) {
			   	return false;
			}else{
			   	return true;
			}
		}

      	function IsPhonenumber(phonenumber) {
			var regex = /^[1-9]\d{2}-\d{3}-\d{4}$/;
			if(!regex.test(phonenumber)) {
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
		that.CountryInput.css({"border": ""});
		that.ZipcodeInput.css({"border": ""});
		that.PostalInput.css({"border": ""});
		that.AddressInput.css({"border": ""});
		that.PhonenumberInput.css({"border": ""});
		that.Alert.html('');
		that.Alert.hide();
		that.activeError = false;
	}
}
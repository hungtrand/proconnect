function SetUpForm(SetUpForm) {
	this.theForm = SetUpForm;

	this.ZipcodeInput = SetUpForm.find('#zipcode');
	this.CountryInput = SetUpForm.find('#country-name');
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
		that.JobTitleInput.on('keyup', function(e) { that.reset(); });
		that.CompanyInput.on('keyup', function(e) { that.reset(); });
		that.RecentJobTitleInput.on('keyup', function(e) { that.reset(); });
		that.RecentCompanyInput.on('keyup', function(e) { that.reset(); });
		that.StartYearSeekerInput.on('keyup', function(e) { that.reset(); });
		that.EndYearSeekerInput.on('keyup', function(e) { that.reset(); });
		that.SchoolInput.on('keyup', function(e) { that.reset(); });
		that.StartYearStudentInput.on('keyup', function(e) { that.reset(); });
		that.EndYearStudentInput.on('keyup', function(e) { that.reset(); });
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
		var jobtitle= that.JobTitleInput.val();
		var company= that.CompanyInput.val();
		var rctJobtitle= that.RecentJobTitleInput.val();
		var rctCompany= that.RecentCompanyInput.val();
		var startSeeker= that.StartYearSeekerInput.val();
		var endSeeker= that.EndYearSeekerInput.val();
		var school= that.SchoolInput.val();
		var startStudent= that.StartYearStudentInput.val();
		var endStudent= that.EndYearStudentInput.val();

		if ($("#inlineRadio2-country").prop("checked")) {
			if(country== ""){
				that.CountryInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter Country ");
				that.Alert.show();
				that.CountryInput.val("");

				return false;
			}
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
		
		if ($("#inlineRadio1").prop("checked")) {
			if(jobtitle==""){
				that.JobTitleInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter job title ");
				that.Alert.show();
				that.JobTitleInput.val("");
				return false;
			}
			if(company==""){
				that.CompanyInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter Company Name ");
				that.Alert.show();
				that.CompanyInput.val("");
				return false;
			}
		}
		if ($("#inlineRadio2").prop("checked")) {
		console.log("looking check")
			if(rctJobtitle==""){
				that.RecentJobTitleInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter recent job title ");
				that.Alert.show();
				that.RecentJobTitleInput.val("");
				return false;
			}
			if(rctCompany==""){
				that.RecentCompanyInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter recent company Name ");
				that.Alert.show();
				that.RecentCompanyInput.val("");
				return false;
			}
			if(startSeeker==""){
				that.StartYearSeekerInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter start year ");
				that.Alert.show();
				that.StartYearSeekerInput.val("");
				return false;
			}
			if(endSeeker==""){
				that.EndYearSeekerInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter end year ");
				that.Alert.show();
				that.EndYearSeekerInput.val("");
				return false;
			}
			if(endSeeker<startSeeker){
				that.EndYearSeekerInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("End year has to be later than start year");
				that.Alert.show();
				that.EndYearSeekerInput.val("");
				return false;
			}
		}
		else if ($("#inlineRadio3").prop("checked")) {
		console.log("student check")
			if(school==""){
				that.SchoolInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter school ");
				that.Alert.show();
				that.SchoolInput.val("");
				return false;
			}
			if(startStudent==""){
				that.StartYearStudentInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter start year ");
				that.Alert.show();
				that.StartYearStudentInput.val("");
				return false;
			}
			if(endStudent==""){
				that.EndYearStudentInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("Please enter end year ");
				that.Alert.show();
				that.EndYearStudentInput.val("");
				return false;
			}
			if(endStudent<startStudent){
				that.EndYearStudentInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
				that.Alert.text("End year has to be later than start year");
				that.Alert.show();
				that.EndYearStudentInput.val("");
				return false;
			}
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
		that.JobTitleInput.css({"border": ""});
		that.CompanyInput.css({"border": ""});
		that.RecentJobTitleInput.css({"border": ""});
		that.RecentCompanyInput.css({"border": ""});
		that.StartYearSeekerInput.css({"border": ""});
		that.EndYearSeekerInput.css({"border": ""});
		that.SchoolInput.css({"border": ""});
		that.StartYearStudentInput.css({"border": ""});
		that.EndYearStudentInput.css({"border": ""});
		that.Alert.html('');
		that.Alert.hide();
		that.activeError = false;
	}
}
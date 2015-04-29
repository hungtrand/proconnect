function JobPost() {
	this.container = $('#form-div');
	this.alert = $('#AlertNewImg')
	this.data;
	this.info;
	this.resetBorder();
	this.init();	
}

JobPost.prototype = {
	constructor: this,

	init: function() {
		var that = this;

		that.info = new ModalFiller();
		that.info.load();
	},

	load: function() {
		var that = this;
		// create a json object of all the data sent to the DB
		var data = {
			JobTitle: that.info.jobTitle.text(),
			CompanyName: that.info.jobLocation.text(),
			ContactInfo: that.info.contactInfo.text(),
			// CompanyImg: that.info.companyImg.attr('src'),
			JobDescription: that.info.jobDescription.text(),
			SkillDescription: that.info.skillDescription.text(),
			CompanyDescription: that.info.companyDescription.text(),
			EmploymentType: that.info.employmentType.text(),
			Experience: that.info.experience.text(),
			JobFunctions: that.info.jobFunctions.text(),
			Industries: that.info.industries.text()
		};
		that.data = data;

		//switch case to get all the required fields
		var counter = 0;
		$.each(data, function(key, value) {
			switch(value) {
				case 'Job Title Unavailable':
					$('#job-title').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Company Name Unavailable':
					$('#company-name').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Email Unavailable':
					$('#email').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Website Unavailable':
					$('#website').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Company Description Unavailable':
					$('#company-desc').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Desired Skills & Experiences Unavailable':
					$('#skill-desc').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Job Description Unavailable':
					$('#job-desc').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Employment Type Unavailable':
					$('#employment-type-dropbox').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Experience Unavailable':
					$('#experience-dropbox').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Job Functions Unavailable':
					$('#jobFunc-dropbox-0').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					$('#jobFunc-dropbox-1').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					$('#jobFunc-dropbox-2').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				case 'Industries Unavailable':
					$('#industry-dropbox-0').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					$('#industry-dropbox-1').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					$('#industry-dropbox-2').css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
					counter++;
					break;
				default:
					break;
			}
		});
		// that.createPost();
		// if counter does not equal 0, meaning there is one or more error in the form, then error
		if(counter != 0) {
			that.error();			
		} else {
			that.send( function(jsonData) {
				that.confirmSent(jsonData);
			});
		}
	},

	// reset the borders on submission
	resetBorder: function() {
		var that = this;
		$('#job-title').css({"border": ""});			
		$('#company-name').css({"border": ""});
		$('#email').css({"border": ""});			
		$('#website').css({"border": ""});
		$('#company-desc').css({"border": ""});	
		$('#skill-desc').css({"border": ""});
		$('#job-desc').css({"border": ""});			
		$('#employment-type-dropbox').css({"border": ""});			
		$('#experience-dropbox').css({"border": ""});			
		$('#jobFunc-dropbox-0').css({"border": ""});
		$('#jobFunc-dropbox-1').css({"border": ""});
		$('#jobFunc-dropbox-2').css({"border": ""});			
		$('#industry-dropbox-0').css({"border": ""});
		$('#industry-dropbox-1').css({"border": ""});
		$('#industry-dropbox-2').css({"border": ""});
	},

	// createPost: function() {
	// 	var that = this;
	// 	var uploadedImageURL = ''

	// 	function saveFeed() {
	// 		uploadedImageURL = that.processedImageURL.val();
	// 		var feed = new Feed();
	// 		feed.setContentMessage(contentMsg);
	// 		feed.setFeedLink(that.inputExternalLink.val());
	// 		feed.setImageURL(uploadedImageURL);
	// 		feed.setYouTubeURL(that.YouTubeURL.val());

	// 		feed.update(function(json) { 
	// 			try {
	// 				that.showAlert('Successfully posted on your network', 'success');
	// 				that.reset();
	// 			} catch(e) {
	// 				that.showAlert(json, 'danger');
	// 				console.log(json);
	// 			} 

	// 			// execute all saved functions here
	// 			that.executeCallback(json);
	// 		});
	// 	}

	// 	if(that.data.CompanyImg != '../image/comapnyimg') {
	// 		that.uploadCompanyImage(function(success) {
	// 			if(success) {
	// 				saveFeed();
	// 			} else {
	// 				console.log('bye');
	// 			}
	// 		});
	// 	} else {
	// 		saveFeed();
	// 	}
	// },

	// uploadCompanyImage: function (callback) {
	// 	var that = this;
	// 	var success = false;
	// 	fileUpload(that.data.companyimg, '/feed/php/imageUpload.php', that.Alert.attr('id'), function() {

	// 		if (that.Alert.find('#uploadedFile').length > 0) {
	// 			var newUrl = that.Alert.find('#uploadedFile').val();
	// 			that.processedImageURL.val(newUrl);
	// 			success = true;
	// 			callback(success);
	// 			setTimeout(function() {
	// 				that.Alert.find('.label-success').fadeOut('3000', function() {
	// 					$(this).remove();
	// 				});
	// 			}, 5000);
	// 		}
			
	// 	});
	// },	

	//send the data to the database
	send: function(callback) {
		var that = this;
		var data = that.data;

		$.ajax({
			url: 'php/dummy3.php',
			data: data,
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				callback(json);
			} catch (e) {
				callback(json);
			}
		}).fail(function(e) {
			console.log(e);
		});
	},

	confirmSent: function(callback) {
		var that = this;
		alert("Should redirect the user to their Job Post");
	},

	error: function() {
		var that = this;
		alert("A field Is Incomplete, please review and correctly fill in all fields");
	}
}
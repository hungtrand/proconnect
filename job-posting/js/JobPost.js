function JobPost() {
	this.container = $('#form-div');
	this.Alert = $('#AlertNewImg')
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
			JobID: 0,
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
			Industries: that.info.industries.text(),
			CompanyImage: that.container.find('#CompanyImageURL').val()
		};
		that.data = data;

		//switch case to get all the required fields
		var counter = 0;
		$.each(data, function(key, value) {
			switch(value) {
				case 'Job Title Unavailable':
					$('#job-title').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Company Name Unavailable':
					$('#company-name').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Email Unavailable':
					$('#email').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Website Unavailable':
					$('#website').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Company Description Unavailable':
					$('#company-desc').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Desired Skills & Experiences Unavailable':
					$('#skill-desc').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Job Description Unavailable':
					$('#job-desc').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Employment Type Unavailable':
					$('#employment-type-dropbox').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Experience Unavailable':
					$('#experience-dropbox').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Job Functions Unavailable':
					$('#jobFunc-dropbox-0').toggleClass("errorInput", true);
					$('#jobFunc-dropbox-1').toggleClass("errorInput", true);
					$('#jobFunc-dropbox-2').toggleClass("errorInput", true);
					counter++;
					break;
				case 'Industries Unavailable':
					$('#industry-dropbox-0').toggleClass("errorInput", true);
					$('#industry-dropbox-1').toggleClass("errorInput", true);
					$('#industry-dropbox-2').toggleClass("errorInput", true);
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
		$('#job-title').toggleClass("errorInput", false);			
		$('#company-name').toggleClass("errorInput", false);
		$('#email').toggleClass("errorInput", false);			
		$('#website').toggleClass("errorInput", false);
		$('#company-desc').toggleClass("errorInput", false);	
		$('#skill-desc').toggleClass("errorInput", false);
		$('#job-desc').toggleClass("errorInput", false);			
		$('#employment-type-dropbox').toggleClass("errorInput", false);			
		$('#experience-dropbox').toggleClass("errorInput", false);			
		$('#jobFunc-dropbox-0').toggleClass("errorInput", false);
		$('#jobFunc-dropbox-1').toggleClass("errorInput", false);
		$('#jobFunc-dropbox-2').toggleClass("errorInput", false);			
		$('#industry-dropbox-0').toggleClass("errorInput", false);
		$('#industry-dropbox-1').toggleClass("errorInput", false);
		$('#industry-dropbox-2').toggleClass("errorInput", false);
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

		var submitForm = function() {
			$.ajax({
				url: 'php/jobpost_controller.php',
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
		};

		if  (!that.container.find('#CompanyImage').val()) {
			submitForm();
		} else {
			that.uploadImage(function(success) {
				if (success) {
					data.CompanyImage = that.container.find("#CompanyImageURL").val();
					submitForm();
				} else {
					that.displayToast('Failed to upload file. Form not submitted.');
				}
				
			});
		}

		
	},

	uploadImage: function(callback) {
		var that = this;
		that.displayToast(that.container.find('#AlertNewImg img'), true); // display waiting gif
		var success = false;
		fileUpload(document.getElementById('formCompanyImage'), '/job-posting/php/imageUpload.php', 'AlertNewImg', function() {
			var alertDiv = that.container.find('#AlertNewImg');
			if (alertDiv.find('#uploadedFile').length > 0) {
				var newUrl = alertDiv.find('#uploadedFile').val(); 
				that.container.find('#CompanyImageURL').val(newUrl);
				success = true;
				callback(success);
			}
			
		});
	},

	confirmSent: function(callback) {
		var that = this;
		that.displayToast('Your job post has successfully been submitted.');
		that.container.find('input[type="text"], textarea').val('');
		that.container.find('input[type="file"]').val('');
		that.container.find('select option').removeAttr('selected');
		that.container.find('input[type="radio"]').removeAttr('checked');
		CKEDITOR.instances.companyDesc.setData('');
		CKEDITOR.instances.skillDesc.setData('');
		CKEDITOR.instances.jobDesc.setData('');
		$('#ImagePreview').attr('src', '../image/companyimg');
	},

	error: function() {
		var that = this;
		var alertMsg = 'Please provide information for required fields.';
		that.container.find('.errorInput:first').focus();
		that.container.find('.errorInput').one('change', function() {
			$(this).toggleClass('errorInput', false);
		});

		that.displayToast(alertMsg);
		
	},

	displayToast: function(msg, keepShown) {
		$('.toast').html(msg).slideDown('slow');

		if (!keepShown) {
			setTimeout(function() {
				$('.toast').slideUp('slow', function() {
					$(this).html('');
				});
			}, 5000);
		}
	}
}
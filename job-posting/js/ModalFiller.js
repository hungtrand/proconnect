// script to fill the modal for preview
function ModalFiller() {
	this.container = $('#myModal');
	this.jobTitle;
	this.jobLocation;
	this.contactInfo;
	// this.companyImg;
	this.jobDescription;
	this.skillDescription;
	this.companyDescription;
	this.employmentType;
	this.experience;
	this.jobFunctions;
	this.industries;
	this.data;
	this.init();
}

ModalFiller.prototype = {
	constructor: this,

	init: function () {
		var that = this;

		that.jobTitle = that.container.find('#modalJobTitle');
		that.jobLocation = that.container.find('#modalJobLocation');
		that.contactInfo = that.container.find('#modalContactInfo');
		// that.companyImg = that.container.find('#modalImagePreview');
		that.jobDescription = that.container.find('#modalJobDescription');
		that.skillDescription = that.container.find('#modalSkillDescription');
		that.companyDescription = that.container.find('#modalCompanyDescription');
		that.employmentType = that.container.find('#job-employment-type');
		that.experience = that.container.find('#job-experience');
		that.jobFunctions = that.container.find('#job-function');
		that.industries = that.container.find('#industries');
	},

	createModal: function () {
		var that = this;

		that.loadJobTitle();
		that.loadJobLocation();
		that.loadContactInfo();
		// that.loadCompanyImg();
		that.loadCompanyDesc();
		that.loadJobDesc();
		that.loadSkillDesc();
		that.loadEmploymentType();
		that.loadExperience();
		that.loadJobFunc();
		that.loadIndustries();		
	},

	loadJobTitle: function() {
		var that = this;

		if($('#job-title').val().length > 0) {
			that.jobTitle.text($('#job-title').val());
		} else {
			that.jobTitle.text('Job Title Unavailable');
		}
	},

	loadJobLocation: function() {
		var that = this;

		if($('#company-name').val().length > 0) {
			that.jobLocation.text($('#company-name').val());
		} else {
			that.jobLocation.text('Company Name Unavailable');
		}
	},

	loadContactInfo: function() {
		var that = this;

		var radioValue = $('input[name=receiver]:checked', '#contact-form').val();
		if(radioValue === '1') {
			if($('#email').val().length > 0) {
				that.contactInfo.text($('#email').val());
			} else {
				that.contactInfo.text('Email Unavailable');
			}
		} else if (radioValue === '2') {
			if($('#email').val().length > 0) {
				that.contactInfo.text($('#website').val());
			} else {
				that.contactInfo.text('Website Unavailable');
			}
		}
	},

	// loadCompanyImg: function() {
	// 	if($('#ImagePreview').attr('src') != '../image/companyimg') {
	// 		$('#modalImagePreview').attr('src', $('#ImagePreview').attr('src'));
	// 	} else {
	// 		$('#modalImagePreview').attr('src', '../image/companyimg');
	// 	}
	// },

	loadCompanyDesc: function() {
		var that = this;

		if(CKEDITOR.instances.companyDesc.getData().trim() != '') {
			that.companyDescription.text('');
			that.companyDescription.append(CKEDITOR.instances.companyDesc.getData());
		} else {
			that.companyDescription.text('Company Description Unavailable');
		}
	},

	loadSkillDesc: function() {
		var that = this;

		if(CKEDITOR.instances.skillDesc.getData().trim() != '') {
			that.skillDescription.text('');
			that.skillDescription.append(CKEDITOR.instances.skillDesc.getData());
		} else {
			that.skillDescription.text('Desired Skills & Experiences Unavailable');
		}
	},

	loadJobDesc: function() {
		var that = this;

		if(CKEDITOR.instances.jobDesc.getData().trim() != '') {
			that.jobDescription.text('');
			that.jobDescription.append(CKEDITOR.instances.jobDesc.getData());
		} else {
			that.jobDescription.text('Job Description Unavailable');
		}
	},

	loadEmploymentType: function() {
		var that = this;

		var employmentTypeValue = $('#employment-type-dropbox').val();
		var employmentTypeInput = $('#employment-type-dropbox option[value='+employmentTypeValue+']');
		if(employmentTypeInput.val() > 1) {
			that.employmentType.text(employmentTypeInput.text());
		} else {
			that.employmentType.text('Employment Type Unavailable');
		}
	},

	loadExperience: function() {
		var that = this;

		var experienceValue = $('#experience-dropbox').val();
		var experienceInput = $('#experience-dropbox option[value='+experienceValue+']');
		if(experienceInput.val() > 1) {
			that.experience.text(experienceInput.text());
		} else {
			that.experience.text('Experience Unavailable');
		}
	},

	loadJobFunc: function() {
		var that = this;

		var jobFunc0Value = $('#jobFunc-dropbox-0').val();
		var jobFunc0Input = $('#jobFunc-dropbox-0 option[value='+jobFunc0Value+']');

		var jobFunc1Value = $('#jobFunc-dropbox-1').val();
		var jobFunc1Input = $('#jobFunc-dropbox-1 option[value='+jobFunc1Value+']');

		var jobFunc2Value = $('#jobFunc-dropbox-2').val();
		var jobFunc2Input = $('#jobFunc-dropbox-2 option[value='+jobFunc2Value+']');

		var jobFunc = [];
		if(jobFunc0Input.val() > 0) {
			jobFunc.push(jobFunc0Input.text());
		}
		if(jobFunc1Input.val() > 0) {
			jobFunc.push(jobFunc1Input.text());
		}
		if(jobFunc2Input.val() > 0) {
			jobFunc.push(jobFunc2Input.text());
		}

		var jobFuncString = '';
		var counter1 = 0;
		$.each(jobFunc, function(index, item) {
			if(counter1 > 0) {
				jobFuncString += ', ';
			}
			jobFuncString += item;
			counter1++;
		});

		if(jobFuncString.length > 0) {
			that.jobFunctions.text(jobFuncString);	
		} else {
			that.jobFunctions.text('Job Functions Unavailable')
		}
	},

	loadIndustries: function() {
		var that = this;

		var industry0Value = $('#industry-dropbox-0').val();
		var industry0Input = $('#industry-dropbox-0 option[value='+industry0Value+']');

		var industry1Value = $('#industry-dropbox-1').val();
		var industry1Input = $('#industry-dropbox-1 option[value='+industry1Value+']');

		var industry2Value = $('#industry-dropbox-2').val();
		var industry2Input = $('#industry-dropbox-2 option[value='+industry2Value+']');

		var industryArr = [];
		if(industry0Input.val() > 0) {
			industryArr.push(industry0Input.text());
		}
		if(industry1Input.val() > 0) {
			industryArr.push(industry1Input.text());
		}
		if(industry2Input.val() > 0) {
			industryArr.push(industry2Input.text());
		}

		var industryString = '';
		var counter2 = 0;
		$.each(industryArr, function(index, item) {
			if(counter2 > 0) {
				industryString += ', ';
			}
			industryString += item;
			counter2++;
		});

		if(industryString.length > 0) {
			that.industries.text(industryString);
		} else {
			that.industries.text('Industries Unavailable');
		}
	},

	load: function () {
		var that = this;
		that.createModal()
	}
}
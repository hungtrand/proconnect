// script to fill the modal for preview
function ModalFiller() {
	this.container = $('#myModal');
	this.jobID;
	this.jobTitle;
	this.jobLocation;
	this.contactInfo;
	this.companyImg;
	this.jobDescription;
	this.skillDescription;
	this.companyDescription;
	this.employmentType;
	this.experience;
	this.jobFunctions;
	this.industries;
	this.modalCreator;
	this.applyBtn;
	this.data;
	this.init();
}

ModalFiller.prototype = {
	constructor: this,

	init: function () {
		var that = this;
		var data;

		that.jobID = that.container.find('#jobID');
		that.jobTitle = that.container.find('#modalJobTitle');
		that.jobLocation = that.container.find('#modalJobLocation');
		that.contactInfo = that.container.find('#modalContactInfo');
		that.companyImg = that.container.find('#modalImagePreview');
		that.jobDescription = that.container.find('#modalJobDescription');
		that.skillDescription = that.container.find('#modalSkillDescription');
		that.companyDescription = that.container.find('#modalCompanyDescription');
		that.employmentType = that.container.find('#job-employment-type');
		that.experience = that.container.find('#job-experience');
		that.jobFunctions = that.container.find('#job-function');
		that.industries = that.container.find('#industries');
		that.applyBtn = that.container.find('#apply-btn');
		that.modalCreator = $('.modalCreator');
		
		that.modalCreator.on('click', function(ev) {
			ev.preventDefault();
			var pretense = $(this).parent('div').parent('div');
			that.jobID.attr('value', pretense.find('.jobID').attr('value'));
			that.jobTitle.text(pretense.find('.jobTitle').text());
			that.jobLocation.text(pretense.find('.jobLocation').text());
			that.contactInfo.text(pretense.find('.contactInfo').val());
			that.companyImg.attr('src', pretense.find('.companyImg').attr('src'));
			that.jobDescription.text(pretense.find('.jobDescription').val());
			that.skillDescription.text(pretense.find('.skillDescription').val());
			that.companyDescription.text(pretense.find('.companyDescription').val());
			that.employmentType.text(pretense.find('.employmentType').val());
			that.experience.text(pretense.find('.experience').val());
			that.jobFunctions.html(pretense.find('.jobFunctions').val());
			that.industries.text(pretense.find('.industry').val());
			that.applyBtn.on('click', function(ev) {
				ev.preventDefault();
				that.applyBtn.css('background-color', '#9FF781');
				that.applyBtn.css('color', '#333');
				that.applyBtn.text('Applied');
				alert('You have successfully applied for this job');
			});
		});
	}
}
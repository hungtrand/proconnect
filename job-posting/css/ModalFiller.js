function ModalFiller() {
	this.container = $("#myModal").html();
	this.jobTitle;
	this.jobDesc;
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

		that.jobTitle = that.container.find("#modalJobTitle");
		that.jobDesc = that.container.find("#modalJobDescription");
		that.employmentType = that.container.find("#job-employment-type");
		that.experience = that.container.find("#job-experience");
		that.jobFunctions = that.container.find("#job-function");
		that.industries = that.container.find("#industries");
	},

	fetch: function (callback) {
		var that = this;

		that.jobTitle = $("#job-title").val();
	},

	createModal: function (data) {
		var that = this;
		that.jobTitle = $("#job-title").val();
	}
}
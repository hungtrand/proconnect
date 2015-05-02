function AdvSearch() {
	this.countryDropbox;
	this.industryDiv;
	this.jobFuncDiv;
	this.advSearchBtn1;
	this.advSearchBtn2;
	this.init();
}

AdvSearch.prototype = {
	constructor: this,

	init: function() {
		var that = this;

		that.countryDropbox = new CountryDropbox();
		that.countryDropbox.load();
		that.industryDiv = new IndustryDropbox();
		that.industryDiv.load();
		that.jobFuncDiv = new JobFuncDropbox();
		that.jobFuncDiv.load();

		that.advSearchBtn1 = $('#job-page-searching-footer1');
		that.advSearchBtn2 = $('#job-page-searching-footer2');
		that.advSearchBtn1.click( function(ev) {
			ev.preventDefault();
			$('#footer').fadeIn('slow');
			that.advSearchBtn1.hide();
			that.advSearchBtn2.show();
		});
		that.advSearchBtn2.click( function(ev) {
			ev.preventDefault();
			$('#footer').fadeOut('slow');
			that.advSearchBtn2.hide();
			that.advSearchBtn1.show();
		});
	}
}
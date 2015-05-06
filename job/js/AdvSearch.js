function AdvSearch() {
	this.countryDropbox;
	this.industryDiv;
	this.jobFuncDiv;
	this.advSearchBtn1;
	this.btnHideAdvSearch;
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

		that.advSearchBtn1 = $('#adv-searching-btn');
		that.advSearchBtn1.on('click', function(ev) {
			ev.preventDefault();
			$('#footer').slideDown('slow');
		});

		that.btnHideAdvSearch = $('#hideAdvSearch');
		that.btnHideAdvSearch.on('click', function(e) {
			e.preventDefault();
			$('#footer').slideUp('slow');
		});
	}
}
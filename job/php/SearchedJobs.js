function SearchedJobs () {
	this.searchBtn;
	this.jobTitle;
	this.location;
	this.country;
	this.industry;
	this.jobFunc;
	this.salary;
	this.data;
	this.setSearch();
	this.init();
}

SearchedJobs.prototype = {
	constructor: this,

	init: function() {
		var that = this;

		that.searchBtn = $('#btn-search-1');
		that.jobTitle = $('#search-job-title');
		that.location = $('#search-location');
		that.country = $('#country-dropbox');
		that.industry = $('input[name="industry"]:checked');
		that.jobFunc = $('input[name="jobFunc"]:checked');
		that.salary = $('input[name="salary"]:checked');
	},

	load: function() {
		var that = this;

	},

	setSearch: function() {
		var that = this;
		console.log(that.searchBtn);
	}
}
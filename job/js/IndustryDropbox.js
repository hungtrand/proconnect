function IndustryDropbox() {
	this.industry;
	this.industryData;
	this.init();
}

IndustryDropbox.prototype = {

	constructor: this,

	init: function() {
		var that = this;

		that.industry = $('#adv-industry-div');
	},

	load: function() {
		var that = this;

		that.fetchIndustry(function(jsonData) {
			that.loadIndustry(jsonData);
		});
	},

	fetchIndustry: function(callback) {
		var that = this;
		var industryData = that.industryData;

		$.ajax({
			url: 'php/IndustryData.php',
			type: 'POST',
			data: industryData,
			contentType: 'text/plain'
		}).done( function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.industryData = json;
				callback(json);
			} catch (e) {
				$('#job-page-alert').text("Unforunately we were unable to load some data.");
			}
		}).fail (function() {
			$('#job-page-alert').text("Unforunately we were unable to load some data.");
		})
	},

	loadIndustry: function(callback) {
		var that = this;
		var industryData = that.industryData;

		$.each(industryData, function(key, value) {
			that.industry.append('<input type="checkbox" name="industry" value='+value.industryID+'" id="'+value.industryValue+'">'+value.industryValue+'<br />');
		});
	}
}
function CountryDropbox() {
	this.country;
	this.countryData;
	this.init();
}

CountryDropbox.prototype = {
	
	constructor: this,

	init: function() {
		var that = this;

		that.country = $('#country-dropbox');
	},

	load: function() {
		var that = this;

		that.fetchCountry(function(jsonData) {
			that.loadCountry(jsonData);
		});
	},

	fetchCountry: function(callback) {
		var that = this;
		var countryData = that.countryData;

		$.ajax({
			url: 'php/CountryData.php',
			type: 'POST',
			data: countryData,
			contentType: 'text/plain'
		}).done( function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.countryData = json;
				callback(json);
			} catch (e) {
				$('#job-page-alert').text("Unforunately we were unable to load some data.");
			}
		}).fail (function() {
			$('#job-page-alert').text("Unforunately we were unable to load some data.");
		});
	},

	loadCountry: function(callback) {
		var that = this;
		var countryData = that.countryData;
		$.each(countryData, function(key, value) {
			that.country.append('<option name="country" value="'+value.countryID+'" id="'+value.countryValue+'">'+value.countryValue+'</option>');
		});
	}
}
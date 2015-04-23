function SuggestionList(container) {
	/*this.data = [
		{ "Name": "Adrian Adam", "JobTitle": "Developer", "CompanyName": "Google, Inc.", "Location": "Mountain View"},
		{ "Name": "Bryan Adam", "JobTitle": "Writer",  "CompanyName": "Microsoft, Inc.", "Location": "Mountain View"},
		{ "Name": "Collins Adam", "JobTitle": "Manager",  "CompanyName": "Dropbox, Inc.", "Location": "Mountain View"},
		{ "Name": "Duncan Adam", "JobTitle": "Auditor",  "CompanyName": "Pandora, Inc.", "Location": "Mountain View"}
	];*/
	this.data = [];

	this.container = container;
	this.page = 0;
	this.Alert;
	this.waitingGif = $('<div class="text-center hidden waitingGif"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');

	this.init();
}

SuggestionList.prototype = {
	constructor: SuggestionList,

	init: function() {
		this.Alert = $('#SuggestionsListEndAlert');
	},

	fetch: function(callback) {
		var that = this;

		var data = {
			page: that.page
		}

		$.ajax({
			url: '/connections/php/FetchSuggestions_controller.php',
			type: 'POST',
			data: data
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				callback(json);
			} catch (e) {
				that.Alert.html(json);
				that.Alert.toggleClass('hidden', false);
			}

			that.container.find('.waitingGif').remove();
		}).fail(function() {
			that.Alert.html("Network or Server Error occurred.");
			that.Alert.toggleClass('hidden', false);
		});
	},

	load: function() {
		var that = this;
		that.container.append(that.waitingGif);

		that.page = 1;
		that.Alert.toggleClass('hidden', true);
		that.container.html('');

		that.fetch(function(jsonData) {
			that.appendView(jsonData);
		});
		
	},

	next: function() {
		var that = this;
		that.page++;
		that.toggleClass('hidden', true);

		that.fetch(function(jsonData) {
			that.appendView(jsonData);
		});
	},

	appendView: function(json) {
		var that = this;
		if (!json) {
			that.Alert.html("End of Results");
			that.Alert.toggleClass('hidden', false);
			return false;
		}

		for (var i = 0, l=json.length; i < l; i++) {
			that.data.push(json[i]);
			var conn = new NewConnection(json[i]);

			this.container.append(conn.getView());
		}
	}
}
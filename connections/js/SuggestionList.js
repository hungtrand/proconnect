function SuggestionList(container) {
	this.data = [
		{ "Name": "Adrian Adam", "JobTitle": "Developer", "CompanyName": "Google, Inc.", "Location": "Mountain View"},
		{ "Name": "Bryan Adam", "JobTitle": "Writer",  "CompanyName": "Microsoft, Inc.", "Location": "Mountain View"},
		{ "Name": "Collins Adam", "JobTitle": "Manager",  "CompanyName": "Dropbox, Inc.", "Location": "Mountain View"},
		{ "Name": "Duncan Adam", "JobTitle": "Auditor",  "CompanyName": "Pandora, Inc.", "Location": "Mountain View"}
	];

	this.container = container;
	this.init();
}

SuggestionList.prototype = {
	constructor: SuggestionList,

	init: function() {

	},

	fetch: function(page) {
		if (!page) page = 1;
		var data = {
			page: page
		}

		$.ajax({
			url: 'php/Suggestions_controller.php',
			type: 'POST',
			data: data
		}).done(function(json) {

		});
	},

	load: function() {

		for (var i = 0, l=this.data.length; i < l; i++) {
			var conn = new NewConnection(this.data[i]);

			this.container.append(conn.getView());
		}
	}
}
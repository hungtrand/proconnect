function SuggestionList(container) {
	this.data = [
		{ "Name": "Adrian Adam", "JobTitle": "Developer", "CompanyName": "Google, Inc.", "Location": "Mountain View"},
		{ "Name": "Bryan Adam", "JobTitle": "Writer",  "CompanyName": "Microsoft, Inc.", "Location": "Mountain View"},
		{ "Name": "Collins Adam", "JobTitle": "Manager",  "CompanyName": "Dropbox, Inc.", "Location": "Mountain View"},
		{ "Name": "Duncan Adam", "JobTitle": "Auditor",  "CompanyName": "Pandora, Inc.", "Location": "Mountain View"}
	];

	this.ConnTemplate;
	this.container = container;
	this.init();
}

SuggestionList.prototype = {
	constructor: SuggestionList,

	init: function() {
		this.ConnTemplate = $('#SuggestionTemplate').html();
	},

	load: function() {

		for (var i = 0, l=this.data.length; i < l; i++) {
			var conn = $(this.ConnTemplate);
			var connData = this.data[i];
			conn.find('.ConnectionName').text(connData['Name']);
			conn.find('.ConnectionJob').text(connData['JobTitle']);
			conn.find('.ConnectionCompany').text(connData['CompanyName']);
			conn.find('.ConnectionLocation').text(connData['Location']);

			this.container.append(conn);
		}
	}
}
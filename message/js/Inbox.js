function Inbox(data) {
	this.container;
	// this.btnConnect;
	// this.btnDismiss;
	this.ConnTemplate;
	this.data;
	this.init(data);
}

Inbox.prototype = {
	constructor: this,

	init: function(data) {
		var that = this;
		that.data = data;
		that.ConnTemplate = $('#sender-message-content').html();

		var conn = $(that.ConnTemplate);

		this.data = data;
		conn.find('.sender-name').text(data['sender-name']);
		conn.find('.sender-message').text(data['sender-message']);

		that.container = conn;
	},

	getView: function() {
		return this.container;
	}
}
function NewConnection(data) {
	this.container;
	this.btnConnect;
	this.btnDismiss;
	this.ConnTemplate;
	this.data;

	this.init(data);
}

NewConnection.prototype = {
	constructor: this,

	init: function(data) {
		var that = this;
		that.data = data;
		that.ConnTemplate = $('#SuggestionTemplate').html();

		var conn = $(that.ConnTemplate);

		conn.find('.UserID').val(data['UserID']);
		conn.find('.ConnectionName').text(data['Name']);
		conn.find('.ConnectionJob').text(data['JobTitle']);
		conn.find('.ConnectionCompany').text(data['CompanyName']);
		conn.find('.ConnectionLocation').text(data['Location']);

		that.container = conn;

		that.btnConnect = that.container.find('.addNewConnection');
		that.btnConnect.on('click', function(e) {
			e.preventDefault();
			that.connect(function(returnedData) {
				that.confirmConnect(returnedData);
			});
		});

		that.btnDismiss = that.container.find('.dismissConnection');
		that.btnDismiss.on('click', function(e) {
			e.preventDefault();
			console.log('asdfafd');
			that.dismiss();
		});
	},

	connect: function(callback) {
		var that = this;
		var data = {
			'UserID': this.data['UserID']
		}

		$.ajax({
			url: 'php/NewConnection_controller.php',
			data: data,
			type: 'POST'
		}).done(function(json) {

			console.log(json);
			try {
				json = $.parseJSON(json)
				callback(json);
			} catch (e) {
				that.failConnect(json);
			}
			
		}).fail(function(e) {
			that.failConnect();
		});
	},

	confirmConnect: function(json) {
		var that = this;
		if (json['success'] == 1)
			that.btnConnect.replaceWith('<span class="label label-success">connected</label>');
	},

	failConnect: function(msg) {
		if (!msg) msg = "Failed";

		var that = this;
		that.btnConnect.find('.txt').text(msg).toggleClass('text-danger', true);
		setTimeout(function() {
			that.btnConnect.find('.txt').text('Connect').toggleClass('text-danger', false);
		}, 3000);
	},

	dismiss: function() {
		var that = this;
		that.container.fadeOut('600', function() {
			$(this).remove();
		});
	},

	getView: function() {
		return this.container;
	}
}
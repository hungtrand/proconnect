function UserConnection(data) {
	this.container;
	this.btnConnect;
	this.btnDismiss;
	this.ConnTemplate;
	this.data;

	this.init(data);
}

UserConnection.prototype = {
	constructor: this,

	init: function(data) {
		var that = this;
		that.data = data;
		that.ConnTemplate = $('#ConnectionTemplate').html();

		var conn = $(that.ConnTemplate);

		this.data = data;
		var profileLink = '/profile-public-POV/?UserID=' + data['UserID'];
		conn.find('.ConnectionName').text(data['Name']);
		conn.find('.ConnectionName').attr('href', profileLink);
		conn.find('.ProfileLink').attr('href', profileLink);
		conn.find('.UserID').val(data['UserID']);
		conn.find('.ConnectionJob').text(data['JobTitle']);
		conn.find('.ConnectionCompany').text(data['CompanyName']);
		conn.find('.ConnectionLocation').text(data['Location']);

		if (data['ProfileImage']) {
			conn.find('.ProfileImage').attr('src', data['ProfileImage']);
		}

		that.container = conn;

		that.btnConnect = that.container.find('.removeConnection');
		that.btnConnect.on('click', function(e) {
			e.preventDefault();
			that.remove(function(returnedData) {
				that.confirmRemove(returnedData);
			});
		});
	},

	remove: function(callback) {
		var that = this;
		var data = {
			'UserID': this.data['UserID']
		}

		$.ajax({
			url: 'php/removeConnection_controller.php',
			data: data,
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json)
				callback(json);
			} catch (e) {
				that.failRemove(json);
			}
			
		}).fail(function(e) {
			that.failRemove();
		});
	},

	confirmRemove: function(json) {
		var that = this;
		if (json['success'] == 1)
			that.btnConnect.replaceWith('<span class="label label-success">Removed</label>');

		setTimeout(function() {
			that.container.fadeOut('800', function() {
				$(this).remove();
			});
		}, 500);
	},

	failRemove: function(msg) {
		if (!msg) msg = "Failed";

		var that = this;
		that.btnConnect.find('.txt').text(msg).toggleClass('text-danger', true);
		setTimeout(function() {
			that.btnConnect.find('.txt').text('Connect').toggleClass('text-danger', false);
		}, 3000);
	},

	getView: function() {
		return this.container;
	}
}
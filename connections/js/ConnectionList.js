function ConnectionList(container) {
	this.data = [];

	this.container = container;
	this.page = 0;
	this.Alert;
	this.waitingGif = $('<div class="text-center hidden waitingGif"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');

	this.init();
}

ConnectionList.prototype = {
	constructor: ConnectionList,

	init: function() {
		this.Alert = $('#ConnectionsListEndAlert');
	},

	fetch: function(callback) {
		var that = this;

		var data = {
			page: that.page
		}

		$.ajax({
			url: 'php/Connections_controller.php',
			type: 'POST',
			data: data
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				callback(json);
			} catch (e) {
				that.showAlert(json, 'info');
				if (json.indexOf('End') > -1) that.page = -1;
			}

			that.container.find('.waitingGif').remove();
		}).fail(function() {
			that.showAlert("Network or Server Error occurred.", "danger");
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
		if (that.page == -1) {
			that.showAlert('End of results', 'info');
			return false;
		}
		
		that.page++;
		that.showAlert(that.waitingGif, "info");

		that.fetch(function(jsonData) {
			that.appendView(jsonData);
		});
	},

	appendView: function(json) {
		var that = this;

		for (var i = 0, l=json.length; i < l; i++) {
			that.data.push(json[i]);
			var conn = new UserConnection(json[i]);

			this.container.append(conn.getView());
		}
	},

	showAlert: function(msg, type) {
		var that = this;
		that.Alert.html(msg);
		switch(type) {
			case 'success':
				that.Alert.attr('class', 'alert alert-success').slideDown();
			break;
			case 'danger':
				that.Alert.attr('class', 'alert alert-danger').slideDown();
			default:
				that.Alert.attr('class', 'alert alert-info').slideDown();
				
		}

		$(document).one('click', function() {
			setTimeout(function() {
				that.Alert.attr('class', 'alert alert-info').fadeOut(1000);
			}, 2000);
		});
		
	}
}
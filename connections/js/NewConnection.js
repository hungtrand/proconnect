function NewConnection(data, mode) {
	this.container;
	this.btnConnect;
	this.btnDismiss;
	this.ConnTemplate;
	this.data;
	if(mode == 'show') this.mode = mode;
	else this.mode = 'hide';

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
		conn.find('.ConnectionFirstName').text(data['FirstName']);
		conn.find('.ConnectionJob').text(data['JobTitle']);
		conn.find('.ConnectionCompany').text(data['CompanyName']);
		conn.find('.ConnectionLocation').text(data['Location']);
		if (data['ProfileImage']) {
			conn.find('.ProfileImage').attr('src', data['ProfileImage']);
		}
		
		/*toggle suggestions hide/show events*/
		conn.find('.ProfileImage').on('click', function() {
			that.switchMode('show');
		});

		conn.on('click', function(e) {
			e.stopPropagation();
		});

		$(document).on('click', function(e) {
			that.switchMode('hide');
		});
		/*end of suggestions hide/show events*/

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

		if (that.mode != 'show') {
			that.switchMode('hide');
			conn.css({
				'width':'21%',
				'float':'right',
				'clear':'both'
			});
		}
	},

	switchMode: function(mode) {
		var conn = this.container;
		switch(mode) {
			case 'show':
				conn.animate({width:'100%'},400, 'linear', function() {
					conn.find('.BlurHide').show();
					conn.find('.FullHide').hide();
				});
			break;
			default:
				conn.find('.BlurHide').hide();
				conn.find('.FullHide').show();
				conn.animate({width:'21%'},400, 'linear');
		}
	},

	connect: function(callback) {
		var that = this;
		var data = {
			'UserID': this.data['UserID']
		}

		$.ajax({
			url: '/connections/php/NewConnection_controller.php',
			data: data,
			type: 'POST'
		}).done(function(json) {

			//console.log(json);
			try {
				json = $.parseJSON(json);
			} catch (e) {
				// console.log(json);
			}

			callback(json);
			
		}).fail(function(e) {
			that.failConnect();
		});
	},

	confirmConnect: function(json) {
		var that = this;
		if (json['success'] == 1) {
			that.btnConnect.replaceWith('<span class="label label-success">Invitation Sent.</label>');
			setTimeout(function() {
				that.container.fadeOut('slow', function() {
					$(this).remove();
				});
			},3000);
		}
		else 
			that.failConnect('Invitation Failed');
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
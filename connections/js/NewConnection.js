function NewConnection(data, mode) {
	this.container;
	this.btnConnect;
	this.btnDismiss;
	this.ConnTemplate;
	this.data;
	this.mode = 'hide';

	this.init(data, mode);
}

NewConnection.prototype = {
	constructor: this,

	init: function(data, mode) {
		var that = this;
		that.data = data;
		that.ConnTemplate = $('#SuggestionTemplate').html();

		var conn = $(that.ConnTemplate);

		var profileLink = '/profile-public-POV/?UserID=' + data['UserID'];
		conn.find('.UserID').val(data['UserID']);
		conn.find('.ConnectionName').text(data['Name']);
		conn.find('.ConnectionName').attr('href', profileLink);
		conn.find('.ConnectionFirstName').text(data['FirstName']);
		conn.find('.ConnectionJob').text(data['JobTitle']);
		conn.find('.ConnectionCompany').text(data['CompanyName']);
		conn.find('.ConnectionLocation').text(data['Location']);
		if (data['ProfileImage']) {
			conn.find('.ProfileImage').attr('src', data['ProfileImage']);
		}

		if (parseInt(data['Connected']) == 1) {
			conn.find('.addNewConnection').attr('disabled', 'disabled').text('Already Connected');
		}
		
		/*toggle suggestions hide/show events*/
		conn.find('.ProfileImage').on('mouseover', function() {
			that.switchMode('show');
		});

		conn.on('click', function(e) {
			e.stopPropagation();
		});

		$(document).on('click', function(e) {
			if (that.mode == 'static') return false;
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

		// initialize hide mode
		conn.css({
			'width':'100px',
			'float':'left',
			'clear':'both',
			'z-index':"0"
		});

		conn.find('.panel-heading, .panel, .panel-body').css({
			'background-color':'transparent',
		});

		conn.find('.panel').css('border-width', "0px");

		conn.find('.BlurHide').hide();
		conn.find('.FullHide').show();
		// end of initialization

		// if a parameter was passed in for mode then execute that mode
		if (mode == 'show' || mode == 'static') {
			that.switchMode(mode);
		}
	},

	switchMode: function(mode) {
		var that = this;
		var conn = this.container;
		switch(mode) {
			case 'static':
			case 'show':
				if (that.mode == 'show' || that.mode == 'static') return false;
				that.mode = mode;
				conn.find('.panel-heading, .panel, .panel-body').css({
					'background-color':'#fff',
				});
				conn.find('.panel').css('border-width', '2px');
				conn.animate({width:'400px', 'z-index':"9"},400, 'linear', function() {
					conn.find('.BlurHide').show();
					conn.find('.FullHide').hide();
				});
				conn.toggleClass('box', true);
			break;
			default:
				if (that.mode == 'hide') return false;
				that.mode = 'hide';
				conn.find('.BlurHide').hide();
				conn.find('.FullHide').show();
				conn.animate({width:'100px', 'z-index':"0"},400, 'linear', function() {
					conn.find('.panel-heading, .panel, .panel-body').css({
						'background-color':'transparent',
					});
					conn.find('.panel').css('border-width', "0px");
				});
				conn.toggleClass('box', false);
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
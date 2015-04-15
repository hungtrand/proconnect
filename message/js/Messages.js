var counter = 0;
var totalMessages = 0;

function Messages(data, page) {
	this.container;
	this.btnSend;
	this.btnRemove;
	this.ConnTemplate;
	this.totalMsg;
	this.page=page;
	this.data;
	this.init(data);
}

Messages.prototype = {
	constructor: this,

	init: function(data) {
		counter++;
		if(counter > 8) {
			counter = 0;
		}
		var that = this;
		that.data = data;
		that.ConnTemplate = $('#sender-message-content').html();

		var conn = $(that.ConnTemplate);
		conn.find('.messageID').val(data['messageID']);
		conn.find('.sender-picture').attr("src", data['sender-picture']);
		conn.find('.sender-name').text(data['sender-name']);
		conn.find('.sender-name').attr("href", data['sender-href']);
		conn.find('.message-subject').text(data['message-subject']);
		conn.find('.message-time').text(data['message-time']);
		conn.find('.sender-message').text(data['sender-message']);
		totalMessages = data['total-messages'];

		that.container = conn;

		$('article').readmore({
			speed: 600
		});

		that.btnSend = that.container.find('.message-friend');
		that.btnSend.on('click', function(ev) {
			ev.preventDefault();
			$("#message-div").empty();
				var iniInbox = $("#update-message-frame").html();
				var textbox = $("#message-textfield").html();
				var edit = $(iniInbox);
				edit.find(".message-frame-name").text("Reply Message");;
				edit.find(".message-frame-display").append(textbox);
				$("#message-div").append(edit);
				$("#recipient-textarea").val(data['sender-name']);
				$("#userID").val(data['sender-ID']);
				$("#recipient-subject-textarea").val("RE: "+data['message-subject']);
				$('html,body').animate({
	        		scrollTop: $("#message-div").offset().top - 1000
	    		});
	    		var userTypeahead = new typeahead();
	    		var sendMessage = new NewMessage(textbox);
		});
		that.btnRemove = that.container.find('.remove-mail');
		that.btnRemove.on('click', function(ev) {
			ev.preventDefault();
			that.remove( function(returnedData) {
				that.confirmRemove(returnedData);
			});
		});
	},

	remove: function(returnedData) {
		var that = this;
		var data = {'messageID': this.data['messageID']}

		$.ajax({
			url: 'php/dummy.php',
			data: data,
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				returnedData(json);
			} catch (ev) {
				that.failRemove(json);
			}
		}).fail(function(ev) {
			that.failRemove();
		});
	},

	confirmRemove: function(json) {
		var that = this;

		setTimeout(function() {
			that.container.fadeOut('800', function() {
				$(this).remove();
				alert("Successfully moved message to Trash");
			})
		}, 200);

	},

	getView: function() {
		return this.container;
	}
}
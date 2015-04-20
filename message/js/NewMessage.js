function NewMessage(container) {
	this.container = container;
	this.user;
	this.userID;
	this.subject;
	this.bodyContent;
	this.sendBtn;
	this.cancelBtn;
	this.init();
}

NewMessage.prototype = {
	constructor: NewMessage,

	init: function() {
		var that = this;
		that.user = $("#recipient-textarea").val();
		that.userID = $("#userID").val();
		that.subject = $("#recipient-subject-textarea").val();
		that.bodyContent =$("#summary-textarea").val();
		that.sendBtn = $(".send-btn");

		that.sendBtn.on('click', function(ev) {
			ev.preventDefault();
			if($("#recipient-textarea").val().length===0) {
				alert("Cannot send message, recipient's name is empty");
			} else if($("#summary-textarea").val().length===0) {
				alert("Cannot send message, the message body is empty");
			} else {
				$("#loading-sent").show();
				that.sendMsg( function(callback) {
					that.confirmSent(callback);
				});				
			}
		});

		that.cancelBtn = $(".cancel-btn");
		that.cancelBtn.on('click', function(ev) {
			ev.preventDefault();
			that.cancelMsg();
		})
	},

	sendMsg: function(callback) {
		var that = this;
		var data={User: this.user, UserID: this.userID, Subject: this.subject, Message: this.bodyContent};
		$.ajax({
			url: 'php/dummy.php',
			data: data,
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				callback(json);
			} catch (ev) {
				console.log(data);
			}
		}).fail(function(ev) {
			console.log(data);
		});
	},

	confirmSent: function(json) {
		var that = this;
		setTimeout(function() {
			$(that.container).fadeOut('800', function() {
				$("#loading-sent").hide();
				that.cancelBtn.trigger('click');
			})
		}, 1500);
	},

	cancelMsg: function() {
		$("#message-frame-display").empty();
		var iniMessages = new LoadMessages($('.message-frame-display'), "Inbox", 1);
		iniMessages.load()
	}
}
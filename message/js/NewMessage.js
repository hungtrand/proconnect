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
				$(".loading").show();
			that.sendMsg( function(callback) {
				that.confirmSent(callback);
			});
		});
		that.cancelBtn = $(".cancel-btn");
		that.cancelBtn.on('click', function(ev) {
			ev.preventDefault();
			$("#message-div").empty();
			var initbox = $("#main-inbox");
			var iniValue = initbox.attr("value");
			var iniInbox = $("#update-message-frame").html();
			var iniEdit = $(iniInbox);
			iniEdit.find(".message-frame-name").text(iniValue);
			$("#message-div").append(iniEdit);
			var iniMessages = new LoadMessages($('.message-frame-display'), iniValue, 1);
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
				$(".loading").hide();
				that.cancelBtn.trigger('click');
			})
		}, 2500);
	}
}
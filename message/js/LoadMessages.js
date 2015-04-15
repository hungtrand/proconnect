function LoadMessages(container, form, page) {
	
	URLs={Inbox: 'php/dummy.php', Outbox: 'php/dummy2.php', Archive: 'php/dummy3.php', Trash: 'php/dummy4.php'};
	this.data = "";
	this.form = form;
	this.container = container;
	this.page = page;
	this.init(form);
}

LoadMessages.prototype = {

	constructor: LoadMessages,

	init: function(form) {
		this.fetch(form);
	},

	fetch: function(form) {
		var that = this;
		var pageForm = {};
		pageForm[that.form] = that.page;

		$.ajax({
			url: URLs[form],
			type: 'POST',
			data: pageForm,
			contentType: 'text/plain'
		}).done(function(data) {
			that.data = JSON.parse(data);
			that.load();
		}).fail(function() {
			//should do something
		});
	},

	load: function() {
		var that = this;
		that.appendView(that.data);
	},

	next: function() {
		var that = this;
		that.page++;
		that.toggleClass('hidden', true);

		that.fetch(function(jsonData) {
			that.appendView(jsonData);
		});
	},

	appendView: function(data) {
		var messageData = $(data);
		var that = this;
		var messageIndex = "message";
		var key
		var counter = 0;
		for(key in data)
		{
			if(data.hasOwnProperty(key))
			{
				counter++;
			}
		};

		for(var i = 1; i < counter+1; i++)
		{
			var index = messageIndex + i;
			var box = new Messages($(data).attr(index), this.page);
			this.container.append(box.getView());
		}

		if(totalMessages > 8) {
			var divider = Math.ceil(totalMessages/8);
			var footer = $("#message-nav-temp").html();
			var loadPageNumber;
			$("#message-div").append(footer);
			$("#page-jumper").attr("placeholder", this.page+" out of "+divider);
			if(this.page === 1) {
				$("#prev-page").remove();
			}
			if(this.page === divider) {
				$("#next-page").remove();
			}

			$("#next-page").on('click', function(ev) {
				ev.preventDefault();
				var nextPage = that.page;
				nextPage = nextPage + 1;
				$("#message-div").empty();
				var iniInbox = $("#update-message-frame").html();
				var iniEdit = $(iniInbox);
				iniEdit.find(".message-frame-name").text(that.form);
				$("#message-div").append(iniEdit);
				var iniMessages = new LoadMessages($('.message-frame-display'), that.form, nextPage);
			});
			
			$("#prev-page").on('click', function(ev) {
				ev.preventDefault();
				var prevPage = that.page;
				prevPage = prevPage - 1;
				$("#message-div").empty();
				var iniInbox = $("#update-message-frame").html();
				var iniEdit = $(iniInbox);
				iniEdit.find(".message-frame-name").text(that.form);
				$("#message-div").append(iniEdit);
				var iniMessages = new LoadMessages($('.message-frame-display'), that.form, prevPage);
			});
		}
	}
}
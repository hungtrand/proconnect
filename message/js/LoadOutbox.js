function LoadOutbox(container) {
	this.data = "";

	this.container = container;

	this.init();
}

LoadOutbox.prototype = {

	constructor: LoadOutbox,

	init: function() {
		this.fetch();
	},

	fetch: function() {
		var that = this;

		$.ajax({
			url: 'php/dummy2.php',
			type: 'POST',
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
			var box = new Outbox($(data).attr(index));
			this.container.append(box.getView());
		}
	}
}
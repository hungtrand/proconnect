function FeedList(container) {
	this.data = [];

	this.container = container;
	this.page = 0;
	this.Alert;
	this.waitingGif = $('<div class="text-center hidden waitingGif"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');

	this.init();
}

FeedList.prototype = {
	constructor: this,

	init: function() {
		this.Alert = $('#FeedListEndAlert');
	},

	fetch: function(callback) {
		var that = this;

		var data = {
			page: that.page
		}

		$.ajax({
			url: 'php/FeedList_controller.php',
			type: 'POST',
			data: data
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				callback(json);
			} catch (e) {
				that.Alert.html(json);
				that.Alert.toggleClass('hidden', false);
			}

			that.container.find('.waitingGif').remove();
		}).fail(function() {
			that.Alert.html("Network or Server Error occurred.");
			that.Alert.toggleClass('hidden', false);
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
		that.page++;
		that.toggleClass('hidden', true);

		that.fetch(function(jsonData) {
			that.appendView(jsonData);
		});
	},

	appendView: function(json) {
		var that = this;
		if (!json) {
			that.Alert.html("End of Results");
			that.Alert.toggleClass('hidden', false);
			return false;
		}

		for (var i = json.length, l=-1; i > l; i--) {
			that.data.push(json[i]);
			var feed = new Feed(json[i]);

			var ele = feed.getView();
			that.container.prepend(ele);
		}
	}
}
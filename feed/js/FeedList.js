function FeedList(container) {
	this.data = [];
	this.unreadCache = [];

	this.container = container;
	this.page = 0;
	this.Alert;
	this.waitingGif = $('<div class="text-center hidden waitingGif"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');

	this.init();
}

FeedList.prototype = {
	constructor: this,

	init: function() {
		var that = this;
		this.Alert = $('#FeedListEndAlert');
		setInterval(function() {
			that.fetchNewest();
		}, 15000);
	},

	fetch: function(callback, intNewerThanID) {
		var that = this;

		var data = {};

		if (!isNaN(parseInt(intNewerThanID))) 
			data['afterID'] = intNewerThanID;
		else
			data['page'] = that.page;

		$.ajax({
			url: '/feed/php/FeedList_controller.php',
			type: 'POST',
			data: data
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				callback(json);
			} catch (e) {
				that.showAlert(json, "info");
				if (json.indexOf('End') > -1) that.page = -1;
			}

			that.container.find('.waitingGif').remove();
		}).fail(function() {
			that.showAlert("Network or Server Error Occured", "danger");
		});
	},

	fetchNewest: function() {
		var that = this;

		var afterID = that.data[that.data.length - 1]['FeedID'];
		if (that.unreadCache.length > 0) {
			afterID = that.unreadCache[that.unreadCache.length - 1]['FeedID'];
		}

		that.fetch(function(json) {
			if (json.length < 1 ) return false;

			for (var i = 0, l = json.length; i < l; i++) {
				that.unreadCache.push(json[i]);
			}

			if (that.container.find('.newPostAlert').length < 1) {
				var viewNewLink = $('<div class="alert alert-success newPostAlert text-center"><a href="#">' + json.length + ' new posts. Click to view.</a>');
				viewNewLink.on('click', function(e) {
					e.preventDefault();
					that.appendView(that.unreadCache);
					$(this).remove();
				});

				that.container.prepend(viewNewLink);
			}

			console.log(that.unreadCache);
			
		}, afterID);
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
			that.appendView(jsonData, true);
		});
	},

	appendView: function(json, older) {
		var that = this;

		for (var i = json.length, l=-1; i > l; i--) {
			var feed = new Feed(json[i]);

			var ele = feed.getView();

			if (older) {
				that.data.unshift(json[i]); // save the data to front of array 
				that.container.append(ele);
			} else {
				that.data.push(json[i]);  // save the data to the end of array
				that.container.prepend(ele);
			}
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
function FeedList(container) {
	this.data = [];
	this.unreadCache = [];
	this.busy = false;

	this.container = container;
	this.page = 0;
	this.Alert;
	this.waitingGif = $('<div class="text-center waitingGif"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');

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
			url: 'php/FeedList_controller.php',
			type: 'POST',
			data: data
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
			} catch (e) {
				console.log(e);
			}

			callback(json);
		}).fail(function() {
			that.showAlert("Network or Server Error Occurred", "danger");
		});
	},

	fetchNewest: function() {
		var that = this;

		var afterID = that.data[that.data.length - 1]['FeedID'];
		if (that.unreadCache.length > 0) {
			afterID = that.unreadCache[that.unreadCache.length - 1]['FeedID'];
		}

		that.fetch(function(json) {
			if (typeof json == 'string') return false;

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
		that.Alert.slideUp(700);
		that.container.html('');

		that.fetch(function(jsonData) {
			that.appendView(jsonData);
		});
		
	},

	next: function() {
		var that = this;
		if (that.busy) return false;
		if (that.page == -1) {
			that.showAlert('End of results', 'info');
			return false;
		}

		that.busy = true;
		that.page++;
		that.showAlert(that.waitingGif, "default");

		that.fetch(function(jsonData) {
			if (typeof jsonData	== 'string') {
				that.showAlert(jsonData, 'danger');
				if (jsonData.indexOf('End') > -1) that.page = -1;
			}
			else {
				setTimeout(function() {
					that.appendView(jsonData, true);
					that.busy = false;
				}, 2000);
			}
		});
		
		
	},

	appendView: function(json, older) {
		if (typeof json == 'string') {
			showAlert('You are up to date.');
			return false;
		}

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
				that.Alert.attr('class', 'alert alert-success');
			break;
			case 'danger':
				that.Alert.attr('class', 'alert alert-danger');
			break;
			case 'info':
				that.Alert.attr('class', 'alert alert-info');
				break;
			default:
				that.Alert.attr('class', 'alert alert-default');
				
		}

		that.Alert.slideDown();

		$(document).one('click', function() {
			setTimeout(function() {
				that.Alert.attr('class', 'alert alert-info').slideUp(500);
			}, 2000);
		});
		
	}
}
function CommentList(container, FeedID) {
	this.data = [];
	this.FeedID = FeedID;
	this.unreadCache = [];

	this.container = container;
	this.page = 0;
	this.Alert;
	this.waitingGif = $('<div class="text-center hidden waitingGif"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');

	this.init();
}

CommentList.prototype = {
	constructor: this,

	init: function() {
		var that = this;
		this.Alert = that.container.find('.CommentListEndAlert');
		setInterval(function() {
			that.fetchNewest();
		}, 15000);

		if (!that.FeedID) console.log("Error: CommentList.js - Missing FeedID");
	},

	fetch: function(callback, intNewerThanID) {
		var that = this;

		var data = {
			'FeedID': that.FeedID
		};

		if (!isNaN(parseInt(intNewerThanID))) 
			data['afterID'] = intNewerThanID;
		else
			data['page'] = that.page;

		$.ajax({
			url: 'php/CommentList_controller.php',
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

		if (that.data.length > 0)
			var afterID = that.data[that.data.length - 1]['CommentID'];
		else 
			var afterID = 0;

		if (that.unreadCache.length > 0) {
			afterID = that.unreadCache[that.unreadCache.length - 1]['CommentID'];
		}

		that.fetch(function(json) {
			if (json.length < 1 ) return false;

			for (var i = 0, l = json.length; i < l; i++) {
				that.unreadCache.push(json[i]);
			}

			if (that.container.find('.newPostAlert').length < 1) {
				var viewNewLink = $('<div class="alert alert-success newPostAlert text-center"><a href="#">' + json.length + ' new comments. Click to view.</a>');
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
			var comment = new Comment(json[i]);

			var ele = Comment.getView();

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
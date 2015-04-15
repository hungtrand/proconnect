function Feed(data, template) {
	/*data = {
		"Creator": '',
		"CreatorImage": '',
		"FeedLink": '',
		"ImageURL": '',
		"ContentMessage": ''
	}*/
	this.data = {'FeedID': 0};
	this.dataURL = "php/feed_controller.php";
	this.template = template ? template : $('#FeedTemplate').html();

	this.init(data);
}

Feed.prototype = {
	constructor: this,

	init: function(data) {
		var that = this;

		if(data) {
			that.data = data;
			that.makeView();
		}
	},

	makeView: function() {
		var that = this;
		var feed = $(that.template);

		var heading = that.data['Creator'] + ' shared: ';
		feed.find('.creatorImage').attr('src', that.data['CreatorImage']);
		feed.find('.contentHeading').text(heading);
		feed.find('.contentImageLink').attr('href', 'FeedLink');
		feed.find('.contentImage').attr('src', that.data['ImageURL']);
		feed.find('.contentMessage').html(that.data['ContentMessage']);

		that.container = feed;
	},

	setImageURL: function(strVal) {
		if (!strVal) return false;
		this.data['ImageURL'] = strVal;
	},

	setFeedLink: function(strVal) {
		if (!strVal) return false;
		this.data['FeedLink'] = strVal;
	},

	setContentMessage: function(strVal) {
		if (!strVal) return false;
		this.data['ContentMessage'] = strVal;
	},

	update: function(callback) {
		var that = this;
		var data = that.data;

		$.ajax({
			url: 'php/feed_controller.php',
			data: data,
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				callback(json);
			} catch (e) {
				callback(json);
			}
			
		}).fail(function(e) {
			console.log(e);
		});
	},

	getView: function() {
		return this.container;
	}
}
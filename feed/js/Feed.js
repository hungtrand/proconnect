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
	this.btnLike;
	this.btnComment;
	this.btnPropagate;

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

		var heading = 'Shared: ';
		feed.find('.FeedID').val(that.data['FeedID']);
		feed.find('.AuthorLink').text(that.data['Creator']).attr('href', that.data['FeedLink']);
		feed.find('.NewComment .CommentAuthor').text(that.data['CreatorFirstName']).attr('href', that.data['FeedLink']);
		feed.find('.creatorImage').attr('src', that.data['CreatorImage']);
		feed.find('.NewComment .CommentProfileImage').attr('src', that.data['CreatorImage']);
		feed.find('.contentHeading').text(heading);
		feed.find('.contentImageLink').attr('href', that.data['ImageURL'])
			.attr('data-title', that.data['ContentMessage']);
		feed.find('.contentImage').attr('src', that.data['ImageURL']);
		feed.find('.contentMessage').html(that.data['ContentMessage']);
		feed.find('.timestamp').html(that.data['Timestamp']);

		if (that.data['YouTubeID']) {
			var url = feed.find('.YouTubeFrame').attr('src');
			url = url.replace('{{YouTubeID}}', that.data['YouTubeID']);
			feed.find('.YouTubeFrame').attr('src', url);
		} else {
			feed.find('.YouTubeFrame').parent().remove();
		}

		if (that.data['Liked'] == 1) {
			feed.find('.feedLike').text('Liked').toggleClass('text-success')
				.removeAttr('href');
		}

		var numLikes = parseInt(that.data['nLiked']);
		if (numLikes > 0)
			feed.find('.numLikes').text('('+numLikes+')');

		// actions buttons
		that.btnLike = feed.find('.feedLike');
		that.btnComment = feed.find('.feedComment');
		that.btnPropagate = feed.find('.feedPropagate');

		that.container = feed;
		that.bindEvents();
	},

	bindEvents: function() {
		var that = this;

		that.container.find('.contentImageLink').on('click', function(e) {
			e.preventDefault();

			$(this).ekkoLightbox();
		});

		that.btnLike.on('click', function(e) {
			if (that.data['FeedID'] <= 0) return false;
			sendData = {'FeedID': that.data['FeedID'], 'Action':'Like'};
			that.submit(sendData, 'php/FeedActions_controller.php', function(json) {
				if (typeof json == 'string') return false;

				that.btnLike.text('Liked').toggleClass('text-success', true).unbind('click').removeAttr('href');
			});
		});
	},

	setImageURL: function(strVal) {
		if (!strVal) return false;
		this.data['ImageURL'] = strVal;
	},

	setYouTubeURL: function(strVal) {
		if (!strVal) return false;
		this.data['YouTubeURL'] = strVal;
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
		that.submit(data, 'php/feed_controller.php', callback);
	},

	submit: function(data, url, callback) {
		$.ajax({
			url: url,
			data: data,
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				
			} catch (e) {
				// console.log(json);
			}

			if (callback)
				callback(json);
			
		}).fail(function(e) {
			console.log(e);
		});
	},

	getView: function() {
		return this.container;
	}
}
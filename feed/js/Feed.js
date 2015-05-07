function Feed(data, template) {
	/*data = {
		"Creator": '',
		"CreatorImage": '',
		"FeedLink": '',
		"ImageURL": '',
		"ContentMessage": ''
	}*/
	this.data = {'FeedID': 0};
	this.dataURL = "/feed/php/feed_controller.php";
	this.template = template ? template : $('#FeedTemplate').html();
	this.btnLike;
	this.btnComment;
	this.btnPropagate;
	this.btnSubmitComment;
	this.txtNewComment;
	this.CommentSection;
	this.CommentList;
	this.jsCommentList;

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
		feed.find('.F2UID').val(that.data['F2UID']);
		feed.find('.AuthorProfileLink').attr('href', that.data['FeedLink']);
		feed.find('.AuthorLink').text(that.data['Creator']).attr('href', that.data['FeedLink']);
		feed.find('.NewComment .CommentAuthor').text(that.data['CreatorFirstName']).attr('href', that.data['FeedLink']);
		feed.find('.creatorImage').attr('src', that.data['CreatorImage']);
		//feed.find('.NewComment .CommentProfileImage').attr('src', that.data['CreatorImage']);
		feed.find('.contentHeading').text(heading);
		feed.find('.contentImageLink').attr('href', that.data['ImageURL'])
			.attr('data-title', that.data['ContentMessage']);
		if (that.data['ImageURL'])
			feed.find('.contentImage').attr('src', that.data['ImageURL']);
		else 
			feed.find('.contentImage').hide();
		feed.find('.contentMessage').html(that.data['ContentMessage']);
		feed.find('.InterestCategory').text(that.data['InterestCategory']);
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

		that.CommentSection = feed.find(".CommentSection");
		that.CommentList = feed.find('.comments-list');
		that.txtNewComment = feed.find(".txtNewComment");
		that.btnSubmitComment = feed.find('.submitComment');

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
			sendData = {'F2UID': that.data['F2UID'], 'Action':'Like'};
			that.submit(sendData, 'php/FeedActions_controller.php', function(json) {
				if (typeof json == 'string') return false;

				that.btnLike.text('Liked').toggleClass('text-success', true).unbind('click').removeAttr('href');
			});
		});

		that.btnComment.on('click', function(e) {
			e.preventDefault();
			that.CommentSection.slideDown('400', function() {
				that.txtNewComment.focus();
				if (!that.jsCommentList) {
					that.jsCommentList = new CommentList(that.CommentList, that.data['FeedID']); 
					that.jsCommentList.load();
				}
			});
		});

		that.txtNewComment.on('keyup', function() {
			if ($(this).val()) that.btnSubmitComment.removeAttr('disabled');
			else that.btnSubmitComment.attr('disabled', 'disabled');
		});

		that.btnSubmitComment.on('click', function(e) {
			e.preventDefault();
			var btn = $(this);
			btn.text('Submitting...').toggleClass('btn-default btn-info');
			var data = {
				'CommentID': 0,
				'FeedID': that.data['FeedID'],
				'CommentMessage': that.txtNewComment.val().trim()
			};

			var url = '/feed/php/comment_controller.php';
			that.submit(data, url, function(json) {
				// console.log(json);
				if (typeof json != 'string') {
					btn.text('Sent').toggleClass('btn-info btn-success').attr('disabled', 'disabled');
					that.txtNewComment.val('');
					that.jsCommentList.appendView([json]); // note json is encapsulated in an array here
					setTimeout(function() {
						btn.text('Comment').toggleClass('btn-default btn-success');
					}, 2000);
				}
			});
		});

		// if (that.container.hasClass('feed')) {
		// 	that.container.hover(function() {
		// 		$('.feed').not($(this)).css('opacity', 0.5);
		// 		$(this).toggleClass('hover', true);
		// 	}, function() {
		// 		$(this).toggleClass('hover', false);
		// 		$('.feed').css('opacity', 1);
		// 	});
		// }
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

	setInterestCategory: function(strVal) {
		if (!strVal) return false;
		this.data['InterestCategory'] = strVal;
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
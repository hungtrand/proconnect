function Comment(data, template) {
	/*data = {
		"Creator": '',
		"CreatorImage": '',
		"FeedLink": '',
		"ImageURL": '',
		"ContentMessage": ''
	}*/
	this.data = {'FeedID': 0};
	this.dataURL = "php/comment_controller.php";
	this.template = template ? template : $('#CommentTemplate').html();

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
		var comment = $(that.template);

		var heading = 'Shared: ';
		comment.find('.CommentID').val(that.data['CommentID']);
		comment.find('.CommentAuthor').text(that.data['Creator']).attr('href', that.data['CreatorProfileLink']);
		comment.find('.CommentProfileImage').attr('src', that.data['CreatorImage']);
		comment.find('.CommentMessage').html(that.data['CommentMessage']);
		comment.find('.CommentTimestamp').html(that.data['Timestamp']);

		that.container = comment;
		that.bindEvents();
	},

	bindEvents: function() {
		var that = this;

	},

	setCommentMessage: function(strVal) {
		if (!strVal) return false;
		this.data['ContentMessage'] = strVal;
	},

	update: function(callback) {
		var that = this;
		var data = that.data;
		that.submit(data, 'php/comment_controller.php', callback);
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
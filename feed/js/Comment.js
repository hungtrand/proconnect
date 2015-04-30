function Comment(data, template) {
	/*data = {
		"CommentID": '',
		"CommentAuthor": '',
		"CommentProfileImage": '',
		"CommentMessage": '',
		"CommentTimestamp": ''
	}*/
	this.data = {'CommentID': 0};
	this.dataURL = "php/comment_controller.php";
	this.template = template ? template : $('#CommentTemplate').html();

	this.init(data);
}

Comment.prototype = {
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
		comment.find('.CreatorName').text(that.data['CreatorFirstName']).attr('href', that.data['CreatorLink']);
		comment.find('.CreatorImage').attr('src', that.data['CreatorImage']);
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
		this.data['CommentMessage'] = strVal;
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
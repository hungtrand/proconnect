function NewPost() {
	this.mode = "inactive";
	this.container = $('#NewPost');
	this.formNewPost;
	this.inputContentMessage;
	this.inputFeedImage;
	this.btnSharePost;
	this.btnAttachImg;
	this.btnAttachLink;
	this.inputExternalLink;
	this.Alert;
	this.btnPostMode;

	this.waitingGif = $('<div class="text-center hidden waitingGif"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');
	this.callbacks = [];

	this.init();
}

NewPost.prototype = {
	constructor: this,

	init: function() {
		var that = this;

		that.formNewPost = that.container.find('#formNewPost');
		that.inputContentMessage = that.container.find('#ContentMessage');
		that.inputFeedImage = that.container.find('#FeedImage');
		that.btnPostMode = that.container.find('#btnPostMode');
		that.btnPostMode.on('click', function() {that.changeMode('active')});
		that.btnSharePost = that.container.find('#btnSharePost');
		that.btnAttachImg = that.container.find('#btnAttachImg');
		that.btnAttachLink = that.container.find('#btnAttachLink');
		that.inputExternalLink = that.container.find('#ExternalLink');
		that.Alert = that.container.find('#AlertNewPost');

		that.bindEvents();
	},

	bindEvents: function() {
		var that = this;

		that.btnAttachLink.on('click', function(e) {
			e.stopPropagation();
			that.inputExternalLink.parent().slideDown('slow');
			that.inputExternalLink.focus();
		});

		that.container.on('click', function(e) {
			e.stopPropagation();
		});

		$(document).on('click', function(e) {
			that.changeMode('inactive');
			that.inputExternalLink.parent().slideUp('slow');
		});

		that.btnSharePost.on('click', function(e) {
			e.preventDefault();
			that.saveNewPost();
		});
	},

	changeMode: function(newMode) {
		var that = this;
		if (newMode == that.mode) return;

		if (newMode) that.mode = newMode;
		else
			that.mode = that.mode == 'active' ? 'inactive' : 'active';

		if (that.mode == 'active') {
			that.formNewPost.show(600, 'linear', function() {
				that.formNewPost.find('textarea').focus();
			});
			that.btnPostMode.fadeOut(600);
		} else {
			that.formNewPost.hide(600, 'linear');
			that.btnPostMode.fadeIn(600);
		}
	},

	saveNewPost: function() {
		var that = this;
		var feed = new Feed();
		feed.setContentMessage(that.inputContentMessage.val());
		feed.setFeedLink(that.inputExternalLink.val());

		feed.update(function(json) { 
			try {
				that.Alert.attr('class', 'alert alert-success')
					.text('Successfully posted on your network').slideDown();
				that.reset();

				setTimeout(function() {
					that.Alert.attr('class', 'alert alert-info').fadeOut();
				}, 3000);
			} catch(e) {
				that.Alert.attr('class', 'alert alert-danger')
					.text(json).slideDown();
				console.log(json);
			} 

			that.executeCallback(json);
		});
	},

	executeCallback: function(data) {
		var that = this;

		for (var i = 0, l = that.callbacks.length; i < l; i++) {
			that.callbacks[i](data);
		}
	},

	reset: function() {
		this.inputExternalLink.val('');
		this.inputContentMessage.val('');
		this.inputFeedImage.val('');
	},

	onSubmit: function(callback) {
		var that = this;
		that.callbacks.push(callback);
	}
}
function NewPost() {
	this.mode = "inactive";
	this.container = $('#NewPost');
	this.formNewPost;
	this.inputContentMessage;
	this.inputFeedImage;
	this.processedImageURL;
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
		that.imagePreview = that.container.find('#ImagePreview');
		that.processImageURL = that.container.find('#ImageURL');
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

		that.btnAttachImg.on('click', function(e) {
			e.preventDefault();
			that.inputFeedImage.trigger('click');
		});

		that.inputFeedImage.on('change', function(evt) {
			var tgt = evt.target || window.event.srcElement, files = tgt.files;

			if (FileReader && files && files.length) {
		        var fr = new FileReader();
		        fr.onload = function () {
		            that.imagePreview.attr('src', fr.result).show();
		        }
		        fr.readAsDataURL(files[0]);
		    }
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
			that.container.find('blockquote').fadeOut(600);
		} else {
			that.formNewPost.hide(600, 'linear');
			that.btnPostMode.fadeIn(600);
			that.container.find('blockquote').fadeIn(600);
		}
	},

	saveNewPost: function() {
		var that = this;
		if (that.inputContentMessage.val().trim() == '') return false;
		var uploadedImageURL = '';
		if (that.inputFeedImage.val() != '') {
			if (that.uploadImage()) {
				uploadedImageURL = that.processedImageURL;
			}
		}
		var feed = new Feed();
		feed.setContentMessage(that.inputContentMessage.val());
		feed.setFeedLink(that.inputExternalLink.val());
		feed.setImageURL(uploadedImageURL);

		feed.update(function(json) { 
			try {
				that.showAlert('Successfully posted on your network', 'success');
				that.reset();
			} catch(e) {
				that.showAlert(json, 'danger');
				console.log(json);
			} 

			// execute all saved functions here
			that.executeCallback(json);
		});
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

		setTimeout(function() {
			that.Alert.attr('class', 'alert alert-info').fadeOut();
		}, 3000);
	},	

	uploadImage: function() {
		var that = this;
		that.showAlert(that.waitingGif);
		var success = false;
		fileUpload(that.formNewPost[0], '/feed/php/imageUpload.php', that.Alert.attr('id'), function() {

			if (that.Alert.find('#uploadedFile').length > 0) {
				var newUrl = that.Alert.find('#uploadedFile').val();
				that.ImageURL.val(newUrl);
				success = true;
				setTimeout(function() {
					that.Alert.find('.label-success').fadeOut('3000', function() {
						$(this).remove();
					});
				}, 5000);
			}
			
		});

		return success;
	},

	executeCallback: function(data) {
		var that = this;

		for (var i = 0, l = that.callbacks.length; i < l; i++) {
			that.callbacks[i]([data]);
		}
	},

	reset: function() {
		this.inputExternalLink.val('');
		this.inputContentMessage.val('');
		this.inputFeedImage.val('');
		this.imagePreview.attr('src', '');
		this.imagePreview.hide();
	},

	// take in any function to execute after a submission is made for a post
	onSubmit: function(callback) {
		var that = this;
		that.callbacks.push(callback);
	}
}
// NewPost - the object validate the new post form, upload image and submit form
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
		that.processedImageURL = that.container.find('#ImageURL');
		that.btnYouTube = that.container.find('#btnYouTube');
		that.YouTubeURL = that.container.find('#YouTubeURL');
		that.btnPostMode = that.container.find('#btnPostMode');
		that.btnPostMode.on('click', function() {that.changeMode('active')});
		that.btnSharePost = that.container.find('#btnSharePost');
		that.btnAttachImg = that.container.find('#btnAttachImg');
		that.btnAttachLink = that.container.find('#btnAttachLink');
		that.inputExternalLink = that.container.find('#ExternalLink');
		that.Alert = that.container.find('#AlertNewPost');

		that.btnYouTube.on('click', function(e) {
			e.preventDefault();
			that.YouTubeURL.parent().fadeIn('2500', function() {
				that.YouTubeURL.focus();
			});
		});

		// replace textbox with CKEditor
		CKEDITOR.replace("ContentMessage", {
			toolbarGroups: [
				//{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
				// { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
				//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
				//{ name: 'forms' },
				'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
				{ name: 'links' },
				//{ name: 'insert' },
				'/',
				 { name: 'styles' },
				// { name: 'colors' },
				// { name: 'tools', groups: ['mode'] },
				// { name: 'others' },
				//{ name: 'about' }
			]

			// NOTE: Remember to leave 'toolbar' property with the default value (null).
		});

		that.bindEvents();
	},

	bindEvents: function() {
		var that = this;

		that.container.on('click', function(e) {
			e.stopPropagation();
		});

		$(document).on('click', function(e) {
			that.changeMode('inactive');
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
		if (that.mode=='active' && CKEDITOR.instances.ContentMessage.getData().trim() != '') return;

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
		var contentMsg = CKEDITOR.instances.ContentMessage.getData().trim();
		if (contentMsg == '' && that.inputFeedImage.val() == '') return false;
		var uploadedImageURL = '';

		function saveFeed() {
			uploadedImageURL = that.processedImageURL.val();
			var feed = new Feed();
			feed.setContentMessage(contentMsg);
			feed.setFeedLink(that.inputExternalLink.val());
			feed.setImageURL(uploadedImageURL);
			feed.setYouTubeURL(that.YouTubeURL.val());

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
		}

		if (that.inputFeedImage.val() != '') {
			that.uploadImage(function(success) {
				if (success) {
					saveFeed();
				} else {
					showAlert('Could not upload your image. Image must be less than 10MB.', 'danger');
				}
			});
		} else {
			saveFeed();
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

		setTimeout(function() {
			that.Alert.attr('class', 'alert alert-info').fadeOut();
		}, 3000);
	},	

	uploadImage: function(callback) {
		var that = this;
		that.showAlert(that.waitingGif);
		var success = false;
		fileUpload(that.formNewPost[0], '/feed/php/imageUpload.php', that.Alert.attr('id'), function() {

			if (that.Alert.find('#uploadedFile').length > 0) {
				var newUrl = that.Alert.find('#uploadedFile').val();
				that.processedImageURL.val(newUrl);
				success = true;
				callback(success);
				setTimeout(function() {
					that.Alert.find('.label-success').fadeOut('3000', function() {
						$(this).remove();
					});
				}, 5000);
			}
			
		});
	},

	executeCallback: function(data) {
		var that = this;

		for (var i = 0, l = that.callbacks.length; i < l; i++) {
			that.callbacks[i]([data]);
		}
	},

	reset: function() {
		var that = this;
		that.inputExternalLink.val('');
		CKEDITOR.instances.ContentMessage.setData('');
		that.inputFeedImage.val('');
		that.imagePreview.attr('src', '');
		that.imagePreview.hide();
		that.formNewPost.get(0).reset();
	},

	// take in any function to execute after a submission is made for a post
	onSubmit: function(callback) {
		var that = this;
		that.callbacks.push(callback);
	}
}
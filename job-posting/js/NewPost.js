// NewPost - the object validate the new post form, upload image and submit form
function NewPost() {
	this.inputFeedImage;
	this.imagePreview;
	this.btnAttachImg;
	this.init();
}

NewPost.prototype = {
	constructor: this,

	init: function() {
		var that = this;
		that.inputFeedImage = $('#FeedImage');
		that.imagePreview = $('.ImagePreview');
		that.btnAttachImg = $('#btnAttachImg');

		// replace textbox with CKEditor
		CKEDITOR.replace('companyDesc', {
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
			]

			// NOTE: Remember to leave 'toolbar' property with the default value (null).
		});
		CKEDITOR.replace('jobDesc', {
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
			]

			// NOTE: Remember to leave 'toolbar' property with the default value (null).
		});CKEDITOR.replace('skillDesc', {
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
			]

			// NOTE: Remember to leave 'toolbar' property with the default value (null).
		});

		that.bindEvents();
	},

	bindEvents: function() {
		var that = this;

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
	}
}
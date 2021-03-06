function ProfileImageUploader(CurrentImageSrc) {
	this.modal;
	this.UploadForm;
	this.UploadActionURL;
	this.CurrentImage;
	this.NewImage;
	this.StatusDiv;
	this.onCloseHandlers = []; // array of handlers
	this.show = false;

	this.init(CurrentImageSrc);
}

ProfileImageUploader.prototype = {
	constructor: this,

	init: function(CurrentImageSrc) {
		var that = this;

		$.ajax({
			url: 'FileUpload.html',
			type: 'POST'
		}).done(function(modal) {
			that.modal = $(modal);
			that.modal.modal(); // initialize Bootstrap modal
			that.UploadForm = that.modal.find('.formUpload');
			that.UploadActionURL = that.UploadForm.attr('action');
			that.StatusDiv = that.modal.find('.uploadStatus');
			that.CurrentImage = that.modal.find('.CurrentImage');
			that.NewImage = that.modal.find('.NewImage');
			that.btnUpload = that.modal.find('#btnUpload');

			that.bindModalEventHandlers();
			if (that.show) that.modal.modal('show');
			if (CurrentImageSrc) that.CurrentImage.attr('src', CurrentImageSrc);
		});
	}, 

	getView: function() {
		var that = this;

		that.show = true;
		if (that.modal) that.modal.modal('show');
	},

	bindModalEventHandlers: function() {
		var that = this;

		// On file selection, show a preview of the image before the actual upload
		that.UploadForm.find('input[type="file"]').on('change', function(evt) {
			var tgt = evt.target || window.event.srcElement, files = tgt.files;

			if (FileReader && files && files.length) {
		        var fr = new FileReader();
		        fr.onload = function () {
		            that.NewImage.attr('src', fr.result);
		        }
		        fr.readAsDataURL(files[0]);
		    }

		    that.btnUpload.removeAttr('disabled').toggleClass('btn-default btn-success');;
			that.modal.find('#NewImageContainer label').toggleClass('label-default label-info');
		});

		// submit file on btnUpload click
		that.btnUpload.on("click", function(e) {
			e.preventDefault();

			that.upload();
		});

		// On modal close, update the profile image on the profile page with new image
		// Also execute all the callback functions that was saved
		that.modal.on('hidden.bs.modal', function() {
			var newImage = '';
			if (that.StatusDiv.find('#uploadedFile').length > 0) {
				newImage = that.StatusDiv.find('#uploadedFile').val();
			}

			// Execute callbacks
			for (var i=0, l=that.onCloseHandlers.length; i<l; i++) {
				that.onCloseHandlers[i](newImage);
			}

			that.modal.remove();
		});
	},

	// Attach/save callback functions into object property to execute later
	onClose: function(callback) {
		var that = this;

		that.onCloseHandlers.push(callback);
	},

	upload: function() { 
		var that = this;
		that.StatusDiv.find('#uploadedFile').remove();
		fileUpload(this.UploadForm[0], this.UploadActionURL, this.StatusDiv.attr('id'), function() {
			that.UploadForm.find('input[type="file"]').val('');
			that.btnUpload.attr('disabled', 'disabled').toggleClass('btn-default btn-success');
			that.NewImage.attr('src', '');

			if (that.StatusDiv.find('#uploadedFile').length > 0) {
				var newUrl = that.StatusDiv.find('#uploadedFile').val();
				that.CurrentImage.attr('src', newUrl);
				$('.SignedInUserProfileImage').attr('src', newUrl);
				that.modal.find('#NewImageContainer label').toggleClass('label-default label-info');
				setTimeout(function() {
					that.StatusDiv.find('.label-success').fadeOut('3000', function() {
						$(this).remove();
					});
				}, 5000);
			}
			
		});
	}
}


function ApplyModalFiller() {
	this.userID;
	this.userName;
	this.employmentStatus;
	this.employmentLocation;
	this.emailAddress;
	this.phoneNumber;
	this.container = $('#applyModal');
	this.applyBtn = $('#apply-btn');
	this.submitBtn;
	this.data;
	this.init();
}

ApplyModalFiller.prototype = {
	constructor: this,

	init: function() {
		var that = this;

		that.userID = that.container.find('#userID');
		that.userName = that.container.find('#modalUserName');
		that.employmentStatus = that.container.find('#modalUserStatus');
		that.employmentLocation = that.container.find('#modalCompany');
		that.emailAddress = that.container.find('#modalEmailAddress');
		that.phoneNumber = that.container.find('#modalPhoneNumber');
		that.applyBtn.click( function(ev) {
			ev.preventDefault();
			that.load();
		});
		that.submitBtn = that.container.find('#jobApplication');
		that.submitBtn.click( function(ev) {
			ev.preventDefault();
			that.createApplication( function(jsonData) {
				that.submit(jsonData);
			});
		});
	},

	fetch: function(callback) {
		var that = this;
		var data = that.data;

		$.ajax({
			url: 'php/JobAppData.php',
			type: 'POST',
			data: data,
			contentType: 'text/plain'
		}).done( function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.data = json;
				callback(json);				
			} catch (e) {
				$('#job-page-alert').text("Unforunately we were unable to search for your job content.");
			}
		}).fail (function() {
			$('#job-page-alert').text("Unforunately we were unable to search for your job content.");
		});
	},

	load: function() {
		var that = this;
		that.fetch(function(jsonData) {
			that.loadModal(jsonData);
		});
	},

	loadModal: function(callback) {
		var that = this;
		var data = that.data;
		$.each(data, function(key, value) {
			that.userID.attr('value', value.userID);
			that.userName.text(value.userName);
			if(value.userEmploymentStatus.length > 0) {
				that.employmentStatus.text('Employment: '+value.userEmploymentStatus);
			} else {
				that.employmentStatus.text('Employment: Unavailable');
			}
			if(value.userEmploymentLocation.length > 0) {
				that.employmentLocation.text('Location: '+value.userEmploymentLocation);				
			} else {
				that.employmentLocation.text('Location: Unavailable');
			}
			that.emailAddress.text(value.userEmailAddress);
		});
	},

	createApplication: function() {
		var that = this;
		var data = that.data;
		data['user'] = {
			'jobID': $('#jobID').attr('value'),
			'userID': that.userID.attr('value'),
			'userName': that.userName.text(),
			'userEmploymentStatus': that.employmentStatus.text(),
			'userEmploymentLocation' : that.employmentLocation.text(),
			'userEmailAddress': that.emailAddress.text(),
			'userPhoneNumber': that.phoneNumber.val()
		};
		that.data = data;
	},

	submit: function(callback) {
		var that = this;
		var data = that.data;

		$.ajax({
			url: 'php/JobSubmissionData.php',
			type: 'POST',
			data: data,
			contentType: 'text/plain'
		}).done( function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.data = json;
				callback(json);
			} catch (e) {
				console.log('unable to load');
			}
		}).fail (function() {
			console.log('unable to load');
		});
	}
}
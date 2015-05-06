function JobGrid() {
	this.jobID;
	this.jobTitle;
	this.jobLocation;
	this.contactInfo;
	this.companyImg;
	this.jobDescription;
	this.skillDescription;
	this.companyDescription;
	this.employmentType;
	this.experience;
	this.jobFunctions;
	this.industries;
	this.container;
	this.pageCounter;
	this.loadMoreBtn;
	this.wrapper;
	this.template;
	this.data;
	this.setLoadBtn();
	this.init();
}

JobGrid.prototype = {
	constructor: this,

	init: function() {
		var that = this;
		that.wrapper = $('#job-grid');
		that.template = $('#job-container').html();
		that.container = $(that.template);
		that.pageCounter = parseInt($('#page-counter').val());
		that.jobID = that.container.find('.jobID');
		that.jobTitle = that.container.find('.jobTitle');
		that.jobLocation = that.container.find('.jobLocation');
		that.contactInfo = that.container.find('.contactInfo');
		that.companyImg = that.container.find('.companyImg');
		that.jobDescription = that.container.find('.jobDescription');
		that.skillDescription = that.container.find('.skillDescription');
		that.companyDescription = that.container.find('.companyDescription');
		that.employmentType = that.container.find('.mploymentType');
		that.experience = that.container.find('.experience');
		that.jobFunctions = that.container.find('.jobFunctions');
		that.industries = that.container.find('.industry');
	},

	load: function() {
		var that = this;
		
		that.fetch(function(jsonData) {
			that.createJob(jsonData);
		});
	},

	fetch: function(callback) {
		var that = this;
		var data = {'page': that.pageCounter++};
		$('#page-counter').val(that.pageCounter);

		$.ajax({
			url: 'php/JobList_controller.php',
			type: 'POST',
			data: data
		}).done( function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.data = json;
				callback(json);
			} catch(e) {
				$('#job-page-alert').text("There are currently no jobs available.");
			}
		}).fail (function() {
			$('#job-page-alert').text("Unforunately we were unable to load content");
		});
	},

	createJob: function(callback) {
		var that = this;
		var data = that.data;

		$.each(data, function(key, value) {
			that.jobID.val(value.jobID);
			that.companyImg.attr('src', value.companyImg);
			
			that.jobTitle.text(value.jobTitle);
			that.jobLocation.text(value.jobLocation);
			that.contactInfo.val(value.contactInfo);
			that.jobDescription.val(value.jobDescription);
			that.skillDescription.val(value.skillDescription);
			that.companyDescription.val(value.companyDescription);
			that.employmentType.val(value.employmentType);
			that.experience.val(value.experience);
			that.jobFunctions.val(value.jobFunctions);
			that.industries.val(value.industries);
			that.wrapper.append(that.container);
			that.init();
		});
		var modalFiller = new ModalFiller();
	},

	setLoadBtn: function() {
		var that = this;
		that.loadMoreBtn = $('#job-display-footer1');
		that.loadMoreBtn.click( function(ev) {
			ev.preventDefault();
			$('#loading-div').slideDown('1000', function() {
				$(this).show();
				scrollTop: $(this).offset().top
			});
			setTimeout( function() {
				$('#loading-div').slideUp('1000', function() {
					$(this).hide();
					that.pageCounter++;
					$('#page-counter').attr('value', that.pageCounter);
					that.loadMore();
				});
			}, 2000);
		});
	},

	loadMore: function() {
		var that = this;
		that.fetch(function(jsonData) {
			that.loadMoreBtn = '';
			that.createJob(jsonData);
		});
	}
}
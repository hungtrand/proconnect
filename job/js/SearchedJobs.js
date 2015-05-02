function SearchedJobs () {
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
	this.searchBtn;
	this.jobSearchedTitle;
	this.jobSearchedLocation;
	this.jobSearchedCountry;
	this.jobSearchedIndustry;
	this.jobSearchedJobFunc;
	this.jobSearchedSalary;
	this.dataSearched;
	this.dataConstructed;
	this.setLoadBtn();
	this.setSearch();
	this.init();
}

SearchedJobs.prototype = {
	constructor: this,

	init: function() {
		var that = this;
		that.wrapper = $('#job-grid');
		that.template = $('#job-container').html();
		that.container = $(that.template);
		that.pageCounter = $('#page-counter').val();
		that.jobID = that.container.find('.jobID');
		that.jobTitle = that.container.find('.jobTitle');
		that.jobLocation = that.container.find('.jobLocation');
		that.contactInfo = that.container.find('.contactInfo');
		that.companyImg = that.container.find('.companyImg');
		that.jobDescription = that.container.find('.jobDescription');
		that.skillDescription = that.container.find('.skillDescription');
		that.companyDescription = that.container.find('.companyDescription');
		that.employmentType = that.container.find('.employmentType');
		that.experience = that.container.find('.experience');
		that.jobFunctions = that.container.find('.jobFunctions');
		that.industries = that.container.find('.industry');
	},

	load: function() {
		var that = this;
			setTimeout( function() {
				$('#loading-div').fadeOut('1000', function() {
					that.wrapper.slideDown('slow');
				});
			}, 1000);

		that.fetch( function(jsonData) {
			that.createJob(jsonData);
		});
	},

	setSearch: function() {
		var that = this;
		var data = {};
		that.searchBtn = $('#btn-search-1');

		that.searchBtn.on('click', function(ev) {
			ev.preventDefault();
			$('#load-more1').hide();
			$('#load-more2').show();
			that.wrapper.slideUp('slow');
			$('#page-counter').attr('value', "1");
			that.jobSearchedTitle = $('#search-job-title').val();
			that.jobSearchedLocation = $('#search-jobSearchedLocation').val();
			that.jobSearchedCountry =  {
				'jobSearchedCountryID': $('#jobSearchedCountry-dropbox option:selected').val(),
				'jobSearchedCountryValue': $('#jobSearchedCountry-dropbox option:selected').text()
			};
			var jsonjobSearchedIndustry = {};
			$('input[name="jobSearchedIndustry"]:checked').each( function() {
				var jobSearchedIndustry = {
					jobSearchedIndustryID: this.value,
					jobSearchedIndustryValue: this.id
				};
				jsonjobSearchedIndustry['jobSearchedIndustry'+this.value] = jobSearchedIndustry;
			});
			var jsonjobSearchedJobFunc = {};
			$('input[name="jobSearchedJobFunc"]:checked').each( function() {
				var jobSearchedJobFunc = {
					jobSearchedJobFuncID: this.value,
					jobSearchedJobFuncValue: this.id
				};
				jsonjobSearchedJobFunc['jobSearchedJobFunc'+this.value] = jobSearchedJobFunc;
			});
			var jsonjobSearchedSalary = {};
			$('input[name="jobSearchedSalary"]:checked').each( function() {
				var jobSearchedSalary = {
					jobSearchedSalaryID: this.value,
					jobSearchedSalaryValue: this.id
				};
				jsonjobSearchedSalary['jobSearchedSalary'+this.value] = jobSearchedSalary;
			});
			data = {
				'jobSearchedTitle': that.jobSearchedTitle,
				'jobjobSearchedLocation': that.jobSearchedLocation,
				'jobjobSearchedCountry': that.jobSearchedCountry,
				'jobjobSearchedIndustry': jsonjobSearchedIndustry,
				'jobjobSearchedJobFunc': jsonjobSearchedJobFunc,
				'jobjobSearchedSalary': jsonjobSearchedSalary,
				'jobPageNumber': that.pageCounter
			}

			that.dataSearched = data;
			$('#loading-div').fadeIn('1000', function() {
				$(this).show();
			});
			setTimeout( function() {
				$('#loading-div').fadeOut('5000', function() {
					that.wrapper.empty();
					that.load();
				});
			}, 2000);
		});
	},

	fetch: function(callback) {
		var that = this;
		that.dataSearched['jobPageNumber'] = that.pageCounter;
		console.log(that.dataSearched.jobPageNumber);
		var data = that.dataSearched;

		$.ajax({
			url: 'php/DataForSearchingJobs.php',
			type: 'POST',
			data: data,
			contentType: 'text/plain'
		}).done( function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.dataConstructed = json;
				callback(json);
			} catch(e) {
				$('#job-page-alert').text("Unforunately we were unable to search for your job content.");
			}
		}).fail (function() {
			$('#job-page-alert').text("Unforunately we were unable to search for your job content.");
		});
	},

	createJob: function(callback) {
		var that = this;
		var data = that.dataConstructed;

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
		that.loadMoreBtn = $('#job-display-footer2');

		that.loadMoreBtn.click( function(ev) {
			ev.preventDefault();
			
			$('#loading-div').fadeIn('1000', function() {
				$(this).show();
			});
			setTimeout( function() {
				$('#loading-div').fadeOut('1000', function() {
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
			that.createJob(jsonData);
		});
	}
}
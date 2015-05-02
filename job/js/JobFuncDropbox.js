function JobFuncDropbox() {
	this.jobFunc;
	this.jobFuncData;
	this.init();
}

JobFuncDropbox.prototype = {
	
	constructor: this,

	init: function() {
		var that = this;

		that.jobFunc = $('#adv-function-div');
	},

	load: function() {
		var that = this;

		that.fetchJobFunc(function(jsonData) {
			that.loadJobFunc(jsonData);
		});
	},

	fetchJobFunc: function(callback) {
		var that = this;
		var jobFuncData = that.jobFuncData;

		$.ajax({
			url: 'php/JobFuncData.php',
			type: 'POST',
			data: jobFuncData,
			contentType: 'text/plain'
		}).done( function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.jobFuncData = json;
				callback(json);
			} catch (e) {
				$('#job-page-alert').text("Unforunately we were unable to load some data.");
			}
		}).fail (function() {
			$('#job-page-alert').text("Unforunately we were unable to load some data.");
		})
	},

	loadJobFunc: function(callback) {
		var that = this;
		var jobFuncData = that.jobFuncData;
		$.each(jobFuncData, function(key, value) {
			that.jobFunc.append('<input type="checkbox" name="jobFunc" value="'+value.jobFuncID+'" id="'+value.jobFuncValue+'"">'+value.jobFuncValue+'<br />');
		});
	}
}
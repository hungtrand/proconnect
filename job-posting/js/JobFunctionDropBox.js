//script to fill the job function dropbox
function JobFunctionDropBox() {
	this.dropbox = $('.jobFunc-dropbox');
	this.data;
	this.init();
}

JobFunctionDropBox.prototype = {
	constructor: this,

	init: function() {
		var that = this;

		var counterJobFunc = 0;
		$('#jobFunc-btn-zero').click( function(ev) {
			ev.preventDefault();
			counterJobFunc++;
			if(counterJobFunc === 1) {
				$('#jobFunc-one').show();
			}
			if(counterJobFunc === 2) {
				$('#jobFunc-two').show();	
			}
		}),

		$('#jobFunc-btn-one').click( function(ev) {
			ev.preventDefault();
			counterJobFunc--;
			$('#jobFunc-one').hide();
			$('#jobFunc-one select').prop('selectedIndex', 0);
		}),

		$('#jobFunc-btn-two').click( function(ev) {
			ev.preventDefault();
			counterJobFunc--;
			$('#jobFunc-two').hide();
			$('#jobFunc-two select').prop('selectedIndex', 0);
		})
	},

	fetch: function(callback) {
		var that = this;
		var data = that.data;

		$.ajax({
			url: '/lib/php/Lookup_JobFunctions_controller.php',
			type: 'POST',
			data: data,
			contentType: 'text/plain'
		}).done( function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.data = json;
				callback(json);
			} catch(ev) {
				console.log('unable to load');
			}
		}).fail (function() {
			console.log('unable to load');
		})
	},

	load: function() {
		var that = this;
		that.fetch (function(jsonData) {
			that.createIndustry(jsonData);
		});
	},

	createIndustry: function(data) {
		var that = this;
		$.each(data, function (i, value) {
			that.dropbox.append('<option value='+value['JOBFUNCTION']+'>'+value['JOBFUNCTION']+'</option>');
		})
	}
}
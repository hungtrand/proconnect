//script to fill in the industry drop box
function IndustryDropBox() {
	this.dropbox = $('.industry-dropbox');
	this.data;
	this.init();
}

IndustryDropBox.prototype = {
	constructor: this,

	init: function() {
		var that = this;

		var counterIndustry = 0;
		$('#industry-btn-zero').click( function(ev) {
			ev.preventDefault();
			counterIndustry++;
			if(counterIndustry === 1) {
				$('#industry-additional-one').show();
			}
			if(counterIndustry === 2) {
				$('#industry-additional-two').show();	
			}
		}),

		$('#industry-btn-one').click( function(ev) {
			ev.preventDefault();
			counterIndustry--;
			$('#industry-additional-one').hide();
			$('#industry-additional-one select').prop('selectedIndex', 0);
		}),

		$('#industry-btn-two').click( function(ev) {
			ev.preventDefault();
			counterIndustry--;
			$('#industry-additional-two').hide();
			$('#industry-additional-two select').prop('selectedIndex', 0);
		})
	},

	fetch: function(callback) {
		var that = this;
		var data = that.data;

		$.ajax({
			url: 'php/dummy.php',
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
		$.each(data, function (key, value) {
			that.dropbox.append('<option value='+value.industryID+'>'+value.industryValue+'</option>');
		})
	}
}
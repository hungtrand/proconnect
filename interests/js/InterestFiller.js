function InterestFiller() {
	this.container = $('#interest-wrapper');
	this.template = $('#interest-div').html();
	this.colorArr = [
		'#D8CEF6',
		'#F6CECE',
		'#F6E3CE',
		'#CEF6CE',
		'#A9E2F3',
		'#CECEF6',
		'#ECCEF5',
		'#F6CEF5',
		'#F6CED8',
		'#F5F6CE',
		'#A9F5A9'];
	this.temp;
	this.interestN;
	this.div;
	this.edit;
	this.interestID;
	this.interestName;
	this.data;
	this.divData =[];
	this.init();
	this.repositoryElement;
}

InterestFiller.prototype = {
	constructor: this,

	init: function() {
		var that = this;
		that.temp = $(that.template);
		that.interestID = that.temp.find('.interestID');
		that.interestName = that.temp.find('.interestName');
		that.interestN = that.temp.find('.interestN');
		// that.txtFeedCategory = $('.searchedInterest');
		that.div = that.temp.find('.div-btn');
		that.edit = that.temp.find('.hash-edit');
		// that.bindEvents();
	},

	setInputReader: function() {
		var that = this;
		var data = that.divData;
		$('.searchedInterest').on('keyup', function(ev) {
			var searchedItem = $('.searchedInterest').val().toLowerCase();
			var searchedItemLength = $('.searchedInterest').val().length;

			if (searchedItem.length % 2 == 0 && searchedItem.length < 4) return false;
			$.each(data, function(index, value) {
				var repositoryItem = $(value).find('.interestName').attr('value').toLowerCase();
				var repositoryID = '#'+$(value).find('.interestID').attr('value');
				that.repositoryElement = $(repositoryID);
				var reg = new RegExp(searchedItem, 'g');
				var arr = repositoryItem.match(reg);
				console.log(arr);
				if (arr) {
					$(repositoryID).closest('.col').show();
				} else {
					$(repositoryID).closest('.col').hide();
				};

				// for(i = 0; i < searchedItemLength+1; i++) {
				// 	if(searchedItem === repositoryItem.substring(0, i)) {
				// 		$(repositoryID).show();
				// 	}
				// 	else {
				// 		$(repositoryID).hide();
				// 	}
				// }
				// $('#'+$(value).find('.interestID').attr('value')).hide();
			});
		});
	},

	// bindEvents: function() {
	// 	var that = this;

	// 	// bind typeahead for interests
	// 	var interests = new Bloodhound({
	// 		datumTokenizer: Bloodhound.tokenizers.whitespace,
	// 		queryTokenizer: Bloodhound.tokenizers.whitespace,
	// 		prefetch: '/lib/php/Lookup_Interests_controller.php'
	// 	});

	// 	function interestsWithDefaults(q, sync) {
	// 		if (q === '') {
	// 			sync(interests.get('General','Aerospace Engineering', 'Arts', 
	// 				'Biology', 'Biochemical Engineering', 'Chemical Engineering', 
	// 				'Computer Engineering',	'Computer Programming', 'Fashion Design',
	// 				'Health Science', 'Literature', 'Music'));
	// 		}

	// 		else {
	// 			interests.search(q, sync);
	// 		}
	// 	}

	// 	that.txtFeedCategory.typeahead({
	// 		minLength: 0,
	// 		highlight: true
	// 	}, {
	// 		name: 'Interests',
	// 		source: interestsWithDefaults,
	// 		limit: 10
	// 	});
	// 	// end of typeahead
	// },

	load: function(callback) {
		var that = this;
		that.fetch( function(jsonData) {
			that.create(callback);
		});
	},

	fetch: function(callback) {
		var that = this;
		var data = that.data;

		$.ajax({
			url: '../lib/php/Lookup_Interests_controller.php',
			type: 'POST',
			data: data,
			contentType: 'text/plain'
		}).done (function(json) {
			try {
				json = $.parseJSON(json.trim());
				that.data = json;
				//console.log(that.data);
				callback(json);
			} catch (ev) {
				console.log('stuff');
			}
		}).fail (function() {
			console.log('stuff');
		});
	},

	create: function(callback) {
		var that = this;
		var data = that.data;
		$.each(data, function(key, value) {
			that.interestID.attr('value', value.INTERESTID);
			that.interestName.attr('value', value.INTEREST);
			that.div.attr('id', value.INTERESTID);
			that.interestN.text(value.INTEREST);
			that.coloring(Math.ceil(Math.random()*10));
			that.divData.push(that.temp);
			that.div.on('click', function(ev) {
				ev.preventDefault();
				window.location.hash = value.INTERESTID;
				$('#interest-container').animate({opacity: 0}, 600);
				callback(data);
			});
			that.init();
		});
			//console.log(that.divData);
			that.setInputReader();
			that.container.append(that.divData);
	},

	coloring: function(number) {
		var that = this;
		var c = that.colorArr;
		that.div.css('background-color', c[number]);
	},
}
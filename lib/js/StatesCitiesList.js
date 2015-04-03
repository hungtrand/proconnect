// practice model view controller, do not follow, just testing out
function StatesCitiesList() {
	this.container = $('<div class="StatesCitiesList">');
	this.StatesSelect = $('<select class="StatesList">');
	this.CitiesSelect = $('<select class="CitiesList">');
	this.states_json;
	this.cities_json;
	this.states_model_changed = false;
	this.cities_model_changed = false;
	this.selectedState;

	this.data;

	this.init();
}

StatesCitiesList.prototype = {
	constructor: this,

	init: function() {
		this.states_model();
		//this.cities_model();
		this.view_controller();
		this.container.append(this.StatesSelect);
		this.container.append(this.CitiesSelect);
	},

	states_model: function() {
		var that = this;

		// request controller  to go fetch states
		statesURL = '/share/Lookup_States_controller.php';
		that.data_controller(statesURL, {}, function(newData) {
			that.states_model_changed = true;
			that.states_json = newData;
		});	
	},

	cities_model: function(callback) {
		var that = this;
		//request controller to go fetch
		citiesURL = '/share/Lookup_Cities_controller.php';
		params = { "StateCode": that.selectedState };
		that.data_controller(citiesURL, params, function(newData) {
			that.cities_model_changed = true;
			that.cities_json = newData;
			if (callback) callback(newData);
		});
	},

	states_view: function() {
		if (!this.states_model_changed) return;

		var that = this;
		that.StatesSelect.html('');

		that.StatesSelect.append('<option selected>Select One</option>');
		for (var i =0, l=that.states_json.length; i < l; i++) {
			var st = that.states_json[i];
			var one = $("<option>").attr('value', st['STATE_CODE']);
			one.text(st['STATE']);

			that.StatesSelect.append(one);
		}

		that.states_model_changed = false;
	},

	cities_view: function() {
		if (!this.cities_model_changed) return;

		var that = this;
		that.CitiesSelect.html('');

		that.CitiesSelect.append('<option selected>Select One</option>');
		for (var i =0, l=that.cities_json.length; i < l; i++) {
			var st = that.cities_json[i];
			var one = $("<option>").attr('value', st['CITY']);
			one.text(st['CITY']);

			that.CitiesSelect.append(one);
		}

		that.cities_model_changed = false;
	},

	//shared between states and cities
	data_controller: function(url, params, callback) {
		var that = this;
		data = {};
		if (params) {
			data = params;
		}

		$.ajax({
			url: url,
			data: data,
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				//console.log(json);
				
			} catch (e) {
				console.log(json);
			}

			callback(json);

			that.states_view(); // notify view
			that.cities_view();
		}).fail(function() {
			console.log('server or network error');
		});
	},

	view_controller: function() {
		var that = this;

		that.StatesSelect.on('change', function() {
			//request controller to go fetch
			that.getCities();
		});
	},

	getView: function() {
		var that = this;

		return that.container;
	},

	getStates: function() {
		return this.states_json;
	},

	getCities: function(statecode, callback) {
		var that = this;
		if (!statecode) statecode = that.StatesSelect.val();

		that.selectedState = statecode;

		if (callback)
			that.cities_model(callback);
		else 
			that.cities_model();
	}

}
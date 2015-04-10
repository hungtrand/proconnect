function NewConnectionSearch(container) {
	this.container = container;
	this.Alert;
	this.ConnTemplate;
	this.waitingGif = $('<div class="text-center hidden"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');
	this.callbacks = [];

	this.init();
}

NewConnectionSearch.prototype = {
	constructor: this,

	init: function() {
		var that = this;
		that.Alert = that.container.find('#NewConnectionSearchAlert');
		that.ConnTemplate = $('#SuggestionTemplate').html();
		var form = that.container.find('#NewConnectionSearchForm');

		that.container.on('hide.bs.modal', function() {
			for (var i=0; i < that.callbacks.length; i++) {
				that.callbacks[i]();
			}
		});

		that.container.on('shown.bs.modal', function() {
			that.reset();
		});

		form.append(that.waitingGif);

		form.on('submit', function(e) {
			e.preventDefault();
			that.container.find('.searchResults').html('');
			that.waitingGif.toggleClass('hidden', false);
			that.Alert.html('').toggleClass('hidden', true);
			that.search(function(data) {
				that.appendView(data);
			});
		});

		that.container.find('.submit').on('click', function(e) {
			e.preventDefault();

			form.submit();
		});

		that.container.find('.keywords').on('keydown', function(e) {
			if (!that.Alert.hasClass('hidden'))
				that.Alert.toggleClass('hidden', true);
		});
	},

	search: function(callback) {
		var that = this;
		var form = that.container.find('#NewConnectionSearchForm');

		var data = {
			"keywords": form.find('.keywords').val(),
			"page": 1
		};

		$.ajax({
			url: form.attr('action'),
			data: data,
			type: 'POST'
		}).done(function(json) {
			that.waitingGif.toggleClass('hidden', true);
			try {
				json = $.parseJSON(json);
				callback(json);
			} catch (e) {
				that.Alert.html(json);
				that.Alert.toggleClass('hidden', false);
				return false;
			}
		}).fail(function() {
			that.Alert.toggleClass('alert-danger', true).toggleClass('alert-warning');
			that.Alert.toggleClass('hidden', false);
			that.Alert.html(json);
		});
	},

	appendView: function(json) {
		var that = this;
		var resultsContainer = that.container.find('.searchResults');

		for (var i = 0, l=json.length; i < l; i++) {
			var conn = new NewConnection(json[i]);
			resultsContainer.append(conn.getView());
		}
	},

	onClose: function(callback) {
		var that = this;
		that.callbacks.push(function() { callback() });
	},

	reset: function() {
		var that = this;
		that.container.find('.keywords').focus().val('');
		that.container.find('.searchResults').html('');
		that.Alert.toggleClass('hidden', true);
	}
}
function StatesList(container, tag) {
	this.container = container;
	this.data;

	this.init(tag);
}

StatesList.prototype = {
	this.constructor = this,

	init: function(tag) {
		if (!tag) tag = "option";
		this.load();
	},

	load: function() {
		var that = this;

		$.ajax({
			url: '/share/Lookup_States_controller.php',
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				that.data = json;
			} catch (e) {
				console.log(json);
			}
		}).fail(function() {
			console.log('server or network error');
			this.container.html('Failed to load.');
		});
	},

	getView: function() {
		var that = this;
		var vw;
		for (var i =0, l=that.data.length; i < l, i++) {
			var st = that.data[i];
			var one = $(that.tag).attr('value', st['STATE_CODE']);
			one.text(st['STATE']);

			vw.push(one);
		}

		return vw;
	}
}
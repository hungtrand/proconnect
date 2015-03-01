function home() {
	this.hash;

	this.init();
}

home.prototype = {
	constructor: home,

	init: function() {
		this.hash = window.location.hash;
		this.onLoad();
	},

	onLoad: function() {
		$.ajax(url: 'lib/templates/waiting_affix.html')
		.done(function(waitingGif) { $(body).prepend(waitingGif)});
	},

	onFailedVerification: function() {

	},

	waiting: function() {

	}
}
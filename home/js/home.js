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

	},

	onFailedVerification: function() {

	},

	waiting: function() {

	}
}
function MessageFrame(container) {
	this.data = [];

	this.container = container;
	this.page = 0;
	this.Alert;
	this.waitingGif = $('<div class="text-center hidden waitingGif"><img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/></div>');

	this.init();
}

MessageFrame.prototype = {
	alert("FSDJS");
}
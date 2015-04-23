function NotificationHandler(jQueryRoot) {
	this.root = jQueryRoot;
}

NotificationHandler.prototype = {
	init: function() {
		var that = this;
		this.root.hover(function(){
			that.root.attr("aria-expanded","true");
			that.root.addClass("open");
		},function(){
			// $(this).attr("aria-expanded","false");
			// $(this).removeClass("open");
		});
	}
}
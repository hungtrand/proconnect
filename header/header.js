$(document).ready(function() {

$("#message").hover(function(){
	$("#message-menu").attr("aria-expanded","true");
	$("#message").addClass("open");
},function(){
	$("#message-menu").attr("aria-expanded","false");
	$("#message").removeClass("open");
}
);
$("#notification").hover(function(){
	$("#notification-menu").attr("aria-expanded","true");
	$("#notification").addClass("open");
},function(){
	$("#notification-menu").attr("aria-expanded","false");
	$("#notification").removeClass("open");
}
);
$("#connection").hover(function(){
	$("#connection-menu").attr("aria-expanded","true");
	$("#connection").addClass("open");
},function(){
	$("#connection-menu").attr("aria-expanded","false");
	$("#connection").removeClass("open");
}
);

});

$(document).ready(function() {
	var list = $("#message-form a");
		$(list.click(function() {
			$("#message-div").empty();
			var value = $(this).attr("value");
			var inbox = $("#update-message-frame").html();
			var edit = $(inbox);
			edit.find(".message-frame-name").text(value);
			$("#message-div").append(edit);
		}));
});
$(document).ready(function() {

		if(window.innerWidth < 862) {
			var tempSmall = $("#sidebar-small-temp").html();
			console.log(tempSmall);
			$("#nav-container").append(tempSmall);
		}
		else {
			console.log("Hello");
			var tempLarge = $("#sidebar-large-temp").html();
			$("#nav-container").append(tempLarge);
		}

	$(window).resize(function() {
		$("#nav-container").empty();
		if(window.innerWidth < 862) {
			var tempSmall = $("#sidebar-small-temp").html();
			console.log(tempSmall);
			$("#nav-container").append(tempSmall);
		}
		else {
			console.log("Hello");
			var tempLarge = $("#sidebar-large-temp").html();
			$("#nav-container").append(tempLarge);
		}
	});

	var initbox = $("#main-inbox");

	var newMsgForm = $("#main-new");
	$(newMsgForm.click(function() {
		$("#message-div").empty();
		var value = $(this).attr("value");
		var inbox = $("#update-message-frame").html();
		var textbox = $("#message-textfield").html();
		var edit = $(inbox);
		edit.find(".message-frame-name").text(value);
		edit.find(".message-frame-display").append(textbox);
		$("#message-div").append(edit);
	}));

	var list = $("#message-form a");
	$(list.click(function() {
		var form = "#"+$(this).attr("id");
		console.log(form);
		$("#message-div").empty();
		var value = $(this).attr("value");
		var inbox = $("#update-message-frame").html();
		var edit = $(inbox);
		edit.find(".message-frame-name").text(value);
		$("#message-div").append(edit);
		switch(form) {
			case "#main-inbox":
				var messages = new LoadInbox($('.message-frame-display'));
			break;
			case "#main-outbox":
				var messages = new LoadOutbox($('.message-frame-display'));
			break;
			case "#main-archive":
				var messages = new LoadArchive($('.message-frame-display'));
			break;
			case "#main-trash":
				var messages = new LoadTrash($('.message-frame-display'));
			break;
			default:
			break;
		}
	}));
	var suggList = new SuggestionList($('#SuggListing'));
	suggList.load();

	initbox.click();
});
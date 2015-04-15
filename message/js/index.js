var index = 0;
$(document).ready(function() {
	var tempSmall = $("#sidebar-small-temp").html();
	var tempLarge = $("#sidebar-large-temp").html();

	if(window.innerWidth < 862) {
		$("#nav-container").append(tempSmall);
		animater(120);
	}
	else {
		$("#nav-container").append(tempLarge);
	}

	$(window).resize(function() {
		$("#nav-container").empty();
		if(window.innerWidth < 862) {
			$("#nav-container").append(tempSmall);
		}
		else {
			$("#nav-container").append(tempLarge);
		}
	});
	var searchTypeahead = new typeahead();

	/*Initial start up witll load inbox*/
	globalPageNumber = 1;
	globalVal = "Inbox";
	$("#message-div").empty();
	var initbox = $("#main-inbox");
	var iniInbox = $("#update-message-frame").html();
	var iniEdit = $(iniInbox);
	iniEdit.find(".message-frame-name").text(globalVal);
	$("#message-div").append(iniEdit);
	var iniMessages = new LoadMessages($('.message-frame-display'), globalVal, globalPageNumber);

	/*If the client clicks on new message, this clear and update the message-div with a textbox application*/
	var newMsgForm = $("#main-new");
	newMsgForm.click(function() {
		$("#message-div").empty();
		var value = $(this).attr("value");
		var textbox = $("#message-textfield").html();
		var edit = $(iniInbox);
		edit.find(".message-frame-name").text(value);
		edit.find(".message-frame-display").append(textbox);
		$("#message-div").append(edit);
		if(window.innerWidth < 862) {
			animater(0);
		}
    	var userTypeahead = new typeahead();
   		var sendMessage = new NewMessage(textbox);
	});

	/*If the client clicks on a sidebar content, then it will clear and load content to the message div accordingly*/
	var list = $("#message-form a");
	list.click(function() {
		var form = "#"+$(this).attr("id");
		$("#message-div").empty();
		var value = $(this).attr("value");
		if(globalVal===value) {
			globalPageNumber=1;
			globalVal=value;
		}
		var edit = $(iniInbox);
		edit.find(".message-frame-name").text(value);
		$("#message-div").append(edit);
		var messages = new LoadMessages($('.message-frame-display'), value, 1);
		animater(272);
	});
	
	$("#search-button").click(function() {
		var searchField = $("#search-subject");
		searchField.val("");
	})

	function animater(number) {
		$('html,body').animate({
        	scrollTop: $("#message-div").offset().top - number
    	});
	};

	var suggList = new SuggestionList($('#SuggListing'));
	suggList.load();
});
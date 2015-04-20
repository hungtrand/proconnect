/**
 * Factory method for making media items
*/
var MediaItemFactory = (function(){
	return {
		makeItem: function(specialID,options) {

			var itemClass = null;

			if(specialID === 'message-menu') {
				// console.log(specialID);
				itemClass = MessageItem;
			} else if(specialID === 'notification-menu'){
				itemClass = NotificationItem;
				// console.log(specialID);
			} else if (specialID === 'connection-menu') {
				// console.log(specialID);
				itemClass = NewConnectionItem;
			}

			if(itemClass === null) {
				return false
			}

			return itemClass(options);
		}
	}
})();


function MediaItem(options) {
	var baseItem = $(document.getElementById("MediaItem").content.cloneNode(true)); //stamp out base item
	var imgURL = options["user-img-url"] || '/image/user_img.png';
	var userURL = options["user-url"] || '#';
	var date = options["date"] || ""; 
	

	baseItem.find(".time-ago").text(date);			//adding base item

	if( options["isNewMessage"] === true) {
		baseItem.find("li").addClass("new-item");	//add new item class
	}

	/* allow redirect to user page */
	baseItem.find("img.media-object").on("click",function(e){
		e.preventDefault();
		window.location.href = userURL;				//send user to another user public POV
	}).attr("src",imgURL);

	/* handle new message notification clearing */
	baseItem.find("a").on("click",function(e){
		var that = this;
		if($(this).parent("li").hasClass("new-item") === true){

			//do an ajax call to server to signal new message has been open
			$.ajax({
				url: "/header/php/dummy.php",			//<------ must be hard link
				data: {"openedMessageID":"messageID"},	//<------ flag a message has been read and give message id
				method: "POST",
				beforeSend: function() {
					e.preventDefault();
				},
				error: function(qXHR, textStatus,errorThrown ) {
					console.log(textStatus + ": " + errorThrown);
				}
			}).done(function(){
				/**
				  * Decrement notification amount
				  * NOTE: This step can be done before the ajax due to the non-volatile nature of the procedure 
				  * and to guarantee usability
				*/
				var notificationNumberDisplay = $(that).closest("li.notification-icon").find("span.notification-number");
				var newAmount = notificationNumberDisplay.text() - 1;
				if(newAmount > 0) {
					notificationNumberDisplay.text(newAmount);
				} else {
					notificationNumberDisplay.text("");
					$(that).closest("li.notification-icon").find("span.glyphicon").removeClass("attention-icon");			//remove attention-icon class
				}

				$(that).parent("li").removeClass("new-item");				//remove new-item class

				window.location.href = $(that).prop("href"); 				//manually redirect user
			});
		} 
	});
	return baseItem;
}

function MessageItem(options){
	var modTemplate = new MediaItem(options);

	
	var snippet = options["optional-snippet"] || "";
	var message = options["message"] || "";


	//fill in the required fields
	modTemplate.find("a.landing-destination").attr("href","../message/");

	modTemplate.find(".media-heading").text(options["user-name"]);
	modTemplate.find("p.snippet-zone").text(snippet);
	modTemplate.find("p.snippet-zone").after(message);

	return modTemplate;
}

function NotificationItem(options) {
	var baseItem = new MediaItem(options);

	var snippet = options["optional-snippet"] || "";
	var message = options["message"] || "";


	//fill in the required fields
	baseItem.find("a.landing-destination").attr("href","#");

	baseItem.find(".media-heading").text(options["user-name"]);
	baseItem.find("p.snippet-zone").text(snippet);
	baseItem.find("p.snippet-zone").after(message);

	return baseItem;
}

function NewConnectionItem(options) {
	var baseItem = new MediaItem(options);

	var snippet = options["optional-snippet"] || "";
	var message = options["message"] || "";


	//fill in the required fields
	baseItem.find("a.landing-destination").attr("href","../connections");

	baseItem.find(".media-heading").text(options["user-name"]);
	baseItem.find("p.snippet-zone").text(snippet);
	baseItem.find("p.snippet-zone").after(message);

	return baseItem;
}
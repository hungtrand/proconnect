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
	var baseItem = $(document.getElementById("MediaItem").content.cloneNode(true)); //get base item
	var imgURL = options["user-img-url"] || '/image/user_img.png';
	var userURL = options["user-url"] || '#';


	if( options["isNewMessage"] === true) {
		baseItem.find("li").addClass("new-item");
	}

	//allow redirect to user page
	baseItem.find("img.media-object").on("click",function(e){
		e.preventDefault();
		//send user to another user public POV
		window.location.href = userURL;
	}).attr("src",imgURL);

	//handle new message clearing
	baseItem.find("a").on("click",function(e){

		//START HERE

		if($(this).parent("li").hasClass("new-item") === true){
			var notificationNumberDisplay = $(this).closest("li.notification-icon").find("span.notification-number");
			var newAmount = notificationNumberDisplay.text() - 1;
			// var newParsedAmount = (newAmount < 0);
			//decrement notification amount
			//NOTE: This step is purposely done before the ajax due to the non-volatile nature of the procure 
			//and to guarantee usability

			console.log(newAmount);

			//do an ajax call to server to signal new message has been open
			$.ajax({
				url: "/header/php/dummy.php",			//<------ must be hard link
				data: {"openedID":"messageID"},			//<------ flag a message has been selected and give message id
				method: "POST",
				error: function(qXHR, textStatus,errorThrown ) {
					console.log(textStatus + ": " + errorThrown);
				}
			});
		} 

		e.preventDefault();
	});
	return baseItem;
}

function MessageItem(options){
	var modTemplate = new MediaItem(options);

	
	var snippet = options["optional-snippet"] || "";
	var message = options["message"] || "";
	var date = options["date"] || ""; // may add date difference 


	// console.log(options);

	//fill in the required fields
	// var modTemplate = new MediaItem();
	


	modTemplate.find("a.landing-destination").attr("href","../message/");

	modTemplate.find(".media-heading").text(options["user-name"]);
	modTemplate.find("p.snippet-zone").text(snippet);
	modTemplate.find("p.snippet-zone").after(message);
	modTemplate.find(".time-ago").text(date);

	return modTemplate;
}

function NotificationItem(options) {
	var baseItem = new MediaItem(options);

	return baseItem;
}

function NewConnectionItem(options) {
	var baseItem = new MediaItem(options);

	return baseItem;
}
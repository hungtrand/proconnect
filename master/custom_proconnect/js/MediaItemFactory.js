/**
 * Factory method for making media items
*/
var MediaItemFactory = (function(){
	return {
		makeItem: function(specialID,options) {

			var itemClass = null;

			if(specialID === 'message-list') {
				// console.log(specialID);
				itemClass = MessageItem;
			} else if(specialID === 'notification-list'){
				itemClass = NotificationItem;
				// console.log(specialID);
			} else if (specialID === 'connection-list') {
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
	// var baseItem = document.getElementById("MediaItem").content.cloneNode(true); //stamp out base item
	var baseItem = $($("#MediaItem").html()); 
	var imgURL = options["user-img-url"] || '/image/user_img.png';
	var userURL = options["user-url"] || '#';
	var date = options["date"] || ""; 
	
	baseItem.find(".time-ago").text(date);			//adding base item

	if( options["isNewMessage"] === true) {
		baseItem.find("li").addClass("new-item");	//add new item class
	}

	/* allow redirect to user page */
	baseItem.find("img.thumb").on("click",function(e){
		e.preventDefault();
		e.stopPropagation();
		window.location.href = userURL;				//send user to another user public POV
	}).attr("src",imgURL);

	
	return baseItem;
}

function MessageItem(data){
	var options = {
		'optional-snippet': data['message-subject'],
		'date': data['message-time'],
		'id': data['messageID'],
		'user-url': data['sender-href'],
		'message': data['sender-message'],
		'user-name': data['sender-name'],
		'user-img-url': data['sender-picture']
	};

	var modTemplate = new MediaItem(options);

	// console.log(modTemplate[0]);
	
	var snippet = options["optional-snippet"] || "";
	var message = options["message"] || "";


	//fill in the required fields
	modTemplate.find("a.landing-destination").attr("href","../message/");

	modTemplate.find(".media-heading").text(options["user-name"]);
	modTemplate.find("p.snippet-zone").text(snippet);
	modTemplate.find("p.snippet-zone").after(message);

	/* handle new message notification clearing */ //<----redirect to message page
	modTemplate.on("click",function(e){
		// window.location.href = $(that).prop("href"); 				//manually redirect user
		window.location.href = "/message/";
		/**
		  * Decrement notification amount
		  * NOTE: This step can be done before the ajax due to the non-volatile nature of the procedure 
		  * and to guarantee usability
		*/
		// var notificationNumberDisplay = $(that).closest("li.notification-icon").find("span.notification-number");
		// var newAmount = notificationNumberDisplay.text() - 1;
		// if(newAmount > 0) {
		// 	notificationNumberDisplay.text(newAmount);
		// } else {
		// 	notificationNumberDisplay.text("");
		// 	$(that).closest("li.notification-icon").find("span.glyphicon").removeClass("attention-icon");			//remove attention-icon class
		// }

		// $(that).parent("li").removeClass("new-item");				//remove new-item class

	});

	return modTemplate;
}

function NotificationItem(data) {
	var heading = "";

	var options = {
		'optional-snippet': '',
		'date': data['timestamp'],
		'id': data['NotificationViewID'],
		'user-url': data['href'],
		'message': '',
		'user-name': data['message'],
		'user-img-url': data['picture']
	};

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

function NewConnectionItem(data) {
	/* data example json format:
	CompanyName: "Google Inc."
	Email: "hungtrand0929@gmail.com"
	JobTitle: "Web Application Developer"
	Location: "Mountain View"
	Name: "Hung Tran"
	ProfileImage: "/users/10/images/HourGlass.jpg"
	UserID: "10"*/
	var heading = data['Name'] + ' invited you to connect.';
	var message = data['Name'] + '<br />' + data['JobTitle'];
	if (data['CompanyName']) message += ' at ' + data['CompanyName'];
	if (data['Location']) message += '<br />' + data['Location'];
	message += '<div class="text-right">';
	message += '<a class="btn btn-success ConnectionAction" href="/connections/php/NewConnection_controller.php?accept=true&UserID=' + data['UserID'] + '">Accept</a>';
	message += '&nbsp;&nbsp;<a class="btn btn-warning ConnectionAction" href="/connections/php/declineConnection_controller.php?UserID=' + data['UserID'] + '">Decline</a>';
	message += '</div>';

	var options = {
		'optional-snippet': '',
		'date': '',
		'id': data['UserID'],
		'user-url': '/profile-public-POV/?UserID=' + data['UserID'],
		'message': message,
		'user-name': heading,
		'user-img-url': data['ProfileImage']
	};

	var baseItem = new MediaItem(options);

	var snippet = options["optional-snippet"] || "";
	var message = options["message"] || "";

	//fill in the required fields
	baseItem.find("a.landing-destination").attr("href","../connections");

	baseItem.find(".media-heading").text(options["user-name"]);
	baseItem.find("p.snippet-zone").text(snippet);
	baseItem.find("p.snippet-zone").after(message);
	baseItem.find('.ConnectionAction').on('click', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		var theLink = $(this);
		$.ajax({
			url: href,
			type: 'POST'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				var li = theLink.closest('li');
				theLink.parent().toggleClass('alert alert-success text-center', true).html('Saved');
				setTimeout(function() {
					li.fadeOut('700', function() {$(this).remove();});
				}, 3000);
			} catch (e) {
				console.log(json);
			}
			
		});
	});

	return baseItem;
}
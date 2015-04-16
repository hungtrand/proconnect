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


function MediaItem() {
	this.srcObject = $('<li class="media">' +
                            '<a class="landing-destination" href="#">' +
                                '<div class="media-left">' +
									'<img class="media-object" src="" alt="" style="max-width: 48px;">' +
                                '</div>' +
                                '<div class="media-body" >' +
                                  '<h4 class="media-heading" >Media heading</h4>' +
                                  '<p class="snippet-zone"></p>' +
                                '</div>' +
                                '<div class="media-right time-ago">de</div>' +
                            '</a>' +
                    	'</li>');
}

function MessageItem(options){

	var imgURL = options["user-img-url"] || '/image/user_img.png';
	var userURL = options["user-url"] || '#';
	var snippet = options["optional-snippet"] || "";
	var message = options["message"] || "";
	var date = options["date"] || ""; // may add date difference 


	// console.log(options);

	//fill in the required fields
	// var modTemplate = new MediaItem();
	var modTemplate = $(document.getElementById("MediaItem").content.cloneNode(true));

	// console.log( modTemplate.content.cloneNode(true) );

	modTemplate.find("a.landing-destination").attr("href","http:www.google.com");
	modTemplate.find("img.media-object").on("click",function(){
		console.log(this);
		//send user to another user public POV
	}).attr("src",imgURL);
	modTemplate.find(".media-heading").val(options["user-name"]);
	console.log(modTemplate.find(".media-heading"));
	modTemplate.find("p.snippet-zone").val(snippet);
	modTemplate.find("p.snippet-zone").after(message);
	modTemplate.find(".time-ago").text(date);

	// console.log(modTemplate);
	// options[""]

	// this.html = this.mediaTemplate().html();

	return modTemplate;
}

function NotificationItem(options) {

}

function NewConnectionItem(options) {

}
$(document).ready(function(){

	//get notification every 10 seconds
	NotificationGetter.get(10000,function(data){
		//display data
		$.each(data,function(i,v){
			if(v > 0) {
				if(i === "messages") {
					$("#message").find("span.notification-number").text(data["messages"]);
					$('#message').find(".navi-menu > span.glyphicon").addClass("attention-icon");
				} else if (i === "notification") {
					$("#notification").find("span.notification-number").text(data["notification"]);
					$('#notification').find(".navi-menu > span.glyphicon").addClass("attention-icon");
				} else if (i === "new-connection") {
					$("#connection").find("span.notification-number").text(data["new-connection"]);
					$('#connection').find(".navi-menu > span.glyphicon").addClass("attention-icon");
				}
			}
		});
	});
	
	//get messages
	function fillMessages(parent) {
		var specialID = $(parent).attr("id");
		MessageGetter.get(specialID,function(jqXHR,obj){
			//clear existing items 
			$(parent).siblings("ul").find(".custom-media-item").remove();

			//show loading div
			$(parent).siblings("ul").find("div#iam-loading").show();
		},function(data){

			//display data
			if (typeof data == 'string') {
				$(parent).siblings("ul.media-list").html('<li class="text-info custom-media-item">No messages.</li>');

			} else {
				$.each(data,function(key,value){
					// make items
					var newItem = MediaItemFactory.makeItem(specialID,value);
					//fill the items
					$(parent).siblings("ul.media-list").children().last().after(newItem);
				});
				// var item = new MediaItem(data);
				// console.log( item.html() );
			}

			$(parent).siblings("ul").find("div#iam-loading").hide();
			
		});
	}

	
	/* Link notification hover handler */
	$(".notification-icon").hover(function(){
		// $(this).find("ul.media-list").fadeIn(500);
		var notificationNum = parseInt($(this).find("span.notification-number").text());

		if (notificationNum > 0) {
			//query
			fillMessages($(this).find("a.navi-menu"));
		} 

		// IamLoading.show($(this).find("ul.media-list li.dropdown-header"));
		$(this).attr("aria-expanded","true");
		$(this).addClass("open");
	},function(){
		// $(this).find("ul.media-list").hide();
		$(this).attr("aria-expanded","false");
		$(this).removeClass("open");
	});

	

	
});
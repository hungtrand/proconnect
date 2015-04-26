$(document).ready(function(){

	//get notification every 10 seconds
	NotificationGetter.get(10000,function(data){
		//display data
		$.each(data,function(i,v){
			if(v > 0) {
				if(i === "messages") {
					$("#message-list").find("span.notification-number").text(data["messages"]);
				} else if (i === "notification") {
					$("#notification-list").find("span.notification-number").text(data["notification"]);
				} else if (i === "new-connection") {
					$("#connection-list").find("span.notification-number").text(data["new-connection"]);
				}
			}
		});
	});
	
	//get notification messages
	function fillMessages(parent) {
		var specialID = $(parent).prop("id");
		MessageGetter.get(specialID,function(jqXHR,obj){
			$(parent).find(".custom-media-item").remove(); //clear existing items 
			$(parent).find("div.iam-loading").show();      //show loading div
		},function(data){
			//display data
			if (typeof data == 'string') {
				$(parent).find(".custom-media-item").remove(); //clear existing items 
				$(parent).children("ul.dropdown-menu").append('<li class="media custom-media-item">No new messages.</li>');
			} else {
				$.each(data,function(key,value){
					// make items
					var newItem = MediaItemFactory.makeItem(specialID,value);
					// console.log(newItem[0]);
					//fill the items
					$(parent).find("ul.dropdown-menu").children().last().after(newItem);
				});
			}

			$(parent).find("div.iam-loading").hide();
		});
	}
	
	/* Link notification hover handler */
	$(".notification-icon").on('click', function(e){

		var notificationNum = parseInt($(this).find("span.notification-number").text());

		if (notificationNum > 0) {
			//query
			fillMessages(this);
		} else {
			// console.log(notificationNum);
			e.preventDefault();
			e.stopPropagation();
		}
	});

	// $(document).on('click', function(e) {
	// 	$(".notification-icon").attr("aria-expanded","false");
	// 	$(".notification-icon").removeClass("open");
	// });
 	
 	/* show menu on scroll down*/
 	$(window).scroll(showMenuOnScroll());
	
	function showMenuOnScroll(e){
 		//Keep track of last scroll
		var lastScroll = 0;
 		return function() {
          //Sets the current scroll position
          var st = $(this).scrollTop();
          //Determines up-or-down scrolling
          if (st > lastScroll){  			//DOWN
				$("#nv-menu").slideUp(100);             
          } else { 							//UP
             	$("#nv-menu").slideDown(100);   
          }
          lastScroll = st;					//Updates scroll position
      	}
	}

	AdvanceSearchInterfaceHandler.init();

	// Load connections suggestions
	var suggList = new SuggestionList($('#SuggListing'));
	suggList.load('compact');
});
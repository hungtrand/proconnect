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
			$(parent).siblings("ul").find(".custom-media-item").remove(); //clear existing items 
			$(parent).siblings("ul").find("div#iam-loading").show();      //show loading div
		},function(data){
			$.each(data,function(key,value){ 														  
				var newItem = MediaItemFactory.makeItem(specialID,value);	//make items
				$(parent).siblings("ul.media-list").children().last().after(newItem);//display item
			});
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

		$(this).attr("aria-expanded","true");
		$(this).addClass("open");
	},function(){
		// $(this).find("ul.media-list").hide();
		$(this).attr("aria-expanded","false");
		$(this).removeClass("open");
	});
 	
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

	$("#advance-option-div").on("click",function(e){
		console.log(e);
		e.preventDefault();
		e.stopPropagation();
	});
});
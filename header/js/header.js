$(document).ready(function(){

	console.log($("#LoadingBlock") );

	// NotificationGetter.get(5000,function(data){
	// 	//console.log(data);
	// 	//display data
	// });
	
	//get message
	function fillNotification(parent) {
		var that = this;
		var specialID = $(this).attr("id");
		MessageGetter.get(specialID,function(data){
			//display data
			$.each(data,function(key,value){
				var newItem = MediaItemFactory.makeItem(specialID,value);
				$(that).siblings("ul.media-list").children().last().after(newItem);
				// console.log(MediaItemFactory.makeItem(specialID,value) );
				// $("#message").append(MediaItemFactory.makeItem(specialID,value));
			});
			// var item = new MediaItem(data);
			// console.log( item.html() );
		});
	}

	
	//Link notification hover handler
	$(".notification-icon").hover(function(){
		// $(this).find("ul.media-list").fadeIn(500);
		// console.log($(this).find("ul.media-list li.dropdown-header"));
		IamLoading.show($(this).find("ul.media-list li.dropdown-header"));
		$(this).attr("aria-expanded","true");
		$(this).addClass("open");
	},function(){
		// $(this).find("ul.media-list").hide();
		$(this).attr("aria-expanded","false");
		$(this).removeClass("open");
	});


	
});
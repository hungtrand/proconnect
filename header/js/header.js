$(document).ready(function(){

	// NotificationGetter.get(5000,function(data){
	// 	//console.log(data);
	// 	//display data
	// });
	
	//get message
	$(".navi-menu").on("click", function() {
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
	});

	



	
});
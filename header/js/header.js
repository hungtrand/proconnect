$(document).ready(function(){

	// NotificationGetter.get(5000,function(data){
	// 	//console.log(data);
	// 	//display data
	// });
	
	//get message
	$(".navi-menu").on("click", function() {
		var specialID = $(this).attr("id");
		MessageGetter.get(specialID,function(data){
			//display data
			$.each(data,function(key,value){
				// console.log(value);
				console.log(MediaItemFactory.makeItem(specialID,value).html() );
			});
			// var item = new MediaItem(data);
			// console.log( item.html() );
		});
	});

	



	
});
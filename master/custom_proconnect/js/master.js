$(document).ready(function(){


	// Mobile 
 	// $(".mobile-notification-list").on('click','a.toggle',function(e){
 	// 	// e.preventDefault();
 	// 	console.log('hellow');
 	// });

	$(document).on('click', function() {
		if ($(".navbar-collapse#main-nav").hasClass('in'))
			$(".navbar-collapse#main-nav").collapse('hide');
	});

	//get notification every 10 seconds
	NotificationGetter.getUsingInterval(10000,NotificationHandler.displayNotifications);
	
	
	
	/* Link notification hover handler */
	$(".notification-icon").on('click', function(e){

		// var notificationNum = parseInt($(this).find("span.notification-number").text());

		// if (notificationNum > 0) {
			//query
			NotificationHandler.fillMessages(this,MessageGetter,MediaItemFactory);
		// } else {
		// 	// console.log(notificationNum);
		// 	e.preventDefault();
		// 	e.stopPropagation();
		// }
	});

 	/* show menu on scroll down*/
 // 	$(window).scroll(showMenuOnScroll());
	
	// function showMenuOnScroll(e){
 // 		//Keep track of last scroll
	// 	var lastScroll = 0;
 // 		return function() {
 //          //Sets the current scroll position
 //          var st = $(this).scrollTop();
 //          //Determines up-or-down scrolling
 //          if (st > lastScroll){  			//DOWN
	// 			$("#nv-menu").slideUp(100);             
 //          } else { 							//UP
 //             	$("#nv-menu").slideDown(100);   
 //          }
 //          lastScroll = st;					//Updates scroll position
 //      	}
	// }

	AdvanceSearchInterfaceHandler.init();

	// Load connections suggestions
	var suggList = new SuggestionList($('#SuggListing'));
	suggList.load('compact');

	$('#swipeBox').on('swiperight', function(ev) {
		$('[href="#sidebar-menu"]').trigger('touchstart');
	});
});
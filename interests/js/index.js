$(document).ready(function() {

	var feedList = new FeedList($('#FeedsSection'));

	if(isMobile.phone) {
		// console.log('is phone');
		feedList.load();
	} else {
		// console.log('not phone');
		feedList.loadCardView();
	}
	// initite scroll
	$('.st-content-inner').scroll(function()
	{	
		var spread = 30;
		var triggerPoint = $('.st-content-inner').children('.container-fluid').height() - $('.st-content-inner').height() - 200;
	    if($('.st-content-inner').scrollTop() > (triggerPoint - spread) && $('.st-content-inner').scrollTop() < (triggerPoint + spread))
	    {
	        feedList.nextCardView();
	    }
	});
});
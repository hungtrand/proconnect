$(document).ready(function() {

	var feedList = new FeedList($('#FeedsSection'));

	if(isMobile.phone) {
		console.log('is phone');
		feedList.load();
	} else {
		console.log('not phone');
		feedList.loadCardView();
	}
	// initite scroll
	$('.st-content-inner').scroll(function()
	{
		var triggerPoint = $('.st-content-inner').children('.container-fluid').height() - $('.st-content-inner').height() - 200;
	    if($('.st-content-inner').scrollTop() > (triggerPoint - 10) && $('.st-content-inner').scrollTop() < (triggerPoint + 10))
	    {
	        feedList.nextCardView();
	    }
	});
});
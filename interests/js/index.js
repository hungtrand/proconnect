$(document).ready(function() {

	var feedList = new FeedList($('#FeedsSection'));

	if(isMobile.phone) {
		console.log('is phone');
		feedList.load();
		$('#interest-wrapper').css('right','0px');
	} else {
		console.log('not phone');
		feedList.loadCardView();
		$('#interest-wrapper').css('right','-15px');
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

	var interestFiller = new InterestFiller();
	interestFiller.load();
	// var TypeAhead = new typeahead();
	$('.interest-expand').on('click', function(ev) {
		ev.preventDefault();
		if($('#interest-container').css('opacity') == 0) {
			$('#interest-container').animate({opacity: 1}, 600);
		} else {
			$('#interest-container').animate({opacity: 0}, 600);			
		}
	});
});
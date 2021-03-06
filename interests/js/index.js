$(document).ready(function() {

	var feedList = new FeedList($('#FeedsSection'));

	if(isMobile.phone) {
		// console.log('is phone');
		feedList.load();
		$('#interest-wrapper').css('right','0px');
	} else {
		// console.log('not phone');
		feedList.CardView = true;
		feedList.loadCardView();
		$('#interest-wrapper').css('right','-15px');
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

	var interestsData = [];
	var interestFiller = new InterestFiller();
	interestFiller.load(function(data) {
		interestsData = data;

		if (!window.location.hash) return;

		var interestID = window.location.hash.substring(1);
  		interestID  = parseInt(interestID);
  		var interest = $('#'+interestID).find('.interestName').val();
  		feedList.setInterest(interest);console.log(interest);
		
		if(isMobile.phone) {
			feedList.load();
		} else {
			feedList.loadCardView();
		}
	});
	// var TypeAhead = new typeahead();
	$('.interest-expand').on('click', function(ev) {
		ev.preventDefault();
		if($('#interest-container').is(':hidden')) {
			$('#interest-container').slideDown('slow');
			$('.searchedInterest').focus();
		} else {
			$('#interest-container').slideUp('slow');			
		}
	});

	
});
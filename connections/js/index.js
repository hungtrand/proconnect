var connList = new ConnectionList($('#ConnListing'));
connList.load();

var suggList = new SuggestionList($('#SuggListing'));
suggList.load();

var connSearch = new NewConnectionSearch($('#modalNewConnection'));
connSearch.onClose(function() {
	connList.load();
});

// initite scroll
// initite scroll
$('.st-content-inner').scroll(function()
{
	var triggerPoint = $('.st-content-inner').children('.container-fluid').height() - $('.st-content-inner').height() - 200;
    if($('.st-content-inner').scrollTop() > (triggerPoint - 10) && $('.st-content-inner').scrollTop() < (triggerPoint + 10))
    {
        connList.next();
    }
});
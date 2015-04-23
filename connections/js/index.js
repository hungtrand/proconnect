var connList = new ConnectionList($('#ConnListing'));
connList.load();

var suggList = new SuggestionList($('#SuggListing'));
suggList.load();

var connSearch = new NewConnectionSearch($('#modalNewConnection'));
connSearch.onClose(function() {
	connList.load();
});

// initite scroll
$(window).scroll(function()
{
    if($(window).scrollTop() == $(document).height() - $(window).height())
    {
        connList.next();
    }
});
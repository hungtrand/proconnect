var connList = new ConnectionList($('#ConnListing'));
connList.load();

var suggList = new SuggestionList($('#SuggListing'));
suggList.load();

var connSearch = new NewConnectionSearch($('#modalNewConnection'));
connSearch.onClose(function() {
	connList.load();
});
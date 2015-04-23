$(document).ready(function() {
	
	var suggList = new SuggestionList($('#SuggListing'));
	suggList.load();

	var feedList = new FeedList($('#FeedsSection'));
	feedList.load();

	var newPost = new NewPost();
	newPost.onSubmit(function(jsonData) {
		feedList.appendView(jsonData)
	});

	// initite scroll
	$(window).scroll(function()
	{
	    if($(window).scrollTop() == $(document).height() - $(window).height())
	    {
	        feedList.next();
	    }
	});
});
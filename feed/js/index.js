var suggList = new SuggestionList($('#SuggListing'));
suggList.load();

var feedList = new FeedList($('#FeedsSection'));
feedList.load();

var newPost = new NewPost();
newPost.onSubmit(function() {
	feedList.load();
});
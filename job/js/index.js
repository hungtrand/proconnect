$(document).ready(function() {
	var advSearch = new AdvSearch();

	var jobGrid = new JobGrid();
	jobGrid.load();

	var searchedJobs = new SearchedJobs();

$('[href="#sidebar-menu"]').click();
	$('#swipeBox').on("swipeleft",function(){
		alert('meh');
	});
	$('#swipeBox').on("swiperight",function(){
  		$('[href="#sidebar-menu"]').trigger('vclick');
	});
	
});
$(document).ready(function() {
	var editor = new NewPost();

	var industry = new IndustryDropBox();
	industry.load();

	var jobFunc = new JobFunctionDropBox();
	jobFunc.load();

	var previewBtn = $('#modal-btn');
	previewBtn.click( function(ev) {
		ev.preventDefault();
		var modalDesc = new ModalFiller();
		modalDesc.load();
	});

	var submitBtn = $('#submit-btn');
	submitBtn.click( function(ev) {
		ev.preventDefault();
		var jobpost = new JobPost();
		jobpost.load();
	});
})
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

	$('#btnAttachImg').on('click', function(e) {
		e.preventDefault();
		$('#FeedImage').trigger('click');
	});

	$('#FeedImage').on('change', function(evt) {
		var tgt = evt.target || window.event.srcElement, files = tgt.files;

		if (FileReader && files && files.length) {
			var fr = new FileReader();
		    fr.onload = function () {
				$('#ImagePreview').attr('src', fr.result).show();
			}
			fr.readAsDataURL(files[0]);
		}
	});
})
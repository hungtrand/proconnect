$(document).ready( function() {
	$('#swipeBox').mousedown( function(ev) {

		ev.preventDefault();
		$(window).mousemove( function() {
			$('[href="#sidebar-menu"]').trigger('touchstart');
		});
	});
});
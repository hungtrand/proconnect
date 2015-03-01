$(document).ready(function(){

	$( "#sortable" ).sortable({
	  placeholder: "ui-state-highlight"
	});

	// $( "#yea" ).sortable({
	//   placeholder: "ui-state-highlight"
	// });
	// $(document).on("click","#change-image-block",function(){
	// 	console.log("hwllo");
	// });
	
	$("#change-image-block").on("click",function(){
		console.log("hah");
	});

});
$(document).ready(function(){
	NotificationGetter.get(5000,function(data){
		console.log(data);
		//display data
	});
});
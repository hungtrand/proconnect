$(document).ready(function(){

	var notiContainer = $(".mobile-noti-list")[0];
	NotificationHandler.fillMessages(notiContainer,MessageGetter,MediaItemFactory);
})
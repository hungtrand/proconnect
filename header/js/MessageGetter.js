var MessageGetter = (function() {
	return {
		get: function(categoryID, beforeSendCB ,displayCallback) {
			var data = {"categoryID":categoryID};
			if (categoryID == 'notification-menu') {
				var contentURL = "/notification/php/notificationInbox_controller.php";
			} else if (categoryID == 'message-menu') {
				var contentURL = "/message/php/inbox_controller.php";
			} else if (categoryID == 'connection-menu') {
				var contentURL = "/connections/php/Connections_controller.php";
				data['filter'] = 'pending';
			}

			$.ajax({
				url: contentURL,			//<------ must be hard link
				data: data,			//<------ may not be necessary
				method: "POST",
				beforeSend: function(jqXHR,obj){
					beforeSendCB(jqXHR,obj);
				},
				error: function(qXHR, textStatus,errorThrown ) {
					console.log(textStatus + ": " + errorThrown);
				}
			}).done(function(data){
					try {
						var messages = JSON.parse(data);
						// console.log(data);

						if(displayCallback !== undefined){
							displayCallback(messages);
						}
					} catch (e) {
						console.log(e);
						displayCallback(data);
					}
			});
		}
	}
})();
var MessageGetter = (function() {
	return {
		get: function(categoryID, beforeSendCB ,displayCallback) {
			$.ajax({
				url: "/header/php/dummy.php",			//<------ must be hard link
				data: {"userID":"message-getter","categoryID":categoryID},			//<------ may not be necessary
				method: "POST",
				beforeSend: function(jqXHR,obj){
					beforeSendCB(jqXHR,obj);
				},
				error: function(qXHR, textStatus,errorThrown ) {
					console.log(textStatus + ": " + errorThrown);
				}
			}).done(function(data){
					// try {
						var messages = JSON.parse(data);
						// console.log(data);

						if(displayCallback !== undefined){
							displayCallback(messages);
						}
					// } catch (e) {
					// 	console.log(e);
					// }
			});
		}
	}
})();
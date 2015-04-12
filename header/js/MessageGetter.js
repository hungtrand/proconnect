var MessageGetter = (function() {
	return {
		get: function(categoryID, displayCallback) {
			$.ajax({
				url: "/header/php/dummy.php",			//<------ must be hard link
				data: {"userID":1234,"categoryID":categoryID},			//<------ may not be necessary
				method: "POST",
				success: function(data){
					try {
						var messages = JSON.parse(data);
						console.log(data);

						if(displayCallback !== undefined){
							displayCallback(messages);
						}
					} catch (e) {
						console.log(e);
					}
				},
				error: function(qXHR, textStatus,errorThrown ) {
					console.log(textStatus + ": " + errorThrown);
				}
			});
		}
	}
})();
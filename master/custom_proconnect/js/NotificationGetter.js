var NotificationGetter = (function() {
	return {
		getUsingInterval: function(timeBetweenEachAjax, displayCallback) {

			timeBetweenEachAjax = timeBetweenEachAjax || 1000; //default time is 1 second

			this.getResponse(displayCallback);		//query response right away

			var interval = window.setInterval(this.getResponse(displayCallback),timeBetweenEachAjax);						  //query a response
		},
		getResponse: function(displayCallback) {
			$.ajax({
					url: "/master/custom_proconnect/php/notifications_controller.php",													  //<------ must be hard link
					// url: "/master/custom_proconnect/php/dummy.php",													  //<------ must be hard link
					data: {"userID":"notification-getter"},															  //<------ may not be necessary
					method: "POST",
					success: function(data){
						try {
							var notifications = JSON.parse(data);
							// console.log(notifications);

							if(displayCallback !== undefined){
								displayCallback(notifications);
							}
						} catch (e) {
							console.log(e);
						}
					},
					error: function(qXHR, textStatus,errorThrown ) {
						console.log(textStatus + ": " + errorThrown);
						clearInterval(interval);				//stop querying since there is an error
					}
				});
		}
	}
})();
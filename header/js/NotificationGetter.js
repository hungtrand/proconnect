var NotificationGetter = (function() {
	return {
		get: function(timeBetweenEachAjax, displayCallback) {

			timeBetweenEachAjax = ( timeBetweenEachAjax === undefined ) ? 1000 : timeBetweenEachAjax; //default time is 1 second

			getResponse();																			  //query response right away

			//var interval = window.setInterval(getResponse,timeBetweenEachAjax);						  //query a response

			function getResponse() {
				$.ajax({
					url: "/header/php/dummy.php",			//<------ must be hard link
					data: {"userID":123},			//<------ may not be necessary
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
	}
})();
var NotificationHandler = (function() {
	return {
		displayNotifications: function(data){
			//display data
			$.each(data,function(i,v){
				if(v >= 0) {
					if(i === "messages") {
						var num1 = (data["messages"] == 0) ? '' : data['messages'];
						$("#message-list").find("span.notification-number").text(num1);
					} else if (i === "notification") {
						var num2 = (data["notification"] == 0) ? '' : data['notification'];
						$("#notification-list").find("span.notification-number").text(num2);
					} else if (i === "new-connection") {
						var num3 = (data["new-connection"] == 0) ? '' : data['new-connection'];
						$("#connection-list").find("span.notification-number").text(num3);
					}
				}
			});
		}		
	}
})();
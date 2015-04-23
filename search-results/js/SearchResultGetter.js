var SearchResultGetter = (function(){
	return {
		get:function(options) {
			$.ajax({
				url: "php/dummy.php",
				method: "GET",
				data: options["data"],
				beforeSend: function(jqXHR,obj){
					if(options["beforeSend"] !== undefined) {
						options["beforeSend"](jqXHR,obj);
					}
				},
				error: function(qXHR, textStatus,errorThrown ) {
					console.log(textStatus + ": " + errorThrown);
				}
			}).done(function(data){
				// try {
					var messages = JSON.parse(data);
					// console.log(data);

					if(options["done"] !== undefined){
						options["done"](messages);
					}
				// } catch (e) {
				// 	console.log(e);
				// }
			});
		}
	}
})();
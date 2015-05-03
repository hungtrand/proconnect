var SearchResultGetter = (function(){
	return {
		get:function(options) {
			$.ajax({
				url: "php/search_controller.php",
				method: "POST",
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
				try {
					data = JSON.parse(data);
					// console.log(data);
				} catch (e) {
					console.log(data);
				}

				if(options["done"] !== undefined){
					options["done"](data);
				}
			});
		}
	}
})();
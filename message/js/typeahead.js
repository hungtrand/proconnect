function typeahead() {
	this.userObjs;
	this.userNames;
	this.init()
}

typeahead.prototype = {
	constructor: typeahead,

	init: function() {
		this.fetch();
	},

	fetch: function() {
		var that = this;
		var userObjs = {};
		var userNames = [];
		var throttledRequest = _.debounce(function(query, process){
		$.ajax({
			url: 'php/dummyConn.php',
			type: 'POST',
			contentType: 'text/plain'
		}).done(function(json) {
			try {
				json = $.parseJSON(json);
				userObjs = {};
				userNames = [];
				_.each( json, function(item, ix, list){
					userNames.push( item['user-name'] );
					userObjs[ item['user-name'] ] = item;
				process( userNames );	
				});
			} catch (ev) {
				alert("OMG");
			}
			});
		}, 750);


		$(".typeahead").typeahead({
			source: function ( query, process ) {
				throttledRequest( query, process );
			},

			highlighter: function( item ){
          		var user = userObjs[ item ];
          
          		return '<div class="user">'+'<img src="'+user['user-picture']+'"/>'+'<strong>'+user['user-name']+'</strong><br /><em>'+user['user-job-title']+'</em></div>';
        	}, 
        	updater: function ( selectedName ) {
        		$("#userID").val(userObjs[selectedName].userID);
				// $( "#userID" ).val( userObjs[ selectedName ].id );
				// console.log($( "#userID" ).val( userObjs[ selectedName ] ));
				// console.log($("#userID").attr("value"));
					return selectedName;
				}
			});
	}
}
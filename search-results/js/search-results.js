$(document).ready(function(){

	var uData = queryString();
	uData["range"] = "1-10"; // <----- could be used for pagination later
	// console.log(uData);
	SearchResultGetter.get({
		data: uData,
		beforeSend: function(jqXHR,obj){
			$("#iam-loading2").show(); //hide loading gif
		},
		done:function(data){
			$("#iam-loading2").hide(); //hide loading gif

			$("#sr-feed-zone").html(""); //clear all 
			$.each(data,function(i,v){	//loop through entries
				var item = SearchResultFactory.makeItem(v);
				$("#sr-feed-zone").append(item);
			});			
		}
		
	});


	//grab data from URL
	function queryString() {
		  var query_string = {};
		  var query = window.location.search.substring(1);
		  var vars = query.split("&");
		  for (var i=0;i<vars.length;i++) {
		    var pair = vars[i].split("=");
		        // If first entry with this name
		    if (typeof query_string[pair[0]] === "undefined") {
		      query_string[pair[0]] = pair[1];
		        // If second entry with this name
		    } else if (typeof query_string[pair[0]] === "string") {
		      var arr = [ query_string[pair[0]], pair[1] ];
		      query_string[pair[0]] = arr;
		        // If third or later entry with this name
		    } else {
		      query_string[pair[0]].push(pair[1]);
		    }
		  } 
	    return query_string;
	}
});
<html>
	<head>
	<script src="../lib/jquery/jquery-2.1.3.min.js"></script>
	<script src="/lib/js/StatesCitiesList.js"></script>
	</head>

	<body> 
	<!-- The Select boxes will be appended here for example here-->
	<div id="test"></div>
	</body>

	<script> 
	// create an instance of the StatesCitiesList
	 var sl = new StatesCitiesList();

	 // use getView method to get the html and append anywhere you want
	 $('#test').html(sl.getView());

	 // if you just want the data for the states just call method getStates()
	 states = sl.getStates();
	 console.log(states);

	 // if you want data for the cities in json format for a particular state
	 // you can call method getCities() like this:
	 // method getCities() take two parameter, the state you want and a callback
	 // function than you want to execute after the cities data come back from ajax
	 sl.getCities('SC', function(cities_json) {
	 	console.log(cities_json);
	 });

	</script>
</html>
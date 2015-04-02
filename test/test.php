<html>
	<head>
	<script src="../lib/jquery/jquery-2.1.3.min.js"></script>
	<script src="/lib/js/StatesCitiesList.js"></script>
	</head>

	<body>
	<div id="test"></div>
	<hr />
	<div id="statesdata"></div>
	<hr />
	<div id="citiesdata"></div>
	</body>

	<script>
	 var sl = new StatesCitiesList();
	 $('#test').html(sl.getView());

	 sl.getStates(function(data) {
	 	console.log(data);
	 });
	 sl.getCities('CA', function(data) {
	 	console.log(data);
	 });

	</script>
</html>
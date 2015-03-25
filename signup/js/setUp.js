$(document).ready(function(){
		$("#country").change(function(){
			var value = this.value;
			if(value == "United States"){
				$("#zipcode-group").show();
				$("#postalcode-group").hide();
			}
			else{
				$("#zipcode-group").hide();
				$("#postalcode-group").show();
			}
		});

});

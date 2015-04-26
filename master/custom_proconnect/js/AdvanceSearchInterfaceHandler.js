var AdvanceSearchInterfaceHandler = (function(){

	function init() {
		
		$("#advance-option-div").on("click",function(e){e.stopPropagation();}); //prevent closing on random click*/

		$(".ao-close").on("click",function(e){$("#ao-show-btn").trigger("click");}); //enable close button

		$(".ao-add-option").keypress(function(e){    //handle adding options
			if(e.charCode === 13) {
				e.preventDefault();
				e.stopPropagation();

				var optionName = $(this).val();
				var name = $(this).siblings(".dynamic-result-div").prop("id");

				var baseItem = $(document.getElementById("ao-checkbox").content.cloneNode(true));
				baseItem.find("input[type=checkbox]").prop("value",optionName).prop("name",name).after(" " + optionName);

				$(this).siblings(".dynamic-result-div").append(baseItem); //attach baseItem

				$(this).val("");//reset value
			}	
		});
	}

	return {
		init: init
	}
})();
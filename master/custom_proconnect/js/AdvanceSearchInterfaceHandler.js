var AdvanceSearchInterfaceHandler = (function(){

	function init() {
		
		$("#ao-main-box").on("click",function(e){
			e.stopPropagation();
			console.log(e);
		}); //prevent closing on random click*/

		$(".ao-close").on("click",function(e){$("#ao-show-btn").trigger("click");}); //enable close button

		$(".ao-add-option").keypress(function(e){    //handle adding options
			if(e.charCode === 13) {
				e.preventDefault();
				e.stopPropagation();

				var optionName = $(this).val();
				var name = $(this).siblings(".dynamic-result-div").prop("id");

				var baseItem = document.getElementById("ao-checkbox").content.cloneNode(true);//stamping out template
				var checkBox = baseItem.querySelector("input[type=checkbox]");
				checkBox.value = optionName;
				checkBox.name = name;
				var textNode = document.createTextNode(" " + optionName);

				checkBox.appendChild(textNode);
				// .prop("value",optionName).prop("name",name).after(" " + optionName);

				console.log(baseItem);
				$(this).siblings(".dynamic-result-div").append(baseItem); //attach baseItem

				$(this).val("");//reset value
			}	
		});
	}

	return {
		init: init
	}
})();
var SearchResultFactory = (function(){
	return {
		makeItem:function(options){
			var baseClass = null;

			//if(options["type"] === "normal") {
				baseClass = RegularSRItem;
				// baseClass = SRItemWithBtn;

			//}

			if(baseClass === null) {
				return false;
			}

			return new baseClass(options);
		}
	}
})();

 // <div class="media sr-media-item">
	// 	  <div class="media-left">
	// 	    <a class="user-url-anchor" href="#">
	// 	      <img class="media-object" src="/image/user_img.png" alt="" style="max-width: 60px;">
	// 	    </a>
	// 	  </div>
	// 	  <div class="media-body">
	// 	    <h4 class="media-heading">Media Heading</h4>
	// 	    <span class="media-subheading">sub heading</span> <br>
	// 	    <span class="media-description">asdasdas</span>
	// 	  </div>
	// 	   <div class="media-right">
	// 	   	<template id="sr-media-btn">
	// 	   		<button type="button" class="btn btn-primary sr-media-btn">asdas</button>
	// 	   	</template>
	// 	   </div>
	// 	</div>
function RegularSRItem(options){
	/*var baseItem = $(document.getElementById("SearchResultMediaItemTemplate").content.cloneNode(true));

	baseItem.find(".user-url-anchor").prop("href", options["user-url"]);
	baseItem.find("img.media-object").prop("src", options["user-img-url"]);
	baseItem.find(".media-heading").text(options["user-name"]);
	baseItem.find(".media-subheading").text(options["user-origin"]);
	baseItem.find(".media-description").text(options["snippet"]);*/
	var conn = new NewConnection(options, 'static');
	var baseItem = conn.getView();

	return baseItem;
}


//NOT USED YET
function SRItemWithBtn(options) {
	var baseItem = RegularSRItem(options);

	var btn = baseItem.find("#sr-media-btn").prop("content"); //stamp out btn

	baseItem.find(".media-right").append(btn); 	//attack btn

	return baseItem;
}
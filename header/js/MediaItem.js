/**
 * Media Item for Navigation Bar
*/
function MediaItem(options){
	this.options = options;

	// this.imgURL = options["user-img-url"] || '/image/user_img.png';
	this.rawTemplate = $('<li class="media" style="max-width:100%;">' + 
                        '<a class="landing-destination" href="#">' +
                        '<div class="media-left">' +
                            '<img class="media-object" src="" alt="" style="max-width: 48px;">' +
                        '</div>' +  
                        '<div class="media-body" style="text-overflow:ellipsis; max-width:150px;">' +
                          '<h4 class="media-heading" ></h4>' +
                          '<p class="media-content"></p>' +
                        '</div>' +
                      '</a>' + 
                    '</li>');
	this.mediaTemplate = function() {
		var modTemplate = this.rawTemplate;
		
		return modTemplate;
	};
}

MediaItem.prototype = {
	html: function(){
		// console.log(this.mediaTemplate());
		return this.mediaTemplate().html();
	}
}
$(document).ready(function(){

	/*
		This script act as the control
	*/

	//initialize model
	var user = new User();
	user.init();

	//serialize object to JSON
	$.fn.serializeObject = function()
	{
	   var o = {};
	   var a = this.serializeArray();
	   $.each(a, function() {
	       if (o[this.name]) {
	           if (!o[this.name].push) {
	               o[this.name] = [o[this.name]];
	           }
	           o[this.name].push(this.value || '');
	       } else {
	           o[this.name] = this.value || '';
	       }
	   });
	   return o;
	};
	
	//enable sortable
	$(".sortable").sortable({
		items: ':not(.no-sort)'
	}).bind('sortupdate', function() {
    	//Triggered when the user stopped sorting and the DOM position has changed.
	});
	
	//enable edit view
	$(".normal-view").on("click",".editable",function(){
		var target = "#" + $(this).attr("for");			//grab target
		var targetLink = '#' + $(this).attr("link");	//grab link
		var indexNum = $(this).attr("index");			//grab index

		//hide current entry except for #user-info-edit
		if(target !== "#user-info-edit"){
			//hide this
			$(this).fadeOut(50);				//fadeOut current content
			$(targetLink).fadeOut(50);
		} 

		//embed index in form
		if(indexNum !== '') {					//an index is present
			$(target).find("form").attr("for-index",indexNum);
		}

		// console.log( $(target).find("form").attr("link") + " " +target  );
		// console.log($(target).find("form").attr("forIndex") );

		//load info
		user.loadEditForm(target);

		//display delete entry link
		$(target).find("a.remove-entry-link").show();
		//display edit view
		$(target).fadeIn().find("form").attr( "link", $(this).attr("link") ); 
	});

	//handle edit-form submit
	$(".editable-form").on("submit", function(e){
		if($("#project-team-members").val() !== ""){ //form submition was not for adding team members
			//add user to model 
			//clear input text
			//update Form
	 		$("#project-team-members").val("");//clear field
			console.log("adding new teammate");

		} else {
			var data = $(this).serializeObject();	//grab data in json object format
			//pass json object to model for processing
			// console.log(data);
			$(this).siblings("div.loading").show();//show loading gif					
			//on success
			
		}
		// console.log(JSON.stringify(data));


		
		e.preventDefault();
		$("a.remove-entry-link").hide(); //hide delete entry link
	});

	//handle remove entry link
	$(".remove-entry-link").on("click",function(e){
		var that = this;
		e.preventDefault();

		//display confirm modal
		bootbox.dialog({
				title:"Remove Entry",
				message: "Are you sure you want to remove this entry?",

				/**
			   * @optional Object
			   * @default: {}
			   * any buttons shown in the dialog's footer
			   */
				buttons: {
					/**
				     * @required Object|Function
				     * 
				     * this first usage will ignore the `success` key
				     * provided and take all button options from the given object
				     */
					success: {
						/**
				       * @required String
				       * this button's label
				       */
						label: "Yes, I'm sure",
						className: 'btn-primary',
						callback: removeEntry
					},
					/**
				     * this usage demonstrates that if no label property is
				     * supplied in the object, the key is used instead
				     */
				    "Cancel": {
				      className: "btn-default",
				    },
				}
		});

		function removeEntry(){
			//find entry-number
			$(that).parent("form").parent("div").attr("entry-number");

			//send to model for removing
		}
	});

	//handle edit-form cancel 
	$(".cancel-btn").on("click",function(){
		// var target = "#" + $(this).attr("for"); //grab target
		var link = '#' + $(this).parent("form").attr("link");
		target = $(this).parent("form").parent("div");
		$(target).fadeOut(50);				 //close editable view
		$(target).find("form").trigger("reset"); //reset form
		$(target).find("a.remove-entry-link").hide(); //hide delete entry link
		//clear temporary data

		console.log(link);

		//repopulate the page

		$(".editable").fadeIn(50);  //debug only
		$(link).fadeIn();			//fade link items in
	});

	//enable add new 
	$(".add-btn").on("click",function(){
		var target = "#" + $(this).attr("for");	//grab target
		var forTarget = '#' + $(this).attr("edit"); //grab edit flag

		
		if(forTarget !== '#true') {
			//display edit view

			$(target).fadeIn(); //.css("display","block").
		} else {				//handle editview on add
			console.log(target);
			//NOTE: target should be the live view id, not edit view id
			$(target).find("div.editable").trigger("click");	
		}

	});

	//enable team member or skill deletion 
	$("ul.sortable").on("click","button.close",function(){

		//remove entry from model

		$(this).parent("li").remove();
	});

	//present checkbox
	$("#work-present-chk").on("click",function(){
								// console.log($(this).prop("checked"));
								if( $(this).prop("checked") ){
									$("#work-present").show();
									$("#work-end-time-explicit").css("visibility","hidden");
								} else {
									$("#work-present").hide();
									$("#work-end-time-explicit").css("visibility","visible");
								}
							});


	// $("#sortable").append("<li class=\"ui-state-default col-md-3\"><div class=\"team-member-block team-member-block-edit-view col-md-6\"><div class=\"team-member-block-description\"> <p>You</p></div></div><button type=\"button\" class=\"close\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></li>");


});
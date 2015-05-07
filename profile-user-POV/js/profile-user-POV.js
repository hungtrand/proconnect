$(document).ready(function() {

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

	// replaces newlines and break for html <br> ARCHIVED
	// function addHTMLBreak(text) {
	// 	console.log( text.replace(/\r?\n/g, '<br />') );
		
	// 	return ;
	// }
	
	//preview profile picture
	function readURL(input) {
	  if (input.files && input.files[0]) {
	   var reader = new FileReader();
	   reader.onload = function(e) {
		   $('#preview').attr('src', e.target.result);
		   $( "#picture-submit" ).trigger( "click" );
	   }

	   reader.readAsDataURL(input.files[0]);
	   }
    }

    $("#input-25").change(function() {
		readURL(this);
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
		$(target).fadeIn().find("form").attr( "link", $(this).attr("link") ).attr("editing","true");
		 
		setTimeout(function(){
			$(target).find('input:text, textarea, input:radio, input:checkbox, select').first().focus();
        }, 1);

		//move window to head of form for easy access
		var anchor = $(this).find("a.anchor").prop("href");
		// console.log(anchor);
		if(undefined != anchor) {
			window.location.href = anchor;
		}
	});
	
	//controls address field
	var country_options = $(".country-option");
	 for(var i = 0; i<country_options.length; i++){
		 country_options[i].addEventListener("click",function(){
			var value = this.value;
			if(value == "United States"){
				$(".us-group").show();
				$(".other-country-group").hide();
			}
			else{
				$(".us-group").hide();
				$(".other-country-group").show();
			}
		});
	}

	// create an instance of the StatesCitiesList
	 var sl = new StatesCitiesList();

	 // use getView method to get the html and append anywhere you want
	 $('#test').html(sl.getView());

	 // if you just want the data for the states just call method getStates()
	 states = sl.getStates();
	 // console.log(states);

	 // if you want data for the cities in json format for a particular state
	 // you can call method getCities() like this:
	 // method getCities() take two parameter, the state you want and a callback
	 // function than you want to execute after the cities data come back from ajax
	 sl.getCities('SC', function(cities_json) {
		// console.log(cities_json);
	 });
	
	//handle edit-form submition
	$(".editable-form").on("submit", function(e){
		e.preventDefault();

		if($("#skill-input").val() !== "") {			//form submission for new skills, NOT a save button event
			var data = $(this).serializeObject();	
			data["for-index"] = $(this).attr("for-index");

			var newSkill = $("#skill-input").val();
			var skillList = {};

			$.each($(this).find("ul#skill-list-edit li"),function(i,li){
				var skillName = $(li).find("span.skill-pill-name").text();
				var endorsementNum = $(li).find("span.badge").text();
				if(newSkill === skillName)
				{
					throw "skill already exist";
				}
				skillList[skillName] = endorsementNum;
			});
			// console.log("OMG" + $(this).siblings("div").next().find("ul").attr("id"));

			skillList[newSkill] = "";
			data["skill"] = skillList;

			user.tempAddNewSkill(data["skill"]);
			var editing = ($(this).attr("editing") === "true") ? true : false;

			if($("#skill-input").val() === "")
			{
				user.modifyData($(this), data, editing);
			}
			else
			{
				// user.updateCachedData($(this), data);
				user.updateEditForm($(this));
			}

			//add new skill
			

			//add new member entry to existing model

			//update Form

			//clear input text
			$("#skill-input").val("");
			//console.log("adding new skill");
		} else {									//all other form submission
			var data = $(this).serializeObject();	//grab data in json object format

			//for-index is used to reference which entry to edit, undefined if there isn't any
			data["for-index"] = $(this).attr("for-index");	//grab for-index, undefined if there isn't any

			if( $(this).parent("div").attr("id") === "skills-endorsements-edit") { //grabbing skill data
				var skillList = {};
				$.each($(this).find("ul#skill-list-edit li"),function(i,li){
					var skillName = $(li).find("span.skill-pill-name").text();
					var endorsementNum = $(li).find("span.badge").text();
					//console.log(skillName + ": " + endorsementNum);
					skillList[skillName] = endorsementNum;
				});
				data["skill"] = JSON.stringify(skillList);	// Convert to string for easy decoding in PHP

			} else if( $(this).parent("div").attr("id") === "project-edit" ) {		//grabbing team members
				// console.log("project-edit hellow");
				var memberList = {};
				$.each($(this).find("ul#project-team-list li"),function(i,li){
					var memName = $(li).find("span.skill-pill-name").text();

					// var imgURL = $(li).find("img").attr("src");	// may be unnecessary
					var memData = user.userData.projects[ data["for-index"] ]["team-member"][memName];
					memberList[memName] = memData;
				});
				data["team-member"] =  memberList
				// console.log(data["team-member"]);

			} 

			// console.log($(this).parent("div").attr("id"));

			//pass json object to model for processing
			try{ 
				FormValidator.validateForm($(this));				//validate this form according to form name

				var editing = ($(this).attr("editing") === "true") ? true : false;
				
				 //console.log(data);
				user.modifyData($(this),data,editing);	//modify data

			} catch(e) {
				user.showErrorInForm(e,$(this));
			}
		}

		$(function(){
    		$("[data-hide]").on("click", function(){
        		$("." + $(this).attr("data-hide")).hide();
    		});
		});
		
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
						callback: user.removeEntry($(that).parent("form"))
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

		// function removeEntry(){
		// 	// var index = .parent("div").attr("entry-number");

		// 	// console.log(user);
		// 	//send to model for removing
			
		// }
	});

	//handle edit-form cancel 
	$(".cancel-btn").on("click",function(){
		// var target = "#" + $(this).attr("for"); //grab target
		var link = '#' + $(this).parent("form").attr("link");
		target = $(this).parent("form").parent("div");
		$(target).fadeOut(50);				 //close editable view
		$(this).parent("form").trigger("reset"); //reset form
		$(target).find("a.remove-entry-link").hide(); //hide delete entry link
		//clear temporary data
		$(this).parent("form").attr("editing","false")

		//clear alert div
		$(this).siblings("div.alert").hide();

		//clear project member list
		if($(this).parent("form").find("ul.sortable").length > 0) {
			$(this).parent("form").find("ul.sortable > li").remove();
		}

		//turn off gif loader
		$(target).find("div.loading").hide();

		//repopulate the page
		$(".editable").fadeIn(50);  //show all editable components
		$(link).fadeIn();			//fade link items in
	});

	//enable add new 
	$(".add-btn").on("click",function(){

		var target = "#" + $(this).attr("for");	//grab target
		var forTarget = '#' + $(this).attr("edit"); //grab edit flag

		
		if(forTarget !== '#true') { 		//handle editview on add
			//display edit view
			$(target).find("form.editable-form").attr("for-index","new");
			$(target).find("form.editable-form").find('.DataID').val(0);
			$(target).find("form.editable-form").find('input:text, textarea').val('');
			$(target).find("form.editable-form").find('input:radio, input:checkbox').removeAttr('checked');
			$(target).find("form.editable-form").find('select').removeAttr('selected');
			$(target).fadeIn(); //.css("display","block").
			$(target).find('input:text, textarea, input:radio, input:checkbox, select').first().focus();
		} else {				
			//console.log(target);	//if add btn is doing an edit action 
			//NOTE: target should be the live view id, not edit view id
                
			$(target).find("div.editable").trigger("click");	
		}

		var anchor = $(this).siblings("a.anchor").prop("href");
		$(this).focus();
		if(undefined != anchor) {
			window.location.href = anchor;
		}

		// function checkDocumentHeight(callback){
		//     var lastHeight = document.body.clientHeight, newHeight, timer;
		//     console.log(lastHeight);
		//     (function run(){
		//         newHeight = document.body.clientHeight;
		//         if( lastHeight != newHeight )
		//             callback();
		//         lastHeight = newHeight;
		//         timer = setTimeout(run, 200);
		//     })();
		// }

		// function doSomthing(){
		//     console.log('height changed');
		//     $(".spacer").show();
		//     document.body.clientHeight += 200;
		// }

		// checkDocumentHeight(doSomthing);
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
	$('#change-image-block').on('click', function() {
		var uploader = new ProfileImageUploader($('.profile-image').attr('src'));
		uploader.onClose(function(newImagePath) {
			if (newImagePath.length > 0)
				$('.profile-image').attr('src', newImagePath);
		});

		$('body').append(uploader.getView());
	});

	$(document).on('scroll',function(e) {
		e.preventDefault();
		e.stopPropagation();
		console.log(e);
	})

	// replace textbox with CKEditor
	// CKEDITOR.replace("summary-textarea", {
	// 	toolbarGroups: [
	// 		//{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	// 		// { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	// 		//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
	// 		//{ name: 'forms' },
	// 		'/',
	// 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },
	// 		{ name: 'links' },
	// 		//{ name: 'insert' },
	// 		'/',
	// 		 { name: 'styles' },
	// 		// { name: 'colors' },
	// 		// { name: 'tools', groups: ['mode'] },
	// 		// { name: 'others' },
	// 		//{ name: 'about' }
	// 	]

	// 	// NOTE: Remember to leave 'toolbar' property with the default value (null).
	// });
});
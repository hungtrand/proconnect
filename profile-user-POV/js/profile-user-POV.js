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
	
	// //enable sortable
	// $(".sortable").sortable({
	// 	items: ':not(.no-sort)'
	// }).bind('sortupdate', function() {
 //    	//Triggered when the user stopped sorting and the DOM position has changed.
	// });
	
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
	});
	
		//controls address field
		var country_options = $(".country-option");
		 for(var i = 0; i<country_options.length; i++){
			 country_options[i].addEventListener("click",function(){
				var value = this.value;
				if(value == "United States"){
					$("#zipcode-group").show();
					$("#other-country-group").hide();
				}
				else{
					$("#zipcode-group").hide();
					$("#other-country-group").show();
				}
			});
		}
	
	//handle edit-form submition
	$(".editable-form").on("submit", function(e){
		
		e.preventDefault();

		if($("#project-team-members").val() !== ""){ //form submission for new members
			//add user to model 
			user.fetchMember($("#project-team-members").val());
			//store the original memberlist
			//add new member entry to existing model
			if(user.oMemberList === ""){
				
			}

			//update Form

			//clear input text
	 		$("#project-team-members").val("");//clear field
			console.log("adding new teammate");

		} else if($("#skill-input").val() !== "") {	//form submission for new skills
			//check for duplicate
			//add new skill 
			
			//update Form

			//clear input text
			$("#skill-input").val("");
			console.log("adding new skill");
		} else {									//all other form submission
			var data = $(this).serializeObject();	//grab data in json object format

			data["for-index"] = $(this).attr("for-index");	//grab for-index, undefined if there isn't any

			if( $(this).parent("div").attr("id") === "skills-endorsements-edit") { //grabbing skill data
				var skillList = {};
				// console.log($(this).find("ul#skill-list-edit"));
				$.each($(this).find("ul#skill-list-edit li"),function(i,li){
					var skillName = $(li).find("span.skill-pill-name").text();
					var endorsementNum = $(li).find("span.badge").text();
					console.log(skillName + ": " + endorsementNum);
					skillList[skillName] = endorsementNum;
				});
				data["skill"] = skillList;	
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
				validateForm($(this));				//validate this form according to form name

				var editing = ($(this).attr("editing") === "true") ? true : false;
				// console.log(data);
				$(this).siblings("div.loading").show();//show loading gif
					
				if(editing) {
					user.setData($(this),data);
				} else {
					user.addData($(this),data);
				}
				//reset form
				$(this).find("button.cancel-btn").trigger("click");
			} catch(e) {
				if(typeof(e) === "string") {
				
					//display error
				 	$(this).find(".alert-msg").text(e);
					$(this).find(".alert-danger").show();
					// console.log(e); //debug only
				} else {
					throw e;
				}
			}
		}
		
		$("a.remove-entry-link").hide(); //hide delete entry link
		

		//RETURNS NOTHING. BUT WILL THROW AN ERROR IF ANY FIELD IS WRONG	
		function validateForm(jQFormEle){ //NEED TO BE IMPLEMENTED
			var formName = jQFormEle.parent("div").attr("id");

			switch(formName){
				case "user-info-edit":
					console.log("user-info-edit");

					if(IsName($("#first-name-input").val()) === false){
						throw "Invalid First Name.";
					}

					if(IsName($("#last-name-input").val()) === false) {
						throw "Invalid Last Name."
					}

					if(IsName($("#middle-initial-input").val()) === false) {
						throw "Invalid Middle Initial."
					}

					if(IsEmail($("#email-input").val()) === false) {
						throw "Invalid Email.";
					}

					if(IsEmail($("#alt-email-input").val()) === false) {
						throw "Invalid Alternate Email.";
					}

					if(IsNumber($("#phone-input").val()) === false) {
						throw "Invalid Phone Number";
					}

					// console.log( jQFormEle.find(":input[required]:visible").css("border-color","red") );
				break;
				case "summary-edit":
					console.log("summary-edit");

					if(wordCount($("#summary-textarea").val()) > 1000) {
						throw "Maximum amount of characters have been reached." + wordCount($("#summary-textarea").val());
					}

				break;
				case "skills-endorsements-edit":
					console.log("skills-endorsements-edit");

					if($("#skill-list-edit li").length >= 50) {
						throw "You have reached the limit for adding skills.";
					}

					console.log($("#skill-list-edit li").length);

				break;//first-name-input
				case "experience-edit":
					console.log("experience-edit");

					if(IsNumber($("#work-start-year").val()) === false) {
						throw "Invalid Start Year.";
					}

					if(IsNumber($("#work-end-year").val()) === false) {
						throw "Invalid End Year.";
					}

					if(compareDate($("#work-start-month").val(), $("#work-end-month").val(), $("#work-start-year").val(), $("#work-end-year").val() )) {
						throw "Invalid Data Organization";
					}

				break;
				case "project-edit":
					console.log("project-edit");

					if(wordCount($("#project-description").val()) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount($("#project-description").val());
					}

				break;
				case "education-edit":
					console.log("education-edit");

					if(IsWord($("#school-name").val()) === false) {
						throw "Invalid School Name";
					}

					if(IsWord($("#degree").val()) === false) {
						throw "Invalid Degree Name";
					}

					if(IsWord($("#field-of-study").val()) === false) {
						throw "Invalid Field Of Study Name";
					}

					if(IsWord($("#grade").val()) === false) {
						throw "Invalid Grade Name";
					}

					if(compareYear($("#school-year-started").val(), $("#school-year-ended").val())) {
						throw "Invalid Date Organization";
					}

					if(wordCount($("#activities").val()) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount($("#project-description").val());
					}

					if(wordCount($("#education-description").val()) > 1000) {
						throw "Maximum amount of words have been reached." + wordCount($("#project-description").val());
					}

				break;
			}

			function wordCount(message)
			{
				var regex = /\s+/gi;
				var counter = message.trim().replace(regex, ' ').split(' ').length;
				return counter;
			}

			function compareYear(year1, year2)
			{
				if(parseInt(year1) < parseInt(year2)) {
					return false;
				}
				else {
					return true;
				}
			}

			function compareMonth(month1, month2)
			{
				if(parseInt(month1) < parseInt(month2)) {
					return false;
				}
				else {
					return true;
				}
			}

			function compareDate(month1, month2, year1, year2) {
				if(compareYear(year1, year2) === false) {
					return false;
				}
				else {
					if(compareMonth(month1, month2) === false)
					{
						return false;
					}
					else
					{
						return true;
					}
				}
			}

			function IsName(name) {
			var regex =/^[a-z ,.'-]+$/i;
				if(!regex.test(name)) {
				   	return false;
				}else{
				   	return true;
				}
			}

			function IsWord(word) {
				var regex = /^[a-z ,.']+$/;
				if(!regex.test(word)) {
					return false;
				}
				else {
					return true;
				}
			}

			function IsEmail(email) {
		        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		        if(!regex.test(email)) {
		           return false;
		        }else{
		           return true;
		        }
		    }

		    function IsNumber(number) {
		    	var regex = /^[0-9]+$/;
		    	if(!regex.test(number)) {
		    		return false;
		    	}
		    	else {
		    		return true;
		    	}
		    }
		}
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
		$(target).find("form").trigger("reset"); //reset form
		$(target).find("a.remove-entry-link").hide(); //hide delete entry link
		//clear temporary data
		$(this).parent("form").attr("editing","false")

		//console.log(link);

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
			$(target).fadeIn(); //.css("display","block").
		} else {				
			console.log(target);	//if add btn is doing an edit action 
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
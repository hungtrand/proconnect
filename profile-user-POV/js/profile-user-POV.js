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

				if(editing) {
					user.setData($(this),data);
				} else {
					user.addData($(this),data);
				}

			} catch(e) {
				if(typeof(e) === "string") {
					//display error
			 	$(this).find(".alert-msg").text(e);
				$(this).find(".alert-danger").show();

					console.log(e); //debug only
				} else {
					throw e;
				}
			}

			// console.log(data);
			$(this).siblings("div.loading").show();//show loading gif					
			//on success
			//turn off gif loader
			
		}
		
		$("a.remove-entry-link").hide(); //hide delete entry link
		

		//RETURNS NOTHING. BUT WILL THROW AN ERROR IF ANY FIELD IS WRONG	
		function validateForm(jQFormEle){ //NEED TO BE IMPLEMENTED
			var formName = jQFormEle.parent("div").attr("id");

			switch(formName){
				case "user-info-edit":
					// console.log("user-info-edit");
					if(IsName($("#first-name-input").val()) === false){
						throw "Invalid name.";
					}

					if(IsEmail($("#email-input").val()) === false){
						throw "Invalid email.";
					}

					// console.log( jQFormEle.find(":input[required]:visible").css("border-color","red") );
				break;
				case "summary-edit":
					console.log("summary-edit");

				break;
				case "skills-endorsements-edit":
					console.log("skills-endorsements-edit");

				break;first-name-input
				case "experience-edit":
					console.log("experience-edit");

				break;
				case "project-edit":
					console.log("project-edit");

				break;
				case "education-edit":
					console.log("education-edit");

				break;
			}
			// var first= that.FirstInput.val().trim();
			// var last = that.LastInput.val().trim();
			// var email= that.EmailInput.val().trim();
			// var password = that.PasswordInput.val(); 
			// var confpassword = that.ConfPasswordInput.val();

			
			// if(first== "" || IsName(first)==false){
			//     that.FirstInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			// 	that.Alert.text("Please enter valid first name");
			// 	that.Alert.show();
			// 	that.FirstInput.val("");

			//     return false;
			// }

			// if(last== "" || IsName(first)==false){
			//     that.LastInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			// 	that.Alert.text("Please enter valid last name");
			// 	that.Alert.show();
			// 	that.LastInput.val("");

			//     return false;
			// }

			// if(email== "" || IsEmail(email)==false){
			//     that.EmailInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			// 	that.Alert.text("Please enter a valid email address ");
			// 	that.Alert.show();
			// 	that.EmailInput.val("");

			//     return false;
			// }

			// if(password=="" || IsPassword(password)==false){
			//     that.PasswordInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			// 	that.Alert.text("Password has to be 6-20 in length ");
			// 	that.Alert.show();
			// 	that.PasswordInput.val("");

			//     return false;
			// }

			// if (password !== confpassword) {
			// 	that.ConfPasswordInput.css({"border": "3px solid rgba(184, 68, 66, 0.62)"});
			// 	that.Alert.text("The passwords don't match. Please type again. ");
			// 	that.PasswordInput.val("");

			// 	return false;
			// }

			// return true;

			function IsName(name) {
			var regex =/^[a-z ,.'-]+$/i;
				if(!regex.test(name)) {
				   	return false;
				}else{
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
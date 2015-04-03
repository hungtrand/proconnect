"use strict"
function User(){
	// this.personalInfo = {
	// 	"first-name":"",
	// 	"last-name":"",
	// 	"middle-initial":"",
	// 	"email-address":"",
	// 	"alt-email-address":"",
	// 	"phone-number":"",
	// 	"phone-number-type":"",
	// 	"user-address":"",
	// 	"summary":""
	// };
	// this.experiences = {
	// 	"0":{
	// 		"position-title":"place holder",
	// 		"company-name":"Company Name",
	// 		"company-location":"Location",
	// 		"work-start-month":"1",
	// 		"work-start-year":"asd",
	// 		"work-end-month":"",
	// 		"work-end-year":"",
	// 		"work-present":"current",
	// 		"experience-description":"something something something really long"
	// 	},
	// 	"1":{
	// 		"position-title":"place holder",
	// 		"company-name":"Company Name",
	// 		"company-location":"Location",
	// 		"work-start-month":"1",
	// 		"work-start-year":"asd",
	// 		"work-end-month":"",
	// 		"work-end-year":"",
	// 		"work-present":"current",
	// 		"experience-description":"something something something really long"
	// 	},
	// };
	// this.skills = Array("skill","skillssssssss","ski","skillasdasdasdwq asdasdasd","skill","skill","skill","skill");
	// this.projects = {
	// 	"0":{
	// 		"project-name":"ProConnect",
	// 		"project-url":"URL",
	// 		"team-member": {
	// 			"0":"me"
	// 		},
	// 		"project-description":""
	// 	},
	// 	"1":{
	// 		"project-name":"ProConnect",
	// 		"project-url":"URL",
	// 		"team-member": {
	// 			"0":"me"
	// 		},
	// 		"project-description":""
	// 	}

		
	// };
	// this.education = {
	// 	"0":{
	// 		"school-name":"Some value",
	// 		"degree":"Bachelor of Science (BS)",
	// 		"field-of-study":"Computer Science",
	// 		"grade":"SHIT",
	// 		"school-year-started":"",
	// 		"school-year-ended":"",
	// 		"activities":""
	// 	},
	// 	"1":{
	// 		"school-name":"Some value",
	// 		"degree":"Bachelor of Science (BS)",
	// 		"field-of-study":"Computer Science",
	// 		"grade":"SHIT",
	// 		"school-year-started":"",
	// 		"school-year-ended":"",
	// 		"activities":""
	// 	}
	// };
	this.userData = "";

	this.temporaryData = "";	// meant to hold any temporary data
	this.oMemberList = "";// meant to hold any temporary data
	this.oSkillList = "";// meant to hold any temporary data
}

User.prototype = {
	constructor: this,

	init:function() {
		this.fetchData();	//fetch data 
	},

	//talk to backend
	fetchData: function() { // START_HERE
		var that = this;
		//do an ajax call to get user data
		// console.log("doing ajax call");
		// var newData = {"some":"data"};

		$.ajax({
			url: "php/dummy.php",
			method: 'POST',
			contentType: 'text/plain',
			error: function(xhr,status,error) {
				bootbox.dialog({
						title: "<div style='text-align:center;'><b style='color:red;'>Error!</b></div>",
						message: "<div style='text-align:center;'><b>Please view the console for more detail.</b></div>",
						buttons: {
							"Close": {
								className: 'btn-primary'
							}
						}
					});
				console.log(status + ": " + error);
			}
		}).done(function(data){
			var succeeded = false;
			 // try{
					that.temporaryData = JSON.parse(data);
					console.log( that.temporaryData );
					that.userData = that.temporaryData; 	//store as user data
					succeeded = true;
			// } catch (e){
					// console.log("Error message: " + e);
					// console.log(data);
			// }
			if(succeeded) {
				that.updateView();
			}
		})
		// this.updateData(newData,true);
		// this.updateView();	
	}, 

	//accessor 
	//expected to return object about a member 
	fetchMember: function(name){

		console.log(name);

		//do an ajax call to fetch member object
		//if no member exist, still return an empty object



		// var template = {"template": {
		// 				//default icon
		// 				"icon-URL" : "https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_30x30_v1.png",
		// 				"direct-URL" : "", //url to the user if any
		// 				"snipet" : "some static smart guy"//snipet of member, e.g. job title, title, etc,
		// 			}
		// 		};
		// return template;

	},

	//mutator
	removeEntry: function(entryElement){
		//get entry index
		console.log(entryElement.attr("for-index"));

		//do an ajax call to the server to remove entry


		//on success, modify model
		//switch case for what entry this is
		//should only be for projects, experiences, and educations
	},

	//mutator - edit the existing entries
	setData: function(jQForm,newData){
		//do ajax call to modify existing data

		//update the user data
		var formName = jQForm.parent("div").attr("id");
		console.log(formName);


		/*switch(formName){
			case "user-info-edit": //update user info
				$.each(newData,function(k,newValue){
					$.each(that.userData.personalInfo,function(name,v){
						if(name === k) {
							// console.log("old data is: " + value);
							// console.log("new data is: " + v);
							that.userData.personalInfo[name] = newValue;
							// console.log(name + ": " + that.userData.personalInfo[name]);
							return false; //break out of the each loop
						}
					});
				});
			break;
			case "summary-edit":
				// console.log("summary-edit");
				$.each(newData,function(k,newValue){
					$.each(that.userData.personalInfo,function(name,v){
						if(name === k) {
							// console.log("old data is: " + value);
							// console.log("new data is: " + v);
							that.userData.personalInfo[name] = newValue;
							// console.log(name + ": " + that.userData.personalInfo[name]);
							return false; //break out of the each loop
						}
					});
				});
				// console.log(this.userData.personalInfo);
			break;
		}*/

		this.updateData(jQForm,newData);
		this.updateView();									//updata view
	},

	//mutator - add new entries
	addData: function(jQForm,newData){
		//do ajax call to add data to server

		//update the user data
		this.updateData(jQForm,newData);
		this.updateView();
	},

	/*
	 * update model 
	 * object - new data
	 * bool isNew - signal new data
	 * NOTE: This function does not handle data validation, the calling functions should handle.
	 */
	updateData: function(jQFormEle,newData) {
		// function addMembers(memberList,projObj) {
		// 	projObj["team-member"] = memberList;

		// 	// var temporaryMemList = projObj["team-member"];
		// 	// projObj["team-member"] = [];
		// 	// $.each(memberList,function(name,other){
		// 	// 	var memFound = false;
		// 	// 	$.each(temporaryMemList,function(oName,oData){ 
		// 	// 		if(name === oName){ 						//found user in existing data

		// 	// 			projObj["team-member"].push({name:oData});
		// 	// 			memFound = true;
		// 	// 			return false;
		// 	// 		} 
		// 	// 	});

		// 	// 	if(memFound === false) {
		// 	// 		projObj["team-member"].push({name:other});
		// 	// 	}

		// 	// });
		// }

		var that = this;
		var formName = jQFormEle.parent("div").attr("id");

		switch(formName){
			case "user-info-edit": //update user info
				$.each(newData,function(k,newValue){
					$.each(that.userData.personalInfo,function(name,v){
						if(name === k) {
							// console.log("old data is: " + value);
							// console.log("new data is: " + v);
							that.userData.personalInfo[name] = newValue;
							// console.log(name + ": " + that.userData.personalInfo[name]);
							return false; //break out of the each loop
						}
					});
				});
			break;
			case "summary-edit":
				// console.log("summary-edit");
				$.each(newData,function(k,newValue){
					$.each(that.userData.personalInfo,function(name,v){
						if(name === k) {
							// console.log("old data is: " + value);
							// console.log("new data is: " + v);
							that.userData.personalInfo[name] = newValue;
							// console.log(name + ": " + that.userData.personalInfo[name]);
							return false; //break out of the each loop
						}
					});
				});
				// console.log(this.userData.personalInfo);
			break;
			case "skills-endorsements-edit":
				// console.log("skills-endorsements-edit");
				// console.log(this.userData.skill);
				this.userData.skill = newData.skill;
				// console.log(newData);
				// console.log(this.userData.skill);
			break;
			case "experience-edit":
				var forIndex = newData["for-index"];
				delete newData["for-index"];
				if(forIndex === "new") {				//new entry
					this.userData.experiences[this.userData.experiences.length] = newData;
					// console.log(this.userData.experiences);
				} else if( /[0-9]/.test(forIndex) ) {	//edit entry
					// console.log(newData);

					if(newData['work-present'] === undefined) {	//work present was not selected
						that.userData.experiences[forIndex]['work-present'] = "";
					}

					$.each(newData,function(k,newValue){
						$.each(that.userData.experiences[forIndex],function(name,v){
							if(name === k) {
								// console.log("old data is: " + v);
								// console.log("new data is: " + newValue);
								that.userData.experiences[forIndex][name] = newValue;
								// console.log(name + ": " + that.userData.personalInfo[name]);
								return false; //break out of the each loop
							}
						});
					});
					// console.log(that.userData.experiences[forIndex]);
				} else {
					throw "Undefined 'for-index' variable.";
				}
 
			break;
			case "project-edit":
				// console.log("project-edit-edit");
				var forIndex = newData["for-index"];
				delete newData["for-index"];
				// var members = newData["team-member"];
				// delete newData["team-member"];		//delete so 

				if(forIndex === "new") {				//new entry
					that.userData.projects[that.userData.experiences.length] = newData;
					// addMembers(members,that.userData.projects[that.userData.experiences.length]);
					// console.log(this.userData.experiences);
				} else if( /[0-9]/.test(forIndex) ) {	//edit entry
					$.each(newData,function(k,newValue){
						$.each(that.userData.projects[forIndex],function(name,v){
							if(name === k) {
								that.userData.projects[forIndex][name] = newValue;
								return false; //break out of the each loop
							}
						});
					});
					// addMembers(members,that.userData.projects[forIndex]);
				} else {
					throw "Undefined 'for-index' variable.";
				}
				// console.log(that.userData.projects);
			break;
			case "education-edit":
				var forIndex = newData["for-index"];
				delete newData["for-index"];
				if(forIndex === "new") {				//new entry
					this.userData.education[this.userData.experiences.length] = newData;
					// console.log(this.userData.experiences);
				} else if( /[0-9]/.test(forIndex) ) {	//edit entry
					$.each(newData,function(k,newValue){
						$.each(that.userData.education[forIndex],function(name,v){
							if(name === k) {
								// console.log("old data is: " + v);
								// console.log("new data is: " + newValue);
								that.userData.education[forIndex][name] = newValue;
								// console.log(name + ": " + that.userData.personalInfo[name]);
								return false; //break out of the each loop
							}
						});
					});
				} else {
					throw "Undefined 'for-index' variable.";
				}
				// console.log(this.userData.education[forIndex]);
			break;
		}
	},

	//accessor
	loadEditForm: function(formWrapperID) {
		var form = $(formWrapperID).find("form"); 	//gather the form

		switch (formWrapperID) {
			case "#user-info-edit":

				// console.log(this.userData.personalInfo);
				//load values
				form.find("#first-name-input").val(this.userData.personalInfo["first-name"]);
				form.find("#last-name-input").val(this.userData.personalInfo["last-name"]);
				form.find("#middle-initial-input").val(this.userData.personalInfo["middle-initial"]);
				form.find("#email-input").val(this.userData.personalInfo["email-address"]);
				form.find("#alt-email-input").val(this.userData.personalInfo["alt-email-address"]);
				form.find("#phone-input").val(this.userData.personalInfo["phone-number"]);
				form.find("#phone-number-type").val(this.userData.personalInfo["phone-number-type"]);
				form.find("#zipcode-input").val(this.userData.personalInfo["zipcode"]);
				form.find("#country-name-input").val(this.userData.personalInfo["country-name"]);
				form.find("#postal-code-input").val(this.userData.personalInfo["postal-code"]);
				form.find("#address-input").val(this.userData.personalInfo["user-address"]);
			break;

			case "#summary-edit":
				form.find("[name='summary']").val(this.userData.personalInfo["summary"]);
			break;

			case "#skills-endorsements-edit":
				// console.log(formWrapperID + " index is: " + $(formWrapperID).find("form").attr("for-index"));
				var skillList = form.find("#skill-list-edit");
				var count = 0;
				var beans = "";
				$.each(this.userData.skill,function(skillName,endorsementNum){
				    beans += "<li entry-index='" + count + "' >" +
		                "<span class='badge'>" + endorsementNum + "</span> " +
		                "<span class='skill-pill-name'>" + skillName + "</span>" +
		                "<button type='button' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
		              "</li>";
		            count++;
	            });
				skillList.html(beans);
			break;

			case "#experience-edit":
				var index =  form.attr("for-index");
				// console.log(formWrapperID + " index is: " +index);
				var exp = this.userData.experiences[index];
				//console.log(exp);
				$("#position-title").val(exp['position-title']);
				$("#company-name").val(exp['company-name']);
				$("#company-location").val(exp['company-location']);
				$("#work-start-month").val(exp['work-start-month']);
				$("#work-start-year").val(exp['work-start-year']);

				if(exp['work-present'] === 'current'){
					$("#work-present-chk").trigger("click");
				} else {
					$("#work-end-month").val(exp['work-end-month']);
					$("#work-end-year").val(exp['work-end-year']);
				}

				$("#work-description").val(exp['experience-description']);
			break;

			case "#project-edit":
				// console.log(formWrapperID + " index is: " + $(formWrapperID).find("form").attr("for-index"));
				var index =  form.attr("for-index");
				var proj = this.userData.projects[index];
				var teamMembers = "";

				$("#project-name").val(proj['project-name']);
				$("#project-url").val(proj['project-url']);

				var userImgURL;

				
				if(proj['team-member'].length === 0) { //project just created
					// userImgURL = "https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_30x30_v1.png";
					teamMembers += "<li class='no-sort' index='" + 0 + "'>" +
		                "<img src='https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_30x30_v1.png'>" +
		                "<span class='skill-pill-name'>You</span>" +
		              "</li>";
				} else {
					var index = 0;
					$.each(proj['team-member'],function(name,detail){
						var closeBtn = (name === "You") ? "" : "<button type='button' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
						var classes = (name === "You") ? 'no-sort' : "";
						teamMembers += "<li class='" + classes + "' index='" + index + "'>" +
						                "<img src='" + detail['icon-URL'] + "'>" +
						                "<span class='skill-pill-name'>" + name + "</span>" +
						                closeBtn +
						              "</li>";
						index++;
					});

				}

				//START HERE
				//enable sortable - Needs to figure this out
				// $(".sortable").sortable({
				// 	items: ':not(.no-sort)'
				// }).bind('sortupdate', function() {
			 //    	//Triggered when the user stopped sorting and the DOM position has changed.
				// });

				// console.log(teamMembers);
				$("#project-team-list").html(teamMembers);
				
	     		$("#project-description").val(proj["project-description"]);

			break;

			case "#education-edit":
				// console.log(formWrapperID + " index is: " + $(formWrapperID).find("form").attr("for-index"));

				var index =  form.attr("for-index");
				var edu = this.userData.education[index];


				$("#school-name").val(edu["school-name"]);
				$("#degree").val(edu["degree"]);
				$("#field-of-study").val(edu["field-of-study"]);
				$("#grade").val(edu["grade"]);
				$("#school-year-started").val(edu["school-year-started"]);
				$("#school-year-ended").val(edu["school-year-ended"]);
				$("#activities").val(edu["activities"]);
				$("#education-description").val(edu["address"]);

			break;

			default: 
			break;
		}

	},

	//update view
	updateView: function(){
		 console.log("updateView " + this.userData.personalInfo["user-address"]);
		//update user info
		$(".first-name").text(this.userData.personalInfo["first-name"]);
		$("#user-mi").text(this.userData.personalInfo["middle-initial"]+'.');
		$("#user-last").text(this.userData.personalInfo["last-name"]);
		$("#user-address").text(this.userData.personalInfo["user-address"]).parent("cite").attr("title",this.userData.personalInfo["user-address"]);
		$("#user-email").text(this.userData.personalInfo["email-address"]);
		$("#user-phone").text(this.userData.personalInfo["phone-number"]);
		$("#user-home").text(this.userData.personalInfo["user-address"]);
		

		//update summary description
		if(this.userData.personalInfo["summary"] !== "") {
			// console.log(this.userData.personalInfo["summary"]);
			$("#user-summary").text(this.userData.personalInfo["summary"]);
		} else {
			// console.log(this.userData.personalInfo["summary"]);

			$("#user-summary").text("Say something about yourself!");
		}


		//update skill
		if (typeof(this.userData.skill)==="object"){
			$("#skill-title b").text("Top skills");	//show top skill
			$("#skill-top-list").html("").show();
			$("#skill-more-list").html("");
			$(".skill-more").hide();

			// console.log(this.userData.skill);
			var count = 0;
			$.each(this.userData.skill,function(key, value){
				// $.each(i,function(name,))
				if(count < 7){
					$("#skill-top-list").append("<li class=\"list-group-item\"><span class=\"badge colored-badge\">" + value + "</span>" + key + "</li>");
				} else {
					$(".skill-more").show();
					$("#skill-more-list").append("<div class='skill-bean'><span >" + key + " <span class=\"badge colored-badge\">" + value + "</span></span></div>");
				}
				count++;
			});
			
		} else {
			$("#skill-title b").text("Add your skills here...");  //show add skill
			$(".skill-more, #skill-top-list").hide();
		}
	
		//update eperiences
		//clear data form
		$("#user-experiences").html("");
		$.each(this.userData.experiences,function(i,exp){
			// $("#user-experiences").html("");

			// exp["company-location"]
			var endTime = (exp["work-present"] === "") ? exp["work-end-month"] + " " + exp['work-end-year'] : exp["work-present"];
			var workTime = exp['work-start-month'] + " " + exp['work-start-year'] + " &#8213 " + endTime;

			// console.log(workTime); index='" + i + "
			$("#user-experiences").append(
				"<div class=\"editable\" for=\"experience-edit\" index='" + i + "'>" +
					"<span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>" +
					"<h4>" + exp['position-title'] + "</h4>" + 
		          	"<h5>" + exp['company-name'] + "</h5>" +
 		          	"<h5>" + workTime + "</h5>" + 
		          	"<p>" + exp['experience-description'] + "</p>" +
	        	"</div>");

		});
		

		//update projects
		//clear displaying entries
		$("#user-projects").html("");
		$.each(this.userData.projects,function(key,proj){

			//format project title
			var projTitle = (proj['project-url'] === "") ? proj['project-name'] : '<a href="' + proj['project-url'] + '">' + proj['project-name'] +'</a>';

			var teamMemberBlock = "";

			var memberCount = 0;
			$.each(proj['team-member'],function(i,v){
				memberCount++;
			});

			if(memberCount > 1) { //there is more than 1 user other than default
				var memberBlocks = "";


				$.each(proj['team-member'],function(name,member){
					var memberName = (member['direct-URL'] === "") ? "<b>" + name + "</b>" : "<a href='" + member['direct-URL'] + "'>" + name + "</a>";
					memberBlocks += "<div class='team-member-block col-md-6'>" +
	                  "<div class='col-md-2'>" +
	                    "<img src='" + member['icon-URL'] + "' class='team-member-mini-image'>" +
	                  "</div>"+
	                  "<div class='team-member-block-description col-md-10'>" + 
	                    memberName + 
	                    "<br>" +
	                    "<p>" + member['snipet'] + "</p>"+
	                  "</div>" +
	                "</div>";
				});

				// console.log(memberBlocks);
				teamMemberBlock = "<div class='team-members-container row' name='team-members' id='elmo" + key+ "'>" + memberBlocks + "</div>"
			}

			$("#user-projects").append(
            "<div>" + 
              "<div class='editable' for='project-edit' link='" + 'elmo' + key +  "' index='" + key + "'>" + 
                "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>" +
                "<h4>" + projTitle + "</h4>" +
                "<p name='description'>" + proj['project-description'] +"</p>" +
              "</div>" + teamMemberBlock +
            "</div>");

		});

		//update education
		//clear displaying entries
		$("#user-education").html("");
		$.each(this.userData.education,function(key,edu){
			var schoolTime = (edu["school-year-ended"] === "") ? edu["school-year-started"] : 
																 edu["school-year-started"] + " &#8213 " + edu["school-year-ended"];
			// console.log(schoolTime);
			$("#user-education").append(
		   "<div class='editable' for='education-edit' index='" + key + "'>" + 
              "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>" +
              "<h4>" + edu['school-name'] + "</h4>" +
              "<h5>" + edu['degree'] + "<span> " + edu['grade'] + "</span></h5>" +
              "<h5>" + schoolTime + "</h5>" +
              "<h5>" + edu['field-of-study'] + "</h5>" +
              "<p>" + edu['education-description']+ "</p>" +
              "<h5 style='color:#888';>Activities and Societies:</h5>" +
              "<p>" + edu['activities'] + "</p>" +
            "</div>" +
          "</div>" );
		});

	}

}


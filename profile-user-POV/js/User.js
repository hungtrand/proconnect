"use strict"
function User(){
	this.personalInfo = {
		"first-name":"",
		"last-name":"",
		"middle-initial":"",
		"email-address":"",
		"alt-email-address":"",
		"phone-number":"",
		"phone-number-type":"",
		"address":"",
		"summary":""
	};
	this.experiences = {
		"0":{
			"position-title":"place holder",
			"company-name":"Company Name",
			"company-location":"Location",
			"work-start-month":"1",
			"work-start-year":"asd",
			"work-end-month":"",
			"work-end-year":"",
			"work-present":"current",
			"experience-description":"something something something really long"
		},
		"1":{
			"position-title":"place holder",
			"company-name":"Company Name",
			"company-location":"Location",
			"work-start-month":"1",
			"work-start-year":"asd",
			"work-end-month":"",
			"work-end-year":"",
			"work-present":"current",
			"experience-description":"something something something really long"
		},
	};
	this.skills = Array("skill","skillssssssss","ski","skillasdasdasdwq asdasdasd","skill","skill","skill","skill");
	this.projects = {
		"0":{
			"project-name":"ProConnect",
			"project-url":"URL",
			"team-member": {
				"0":"me"
			},
			"project-description":""
		},
		"1":{
			"project-name":"ProConnect",
			"project-url":"URL",
			"team-member": {
				"0":"me"
			},
			"project-description":""
		}

		
	};
	this.education = {
		"0":{
			"school-name":"Some value",
			"degree":"Bachelor of Science (BS)",
			"field-of-study":"Computer Science",
			"grade":"SHIT",
			"school-year-started":"",
			"school-year-ended":"",
			"activities":""
		},
		"1":{
			"school-name":"Some value",
			"degree":"Bachelor of Science (BS)",
			"field-of-study":"Computer Science",
			"grade":"SHIT",
			"school-year-started":"",
			"school-year-ended":"",
			"activities":""
		}
	};
	this.userData = "";
	this.temporaryData = "";	// meant to hold any temporary data
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
		// this.modifyData(newData,true);
		// this.updateView();	
	}, 

	//mutator
	setData: function(newData){
		//do ajax call to modify existing data
		this.modifyData(newData,false);
		// this.updateView();
	},

	//mutator
	addData: function(newData){
		//do ajax call to add data 
		this.modifyData(newData,true);
		// this.updateView();
	},

	/*
	 * object - new data
	 * bool isNew - signal new data
	 */
	modifyData: function(newData,isNew) {
		console.log(newData);
		console.log("modifyData");
		//modify current data
	},

	//accessor
	loadEditForm: function(formWrapperID) {
		var form = $(formWrapperID).find("form"); 	//gather the form

		switch (formWrapperID) {
			case "#user-info-edit":
				//load values
				form.find("#first-name-input").val(this.userData.personalInfo.userFirst);
				form.find("#last-name-input").val(this.userData.personalInfo.userLast);
				form.find("#middle-initial-input").val(this.userData.personalInfo.userMI);
				form.find("#email-input").val(this.userData.personalInfo.userEmail);
				form.find("#alt-email-input").val(this.userData.personalInfo.userAltEmail);
				form.find("#phone-input").val(this.userData.personalInfo.userPhoneNumber);
				form.find("#phone-number-type").val(this.userData.personalInfo.userPhoneNumberType);
			break;

			case "#summary-edit":
				form.find("[name='user-description']").val(this.userData.personalInfo.userSummary);
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
				console.log(formWrapperID + " index is: " +index);
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

				//START HERE

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

				console.log(teamMembers);
				$("#project-team-list").html(teamMembers);
				
	     		$("#project-description").val(proj["project-description"]);

			break;

			case "#education-edit":
				console.log(formWrapperID + " index is: " + $(formWrapperID).find("form").attr("for-index"));

				var index =  form.attr("for-index");
				var edu = this.userData.education[index];


				$("#school-name").val(edu["school-name"]);
				$("#degree").val(edu["degree"]);
				$("#field-of-study").val(edu["field-of-study"]);
				$("#grade").val(edu["grade"]);
				$("#school-year-started").val(edu["school-year-started"]);
				$("#school-year-ended").val(edu["school-year-ended"]);
				$("#activities").val(edu["activities"]);
				$("#education-description").val(edu["education-description"]);

			break;

			default: 
			break;
		}

	},

	//update view
	updateView: function(){
		console.log("updateView " + this.userData.personalInfo.userFirst);
		//update user info
		$(".first-name").text(this.userData.personalInfo.userFirst);
		$("#user-mi").text(this.userData.personalInfo.userMI+'.');
		$("#user-last").text(this.userData.personalInfo.userLast);
		$("#user-address").text(this.userData.personalInfo.userAddress).parent("cite").attr("title",this.userData.personalInfo.userAddress);
		$("#user-email").text(this.userData.personalInfo.userEmail);
		$("#user-phone").text(this.userData.personalInfo.userPhoneNumber);
		$("#user-home").text(this.userData.personalInfo.userAddress);

		//update summary description
		if(this.userData.personalInfo.userSummary !== "") {
			$("#user-summary").text(this.userData.personalInfo.userSummary);
		} else {
			$("#user-summary").text("Say something about yourself!");
		}


		//update skill
		if (typeof(this.userData.skill)==="object"){
			$("#skill-title b").text("Top skills");	//show top skill
			$("#skill-top-list").show();
			$(".skill-more").hide();

			console.log(this.userData.skill);
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
		// $("#user-experiences").append();
		$.each(this.userData.experiences,function(i,exp){
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


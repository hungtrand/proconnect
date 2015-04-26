"use strict"
function PublicUser(){
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
}

PublicUser.prototype = {
	constructor: this,

	init:function() {
		this.fetchData();	//fetch data 
	},

	//grab data from URL
	queryString: function () {
		  var query_string = {};
		  var query = window.location.search.substring(1);
		  var vars = query.split("&");
		  for (var i=0;i<vars.length;i++) {
		    var pair = vars[i].split("=");
		        // If first entry with this name
		    if (typeof query_string[pair[0]] === "undefined") {
		      query_string[pair[0]] = pair[1];
		        // If second entry with this name
		    } else if (typeof query_string[pair[0]] === "string") {
		      var arr = [ query_string[pair[0]], pair[1] ];
		      query_string[pair[0]] = arr;
		        // If third or later entry with this name
		    } else {
		      query_string[pair[0]].push(pair[1]);
		    }
		  } 
	    return query_string;
	},

	//talk to backend to get initiate a user data object
	fetchData: function() { 
		var that = this;
		// console.log("doing ajax call");
		// var newData = {"some":"data"};

		//do an ajax call to get user data
		$.ajax({
			url: "php/Profile_controller.php",
			// url: "php/dummy.php",
			method: 'POST',
			data: that.queryString(),   			// <----------- data is {"userID": 11111} 
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
	}, 

	//update view
	updateView: function(){
		var that = this;
		//update user info
		 $('#preview').attr('src', this.userData.personalInfo["picture"]);
		$(".first-name").text(this.userData.personalInfo["first-name"]);
		$("#user-mi").text(this.userData.personalInfo["middle-initial"]+'.');
		$("#user-last").text(this.userData.personalInfo["last-name"]);
		$("#user-address").text(this.userData.personalInfo["user-address"]["address-input"]);
			$("#user-address").append(" ");
			$("#user-address").append(this.userData.personalInfo["user-address"]["country-input"]);
		$("#user-email").text(this.userData.personalInfo["email-address"]);
		$("#user-phone").text(this.userData.personalInfo["phone-number"]);
		$("#user-home").text(this.userData.personalInfo["phone-number"]);

		

		//update summary description
		if(this.userData.personalInfo["summary"] !== "") {
			// console.log(this.userData.personalInfo["summary"]);
			$("#user-summary").text(this.userData.personalInfo["summary"]);
		} else {
			// console.log(this.userData.personalInfo["summary"]);

			$("#user-summary").text("Say something about yourself!");
		}

		//update skill
		if ($.isEmptyObject(this.userData.skill) === false){ //if not an empty object
			$("#skill-title b").text("Top skills");	//show top skill
			$("#skill-top-list").html("").show();
			$("#skill-more-list").html("");
			$(".skill-more").hide();

			// console.log(this.userData.skill);
			var count = 0;
			$.each(this.userData.skill,function(key, value){
				// $.each(i,function(name,))

				//check for 0 value
				value = (value == 0) ? "" : value;

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
					// "<span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>" +
					"<h3>" + exp['position-title'] + "</h3>" + 
		          	"<h4>" + exp['company-name'] + "</h4>" +
 		          	"<h5>" + workTime + "</h5>" + 
		          	"<p>" + exp['experience-description'] + "</p>" +
	        	"</div>");
			if(parseInt(i) < that.userData.experiences.length-1) {
				$("#user-experiences").append("<hr>");
			}

		});

		//clear displaying entries
		$("#user-projects").html("");
		//update projects
		$.each(this.userData.projects,function(key,proj){

			// console.log();
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
                // "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>" +
                "<h3>" + projTitle + "</h3>" +
                "<p name='description'>" + proj['project-description'] +"</p>" +
              "</div>" + teamMemberBlock +
            "</div>");

            //add horizontal line
			if(parseInt(key) < that.userData.projects.length-1) {
				$("#user-projects").append("<hr>");
			}

		});
	
		//clear displaying entries
		$("#user-education").html("");
		//update education
		$.each(this.userData.education,function(key,edu){
			var schoolTime = (edu["school-year-ended"] === "") ? edu["school-year-started"] : 
																 edu["school-year-started"] + " &#8213 " + edu["school-year-ended"];
			// console.log(schoolTime);
			$("#user-education").append(
								   "<div class='editable' for='education-edit' index='" + key + "'>" + 
						              // "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>" +
						              "<h3>" + edu['school-name'] + "</h3>" +
						              "<h4>" + edu['degree'] + "<span> " + edu['grade'] + "</span></h4>" +
						              "<h4>" + edu['field-of-study'] + "</h4>" +
						              "<h5>" + schoolTime + "</h5>" +
						              "<p>" + edu['education-description']+ "</p>" +
						              "<h5 style='color:#888';>Activities and Societies:</h5>" +
						              "<p>" + edu['activities'] + "</p>" +
						            "</div>" +
						          "</div>" );

			if(parseInt(key) < that.userData.education.length-1) {
				$("#user-education").append("<hr>");
			}
		});

	},

	// throw error for specific form
	showErrorInForm:function(error,jQueryForm) {
		if(typeof(error) === "string") {
			//display error
		 	jQueryForm.find(".alert-msg").text(error);
			jQueryForm.find(".alert-danger").show();
			// console.log(e); //debug only
		} else {
			throw error;
		}
	},

}


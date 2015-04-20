<?php
error_reporting(E_ALL); // debug
ini_set("display_errors", 1); // debug
// include '../signout/php/session_check_signout.php';

//$UData = json_decode($_SESSION['__USERDATA__'], true);
//$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];


  $page_title = "Edit Profile"; //require for front end
  include '../header/header.php';
?>

    <div id="main-container" class="container-fluid">
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
              <div class="well well-sm">
                  <div class="row normal-view">
                   
<<<<<<< HEAD
					<div id="profile-image-block" class="col col-sm-6 col-md-4 col-lg-3">
						<div id="progress-block" style= "z-index: 1;">
							<div class="progress">
							  <div id="img-progress-bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
								<span class="sr-only"></span>
							  </div>
							</div>
						</div>
                          <div id="profile-image" class="outer-ref" >
                           <img src="/image/user_img.png" alt="" class="img-responsive profile-image img-rounded" id="preview"/>
              							<div id="picture-edit">
              								<form class="editable-form">
              									<a id="change-image-block"> 							                        
              									 <span id="glyphicon-picture" class="glyphicon glyphicon-picture" aria-hidden="true"></span>
              									 <span id="change-photo-text">Change Photo</span>
              									</a>
              								</form>
              							</div>
                          </div>
						  
=======
            					<div id="profile-image-block" class="col col-sm-6 col-md-4 col-lg-3">
            						<div id="progress-block" style= "z-index: 1;">
            							<div class="progress">
            							  <div id="img-progress-bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            								<span class="sr-only"></span>
            							  </div>
            							</div>
            						</div>
                        <div id="profile-image" class="outer-ref" >
                         <img src="/image/user_img.png" alt="" class="img-responsive profile-image" id="preview"/>
            							<div id="picture-edit">
            								<form class="editable-form">
            									<div id="change-image-block" type = "file"> 							                        
            									 <span id="glyphicon-picture" class="glyphicon glyphicon-picture" aria-hidden="true"></span>
            									 <span id="change-photo-text">Change Photo</span>
            									 <input id= "input-25" type= "file" class>
            									 <button type="submit" id = "picture-submit"class="btn btn-primary save-btn" value="save" style = "display: none;">Save</button>
            									</div>
            								</form>
            							</div>
                        </div>
>>>>>>> UI2
                      </div>
							
                      <div class="col-sm-6 col-md-8 editable" for="user-info-edit">
                          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>

                          <h4><span id="user-first" class="first-name"></span> <span id="user-mi"></span> <span id="user-last"></span></h4>
                          <small><cite title=""><span id="user-address"></span><i class="glyphicon glyphicon-map-marker">
                          </i></cite></small>
                          <p>
                              <i class="glyphicon glyphicon-envelope"></i><span id="user-email"></span>
                              <br />
                              <!-- <i class="glyphicon glyphicon-globe"></i><span id><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a></span>
                              <br /> -->
                              <i class="glyphicon glyphicon-phone"></i><span id="user-phone">phone #</span>
                              <br />
                               <i class="glyphicon glyphicon-home"></i><span id="user-home">somewhere someplace</span>
                              <br />
                              <!-- <i class="glyphicon glyphicon-education"></i><span id="user-education">somewhere someplace</span>
                              <br /> -->
                          </p>
                          
                      </div>
                      <div class="col-sm-6 col-md-8">
                      <!-- Split button -->
                          <div class="btn-group">
                              <button type="button" class="btn btn-primary">
                                  Social</button>
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span><span class="sr-only">Social</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="#">Twitter</a></li>
                                  <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                  <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                  <li class="divider"></li>
                                  <li><a href="#">Github</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <br>

                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-hide="alert" aria-label="Close"><span class="dimissible-color"aria-hidden="true">&times;</span></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                    <span class="alert-msg"></span>
                  </div>

                  <!-- User Info -->
                  <div id="user-info-edit" class="edit-view">
                        <div class="loading">
                          <img src="../image/ajax-loader.gif">
                        </div>
                        <form class="editable-form" method="POST" action="php/Profile_controller.php">
                          <!-- Error Alert -->
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            <span class="alert-msg"></span>
                          </div>
                          <!-- User Name -->
                          <div class="form-group form-inline">
                            <div class="form-group">
                              <label for="first-name-input">First</label>
                              <abbr title="Required" class="required">*</abbr>
                              <input name="first-name" type="text" class="form-control" id="first-name-input" placeholder="First" required>
                            </div>
                            <div class="form-group">
                              <label for="last-name-input">Last</label>
                              <abbr title="Required" class="required">*</abbr>
                              <input name="last-name" type="text" class="form-control" id="last-name-input" placeholder="Last" required>
                            </div>
                            <div class="form-group">
                              <label for="middle-initial-input">M.I.</label>
                              <input name="middle-initial" type="text" class="form-control" id="middle-initial-input" placeholder="M.I." style="width:50px;" maxlength="1">
                            </div>
                          </div>
                          <!-- Email Address -->
                           <div class="form-group">
                            <label for="email-input">Email</label>
                            <abbr title="Required" class="required">*</abbr>
                            <input name="email-address" type="text" class="form-control" id="email-input" value="" required>
                          </div>
                          <!-- Alternate Email Address -->
                           <div class="form-group">
                            <label for="alt-email-input">Alternate Email</label>
                            <input name="alt-email-address" type="text" class="form-control" id="alt-email-input" value="">
                          </div>
                          <!-- Phone -->
                          <label for="phone-input">Phone</label>
                          <div class="form-group form-inline">
                            <input name="phone-number" type="text" class="form-control" id="phone-input" placeholder="#(###) ###-#### ">
                           
                          <div class="form-group">
                              <select class="form-control" id="phone-color" name="phone-type">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                                <option value="Mobile">Mobile</option>
                              </select>
                            </div>
                          </div>

                          <!-- Address -->
                         <div class="form-group">				
							<label for="country">Country</label> <br />
							 <label class="radio-inline">
							  <input class= "country-option" type="radio" name="inlineRadioOptions-country" id="inlineRadio1-country" value="United States" checked> United States
							</label>
							<label class="radio-inline">
							  <input class= "country-option" type="radio" name="inlineRadioOptions-country" id="inlineRadio2-country" value="Other" > Other
							</label>
						</div>
						
						<div class="form-group" id="zipcode-group" >
							<label for="zipcode">Zip Code</label> <br />
							<input class="form-control" id="zipcode-input" type="text" name="zipcode" placeholder="Zip Code">
						</div>
						
						<div id = "other-country-group" style = "display: none;">
						<div class="form-group" id="countryname-group" >
							<input class="form-control" id="country-name-input" type="text" name="country-name" placeholder="Country">
						</div>
						<div class="form-group" id="postalcode-group" >
							<label for="postal-code">Postal Code</label> <br />
							<input class="form-control" id="postal-code-input" type="text" name="postal-code" placeholder="Postal Code">
						</div>
						</div>

						<div class="form-group">
							<label for="address">Address</label> <br />
							<input class="form-control" id="address-input" type="text" name="address" placeholder="Address">
						</div>
                        
							<button type="submit" class="btn btn-primary save-btn" value="save">Save</button>
                          <button type="button" class="btn btn-default cancel-btn" value="cancel" for="user-info-edit">Cancel</button>
                        </form>  
                      </div>
                      
                  </div>
              <!-- <div class="add-star">
                <button id="user-info-edit-btn">Edit Info</button>
              </div> -->
          </div>
      </div>

      <!-- Summary -->
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">

              <div class="well well-sm ">
                  <header>
                        <h2>Summary</h2>
                  </header>


                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-hide="alert" aria-label="Close"><span class="dimissible-color"aria-hidden="true">&times;</span></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                    <span class="alert-msg"></span>
                  </div>

                  <div id="summary-description" class="normal-view" > 
                    <div class="editable" for="summary-edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <p id="user-summary"></p>
                    </div>
                  </div>
                  <div id="summary-edit" class="edit-view" action="php/Education_controller.php" >
                    <div class="loading">
                        <img src="../image/ajax-loader.gif">
                      </div>
                    <!-- <b><h4>Summary</h4></b> -->
                    <form class="editable-form" action="php/Summary_controller.php">
                      <!-- Error Alert -->
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <span class="alert-msg"></span>
                      </div>
                      <textarea name="summary" class="form-control" id="summary-textarea" rows="10"></textarea> <br><br>
                      <button type="submit" class="btn btn-primary save-btn">Save</button>
                      <button type="button" class="btn btn-default cancel-btn">Cancel</button>
                    </form>
                  </div>
              </div>
              
              <div class="add-star" >
                <button  class="add-btn" for="summary-description" edit="true" >Edit Summary</button>
              </div>
          </div>
      </div>

      <!-- Skills -->
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">

              <div class="well well-sm ">
                  <header>
                        <h2>Skills and Endorsements</h2>
                  </header>
                  <!-- Success message goes here -->

                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-hide="alert" aria-label="Close"><span class="dimissible-color"aria-hidden="true">&times;</span></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                    <span class="alert-msg"></span>
                  </div>

                  <!-- normal-view -->
                  <div id="skills-endorsements" class="normal-view "> 
                    <div class="editable" for="skills-endorsements-edit">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                     
                      <div class="panel panel-default ">
                        <!-- Default panel contents -->
                        <!-- List group -->
                          <div id="skill-title" class="panel-heading"><b></b></div>

                          <ul id="skill-top-list" class="list-group">
                            <!-- <li class="list-group-item "><span class="badge colored-badge">12</span>Cras justo odio</li> -->
                          </ul> 

                          <div id="skill-more-title" class="panel-footer skill-more">
                            <b><span class="first-name"></span> also know about...</b>
                          </div>

                          <!-- Default panel contents -->
                          <!-- List group -->
                          
                          <div id="skill-more-list" class="panel-body skill-more">
                            
                          </div>
                      </div>
                    </div>  
                  </div>


                  <!-- edit-view -->
                  <div id="skills-endorsements-edit" class="edit-view " > 
                    <div class="loading">
                      <img src="../image/ajax-loader.gif">
                    </div>
                    <!-- <b><h4>Summary</h4></b> -->
                    <form class="editable-form" action="php/Skill_controller.php">
                      <input id="SkillID" name="SkillID" class="DataID" type="hidden" value="" />
                      <!-- Error Alert -->
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <span class="alert-msg"></span>
                      </div>

                      <div class="form-group">
                        <input name="skill" type="text" class="form-control typeahead" id="skill-input" placeholder="What are you areas of expertise?">
                      </div>  


                      <div class="playground form-group well well-sm"> <!-- contentEditable="true" -->

                        <ul id="skill-list-edit" class="sortable grid">
                          <!-- <li entry-index="" >
                            <span class="badge">12</span>
                            <span class="skill-pill-name">asda</span>
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </li> -->
                        </ul>
                      </div>
                      <b style="float:right">Drag to reorder</b>
                      <button type="submit" class="btn btn-primary save-btn">Save</button>
                      <button type="button" class="btn btn-default cancel-btn">Cancel</button>
                    </form>
                  </div>
                  
              </div>
              
              <div class="add-star" >
                <button id="skills-endorsements-edit-btn" class="add-btn" for="skills-endorsements" edit="true">Add Skill</button>
              </div>
          </div>
      </div>

      <!-- Experience -->
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
              <div class="well well-sm">
                  <header>
                    <h2>Experience</h2>
                  </header>

                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-hide="alert" aria-label="Close"><span class="dimissible-color"aria-hidden="true">&times;</span></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                    <span class="alert-msg"></span>
                  </div>

                  <div id="experience-edit" class="edit-view" entry-number="">
                    <div class="loading">
                        <img src="../image/ajax-loader.gif">
                      </div>
                    <form class="editable-form" action="php/Experience_controller.php">
                      <input id="ExpID" name="ExpID" class="DataID" type="hidden" value="" />
                      <!-- Error Alert -->
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <span class="alert-msg"></span>
                      </div>
                      <!-- Position Title -->
                      <div class="form-group ">
                        <label for="position-title">Position Title</label>
                        <abbr title="Required" class="required">*</abbr>
                        <input name="position-title" type="text" class="form-control" id="position-title" required>
                      </div>
                      <!-- Company Name -->
                       <div class="form-group ">
                        <label for="company-name">Company Name</label>
                        <abbr title="Required" class="required">*</abbr>
                        <input name="company-name" type="text" class="form-control" id="company-name" required>
                      </div>
                      <!-- Location -->
                      <div class="form-group ">
                        <label for="company-location">Location</label>
                        <input name="company-location" type="text" class="form-control" id="company-location" >
                      </div>

                      <!-- Time Period -->
                      <label for="work-start-month">Time Period</label>
                      <abbr title="Required" class="required">*</abbr>
                      <div class="form-group form-inline ">
                        <select name="work-start-month" type="month" class="form-control" id="work-start-month" required> 
                          <option value>Choose...</option>
                          <option value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                        <input name="work-start-year" type="text" class="form-control short-input" id="work-start-year" placeholder="Year" maxlength="4" required> &#8213 

                        <div class="form-group work-time-right-block">
                          <span id="work-present"> current</span>

                          <div id="work-end-time-explicit" >
                            <select name="work-end-month" type="month" class="form-control" id="work-end-month"> 
                              <option value>Choose...</option>
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                            <input name="work-end-year" type="text" class="form-control short-input" id="work-end-year" placeholder="Year" maxlength="4"><br>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input id="work-present-chk" name="work-present" type="checkbox" value="current">
                              I currently work here.
                            </label>
                          </div> 
                        </div>
                      </div>

                      <!-- Description -->
                      <label for="work-description">Description</label>
                      <textarea id="work-description" class="form-control" rows="5" name="experience-description"></textarea> 
                      <br><br>
                      <button type="submit" class="btn btn-primary save-btn">Save</button>
                      <button type="button" class="btn btn-default cancel-btn">Cancel</button>
                      <a class="remove-entry-link" href="#" >Remove this entry.</a>
                    </form>  
                  </div>
                  <div id="user-experiences" class="normal-view outer-ref">
                  </div>
              </div>
              <div class="add-star">
                <button class="add-btn" for="experience-edit">Add Eperience</button>
              </div>
          </div>
      </div>

       <!-- Project-->
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
              <div class="well well-sm">
                  <header>
                    <h2>Projects</h2>
                  </header>

                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-hide="alert" aria-label="Close"><span class="dimissible-color"aria-hidden="true">&times;</span></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                    <span class="alert-msg"></span>
                  </div>

                  <div id="project-edit" class="edit-view" entry-number="">
                    <div class="loading">
                      <img src="../image/ajax-loader.gif">
                    </div>
                    <form class="editable-form" action="php/Project_controller.php">
                      <input id="ProjectID" name="ProjectID" class="DataID" type="hidden" value="0" />
                      <!-- Error Alert -->
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <span class="alert-msg"></span>
                      </div>
                      <!-- Project Name -->
                      <div class="form-group ">
                        <label for="project-name">Name</label>
                        <abbr title="Required" class="required">*</abbr>
                        <input name="project-name" type="text" class="form-control" id="project-name" required>
                      </div>
                      <!-- Project URL -->
                       <div class="form-group ">
                        <label for="project-url">Project URL</label>
                        <input name="project-url" type="text" class="form-control" id="project-url">
                      </div>
                      <!-- Team Members -->
                      <!--<label for="project-team-members">Team Members</label>
                      
                      <div id="project-team-editable-block" class="form-group well well-sm"> 

                        <ul id="project-team-list" class='sortable grid'>  
                          <li class='no-sort' index='0'>
                            
                            <img src="https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_30x30_v1.png">
                            <span class="skill-pill-name">You</span>
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                          </li>
                          <li index='0'>
                            
                            <img src="https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_30x30_v1.png">
                            <span class="skill-pill-name">You</span>
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                          </li>
                        </ul>

                      
                        <input name="new-member-name" type="text" class="form-control" id="project-team-members" placeholder="+Add Member"> 
                        

                      </div> -->

                      <!-- Project Description -->
                      <label for="project-description">Description</label>
                      <textarea name="project-description" id="project-description" class="form-control" rows="5"></textarea> <br><br>

                      <button type="submit" class="btn btn-primary save-btn">Save</button>
                      <button type="button" class="btn btn-default cancel-btn">Cancel</button>
                      <a class="remove-entry-link" href="#" >Remove this entry.</a>
                    </form>  
                  </div>
                  <div id="user-projects" class="normal-view">
                    <!-- <div>
                      <div class="editable" for="project-edit" link="Tmemers" index="">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        <!-- <i class="glyphicon glyphicon-link"></i> 
                        <h4>Project Name</h4>
                        
                        <!-- <h5>Date Range</h5> 
                        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.
                        </p>
                      </div>
                      <div class="team-members-container row" name="team-members" id="Tmemers">

                        <div class="team-member-block col-md-6">
                          <div class="col-md-2">
                            <img src="http://vignette2.wikia.nocookie.net/farmville/images/d/da/38x38-icon.png/revision/latest?cb=20120530023501" class="team-member-mini-image">
                          </div>
                          <div class="team-member-block-description col-md-10">
                            <a href="www.google.com">Google</a> <br>
                            <p>User title displayed hereaasdasdasdassdasdasdasdasdsasd</p>
                          </div>
                        </div>
                      </div>
                    </div> -->

                     <!--  </div> -->
                  </div>
                </div>  
              <div class="add-star">
                <button class="add-btn" for="project-edit">Add Project</button>
              </div>
          </div>
      </div>

      <!-- Education -->
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
              <div class="well well-sm">
                  <header>
                    <h2>Education</h2>
                  </header>

                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-hide="alert" aria-label="Close"><span class="dimissible-color"aria-hidden="true">&times;</span></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only"></span>
                    <span class="alert-msg"></span>
                  </div>
                  
                  <div id="education-edit" class="edit-view" entry-number="">
                    <div class="loading">
                      <img src="../image/ajax-loader.gif">
                    </div>
                    <form class="editable-form" action="php/Education_controller.php">
                      <input id="EduID" name="EduID" class="DataID" type="hidden" value="0" />
                      <!-- Error Alert -->
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <span class="alert-msg"></span>
                      </div>
                      <!-- School -->
                      <div class="form-group">
                        <label for="school-name">School</label>
                        <abbr title="Required" class="required">*</abbr>
                        <input name="school-name" type="text" class="form-control" id="school-name" required>
                      </div>
                      <!-- Degree -->
                       <div class="form-group">
                        <label for="degree">Degree</label>
                        <input name="degree" type="text" class="form-control" id="degree" >
                      </div>
                      <!-- Field of Study -->
                      <div class="form-group">
                        <label for="field-of-study">Field of Study</label>
                        <input name="field-of-study" type="text" class="form-control" id="field-of-study" >
                      </div>

                      <!-- Grade -->
                      <div class="form-group">
                        <label for="grade">Grade</label>
                        <input name="grade" type="text" class="form-control" id="grade" >
                      </div>

                      <!-- Time Period -->
                      <label for="school-year-started">Dates Attended</label>
                      <div class="form-group form-inline ">
                        <select name="school-year-started" type="month" class="form-control" id="school-year-started" > 
                          <option value="" selected>-</option>
                          <option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
                          <option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
                          <option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
                          <option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
                          <option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
                          <option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
                        </select>
                        &#8213 
                        <select name="school-year-ended" type="month" class="form-control" id="school-year-ended" > 
                          <option value="" selected>-</option>
                          <option value="2022">2022</option><option value="2021">2021</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option>
                          <option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
                          <option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
                          <option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
                          <option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
                          <option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
                          <option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
                        </select>
                        <span>Or expected graduation year</span>
                      </div>

                      <!-- Activities and Societies -->
                      <label for="activities">Activities and Societies</label>
                      <textarea name="activities" id="activities" class="form-control" rows="3"></textarea> <br>

                      <!-- Description -->
                      <label for="education-description">Description</label>
                      <textarea name="education-description" id="education-description" class="form-control" rows="4"></textarea> <br>

                      <!-- file -->
                      <!-- <label for="school-description">Description</label>
                      <input name="school-description" id="school-description" class="form-control" rows="5"></input> <br><br> -->
                      <button type="submit" class="btn btn-primary save-btn">Save</button>
                      <button type="button" class="btn btn-default cancel-btn">Cancel</button>
                      <a class="remove-entry-link" href="#" >Remove this entry.</a>
                    </form>  
                  </div>
                  <div id="user-education" class="normal-view">
                    <!-- <div class="editable" for="education-edit" index="0">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <h4>School Name</h4>
                      <h5>Degree and <span>Grade</span></h5>
                      <h5>Dates Attended</h5>
                      <h5>Field of Study</h5>
                     
                      <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                      <h5 style="color:#888";>Activities and Societies:</h5>
                      <p>some society</p>
                    </div> -->
                  </div>

              </div>
              <div class="add-star">
                <button class="add-btn" for="education-edit">Add Education</button>
              </div>
          </div>
      </div>


    </div><!-- /main-container -->

    <!-- Custom styles for this template -->
    <link href="css/profile-user-POV.css" rel="stylesheet">
    <!-- Custom modal handler -->
    <script src="../js/bootbox.min.js"></script>
    <!-- Sortable script -->
    <script src="../js/jquery.sortable.min.js"></script>
    <!-- Custom Script -->
    <script src="js/User.js"></script>
    <script src="js/profile-user-POV.js"></script>
    <script src="../lib/js/FileUpload.js"></script>
    <script src="js/ProfileImageUploader.js"></script>
  </body>
</html>

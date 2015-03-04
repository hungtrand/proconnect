<?php
include '../signout/php/session_check_signout.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Edit Profile</title>

    <script src="../lib/jquery/jquery-2.1.3.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/profile-user-POV.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- JQuery UI -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- // <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custome Script -->
    <script src="js/profile-user-POV.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id= "logo" class="navbar-brand" href="#"><img src="../image/proconnect/logo_text.png" /></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#about">What is ProConnect?</a></li>
            <li><a href="#signup">Join Today</a></li>
            <li><a href="../signout/php/session_signout.php">Sign Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div id="main-container" class="container-fluid">
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
              <div class="well well-sm">
                  <div class="row">
                      <div id="profile-image-block" class="col col-sm-6 col-md-4 col-lg-3">
                          <div id="profile-image" class="outer-ref" >
                            <img src="http://placehold.it/380x500" alt="" class="img-responsive profile-image" />
                            <div id="change-image-block" > 
                              <span id="glyphicon-picture" class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                              <span id="change-photo-text">Change Photo</span>
                            </div>
                          </div>
                      </div>
                      <div class="col-sm-6 col-md-8 editable">
                          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>

                          <h4>Bhaumik Patel</h4>
                          <small><cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
                          </i></cite></small>
                          <p>
                              <i class="glyphicon glyphicon-envelope"></i><span id="email">email@example.com</span>
                              <br />
                              <!-- <i class="glyphicon glyphicon-globe"></i><span id><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a></span>
                              <br /> -->
                              <i class="glyphicon glyphicon-phone"></i><span id="phone">phone #</span>
                              <br />
                               <i class="glyphicon glyphicon-home"></i><span id="home">somewhere someplace</span>
                              <br />
                              <i class="glyphicon glyphicon-education"></i><span id="education">somewhere someplace</span>
                              <br />
                          </p>
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

                  <!-- User Info -->
                  <div class="edit-view">
                        <form >
                          <!-- User Name -->
                          <div class="form-group form-inline">
                            <div class="form-group">
                              <label for="first-name-input">First</label>
                              <abbr title="Required" class="required">*</abbr>
                              <input type="text" class="form-control" id="first-name-input" placeholder="First" required>
                            </div>
                            <div class="form-group">
                              <label for="last-name-input">Last</label>
                              <abbr title="Required" class="required">*</abbr>
                              <input type="text" class="form-control" id="last-name-input" placeholder="Last" required>
                            </div>
                            <div class="form-group">
                              <label for="middle-initial-input">M.I.</label>
                              <input type="text" class="form-control" id="middle-initial-input" placeholder="M.I." style="width:50px;" maxlength="1">
                            </div>
                          </div>
                          <!-- Email Address -->
                           <div class="form-group">
                            <label for="email-input">Email</label>
                            <abbr title="Required" class="required">*</abbr>
                            <input type="text" class="form-control" id="email-input" value="" required>
                          </div>
                          <!-- Alternate Email Address -->
                           <div class="form-group">
                            <label for="alt-email-input">Alternate Email</label>
                            <input type="text" class="form-control" id="alt-email-input" value="">
                          </div>
                          <!-- Phone -->
                          <label for="phone-input">Phone</label>
                          <div class="form-group form-inline">
                            <input type="text" class="form-control" id="phone-input" placeholder="#(###) ###-#### ">
                            <select type="text" class="form-control" id="work-start-month"> 
                              <option value="home">Home</option>
                              <option value="work">Work</option>
                              <option value="mobile">Mobile</option>
                            </select>
                          </div>

                          <!-- Address -->
                          <label for="address">Address</label>
                          <textarea id="address" class="form-control" rows="2"></textarea> <br><br>
                          <button type="submit" class="btn btn-primary">Save</button>
                          <button type="button" class="btn btn-default">Cancel</button>
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
                        <h3>Summary</h3>
                  </header>
                  <div class="normal-view editable">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                  </div>
                  <div class="edit-view">
                    <b><h4>Summary</h4></b>
                    <form>
                      <textarea class="form-control" rows="10"></textarea> <br><br>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default">Cancel</button>
                    </form>
                  </div>
                  
              </div>
              
              <div class="add-star">
                <button id="user-info-edit-btn">Edit Summary</button>
              </div>
          </div>
      </div>

      <!-- Experience -->
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
              <div class="well well-sm">
                  <header>
                    <h3>Experience</h3>
                  </header>
                  <div class="edit-view">
                    <form >
                      <!-- Position Title -->
                      <div class="form-group ">
                        <label for="position-title">Position Title</label>
                        <abbr title="Required" class="required">*</abbr>
                        <input type="text" class="form-control" id="position-title" value="place holder" required>
                      </div>
                      <!-- Company Name -->
                       <div class="form-group ">
                        <label for="company-name">Company Name</label>
                        <abbr title="Required" class="required">*</abbr>
                        <input type="text" class="form-control" id="company-name" value="Company Name" required>
                      </div>
                      <!-- Location -->
                      <div class="form-group ">
                        <label for="company-location">Location</label>
                        <input type="text" class="form-control" id="company-location" value="Location">
                      </div>

                      <!-- Time Period -->
                      <label for="work-start-month">Time Period</label>
                      <abbr title="Required" class="required">*</abbr>
                      <div class="form-group form-inline ">
                        <select type="month" class="form-control" id="work-start-month" required> 
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
                        <input type="text" class="form-control short-input" id="work-start-year" placeholder="Year" maxlength="4"> &#8213 

                        <div class="form-group work-time-right-block">
                          <span id="current"> present</span>

                          <select type="month" class="form-control" id="work-end-month" > 
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
                          <input type="text" class="form-control short-input" id="work-end-year" placeholder="Year" maxlength="4"><br>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value="">
                              I currently work here.
                            </label>
                          </div> 
                        </div>
                      </div>

                      <!-- Description -->
                      <label for="work-description">Description</label>
                      <textarea id="work-description" class="form-control" rows="5"></textarea> <br><br>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default">Cancel</button>
                    </form>  
                  </div>
                  <div class="normal-view outer-ref">
                  
                    <div></div>
                    <div class="editable">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <h4>Position Title</h4>
                      <h5>Company Name</h5>
                      <h5>Time Period</h5>
                      <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                    </div>
                  </div>
              </div>
              <div class="add-star">
                <button id="user-info-edit-btn">Add Position</button>
              </div>
          </div>
      </div>

       <!-- Project-->
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
              <div class="well well-sm">
                  <header>
                    <h3>Projects</h3>
                  </header>
                  <div class="edit-view">
                    <form >
                      <!-- Project Name -->
                      <div class="form-group ">
                        <label for="project-name">Name</label>
                        <abbr title="Required" class="required">*</abbr>
                        <input type="text" class="form-control" id="project-name" value="ProConnect" required>
                      </div>
                      <!-- Project URL -->
                       <div class="form-group ">
                        <label for="project-url">Company Name</label>
                        <input type="text" class="form-control" id="project-url" value="URL">
                      </div>
                      <!-- Team Members -->
                      <label for="project-team-members">Team Members</label>
                      
                      <div id="project-team-editable-block" class="form-group well well-sm"> <!-- contentEditable="true" -->

                        <ul id="sortable">
                          <li class="ui-state-default col-md-3">
                            <div class="team-member-block team-member-block-edit-view col-md-6">
                              <div class="team-member-block-description">
                                <p>You</p>
                              </div>
                            </div>
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </li>
                          <li class="ui-state-default col-md-3">
                            <div class="team-member-block team-member-block-edit-view col-md-6">
                              <div class="team-member-block-description">
                                <p>You</p>
                              </div>
                            </div>
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </li>
                          <li class="ui-state-default col-md-3">
                            <div class="team-member-block team-member-block-edit-view col-md-6">
                              <div class="team-member-block-description">
                                <p>You</p>
                              </div>
                            </div>
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </li>
                           <li class="ui-state-default col-md-3">
                            <div class="team-member-block team-member-block-edit-view col-md-6">
                              <div class="team-member-block-description">
                                <p>You</p>
                              </div>
                            </div>
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </li>
                        </ul>

                        <input type="text" class="form-control" id="project-team-members" placeholder="+Add Member"> 

                      </div>

                      <!-- Project Description -->
                      <label for="project-description">Description</label>
                      <textarea id="project-description" class="form-control" rows="5"></textarea> <br><br>

                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default">Cancel</button>
                    </form>  
                  </div>
                  <div class="normal-view">
                    <div>
                      <div class="editable">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>

                        <h4>Project Name</h4>
                        
                        <h5>Date Range</h5>
                        <p name="description">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.
                        </p>
                      </div>
                      <div class="team-members-container row" name="team-members">

                        <!-- REPEATABLE -->
                        <div class="team-member-block col-md-6">
                          <div class="col-md-2">
                            <img src="http://vignette2.wikia.nocookie.net/farmville/images/d/da/38x38-icon.png/revision/latest?cb=20120530023501" class="team-member-mini-image">
                          </div>
                          <div class="team-member-block-description col-md-10">
                            <a href="www.google.com">Google</a> <br>
                            <p>User title displayed hereaasdasdasdassdasdasd</p>
                          </div>
                        </div>

                        <!-- REPEATABLE -->
                        <div class="team-member-block col-md-6">
                          <div class="col-md-2">
                            <img src="http://vignette2.wikia.nocookie.net/farmville/images/d/da/38x38-icon.png/revision/latest?cb=20120530023501" class="team-member-mini-image">
                          </div>
                          <div class="team-member-block-description col-md-10">
                            <a href="www.google.com">Google</a> <br>
                            <p>User title displayed hereaasdasdasdassdasdasd</p>
                          </div>
                        </div>

                        <!-- REPEATABLE -->
                        <div class="team-member-block col-md-6">
                          <div class="col-md-2">
                            <img src="http://vignette2.wikia.nocookie.net/farmville/images/d/da/38x38-icon.png/revision/latest?cb=20120530023501" class="team-member-mini-image">
                          </div>
                          <div class="team-member-block-description col-md-10">
                            <a href="www.google.com">Google</a> <br>
                            <p>User title displayed hereaasdasdasdassdasdasd</p>
                          </div>
                        </div>

                        <!-- REPEATABLE -->
                        <div class="team-member-block col-md-6">
                          <div class="col-md-2">
                            <img src="http://vignette2.wikia.nocookie.net/farmville/images/d/da/38x38-icon.png/revision/latest?cb=20120530023501" class="team-member-mini-image">
                          </div>
                          <div class="team-member-block-description col-md-10">
                            <a href="www.google.com">Google</a> <br>
                            <p>User title displayed hereaasdasdasdassdasdasd</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>  
              </div>
              <div class="add-star">
                <button id="user-info-edit-btn">Add Project</button>
              </div>
          </div>
      </div>

      <!-- Education -->
      <div class="row">
          <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
              <div class="well well-sm">
                  <header>
                    <h3>Education</h3>
                  </header>
                  <div class="edit-view">
                    <form >
                      <!-- School -->
                      <div class="form-group">
                        <label for="school-name">School</label>
                        <abbr title="Required" class="required">*</abbr>
                        <input type="text" class="form-control" id="school-name" value="Some value" required>
                      </div>
                      <!-- Degree -->
                       <div class="form-group">
                        <label for="degree">Degree</label>
                        <input type="text" class="form-control" id="degree" value="Bachelor of Science (BS)">
                      </div>
                      <!-- Field of Study -->
                      <div class="form-group">
                        <label for="field-of-study">Field of Study</label>
                        <input type="text" class="form-control" id="field-of-study" value="Computer Science">
                      </div>

                      <!-- Grade -->
                      <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="text" class="form-control" id="grade" value="SHIT">
                      </div>

                      <!-- Time Period -->
                      <label for="school-year-started">Dates Attended</label>
                      <div class="form-group form-inline ">
                        <select type="month" class="form-control" id="school-year-started" > 
                          <option value="" selected>-</option>
                          <option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option>
                          <option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option>
                          <option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option>
                          <option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option>
                          <option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
                          <option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option>
                        </select>
                        &#8213 
                        <select type="month" class="form-control" id="work-end-month" > 
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
                      <textarea id="activities" class="form-control" rows="3"></textarea> <br>

                      <!-- Description -->
                      <label for="school-description">Description</label>
                      <textarea id="school-description" class="form-control" rows="5"></textarea> <br><br>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default">Cancel</button>
                    </form>  
                  </div>
                  <div class="normal-view">
                    <div class="editable">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <h4>School Name</h4>
                      <h5>Degree and <span>Grade</span></h5>
                      <h5>Dates Attended</h5>
                      <h5>Field of Study</h5>
                     
                      <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                      <h5 style="color:#888";>Activities and Societies:</h5>
                    </div>
                  </div>

              </div>
              <div class="add-star">
                <button id="user-info-edit-btn">Add Education</button>
              </div>
          </div>
      </div>


    </div><!-- /main-container -->


  </body>



</html>

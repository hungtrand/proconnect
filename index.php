<?php
	include '../signin/php/session_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>World's Most Professional Connection Network</title>
    <link rel="ICON" href="image/proconnect/Tab_logo2.ico" type="image/ico" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>World's Most Professional Connection Network</title>
	<link rel="ICON" href="../image/proconnect/Tab_logo2.ico" type="image/ico" />
    <!-- Bootstrap Core CSS -->
    <link href="../lib/startbootstrap-stylish-portfolio-1.0.3/startbootstrap-stylish-portfolio-1.0.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../lib/startbootstrap-stylish-portfolio-1.0.3/startbootstrap-stylish-portfolio-1.0.3/css/stylish-portfolio.css" rel="stylesheet">

	<link href="signup/css/signup.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
	<!-- JQuery link -->
    <script src="lib/jquery/jquery-2.1.3.min.js"></script>
	<!-- JavaScript link -->
    <script type="text/javascript" src="signup/js/SignUpForm.js"></script>
    <script type="text/javascript" src="signup/js/index.js"></script>
    <!-- Custom Fonts -->
    <link href="../lib/startbootstrap-stylish-portfolio-1.0.3/startbootstrap-stylish-portfolio-1.0.3/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Header -->
    <header id="top" class="header" style= "position: relative;">
		<div class="text-right" style= "position: absolute; width: inherit; padding-top: 20px; padding-right: 20px;">
			<a href="../signin" class="btn" id="signin" >Sign In</a>
		</div>
        <div class="text-vertical-center">
			<img class= "hidden-xs "id= "logo-main" src = "../image/proconnect/ProConnect_black.png" width="400">
			<img class= "hidden-sm hidden-md hidden-lg"id= "logo-main" src = "../image/proconnect/ProConnect_black.png" width="250">
		   <h3>Stay Connected With Your Profession</h3>
            <br>
			<a href="#about" class="btn btn-dark btn-lg">Learn More</a>
			<a href="#signup" class="btn btn-dark btn-lg">Get Started</a>
        </div>
    </header>

    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Make the most of your professional life</h2>
                      <p class="lead">ProConnect represents a center to interact with others, to build a professional identity, and to discover new professional opportunities.</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Services -->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Features</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-users fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>build your network</strong>
                                </h4>
                                <p>Connect and find opportunity</p>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-compass fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Stay on top of your career</strong>
                                </h4>
                                <p>Read professional news, join groups, and follow industry leaders</p>
                             
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-briefcase fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Find your dream job or let it find you</strong>
                                </h4>
                                <p>Save, search, and apply for jobs</p>
                              
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-file-text-o fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Start your profile</strong>
                                </h4>
                                <p>Let people and opportunities find you</p>
                           
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
 
    <section id="signup" class=  "bg-primary login" >
		
		<div class=  "login" >
		<div class="container">
			
			<div class="row">
				<div class ="text-center lock-container formContainer col col-xs-12 col-sm-10 col-md-4 col-lg-4 col-sm-offset-1 col-md-offset-4 col-lg-offset-4">		
					<h2>Join Now</h2>
                    <hr class="small">
					<div class="panel panel-default text-center">
						<div class= "panel-body">
							<form id="SignUpForm" action="signup/php/user_signup.php" class="text-left" novalidate>
								<div class="form-group" style="overflow: auto;">
									<div class="col-xs-6" style="padding: 0 5px 0 0">
										<label for"first">First Name</label> <br />
										<input class="form-control" id="first" type="text" name="first" placeholder="First name" required> 
									</div>

									<div class="col-xs-6" style="padding: 0 0 0 5px">
										<label for"last">Last Name</label> <br />
										<input class="form-control" id="last" type="text" name="last" placeholder="Last name" required>
									</div>
								</div>

								<div class="form-group">
									<label for="email">Email</label> <br />
									<input class="form-control" id="email" type="email" name="email" placeholder="professional@proconnect.com" required>
								</div>

								<div class="form-group">
									<label for="password">Password</label> <br />
									<input class="form-control" id="password" type="password" name="password" placeholder="6 or more characters" required>
								</div>

								<div class="form-group">
									<label for="confirmpassword">Confirm Password</label> <br />
									<input class="form-control" id="confpassword" type="password" name="confpassword" placeholder="Retype your password above" required>
								</div>

								<!-- Invalid input alert -->
								<div class="form-group">
									<div class="alert alert-danger text-center" role="alert" style="display: none; margin-top: 10px;"><b>Invalid Input :</b> Please correct the marked field(s)</div>
								</div>

								<div class="form-group text-center">
									<button class="btn btn-info btn-block" id = "signup-btn"type="submit"><b>Join now</b></button>
									<br />
									<p class="text-center"><a href="../signin/">Already a member? Sign in.</a>
								</div>

							</form>
						</div>
					</div>
				 </div>
			</div>
		</div> <!-- /container -->
	</div>
    </section> 

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Qurious Designs</strong>
                    </h4>
                    <p>1 Washington Sq<br>San Jose, CA 95192</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:contact@ProConnect.com">contact@ProConnect.com</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">ProConnect v1.0 &copy; Copyright 2015 </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="../lib/startbootstrap-stylish-portfolio-1.0.3/startbootstrap-stylish-portfolio-1.0.3/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../lib/startbootstrap-stylish-portfolio-1.0.3/startbootstrap-stylish-portfolio-1.0.3/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>

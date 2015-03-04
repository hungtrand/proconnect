<?php
	include 'signin/php/session_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>World's Most Professional Connection Network</title>

	<!-- JQuery link -->
	<script type="text/javascript" src="lib/jquery/jquery-2.1.3.min.js"></script>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	
	<!--customed CSS-->
	<link rel="stylesheet" type="text/css" href="home/css/homepage.css">
	
	<!-- JavaScript link -->
	<script type="text/javascript" src="signin/js/SignInForm.js"></script>
	<script type="text/javascript" src="signup/js/SignUpForm.js"></script>
	<script type="text/javascript" src="home/js/home.js"></script>
    <script type="text/javascript" src="home/js/index.js"></script>
    
</head>
<body class="container-fluid">
	<div id="header" class="container-fluid">

		<div class="row"> 
			<div class="col col-md-6 col-md-offset-1">

				<!-- logo needs to be changed to ProConnect -->
				<img class="logo" src="image/proconnect/logo_text.png" alt="ProConnect" > 
			</div>
		
			<div class="col col-md-4 text-right">
				<!-- login shortcut -->
				<form id="login-short-cut" class="text-left row" method="POST" action="signin/php/session_signin.php" novalidate>
					
					<div class="col col-md-5">
						<label for="email-login" >Email Address</label>
						<input id="email-login" class="form-control" name="Username" type="email" tabindex="1" > 
					</div>
					<div class="col col-md-5">
						<label for="password-login" >Password</label> 
						<input id="password-login" class="form-control" name="Password" type="password" tabindex="2" > 

						<a href="javascript:void(0)" tabindex="4">Forgot your password?</a>
					</div>
					<div class="col col-md-2">
						<br />
						<button id="signin-btn" class="btn btn-primary" tabindex="3">Sign In</button>
					</div>

					<div class="col col-md-12">
						<!-- Invalid input alert -->
						<div class="alert alert-danger text-center" role="alert" style="display: none; margin-top: 10px;"><b>Invalid Input :</b> Please correct the marked field(s)</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="main-wrapper">	
		<div id="main" class="container-fluid text-center" >
			
			<h2>Stay Connected With Your Profession.</h2>
			<div id="main-body" class="row">
				<section id="left-section" class="col col-md-5 col-md-offset-2 hidden-xs hidden-sm">
					<img class="img-rounded" src="image/pronetwork.jpg" style="width: 100%;" />
				</section>

				<section id="right-section" class="col col-md-3">
					<h2>Get started &mdash; it's free!</h2>
					<p style="font-size:16px">Registration takes less than 2 minutes.</p>
					<div>
						<form id="SignUpForm" action="signup/php/user_signup.php" class="text-left" novalidate>
							<div class="form-group" style="overflow: auto;">
								<div class="col-xs-6" style="padding: 0 5px 0 0">
									<label for"first">First Name:</label> <br />
									<input class="form-control" id="first" type="text" name="first" placeholder="First name" required> 
								</div>

								<div class="col-xs-6" style="padding: 0 0 0 5px">
									<label for"last">Last Name:</label> <br />
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
								<label for="confpassword">Confirm Password</label> <br />
								<input class="form-control" id="confpassword" type="password" name="confpassword" placeholder="retype your password above" required>
							</div>

							<!-- Invalid input alert -->
							<div class="form-group">
								<div class="alert alert-danger text-center" role="alert" style="display: none; margin-top: 10px;"><b>Invalid Input :</b> Please correct the marked field(s)</div>
							</div>

							<div class="form-group">
								<button class="gold-gradient btn btn-lg btn-block" id = "signup-btn"type="submit"><b>Join now</b></button>
							</div>

						</form>
					</div>

				</section>
			</div>
			
		</div>
	</div>
	
	<footer id="footer" class="container-fluid text-center">
		<div>
			<div>Some footer info here</div>
		</div>
	</footer>

</body>
</html>
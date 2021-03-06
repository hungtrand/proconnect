<?php
    error_reporting(E_ALL); // debug
    ini_set("display_errors", 1); // debug
    include 'php/session_check.php';

    $welcome = '';
    if (isset($_COOKIE['__USER_FULL_NAME__'])) { 
        $welcome = 'Welcome back, '.$_COOKIE['__USER_FULL_NAME__']
        .' <a href="../signout/php/cookie_signout.php"><br />(Not '.$_COOKIE['__USER_FULL_NAME__'].'?)</a>'; 
    };

    if (isset($_COOKIE['__USER_PROFILE_IMAGE__'])) {
        $ProfileImage = $_COOKIE['__USER_PROFILE_IMAGE__'];
    } else {
        $ProfileImage = '/image/user_img.png';
    }

    //echo $_SERVER['SERVER_NAME'];
?>
<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin</title>
	<link rel="ICON" href="../image/proconnect/Tab_logo2_bold.ico" type="image/ico" />
    <!-- Bootstrap core CSS 
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    
    <!-- JQuery link -->
    <script src="../lib/jquery/jquery-2.1.3.min.js"></script>

    <!-- JavaScript link -->
    <script type="text/javascript" src="js/SignInForm.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
	<!-- Compressed Vendor BUNDLE-->
    <link href="../social-1/css/vendor.min.css" rel="stylesheet">
	<!-- Compressed Theme BUNDLE-->
	<link href="../social-1/css/theme-core.min.css" rel="stylesheet">
	<!-- Standalone Modules-->
	<link href="../social-1/css/module-essentials.min.css" rel="stylesheet" />
    <link href="../social-1/css/module-layout.min.css" rel="stylesheet" />
    <link href="../social-1/css/module-sidebar.min.css" rel="stylesheet" />
    <link href="../social-1/css/module-sidebar-skins.min.css" rel="stylesheet" />
    <link href="../social-1/css/module-navbar.min.css" rel="stylesheet" />
    <!-- <link href="css/module-media.min.css" rel="stylesheet" /> -->
    <link href="../social-1/css/module-timeline.min.css" rel="stylesheet" />
    <link href="../social-1/css/module-cover.min.css" rel="stylesheet" />
    <link href="../social-1/css/module-chat.min.css" rel="stylesheet" />
    <!-- <link href="css/module-charts.min.css" rel="stylesheet" /> -->
    <link href="../social-1/css/module-maps.min.css" rel="stylesheet" />
    <!-- <link href="css/module-colors-alerts.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-background.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-buttons.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-calendar.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-progress-bars.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-text.min.css" rel="stylesheet" /> -->
	
	<!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class = "login">
	<div id="content">
    <div class="container-fluid">

            <div class="lock-container formContainer ">   
				<a href= "../"><img id= "logo" src = "../image/proconnect/logo_text.png"></a>
				<div class="panel panel-default text-center">
						<img src="<?=$ProfileImage?>" class="img-circle" style="height: 100px; width: 100px; object-fit: cover;">
						<div class= "panel-body">
							<form class="form-signin form" id="SignInForm" action="php/session_signin.php" novalidate>							  								
								<!-- Invalid input alert -->
								<div class="alert alert-danger" role="alert" style="display: none"><b>Invalid Input</b></div>								
								<label class="text-info"><?=$welcome?></label>
								<div class="form-group">
									<label for="inputEmail" class="sr-only">Email address</label>
									<input type="email" name="Username" id="email-login" class="form-control" placeholder="Email address" autofocus>
								</div>

								<div class="form-group">
									<label for="inputPassword" class="sr-only">Password</label>
									<input type="password" name="Password" id="email-password" class="form-control" placeholder="Password" >
								</div>

								<div class="form-group">
									<button class="btn btn-info" type="submit">Sign in <i class="fa fa-fw fa-unlock-alt"></i></button>
									<br /><br />
									<p class="text-center"><a href="forgotPassword.php">Forgot password?</a> <br/> Not a member?  <a href= "../signup/">Join now</a></p>
								</div>

							</form>
						</div>
				</div>

    </div> <!-- /container -->
	</div>
	<!-- Footer -->
    <footer class="footer hidden-xs">
        <strong>ProConnect</strong> v1.0 &copy; Copyright 2015
    </footer>
    <!-- // Footer -->

<!-- Inline Script for colors and config objects; used by various external scripts; -->
    <script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        theme: "social-1",
        skins: {
            "default": {
                "primary-color": "#16ae9f"
            },
            "orange": {
                "primary-color": "#e74c3c"
            },
            "blue": {
                "primary-color": "#4687ce"
            },
            "purple": {
                "primary-color": "#af86b9"
            },
            "brown": {
                "primary-color": "#c3a961"
            }
        }
    };
    </script>
    <!-- Separate Vendor Script Bundles -->
    <script src="../social-1/js/vendor-core.min.js"></script>
    <script src="../social-1/js/vendor-tables.min.js"></script>
    <script src="../social-1/js/vendor-forms.min.js"></script>
    <!-- <script src="js/vendor-media.min.js"></script> -->
    <!-- <script src="js/vendor-player.min.js"></script> -->
    <!-- <script src="js/vendor-charts-all.min.js"></script> -->
    <!-- <script src="js/vendor-charts-flot.min.js"></script> -->
    <!-- <script src="js/vendor-charts-easy-pie.min.js"></script> -->
    <!-- <script src="js/vendor-charts-morris.min.js"></script> -->
    <!-- <script src="js/vendor-charts-sparkline.min.js"></script> -->
    <!-- <script src="../social-1/js/vendor-maps.min.js"></script> -->
    <!-- <script src="js/vendor-tree.min.js"></script> -->
    <!-- <script src="js/vendor-nestable.min.js"></script> -->
    <!-- <script src="js/vendor-angular.min.js"></script> -->
    <!-- Compressed Vendor Scripts Bundle
    Includes all of the 3rd party JavaScript libraries above.
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation.
    Do not use it simultaneously with the separate bundles above. -->
    <!-- <script src="js/vendor-bundle-all.min.js"></script> -->
    <!-- Compressed App Scripts Bundle
    Includes Custom Application JavaScript used for the current theme/module;
    Do not use it simultaneously with the standalone modules below. -->
    <!-- <script src="js/module-bundle-main.min.js"></script> -->
    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL the modules are 100% compatible -->
    <script src="../social-1/js/module-essentials.min.js"></script>
    <script src="../social-1/js/module-layout.min.js"></script>
    <script src="../social-1/js/module-sidebar.min.js"></script>
    <!-- <script src="js/module-media.min.js"></script> -->
    <!-- <script src="js/module-player.min.js"></script> -->
    <!-- <script src="../social-1/js/module-timeline.min.js"></script> -->
    <!-- <script src="../social-1/js/module-chat.min.js"></script> -->
    <!-- <script src="../social-1/js/module-maps.min.js"></script> -->
    <!-- <script src="js/module-charts-all.min.js"></script> -->
    <!-- <script src="js/module-charts-flot.min.js"></script> -->
    <!-- <script src="js/module-charts-easy-pie.min.js"></script> -->
    <!-- <script src="js/module-charts-morris.min.js"></script> -->
    <!-- <script src="js/module-charts-sparkline.min.js"></script> -->
    <!-- [social-1] Core Theme Script:
        Includes the custom JavaScript for this theme/module;
        The file has to be loaded in addition to the UI modules above;
        module-bundle-main.js already includes theme-core.js so this should be loaded
        ONLY when using the standalone modules; -->
    <script src="../social-1/js/theme-core.min.js"></script>
</body>
</html>

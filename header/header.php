<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
include '../signout/php/session_check_signout.php';

$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title; ?></title>
    <link rel="icon" type="image/png" href="/favicon.ico">
    <script src="/lib/jquery/jquery-2.1.3.min.js"></script>


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core CSS -->
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>

    <link rel="stylesheet" href="/header/css/header.css">
    <!-- <link rel="import" href="/lib/templates/centered-loading-gif.html"></link> -->
    <script type="text/javascript" src="/header/js/NotificationGetter.js"></script>
    <!-- // <script type="text/javascript" src="/header/js/NotificationHandler.js"></script> -->
    <script type="text/javascript" src="/header/js/MessageGetter.js"></script>
    <script type="text/javascript" src="/header/js/MediaItemFactory.js"></script>
    <script type="text/javascript" src="/header/js/header.js"></script>

</head>

<body>
    <template id="MediaItem">
        <li class="media custom-media-item">
            <a class="landing-destination" href="#">
                <div class="media-left">
                    <img href="" class="media-object" src="/image/user_img.png" alt="..." style="max-width: 48px;">
                </div> 
                <div class="media-body">
                  <h4 class="media-heading" >Media Heading</h4>
                  <p class="snippet-zone"> Message Title </p>
                  Message Here
                </div>
                <div class="media-right time-ago">lorem</div>
            </a>
        </li>
    </template>
    <nav class="navbar navbar-inverse navbar-fixed-top affix" data-spy="affix" data-offset-top="60 " data-offset-bottom="200">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-view-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="logo navbar-brand hidden-xs hidden-sm " href="#">				
				<img src="../image/proconnect/logo_text.png" />				
				</a>
				<a class="logo navbar-brand hidden-md hidden-lg" style = "width:200px;" href="#">				
				<img style = "width:100%;" src="../image/proconnect/logo_text.png" />				
				</a>

                <form class="navbar-form navbar-left text-center form-inline" role="search">
                    <div class="form-group">
                      <input type="text" size="40" class="form-control" id= "searchbar" placeholder="Search for people, companies, jobs...">
                    </div>
                    <button type="submit" class="btn btn-primary hidden-xs hidden-sm ">&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </form>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="mobile-view-menu">

                <ul class="nav navbar-nav nav-pills navbar-right ">
                    <!-- <li id = "return" style = "display: none;">
                        <a href="#"><span class="glyphicon glyphicon-menu-left"></span></a>
					</li> -->

					<li class="notification-list notification-icon" id="message">

                        <a href="#" class="dropdown-toggle notification-menu navi-menu" id="message-menu" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-envelope"></span>
                            <span class="badge notification-number"></span>
                        </a>

                        <!-- Message Items -->
					    <ul class="dropdown-menu media-list dropdown-menu-right" role="menu">
							<li role="presentation" class="dropdown-header">
                                <strong>Messages</strong> 
                                <span class="glyphicon glyphicon-triangle-right" aria-hidden="true">
                            </li>
                            <div id="iam-loading" >
                                <div>
                                  <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                </div>
                            </div>
					    </ul> 
					</li>
                    <!-- <li role="presentation" class="divider"></li> -->

                    <li class="notification-list notification-icon" id="notification">
                        <a href="#" class="dropdown-toggle notification-menu navi-menu" id= "notification-menu" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-flag"></span>
                            <span class="badge notification-number"></span>
                        </a>
						<ul class="dropdown-menu media-list" role="menu">
							<li role="presentation" class="dropdown-header">
                                <strong>Notifications</strong>
                                <span class="glyphicon glyphicon-triangle-right" aria-hidden="true">
                            </li>
                            <div id="iam-loading" >
                                <div>
                                  <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                </div>
                            </div>
						</ul>
				   </li>

                    <li class="notification-list notification-icon" id="connection">
                        <a href="#" class="dropdown-toggle notification-menu navi-menu" id="connection-menu" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="badge notification-number"></span>
                        </a>
						<ul class="dropdown-menu media-list" role="menu">
								<li role="presentation" class="dropdown-header">
                                    <strong>Add Connections</strong>
                                    <span class="glyphicon glyphicon-triangle-right" aria-hidden="true">
                                </li>
                                <div id="iam-loading" >
                                    <div>
                                      <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                    </div>
                                </div> 
						</ul>
				   </li>

                    <li class="dropdown hidden-xs" id="caret">
                        <a href="#" class="dropdown-toggle" id="caret-menu" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?=$FullName?> <span class="glyphicon glyphicon-cog"></span>
                        </a>
                        <ul class="dropdown-menu " role="menu">
							<li role="presentation" class="dropdown-header">
                                <strong>Account & Settings</strong>
                                <span class="glyphicon glyphicon-triangle-right" aria-hidden="true">
                            </li>
                            <li><a href="#">Account & Settings</a></li>
                            <li><a href="#">Job Posting</a></li>
                            <li class="divider"></li>
                            <li><a href="../signout/php/session_signout.php">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
				 <ul class="nav subNav hidden-sm hidden-md hidden-lg">
                <li role="presentation"><a href="../feed/">
                    Home</a>
                </li>
                <li role="presentation"><a href="../profile-user-POV/">
                    Profile</a>
                </li>
                <li role="presentation"><a href="../connections/">
                    Connections</a>
                </li>
                <li role="presentation"><a href="#">
                    Education</a>
                </li>
                <li role="presentation"><a href="#">
                    Jobs</a>
                </li>
                <li role="presentation"><a href="#">
                    Interests</a>
                </li>
            </ul>

            <!-- Mobile Menu View -->
            <ul class="nav subNav hidden-sm hidden-md hidden-lg">
                    <li role="presentation">
                        <a href="../profile-user-POV/">Home</a>
                    </li>
                    <li role="presentation">
                        <a href="../profile-user-POV/">Profile</a>
                    </li>
                    <li role="presentation">
                        <a href="../connections/">Connections</a>
                    </li>
                    <li role="presentation">
                        <a href="#">Education</a>
                    </li>
                    <li role="presentation">
                        <a href="#">Jobs</a>
                    </li>
                    <li role="presentation">
                        <a href="#">Interests</a>
                    </li>
        
                    <li role="presentation">
                        <a href="#">Account & Settings</a>
                    </li>
                    <li role="presentation">
                        <a href="#">Job Posting</a>
                    </li>
                    <hr>
                    <li role="presentation" id="signout-menu">
                        <a href="../signout/php/session_signout.php">Sign Out</a>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->
            <ul class="nav nav-pills subNav hidden-xs">
                <li role="presentation"><a href="../feed/">
                    Home</a>
                </li>
                <li role="presentation"><a href="../profile-user-POV/">
                    Profile</a>
                </li>
                <li role="presentation"><a href="../connections/">
                    Connections</a>
                </li>
                <li role="presentation"><a href="#">
                    Education</a>
                </li>
                <li role="presentation"><a href="#">
                    Jobs</a>
                </li>
                <li role="presentation"><a href="#">
                    Interests</a>
                </li>
            </ul>
        </div><!-- /.container-fluid -->       
    </nav>

   

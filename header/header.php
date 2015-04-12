<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
// include '../signout/php/session_check_signout.php';

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

    <link rel="stylesheet" href="/header/header.css">
    <script src="/header/header.js"></script>
	

    <script type="text/javascript" src="/header/js/NotificationGetter.js"></script>
    <script type="text/javascript" src="/header/js/header.js"></script>

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top affix" data-spy="affix" data-offset-top="60 " data-offset-bottom="200">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-right-links">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a id="logo" class="navbar-brand hidden-xs hidden-sm " href="#">				
				<img src="../image/proconnect/logo_text.png" />				
				</a>
				<a id="logo" class="navbar-brand hidden-md hidden-lg" style = "width:200px;" href="#">				
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
            <div class="collapse navbar-collapse" id="nav-right-links">

                <ul class="nav navbar-nav nav-pills navbar-right ">
                    <li class="notification-list" id="message">
                        <a href="#" class="dropdown-toggle notification-menu" id= "message-menu" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-envelope"></span><span class="badge">2</span></a>
						  <ul class="dropdown-menu" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						  </ul>
				 </li>
				

                    <li class="notification-list" id="notification">
                        <a href="#" class="dropdown-toggle notification-menu" id= "notification-menu" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-flag"></span><span class="badge">1</span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
				   </li>

                    <li class="notification-list" id="connection">
                        <a href="#" class="dropdown-toggle notification-menu" id= "connection-menu" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span><span class="badge">5</span></a>
						<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
						</ul>
				   </li>

                    <li class="dropdown hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?=$FullName?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Account & Settings</a></li>
                            <li><a href="#">Job Posting</a></li>
                            <li class="divider"></li>
                            <li><a href="../signout/php/session_signout.php">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
				 <ul class="nav subNav hidden-sm hidden-md hidden-lg">
                <li role="presentation"><a href="../profile-user-POV/">
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
	
				<li role="presentation"><a href="#">Account & Settings</a></li>
				<li role="presentation"><a href="#">Job Posting</a></li>
				<hr>
				<li role="presentation" id = "signout-menu"><a href="../signout/php/session_signout.php">Sign Out</a></li>
					
                </div>
            </ul>

            </div><!-- /.navbar-collapse -->
            <ul class="nav nav-pills subNav hidden-xs">
                <li role="presentation"><a href="../profile-user-POV/">
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

   

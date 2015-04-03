<!DOCTYPE html>
<html lang="en">
     
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title; ?></title>
    
    <script src="../lib/jquery/jquery-2.1.3.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    
    <!-- JQuery UI -->
    <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"> -->
    <!-- // <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core CSS -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom Header CSS -->
    <link href="/header/css/header.css" rel="stylesheet"> 

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

                <a id="logo" class="navbar-brand" href="#"><img src="../image/proconnect/logo_text.png" /></a>

                <form class="navbar-form navbar-left text-center" role="search">
                    <div class="form-group">
                      <input type="text" size="40" class="form-control" placeholder="Search for people, companies, jobs...">
                    </div>
                    <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </form>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="nav-right-links">

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-envelope"></span></a>
                    </li>

                    <li>
                        <a href="#"><span class="glyphicon glyphicon-flag"></span></a>
                    </li>

                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span></a>
                    </li>

                    <li class="dropdown">
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

            </div><!-- /.navbar-collapse -->
            <ul class="nav navbar-nav nav-pills subNav">
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
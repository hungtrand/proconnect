<?php
// include '../signout/php/session_check_signout.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Connecttions - ProConnect</title>
    
    <script src="../lib/jquery/jquery-2.1.3.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  

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

    <!-- Custom CSS -->
    <link href="css/index.css" rel="stylesheet">

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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">John Doe <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Account & Settings</a></li>
                            <li><a href="#">Job Posting</a></li>
                            <li class="divider"></li>
                            <li><a href="../signout/php/session_signout.php">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->

            <ul class="nav nav-pills">
                <li role="presentation"><a href="#">
                    Home</a>
                </li>
                <li role="presentation"><a href="#">
                    Profile</a>
                </li>
                <li role="presentation"><a href="#">
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

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col col-md-8">
                <div id="ConnectionsHeader" class="row">
                    <div class="col col-xs-8">
                        <h2 class="text-info">ProConnection Connections</h2>
                    </div>

                    <div class="col col-xs-4 text-right">
                        <button id="btnAddConnection" class="btn btn-danger" title="Add New Connection" data-toggle="modal" data-target="#modalNewConnection"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
                    
                </div>

                <div id="FilterTools" class="row well">
                    <div class="col col-xs-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Sort <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">By Recent Conversation</a></li>
                                <li><a href="#">By First Name</a></li>
                                <li><a href="#">By Last Name</a></li>
                                <li><a href="#">By Date Joined</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col col-xs-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Filter <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">All Contacts</a></li>
                                <li><a href="#">Companies</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col col-xs-4 text-right">
                        <button class="btn btn-sm btn-default">
                            Search
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>

                <hr />

                <div id="ConnListing" style="height: 2000px;">

                </div>
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div id="fixed-right-section" class="col col-md-4 affix hidden-print hidden-xs hidden-sm" role="complimentary" data-spy="affix" data-offset-top="60 " data-offset-bottom="200">
                <div class="well">
                    <h3 class="text-primary" style="overflow: auto;">Suggestions</h3>
                </div>

            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; ProConnect 2015</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <div id="modalNewConnection" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Connection</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="NewConnName" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Company</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="NewConnCompany" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Location</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="NewConnLocation" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="NewConnEmail" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/template" id="ConnectionTemplate">
    <div id="UserConnection" class="col col-xs-12">
        <div class="row">
            <div class="col col-xs-4">
                <img width="100px" src="../users/1/images/androidEating.jpg" class="img-rounded" />
            </div>

            <div class="col col-xs-8">
                <h4 class="text-primary ConnectionName">John Doe</h4>
                <p class="ConnectionWork"><span class="ConnectionJob"></span>&nbsp;at&nbsp;<span class="ConnectionCompany"></span></p>
                <p class="ConnectionLocation"></p>

                <ul class="nav nav-pills">
                    <li role="presentation"><a href="#">
                        <span class="glyphicon glyphicon-envelope"><span>&nbsp;Home</a>
                    </li>
                    <li role="presentation"><a href="#">
                        <span class="glyphicon glyphicon-retweet"><span>&nbsp;Connect</a>
                    </li>
                </ul>
            </div>
        </div>

        <hr />
    </div>
    </script>

    <script src="js/ConnectionList.js"></script>
    <script src="js/index.js"></script>
</body>

</html>

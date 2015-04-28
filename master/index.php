<?php
/** 
*   master/index.php - This page will provide a consistent look across all pages; it provides the left navigation, top navigation, and blank content area.
*   the following variables can be used to inject contents into master
*/

if (!isset($Title)) $Title = "Proconnect";
if (!isset($ProfileImage)) $ProfileImage = "/image/user_img.png";
if (!isset($Content)) $Content = "Content not loaded.";

// these are are if the page is active, assign a class "active" to the nav
// these variables are set on the active pages, not here. this is only to check for empty
if (!isset($HomeActive)) $HomeActive = "";
if (!isset($MessageActive)) $MessageActive = "";
if (!isset($ConnectionActive)) $ConnectionActive = "";
if (!isset($ProfileActive)) $ProfileActive = "";
if (!isset($JobActive)) $JobActive = "";
if (!isset($InterestActive)) $InterestActive = "";

?>

<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$Title?></title>
	 <link rel="ICON" href="../image/proconnect/Tab_logo2_bold.ico" type="image/ico" />
    <!-- Compressed Vendor BUNDLE
    Includes vendor (3rd party) styling such as the customized Bootstrap and other 3rd party libraries used for the current theme/module -->
    <link href="/master/css/vendor.min.css" rel="stylesheet">
    <!-- Compressed Theme BUNDLE
Note: The bundle includes all the custom styling required for the current theme, however
it was tweaked for the current theme/module and does NOT include ALL of the standalone modules;
The bundle was generated using modern frontend development tools that are provided with the package
To learn more about the development process, please refer to the documentation. -->
    <!-- <link href="css/theme.bundle.min.css" rel="stylesheet"> -->
    <!-- Compressed Theme CORE
This variant is to be used when loading the separate styling modules -->
    <link href="/master/css/theme-core.min.css" rel="stylesheet">

    <!-- Custom ProConnect CSS -->
    <link rel="stylesheet" type="text/css" href="/master/custom_proconnect/css/master.css">

    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL modules are 100% compatible -->
    <link href="/master/css/module-essentials.min.css" rel="stylesheet" />
    <link href="/master/css/module-layout.min.css" rel="stylesheet" />
    <link href="/master/css/module-sidebar.min.css" rel="stylesheet" />
    <link href="/master/css/module-sidebar-skins.min.css" rel="stylesheet" />
    <link href="/master/css/module-navbar.min.css" rel="stylesheet" />
    <!-- <link href="css/module-media.min.css" rel="stylesheet" /> -->
    <link href="/master/css/module-timeline.min.css" rel="stylesheet" />
    <link href="/master/css/module-cover.min.css" rel="stylesheet" />
    <link href="/master/css/module-chat.min.css" rel="stylesheet" />
    <!-- <link href="css/module-charts.min.css" rel="stylesheet" /> -->
    <link href="/master/css/module-maps.min.css" rel="stylesheet" />
    <!-- <link href="css/module-colors-alerts.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-background.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-buttons.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-calendar.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-progress-bars.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-text.min.css" rel="stylesheet" /> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    <!-- <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" /> -->
    <!-- // <script src="/lib/jquery/jquery-2.1.3.min.js"></script> -->
    <!-- // <script src="/lib/bootstrap/js/bootstrap.min.js"></script> -->

    
</head>
<body>
    <script id="MediaItem" type="text/html">
        <li class="media custom-media-item">
            <div class="media-left">
                <a class="user-url" href="#">
                    <img class="media-object thumb" src="/image/user_img.png" alt="default">
                </a>
            </div>
            <div class="media-body custom-media-body">
                <div class="pull-right">
                    <span class="label label-default time-ago">5 min</span>
                </div>
                <h5 class="media-heading">Default</h5>
                <p class="margin-none snippet-zone">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </li>
    </script>
    <script id="FeedItem" type="text/html">
        <li class="media">
            <div class="media-left">
                <span class="media-object">
                <i class="fa fa-fw fa-bell"></i>
            </span>
            </div>
            <div class="media-body">
                <a href="" class="text-white">Adrian</a> just logged in
                <span class="time">2 min ago</span>
            </div>
            <div class="media-right">
                <span class="news-item-success"><i class="fa fa-circle"></i></span>
            </div>
        </li>
    </script>
    <template id="ao-checkbox">
        <li>
        <!-- <div class="checkbox"> -->
               <input id="" type="checkbox" value checked>  
               <label class="ao-label" for=""></label>
        <!-- </div> -->
        </li>
    </template>
    <!-- Wrapper required for sidebar transitions -->
    <div class="st-container">
        <!-- Fixed navbar -->
        <div class="navbar navbar-main navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-bars"></i></a>
                    <button id="mobile-view-main-nav-btn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                     <form class="navbar-form margin-none navbar-left visible-xs" method="GET" action="/search-results/results.php">
                        <!-- Search -->
                        <div class="search-1">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-search"></i></span>

                                <input type="text" class="form-control" placeholder="Search for people..." name="searchKey">
                                <!-- <span class="input-group-btn">
                                    <input type="submit" class="btn btn-default">Search</input>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right well " role="menu">
                                        <li>
                                            <div>
                                              <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                            </div>
                                        </li>
                                    </ul> -->
                                </span>
                            </div>
                        </div>
                    </form>
                    <!-- <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs "><i class="fa fa-comments"></i></a> -->

                    <a class="navbar-brand navbar-brand-info hidden-xs" href="/feed/" style= "background-color: #1565c0;"><img width="150px" src="../image/proconnect/logo_text.png" alt="ProConnect" style = "margin-top: 10px;"/></a>
                </div>
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="nav navbar-nav ">
                        <!-- messages -->
                        <li id="message-list" class="dropdown notifications notification-icon">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge notification-number notification-red"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <div class="iam-loading" >
                                    <div>
                                      <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                    </div>
                                </div>

                                <!-- <li class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object thumb" src="images/people/50/guy-2.jpg" alt="people">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="pull-right">
                                            <span class="label label-default">5 min</span>
                                        </div>
                                        <h5 class="media-heading">Adrian D.</h5>
                                        <p class="margin-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </div>
                                </li> -->
                                
                            </ul>
                        </li>
                        <!-- // END messages -->
                        <!-- connection -->
                        <li id="connection-list" class="dropdown notifications notification-icon">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fw icon-user-1"></i>
                                <span class="badge notification-number notification-red"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <div class="iam-loading" >
                                    <div>
                                      <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                    </div>
                                </div>
                            </ul>
                        </li>
                        <!-- // END connection -->
                        <!-- notification -->
                        <li id="notification-list" class="dropdown notifications notification-icon">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="badge notification-number notification-red"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <div class="iam-loading" >
                                    <div>
                                      <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                    </div>
                                </div>
                            </ul>
                        </li>
                        <!-- // END notification -->
                    </ul>
                    
                    <form class="navbar-form margin-none navbar-left hidden-xs" method="GET" action="/search-results/results.php">
                        <!-- Search -->
                        <div class="search-1">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-search"></i></span>

                                <input type="text" class="form-control" placeholder="Search for people..." name="searchKey">
                                <!-- <span class="input-group-btn">
                                    <input type="submit" class="btn btn-default">Search</input>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right well " role="menu">
                                        <li>
                                            <div>
                                              <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                            </div>
                                        </li>
                                    </ul> -->
                                </span>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div id="ao-search-btn-grp" class="pull-left visible-sm visible-md visible-lg"> 
                            <ul class="nav navbar-nav ">
                                <li class="ao-search-btn">
                                    <a class="main-nav-search-btn" type="submit">Search</a>
                                </li>
                                
                                <li class="dropdown" >
                                    <a id="ao-show-btn" data-toggle="dropdown" class="dropdown-toggle">
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <div id="ao-main-box" class="dropdown-menu dropdown-menu-right well" role="options">
                                        <div class="iam-loading" >
                                            <div>
                                              <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
                                            </div>
                                        </div>
                                        <h3>Advance Search By:</h3>
                                        <div class="ao-outer">
                                            <div>
                                                <div class="form-group">
                                                    <label for="ao-education">Education</label> 
                                                    <div class="">
                                                        <ul id="ao-education" class="dynamic-result-div list-unstyled">
                                                        </ul> 
                                                        <input class="ao-add-option" type="text" placeholder="+ Add">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="ao-outer">
                                            <div>
                                                <div class="form-group">
                                                    <label for="ao-education">School</label> 
                                                    <div>
                                                        <ul id="ao-school" class="dynamic-result-div list-unstyled">
                                                        </ul> 
                                                        <input class="ao-add-option" type="text" placeholder="+ Add">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <button type="button" class="ao-close close" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                        <!-- Extra Search Button -->
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- END Search Button -->

                        <!-- <div class="pull-left visible-md visible-lg" data-toggle="tooltip" data-placement="bottom" title="A few Color Examples. Download includes CSS Files for all color examples & the tools to Generate any Color combination. This Color-Switcher is for previewing purposes only.">
						<!-- Color bar -->
						 <!--
                        <div class="pull-left visible-md visible-lg" data-toggle="tooltip" data-placement="bottom" title="A few Color Examples. Download includes CSS Files for all color examples & the tools to Generate any Color combination. This Color-Switcher is for previewing purposes only.">
                            <ul class="skins">
                                <li><span data-file="theme-bundle" data-skin="default" style="background: #16ae9f "></span>
                                </li>
                                <li><span data-file="skin-orange" data-skin="orange" style="background: #e74c3c "></span>
                                </li>
                                <li><span data-file="skin-blue" data-skin="blue" style="background: #4687ce "></span>
                                </li>
                                <li><span data-file="skin-purple" data-skin="purple" style="background: #af86b9 "></span>
                                </li>
                                <li><span data-file="skin-brown" data-skin="brown" style="background: #c3a961 "></span>
                                </li>
                            </ul>
                        </div> -->
                    </form>
                            

                    <ul class="nav navbar-nav navbar-user navbar-right pull-right">
                        <!-- User -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img style="object-fit: cover;" width="30px" height="30px" src="<?=$ProfileImage?>" alt="<?=$FullName?>" class="img-circle" /> <?=$FullName?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/profile-user-POV/">Profile</a>
                                </li>
                                <li><a href="/message/">Messages</a>
                                </li>
                                <li><a href="/signout/php/session_signout.php">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <ul class="nav navbar-nav navbar-right hidden-xs">
                        <li class="pull-right">
                            <a href="#sidebar-chat" data-effect="st-effect-1" data-toggle="sidebar-menu">
                                <i class="fa fa-comments"></i>
                            </a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
        <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
        <div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-white-blue" id="sidebar-menu" data-type="collapse">
            <div data-scrollable>
                <ul class="sidebar-menu">
                    <!-- <li><a href="../../index.html"><i class="icon-paint-brush"></i> <span>Themes</span></a></li> -->
                    <!-- <li class="category">Navigation</li> -->
                    <!-- <li class="hasSubmenu">
                        <a href="#timeline"><i class="icon-ship-wheel"></i> <span>Timeline</span></a>
                        <ul id="timeline">
                            <li><a href="index.html"><i class="fa fa-circle-o"></i> <span>Blocks</span></a>
                            </li>
                            <li><a href="timeline-list.html"><i class="fa fa-circle-o"></i> <span>Listing</span></a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="<?=$HomeActive?>"><a href="/feed/"><i class="fa fa-home"></i> <span>Home</span></a>
                    </li>
                    <li class="<?=$ProfileActive?>"><a href="/profile-user-POV/"><i class="icon-user-1"></i> <span>Profile</span></a>
                    </li>
                    <li class="<?=$ConnectionActive?>"><a href="/connections/"><i class="fa fa-group"></i> <span>Connections</span></a>
                    </li>
                    <li class="<?=$MessageActive?>"><a href="/message/"><i class="icon-comment-fill-1"></i> <span>Messages</span></a>
                    </li>
                    <li class="<?=$JobActive?>"><a href="/jobs/"><i class="fa fa-suitcase"></i> <span>Jobs</span></a>
                    </li>
                    <li class="<?=$InterestActive?>"><a href="/interest/"><i class="fa fa-star"></i> <span>Interests</span></a>
                    </li>
                    <!-- <li class="hasSubmenu">
                        <a href="#components"><i class="icon-paint-brushes"></i> <span>UI Components</span></a>
                        <ul id="components">
                            <li><a href="essential-buttons.html"><i class="fa fa-circle-o"></i> <span>Buttons</span></a>
                            </li>
                            <li><a href="essential-icons.html"><i class="fa fa-circle-o"></i> <span>Icons</span></a>
                            </li>
                            <li><a href="essential-progress.html"><i class="fa fa-circle-o"></i> <span>Progress</span></a>
                            </li>
                            <li><a href="essential-grid.html"><i class="fa fa-circle-o"></i> <span>Grid</span></a>
                            </li>
                            <li><a href="essential-forms.html"><i class="fa fa-circle-o"></i> <span>Forms</span></a>
                            </li>
                            <li><a href="essential-tables.html"><i class="fa fa-circle-o"></i> <span>Tables</span></a>
                            </li>
                            <li><a href="essential-tabs.html"><i class="fa fa-circle-o"></i> <span>Tabs</span></a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- Sample 2 Level Collapse -->
                    <!-- <li class="hasSubmenu">
                        <a href="#submenu"><i class="fa fa-chevron-circle-down"></i> <span>Collapse</span></a>
                        <ul id="submenu">
                            <li class="hasSubmenu">
                                <a href="#submenu-1"><i class="fa fa-circle-o"></i> Submenu</a>
                                <ul id="submenu-1">
                                    <li><a href="#">Regular Link</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Regular Link</a>
                            </li>
                        </ul>
                    </li> -->
                </ul>

                
                <i class="fa fa-users pull-right"></i>
                <div class="affix hidden-print hidden-xs hidden-sm" style="position: fixed; padding-left: 20px" role="complimentary" data-spy="affix" data-offset-top="400">
                    <label class="text-info">People You may know...</label>
                    <ul id="SuggListing" class="sidebar-feed nav">
                        
                    </ul>
                </div>
                <!-- <h4 class="category">Filter</h4>
                <div class="sidebar-block">
                    <ul>
                        <li><a href="#" class="sidebar-link"><span class="fa fa-fw fa-circle-o text-success"></span> Work Related</a>
                        </li>
                        <li><a href="#" class="sidebar-link"><span class="fa fa-fw fa-circle-o text-danger"></span> Very Important</a>
                        </li>
                        <li><a href="#" class="sidebar-link"><span class="fa fa-fw fa-circle-o text-info"></span> Friends &amp; Family</a>
                        </li>
                        <li><a href="#" class="sidebar-link"><span class="fa fa-fw fa-circle-o text-primary"></span> Other</a>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
        <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
        <!-- <div class="sidebar sidebar-chat right sidebar-size-2 sidebar-offset-0 chat-skin-white sidebar-visible-mobile" id="sidebar-chat">
            <div class="split-vertical">
                <div class="chat-search">
                    <input type="text" class="form-control" placeholder="Search" />
                </div>
                <ul class="chat-filter nav nav-pills ">
                    <li class="active"><a href="#" data-target="li">All</a>
                    </li>
                    <li><a href="#" data-target=".online">Online</a>
                    </li>
                    <li><a href="#" data-target=".offline">Offline</a>
                    </li>
                </ul>

            </div>
        </div> -->
        <script id="chat-window-template" type="text/x-handlebars-template">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="chat-collapse" data-target="#chat-bill">
                    <a href="#" class="close"><i class="fa fa-times"></i></a>
                    <a href="#">
                        <span class="pull-left">
                    <img src="{{ user_image }}" width="40">
                </span>
                        <span class="contact-name">{{user}}</span>
                    </a>
                </div>
                <div class="panel-body" id="chat-bill">
                    <div class="media">
                        <div class="media-left">
                            <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
                        </div>
                        <div class="media-body">
                            <span class="message">Feeling Groovy?</span>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
                        </div>
                        <div class="media-body">
                            <span class="message">Yep.</span>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
                        </div>
                        <div class="media-body">
                            <span class="message">This chat window looks amazing.</span>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
                        </div>
                        <div class="media-body">
                            <span class="message">Thanks!</span>
                        </div>
                    </div>
                </div>
                <input type="text" class="form-control" placeholder="Type message..." />
            </div>
        </script>

        <?php // include template for displaying Connection Suggestion
            include_once __DIR__."/../ComponentTemplates/ConnectionSuggestionTemplate.html";
        ?>
        <div class="chat-window-container"></div>
        <!-- sidebar effects OUTSIDE of st-pusher: -->
        <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->
        <!-- content push wrapper -->
        <div class="st-pusher" id="content">
            <!-- sidebar effects INSIDE of st-pusher: -->
            <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
            <!-- this is the wrapper for the content -->
            <div class="st-content">
                <!-- extra div for emulating position:fixed of the menu -->
                <div class="st-content-inner">
                    <div class="container-fluid">
                        <?=$Content?>
                    </div>
                </div>
                <!-- /st-content-inner -->
            </div>
            <!-- /st-content -->
        </div>
        <!-- /st-pusher -->
        <!-- Footer -->
        <footer class="footer">
            <strong>ProConnect</strong> Quorious Design &copy; Copyright 2015
        </footer>
        <!-- // Footer -->
    </div>
    <!-- /st-container -->
    <!-- Inline Script for colors and config objects; used by various external scripts; -->
    <script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#1565c0",
        "default-color": "#1565c0",
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
                "primary-color": "#1565c0"
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
    <script src="/master/js/vendor-core.min.js"></script>
    <script src="/master/js/vendor-tables.min.js"></script>
    <script src="/master/js/vendor-forms.min.js"></script>
    <!-- <script src="js/vendor-media.min.js"></script> -->
    <!-- <script src="js/vendor-player.min.js"></script> -->
    <!-- <script src="js/vendor-charts-all.min.js"></script> -->
    <!-- <script src="js/vendor-charts-flot.min.js"></script> -->
    <!-- <script src="js/vendor-charts-easy-pie.min.js"></script> -->
    <!-- <script src="js/vendor-charts-morris.min.js"></script> -->
    <!-- <script src="js/vendor-charts-sparkline.min.js"></script> -->
    <script src="/master/js/vendor-maps.min.js"></script>
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
    <script src="/master/js/module-essentials.min.js"></script>
    <script src="/master/js/module-layout.min.js"></script>
    <script src="/master/js/module-sidebar.min.js"></script>
    <!-- <script src="js/module-media.min.js"></script> -->
    <!-- <script src="js/module-player.min.js"></script> -->
    <script src="/master/js/module-timeline.min.js"></script>
    <!--<script src="/master/js/module-chat.min.js"></script>-->
    <!--<script src="/master/js/module-maps.min.js"></script>-->
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
    <script src="/master/js/theme-core.min.js"></script>

    <!-- Custom ProConnect -->
    <script type="text/javascript" src="/master/custom_proconnect/js/NotificationGetter.js"></script>
    <script type="text/javascript" src="/master/custom_proconnect/js/AdvanceSearchInterfaceHandler.js"></script>
    <script type="text/javascript" src="/master/custom_proconnect/js/MessageGetter.js"></script>
    <script type="text/javascript" src="/master/custom_proconnect/js/MediaItemFactory.js"></script>
    <script src="../connections/js/NewConnection.js"></script>
    <script src="../connections/js/SuggestionList.js"></script>
    <script type="text/javascript" src="/master/custom_proconnect/js/master.js"></script>
</body>
</html>
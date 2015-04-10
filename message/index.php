<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
// include '../signout/php/session_check_signout.php';

$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];


$page_title = "Message Center"; //require for front end
include '../header/header.php';
?>

    <div class="container">

        <div class="row">

            <div class="col col-md-12">

                <div id="ConnectionsHeader" class="row">
                
                    <div class="col col-xs-8">
                        <h2 class="text-info">ProConnect Message Center</h2>            
                    </div>
                </div>            

                <div class="col col-xs-4 well" id="sidebar">
                
                    <div id="sidebar-content">
                        
                        <a href="#" class="list-group-item">New<span class="sidebar-icon glyphicon glyphicon-pencil"></span></a>

                        <hr />
                    
                        <ul class="list-group" id="message-form">
                            <li><a href="#" id="main-inbox" class="list-group-item" value="Inbox">Inbox<span class="sidebar-icon glyphicon glyphicon-envelope"></span></a></li>
                            <li><a href="#" id="main-outbox" class="list-group-item" value="Outbox">Outbox<span class="sidebar-icon glyphicon glyphicon-envelope"></span></a></li>
                            <li><a href="#" id="main-archive" class="list-group-item" value="Archive">Archive<span class="sidebar-icon glyphicon glyphicon-envelope"></span></a></li>
                            <li><a href="#" id="main-trash" class="list-group-item" value="Trash">Trash<span class="sidebar-icon glyphicon glyphicon-trash"></span></a></li>              
                        </ul>
                    </div>

                    <hr />

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                        </div>
                </div>

                <div id="message-div" class="col col-xs-6 well">

                    

                    
                </div>
                
                <div id="fixed-right-section" class="col col-xs-4 affix hidden-print hidden-xs hidden-sm" role="complimentary" data-spy="affix" data-offset-top="200 " data-offset-bottom="200">
                <div class="well">
                    <h3 class="text-primary" style="overflow: auto; margin-top: 8px; margin-bottom: 19px;">Suggestions</h3>
                    <hr />

                    <div id="SuggListing" >

                    </div>

                    <div id="SuggestionsListEndAlert" class="alert alert-info hidden text-center"></div>
                </div>
            </div>
            </div>
        </div>
    </div>

<script type="text/template" id="update-message-frame">
    <h3 style="margin-top: 8px; margin-bottom: 19px; color: #337AB7;"><p class="message-frame-name"></p></h3>

        <hr />

            <div id="message-view">
                <div id="inbox" class="col col-md-12">
                </div>
            </div>
</script>

  <!-- Custom styles for this template -->
  <link href="css/index.css" rel="stylesheet">
  <!-- Custom modal handler
  <script src="js/MessageFrame.js"></script>
  <script src="js/UserConnection.js"></script>
  <script src="js/NewConnection.js"></script>
  <script src="js/SuggestionList.js"></script>
  <script src="js/ConnectionList.js"></script>
  <script src="js/NewConnectionSearch.js"></script> -->
  <script src="js/index.js"></script>
  <!-- Custom CSS -->
  <link href="css/index.css" rel="stylesheet">

</body>

</html>


                            <!--
                            <div id="message-content" class="well well-sm">
                                
                                <div class="row">
                                    <div class="col col-xs-12">
                                        <img width="50px" src="../image/user_img.png" class="img-rounded" style="float: left; margin-right:10px;"/>
                                        <h4 class="text-primary ConnectionName">John Doe</h4>
                                    </div>

                                    <div id="message-text" class="col col-xs-12">
                                        <hr />
                                        <p>This is a weird message meant for testing, I have no clue why I am writing this. Oh wait yeah I do, for testing purposes... right. Okay, I don't like reading. I want to eat.</p>
                                        <hr />
                                    </div>

                                    <div id="footers" >
                                        <ul class="nav nav-pills">
                                            <li role="presentation"><a href="#"><span class="glyphicon glyphicon-envelope"><span>&nbsp;Email</a></li>
                                            <li role="presentation"><a class="removeConnection" href="#"><span class="glyphicon glyphicon-remove"><span>&nbsp;Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
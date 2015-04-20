<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
// include '../signout/php/session_check_signout.php';

$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

$page_title = "Message Center"; //require for front end
include '../header/header.php';
?>

    <div class="container"><section id="demo">

        <div class="row">

            <div class="col col-md-12">

                <div id="ConnectionsHeader" class="row">
                
                    <div class="col col-xs-8">
                        <h2 class="text-info">ProConnecting</h2>            
                    </div>

                </div>            

                <div class="col col-xs-4 col col-sm-12 well" id="sidebar" role="navigation">
                
                    <div id="sidebar-content">
                        
                        <a href="#" id="main-new" class="list-group-item" value="New Message">New<span class="sidebar-icon glyphicon glyphicon-pencil"></span></a>

                        <hr />

                        <div id="nav-container">
                            <!-- this empty div is filled with sidebar frame -->
                        </div>

                        <hr />

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </div>       
                </div>

                <div id="message-div" class="col col-xs-4 well">
                    <!-- this empty div is filled with either one of the four message boxes, or a new message frame -->                  
                </div>
                
                <div id="fixed-right-section" class="col col-xs-4" role="complimentary">
                <div class="well">
                    <h3 class="text-primary" style="margin-top: 8px; margin-bottom: 19px;">Suggestions</h3>
                    <hr />

                    <div id="SuggListing" >
                        <!-- this empty div is filled with suggested connections -->
                    </div>

                    <div id="SuggestionsListEndAlert" class="alert alert-info hidden text-center"></div>
                </div>
            </div>
            </div>
        </div>
    </div>

<!-- script for each message box: Inbox, Outbox, Archive, Trash -->
<script type="text/template" id="update-message-frame">
    <h3 style="margin-top: 8px; margin-bottom: 19px; color: #337AB7;"><p class="message-frame-name"></p></h3>

        <hr />

            <div id="message-view">
                <div class="message-frame-display" class="col col-md-12">
                </div>
            </div>
</script>

<!-- script for textfield -->
<script type="text/template" id="message-textfield">
    <div class="message-content" class="well well sm">
        <input type+"text" name="newMSG" class="form-control typeahead" id="recipient-textarea" placeholder="Enter the name of the recipient..."><br>
        <input type+"text" name="newMSG" class="form-control typeahead" id="recipient-subject-textarea" placeholder="Subject"><br>
    </div>
    <div class="message-content" class="well well-sm">
                                
        <textarea name="summary" class="form-control" id="summary-textarea" rows="10"></textarea> <br>
        <button type="submit" class="btn btn-primary save-btn">Save</button>
        <button type="button" class="btn btn-default cancel-btn">Cancel</button>
     </div>
</script>

<!-- script for creating filling messages to the display -->
<script type="text/template" id="sender-message-content">
    <div id="message-content" class="well well-sm">                            
        <div class="row">
            <div class="col col-xs-12">
                    <img width="75px" src="../image/user_img.png" class="img-rounded" style="float: left; margin-right:10px;"/>
                <h4 class="text-primary ConnectionName"><strong><a href="#" class="sender-name">John Doe</a></strong></h4>
                <strong><p class="message-subject">Test</p></strong>
                <p class="message-time">message time</p>
            </div>
            <div class="col col-xs-12">
            <div  class="message-text">
                <hr />
                <article>
                    <p class="sender-message">Test</p>
                </article>
                
                <hr />
                </div>
            </div>

            <div id="footers" >
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="#" class="message-friend"><span class="glyphicon glyphicon-envelope"><span>&nbsp;Email</a></li>
                    <li role="presentation"><a href="#" class="remove-mail" ><span class="glyphicon glyphicon-remove"><span>&nbsp;Remove</a></li>
                </ul>
            </div>
        </div>
    </div>
</script>

<!-- sidebar view for small screens -->
<script type="text/template" id="sidebar-small-temp">
    <ul class="list-group" id="small-navigator">
        <li ><a href="#" class="list-group-item"><span>Message Nav</span></a>
            <ul class="list-group" id="message-form">
                <li><a href="#" class="list-group-item" id="main-inbox" value="Inbox">Inbox<span class="sidebar-icon glyphicon glyphicon-inbox"></span></a></li>
                <li><a href="#" class="list-group-item" id="main-outbox" value="Outbox">Outbox<span class="sidebar-icon glyphicon glyphicon-send"></span></a></li>
                <li><a href="#" class="list-group-item" id="main-archive" value="Archive">Archive<span class="sidebar-icon glyphicon glyphicon-folder-open"></span></a></li>
                <li><a href="#" class="list-group-item" id="main-trash" value="Trash">Trash<span class="sidebar-icon glyphicon glyphicon-trash"></span></a></li>                                    
            </ul>
        </li>                                  
    </ul>
</script>

<!-- sidebar view for large screens -->
<script type="text/template" id="sidebar-large-temp">
    <ul class="list-group" id="message-form">
        <li><a href="#" class="list-group-item" id="main-inbox" value="Inbox">Inbox<span class="sidebar-icon glyphicon glyphicon-inbox"></span></a></li>
        <li><a href="#" class="list-group-item" id="main-outbox" value="Outbox">Outbox<span class="sidebar-icon glyphicon glyphicon-send"></span></a></li>
        <li><a href="#" class="list-group-item" id="main-archive" value="Archive">Archive<span class="sidebar-icon glyphicon glyphicon-folder-open"></span></a></li>
        <li><a href="#" class="list-group-item" id="main-trash" value="Trash">Trash<span class="sidebar-icon glyphicon glyphicon-trash"></span></a></li>                                    
    </ul>
</script>

  <!-- Custom modal handler
  <script src="js/MessageFrame.js"></script>-->
  <script src="js/index.js"></script>
  <script src="js/LoadInbox.js"></script>
  <script src="js/Inbox.js"></script>
  <script src="js/LoadOutbox.js"></script>
  <script src="js/Outbox.js"></script>
  <script src="js/LoadArchive.js"></script>
  <script src="js/Archive.js"></script>
  <script src="js/LoadTrash.js"></script>
  <script src="js/Trash.js"></script>
  <script src="js/SuggestionList.js"></script>
  <script src="js/readmore.js"></script>
  <!-- Custom CSS -->
  <link href="css/index.css" rel="stylesheet">

</body>
</html>
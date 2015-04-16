<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
// include '../signout/php/session_check_signout.php';

$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

$page_title = "Message Center"; //require for front end
include '../header/header.php';
?>

    <div id="loading-main">
        <img src="../image/ajax-loader.gif">
    </div>
    <div class="container">

        <div class="row">

            <div class="col col-md-12">

                <div id="ConnectionsHeader" class="row">
                
                    <div class="col col-xs-8">
                        <h2 class="text-info" style="color: #DDDDDD;">ProConnecting</h2>            
                    </div>

                </div>            

                <div class="col col-xs-4 col col-sm-12 well" id="sidebar" role="navigation">
                
                    <div id="sidebar-content">

                        <div class="new-message-btn">
                            <a href="#" id="main-new" class="list-group-item" value="New Message">New<span class="sidebar-icon glyphicon glyphicon-pencil"></span></a>
                        </div>
                        <hr />

                        <div id="nav-container">
                            <!-- this empty div is filled with sidebar frame -->
                        </div>

                        <hr />

                        <div class="input-group" id="searching">
                            <form id="search-form">
                                <input type="text" class="form-control typeahead" id="search-subject" placeholder="Search..." val="">
                                <span class="input-group-btn"><button class="btn btn-default" type="button" id="search-button"><span class="glyphicon glyphicon-search"></span></button></span>
                            </form>
                        </div>
                    </div>       
                </div>
                    <div id="message-div" class="col col-xs-12 well">
                        <input type="hidden" name="pageNumber" id="pageNumber" value="1"/>
                        <div>
                        <h3 style="margin-top: 8px; margin-bottom: 19px; color: #337AB7;"><p class="message-frame-name"></p></h3>

                        <div class="text-right" id="remove-trash">
                            <button class="btn btn-default" type="button" id="empty-trash">Empty Trash</button>
                        </div>
                        </div>
                    
                        <hr />
                        <div id="message-view">
                            <div class="message-frame-display" class="col col-md-12">
                            </div>
                        </div>
                        <div id="MessageListEndAlert" class="alert alert-info hidden text-center"></div>
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

<!-- script for textfield -->
<script type="text/template" id="message-textfield">
    <div class="message-content" class="well well sm">
        <form>
            <input type="text" name="newMsgRecipient" class="form-control typeahead" id="recipient-textarea" autocomplete="off" data-provide="typeahead" placeholder="Enter the name of the recipient..." value=""/><br>
            <input type="hidden" name="userID" id="userID" value=""/>
            <input type="text" name="newMsgSubject" class="form-control" id="recipient-subject-textarea" placeholder="Subject"/><br>
            <div id="loading-sent">
                <img src="../image/ajax-loader.gif">
            </div>
            <textarea name="summary" class="form-control" id="summary-textarea" rows="10"></textarea> <br>
    </form>

    </div>
    <div class="message-content" class="well well-sm">
        <button type="submit" class="btn btn-primary send-btn">Save</button>
        <button type="button" class="btn btn-default cancel-btn">Cancel</button>
     </div>
</script>

<!-- script for filling messages to the display -->
<script type="text/template" id="sender-message-content">
    <div id="message-content" class="well well-sm">
        <input type="hidden" class"messageID" name="messageID" value="" />                           
        <div class="row">
            <div class="col col-xs-12">
                <a href="#" class="sender-href"><img src="../image/user_img.png" class="img-rounded sender-picture" style="float: left; margin-right:10px;"/></a>
                <h4 class="text-primary ConnectionName"><strong><a href="#" class="sender-href"><span class="sender-name">John Doe</span></a></strong></h4>
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
            <div id="footers">
                <ol class="nav nav-pills">
                    
                </ol>
            </div>
            <!--
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>Enter a valid email address
            </div> -->
        </div>
    </div>
</script>

<script type="text/template" id="message-nav-temp">
    <div id="message-nav-footer">
        <div class="row">
            <div class="col col-xs-12 text-right">
                <div class="btn-group" role="group" aria-label="...">
                    <ul class="nav nav-pills">
                        <li role="presentation"><a href="#" id="prev-page"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Prev</a></li>
                        <li role="presentation"><form id="page-jumper-form"><input type="text" name="page-jumper" class="form-control" id="page-jumper" placeholder="" value=""/></form></li>
                        <li role="presentation"><a href="#" id="next-page">Next&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></a></li>
                    </ul>
                </div>
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

  <!-- Custom modal handler -->
  <script src="js/index.js"></script>
  <script src="js/LoadMessages.js"></script>
  <script src="js/SearchMessages.js"></script>
  <script src="js/Messages.js"></script>
  <script src="js/SuggestionList.js"></script>
  <script src="js/NewMessage.js"></script>
  <script src="js/readmore.js"></script>
  <script src="js/typeahead.js"></script>
  <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
  <script src="//underscorejs.org/underscore-min.js"></script>

  <!-- Custom CSS -->
  <link href="css/index.css" rel="stylesheet">

</body>
</html>
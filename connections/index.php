<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug

include '/signout/php/session_check_signout.php';

session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

$Title = "Feed - Proconnect";
$ProfileImage = '/users/'.$UData['USERID'].'/images/'.$UData['PROFILEIMAGE'];
$JobTitle = $UData['TITLE'];

ob_start();
?>
    <!-- Custom CSS -->
    <link href="css/index.css" rel="stylesheet">

    <div class="wrapper" style="padding: 20px;">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col col-md-12 col-sm-10 col-xs-10">
                <div id="ConnectionsHeader" class="row">
                    <div class="col col-xs-8">
                        <h2 class="text-info">Connections</h2>
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

                <div id="ConnListing" class="row">

                </div>

                <div id="ConnectionsListEndAlert" class="alert alert-info hidden text-center"></div>
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <!-- <div id="fixed-right-section" class="col col-md-4 affix hidden-print hidden-xs hidden-sm" role="complimentary" data-spy="affix" data-offset-top="200 " data-offset-bottom="200">
                <div class="well">
                    <h3 class="text-primary" style="overflow: auto;">Suggestions</h3>
    				<hr />

    				<div id="SuggListing" >

    				</div>

                    <div id="SuggestionsListEndAlert" class="alert alert-info hidden text-center"></div>
                </div>
            </div> -->
        </div>
        <!-- /.row -->
    </div>

    <div id="modalNewConnection" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-primary">Add New Connection</h4>
                    <p class="text-info">Please enter name or email of the new connection you want to add:</p>
                </div>
                <div class="modal-body">
                    <form id="NewConnectionSearchForm" class="form-horizontal" action="php/SearchNewConnection_controller.php">
                        <!-- <div class="form-group">
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
                        </div> -->

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-9 input-group">
                                <input type="text" class="form-control keywords" name="NewConnKeywords" />

                                <span class="input-group-btn">
                                    <button class="btn btn-primary submit" type="button" title="Search">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                  </span>
                            </div>
                        </div>
                    </form>

                    <div class="searchResults"></div>
                </div>
                <div class="modal-footer">
                    <div id="NewConnectionSearchAlert" class="alert alert-warning hidden"></div>
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/template" id="ConnectionTemplate">
    <div class="UserConnection col-lg-4 col-md-4 col-sm-6 col-xs-12 item" style="height: 180px;">
        <input type="hidden" class="UserID" name="UserID" value="" />
        <div class="well well-sm">
            <div class="row">
                <div class="col col-xs-4">
                    <img style="object-fit: cover; margin-left: 10px;" width="100px" height="100px" src="../image/user_img.png" class="img-circle ProfileImage" />
                </div>

                <div class="col col-xs-8">
                    <h4 class="text-primary ConnectionName">John Doe</h4>
                    <p class="ConnectionWork"><span class="ConnectionJob"></span>&nbsp;at&nbsp;<span class="ConnectionCompany"></span></p>
                    <p class="ConnectionLocation"></p>

                    <ul class="nav nav-pills">
                        <li role="presentation"><a href="#">
                            <span class="glyphicon glyphicon-envelope"><span>&nbsp;Email</a>
                        </li>
                        <li role="presentation"><a class="removeConnection" href="#">
                            <span class="glyphicon glyphicon-remove"><span>&nbsp;Remove</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </script>
	
	<script type="text/template" id="SuggestionTemplate">
    <div class="NewUserConnection" class="col col-xs-12">
        <input type="hidden" class="UserID" name="UserID" value="" />
        <div class="row">
            <div class="col col-xs-3">
                <img width="50px" src="../image/user_img.png" class="img-rounded ProfileImage" />
            </div>

            <div class="col col-xs-9">
                <h5 class="text-primary ConnectionName" style="margin-top: 0px; margin-bottom: 7px;">John Doe</h5>
                <p class="ConnectionWork" style= "font-size: 12px;"><span class="ConnectionJob"></span>&nbsp;at&nbsp;<span class="ConnectionCompany"></span></p>
                   <a class="addNewConnection" href="#" style= "font-size: 12px;">
                   <span class="glyphicon glyphicon-retweet">&nbsp;<span class="txt">Connect</span></a>
                    &nbsp;&#8226;
				   <a class="dismissConnection" href="#" style= "font-size: 12px; color: gray;">Skip</a>
            </div>
        </div>

        <hr />
    </div>
    </script>

<?php
    $Content = ob_get_clean();
    include __DIR__."/../master/index.php";
?>
    <script src="js/UserConnection.js"></script>
    <script src="js/NewConnection.js"></script>
    <script src="js/SuggestionList.js"></script>
    <script src="js/ConnectionList.js"></script>
    <script src="js/NewConnectionSearch.js"></script>
    <script src="js/index.js"></script>

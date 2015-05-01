<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug

include '/signout/php/session_check_signout.php';

session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

$Title = "Feed - Proconnect";
if (isset($_COOKIE['__USER_PROFILE_IMAGE__'])) {
    $ProfileImage = $_COOKIE['__USER_PROFILE_IMAGE__'];
} else {
    $ProfileImage = '/image/user_img.png';
}
$JobTitle = $UData['TITLE'];
$ConnectionActive = 'active';

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

                <!-- <div id="FilterTools" class="row well">
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
                </div> -->

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

        <div id="modalNewConnection" class="modal fade" role="dialog" data-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-primary">Add New Connection</h4>
                        <p class="text-info">Please enter name or email of the new connection you want to add:</p>
                    </div>
                    <div class="modal-body">
                        <form id="NewConnectionSearchForm" class="form-horizontal" action="php/SearchNewConnection_controller.php">

                            <div class="form-group">
                                <div class="col-xs-10 col-xs-offset-1 input-group">
                                    <input type="text" class="form-control keywords" name="NewConnKeywords" />

                                    <span class="input-group-btn">
                                        <button class="btn btn-primary submit" type="button" title="Search">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                      </span>
                                </div>
                            </div>
                        </form>

                        <ul class="searchResults nav"></ul>
                    </div>
                    <div class="modal-footer">
                        <div id="NewConnectionSearchAlert" class="alert alert-warning hidden"></div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <script type="text/template" id="ConnectionTemplate">
    <div class="UserConnection col-lg-4 col-md-4 col-sm-6 col-xs-12 item" style="height: 180px; margin: 20px 0;">
        <input type="hidden" class="UserID" name="UserID" value="" />

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="media">
                    <div class="pull-left text-center">
                        <img src="../image/user_img.png" alt="people" style="object-fit: cover; padding: 0px;" width="100px" height="100px" class="media-object img-circle ProfileImage" />
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a class="ConnectionName text-primary" href="#">Adrian D.</a>
                        </h4>
                        <br />
                        <div class="text-info">
                            <span><i class="fa fa-briefcase"></i>&nbsp;&nbsp;<span class="ConnectionJob">Job Here</span></span>&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <br />
                            <span><i class="fa fa-building"></i>&nbsp;&nbsp;<span class="ConnectionCompany">Company Here</span></span>

                            <br />
                            <p><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<span class="ConnectionLocation"></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer BlurHide text-right">
                <a href="#" class="btn btn-default btn-sm emailConnection"><i class="fa fa-envelope"></i>&nbsp;Email</a>
                <a href="#" class="btn btn-default btn-sm removeConnection"><i class="fa fa-remove"></i>&nbsp;Remove</a>
            </div>
        </div>
    </div>
    </script>
<?php
    include_once __DIR__."/../ComponentTemplates/ConnectionSuggestionTemplate.html";
?>

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

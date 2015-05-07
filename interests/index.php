<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
// initialize variables with default values
include '/signout/php/session_check_signout.php';

session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
if (isset($_COOKIE['__USER_PROFILE_IMAGE__'])) {
    $ProfileImage = $_COOKIE['__USER_PROFILE_IMAGE__'];
} else {
    $ProfileImage = '/image/proconnect/Tab_logo2_100x100.png';
}

$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];
$Title = "Interests - Proconnect";
$JobTitle = $UData['TITLE'];
$HomeActive = 'active';

ob_start();

?>
    <link rel="stylesheet" type="text/css" href="../lib/lightbox/ekko-lightbox.min.css" />
    <link rel="stylesheet" type="text/css" href="../lib/lightbox/dark.css" />
    <link rel="stylesheet" type="text/css" href="../lib/typeahead/dist/css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />

    <div class="container-fluid">
        <div class ="row" id="interest-navigation">
            <div class="col col-xs-11 col-sm-11 col-md-12 col-lg-12 text-right" id="interest-navigation-big">
                <button class="btn btn-lg interest-expand" style="color: #333;font-size: 25px; width: 100%; background-color: #ccc;"><i class="glyphicon glyphicon-th"></i></button>
            </div>
            <div class="col col-xs-11 col-sm-11 col-md-12 col-lg-12 text-right">
                <div>
                    <input type="hidden" name="boolean flag" value="false" id="flag">
                    
                    <div class="well" id="interest-container">
                        <div class="form-group">
                            <input type="text" placeholder="Search Interests" class="form-control searchedInterest typeahead" name="searchedInterest" id="searchedInterest" value="" style="background-color: white;">
                        </div>
                        <div id="wrapper">
                            <div class="row text-center" id="interest-wrapper" style="margin-top: 25px;">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-xs-12 clearfix" style="height: 50px;"></div>
        </div>
        <div class="interest-feed-pool">
            <div class="cover profile hidden">
                <div id="PostSearchContainer" class="wrapper ">
                    
                </div>
            </div>

            <div id="FeedsSection" class="timeline row">
                <div id="FeedZone1" class="col-xs-12 col-md-6 col-lg-4"></div>
                <div id="FeedZone2" class="col-xs-12 col-md-6 col-lg-4"></div>
                <div id="FeedZone3" class="col-xs-12 col-md-6 col-lg-4"></div>
            </div>

            <div class="row">
                <div id="FeedListEndAlert" class="alert alert-info text-center clearfix" style="margin: 50px 20px; display:none;"></div>
            </div>
        </div>
    </div>

    <div class="modal fade feedModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script type="text/template" id="interest-div"> 
        <div class="col col-xs-12 col-sm-12 col-md-6">
            <a href="#" style="text-decoration: none;" class="hash-edit">
                <div class="div-btn well-sm" id="" style="margin: 5px;">
                    <input type="hidden" name="interestID" class="interestID" value="">
                    <input type="hidden" name="interestName" class="interestName" value=""> 
                    <h4><p class="interestN"></p></h4>
                </div>
            </a>
        </div>
        
    </script>

    <script type="text/template" id="FeedTemplate">
        <div class="feed box col-xs-12 col-md-12 col-lg-12">

            <input type="hidden" class="FeedID" name="FeedID" value="" />
            <input type="hidden" class="F2UID" name="F2UID" value="" />

            <div class="timeline-block">
                <div class="panel panel-default share clearfix-xs">
                    <div class="panel-heading panel-heading-gray title">
                        <div class="media user-wrapper">
                            <div class="media-left col-xs-4">
                                <div style="width: 50px; height: 50px;">
                                    <img src="/image/user_img.png" alt="people" style="object-fit: cover;"
                                    class="img-circle media-object creatorImage hidden-xs" width="50px" height="50px" />
                                    <img src="/image/user_img.png" alt="people" style=""
                                    class="img-rounded media-object creatorImage hidden-sm hidden-md hidden-lg" width="80" />
                                </div>
                            </div>
                            <div class="media-body">
                                <a href="#" class="AuthorLink">{{UserName}}</a>
                                <span class="contentHeading">
                                    What&acute;s new
                                </span>
                                <span class="timestamp label label-muted pull-right">19 OCT</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body feed-content">
                        <div class="contentMessage" style="max-height: 200px; overflow: hidden; text-overflow: ellipsis;"></div>
                        <div>
                            <a class="contentImageLink" data-toggle="lightbox" href="{{ImageURL}}">
                              <img class="media-object contentImage thumbnail" style="max-width: 100%;" src=".{{ImageURL}}" />
                            </a>
                        </div>

                        <div>
                            <iframe class="YouTubeFrame" style="min-height: 300px;" width="100%" src="https://www.youtube.com/embed/{{YouTubeID}}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="text-right">
                            <label class="label label-default labelInterestCategory">
                                <i class="fa fa-tag"></i>&nbsp;&nbsp;<span class="InterestCategory"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="text/template" id="CommentTemplate">
        <li class="media media-clearfix-xs comment">
            <input type="hidden" class="CommentID" name="CommentID" value="" />
            <input type="hidden" class="CommentFeedID" name="CommentFeedID" value="" />

            <div class="media-left">
                <div class="user-wrapper text-center">
                    <img src="/image/user_img.png" alt="people" style="object-fit: cover;"
                    class="img-circle media-object CreatorImage hidden-xs" width="40" height="40" />
                    <div><small><a href="#" class="CreatorName">{{FirstName}}</a></small>
                    </div>
                </div>
            </div>
            <div class="media-body">
                <div class="text-right CommentTimestamp"></div>
                <div class="media-body-wrapper CommentMessage">
                    
                </div>
            </div>
        </li>
    </script>

<?php
    $Content = ob_get_clean();
    include __DIR__."/../master/index.php";
?>
    <script src="../lib/js/FileUpload.js"></script>
    <!-- Hung typeahead -->
    <script src="../lib/typeahead/dist/typeahead.bundle.min.js"></script>
    <!-- Quoc typeahead -->

 <!--  //<script src="/lib/bootstrap/js/bootstrap-typeahead.min.js"></script>
  //<script src="/lib/js/underscore-min.js"></script>
  //<script src="js/typeahead.js"></script> -->
    <script src="../lib/lightbox/ekko-lightbox.js"></script>
    <script src="../feed/js/Comment.js"></script>
    <script src="../feed/js/CommentList.js"></script>
    <script src="../feed/js/NewPost.js"></script>
    <script src="../feed/js/Feed.js"></script>
    <script src="../feed/js/FeedList.js"></script>
    <script src="js/InterestFiller.js"></script>
    <script src="js/index.js"></script>
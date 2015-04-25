<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
// initialize variables with default values
include '/signout/php/session_check_signout.php';

session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

$Title = "Feed - Proconnect";
$ProfileImage = '/users/'.$UData['USERID'].'/images/'.$UData['PROFILEIMAGE'];
$JobTitle = $UData['TITLE'];

ob_start();

?>
    <link rel="stylesheet" type="text/css" href="../lib/lightbox/ekko-lightbox.min.css" />
    <link rel="stylesheet" type="text/css" href="../lib/lightbox/dark.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    
    
        <div class="row">
            <!-- Left main content -->
            <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div id="SelfSection" class="well well-sm">
                    <div id="UserStats" class="row">
                        <div id="ProfileCard" class="col col-xs-12 col-sm-6">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                      <img class="media-object img-circle" style="object-fit: cover;" width="100px" height="100px" src="<?=$ProfileImage?>" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading txt-warning"><?=$FullName?></h4>
                                    <em class="text-muted"><?=$JobTitle?></em>
                                </div>
                            </div>
                        </div>

                        <div id="StatsCard" class="col col-xs-12 col-sm-6 hidden-xs" style="border-left: 1px solid #CCC;">
                            <ul class="list-group" style="margin-top: 10px; margin-bottom: 10px; font-size: 16px;">
                              <li class="list-group-item"><a>124</a>&nbsp;&nbsp; connections.&nbsp;&nbsp; <a>Grow your network.</a></li>
                              <li class="list-group-item"><a>25</a>&nbsp;&nbsp; endorsements.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="NewPost" class="well well-sm">
                    <div class="row">
                        <form id="formNewPost" action="feed_controller.php" class="col col-xs-12" style="display: none;">
                            <div class="form-group">
                                <div class="media">
                                    <div class="media-body">
                                        <textarea class="form-control" id="ContentMessage" name="ContentMessage" rows="5" placeholder="share, inspire, motivate,..."></textarea>
                                    </div>

                                    <div class="media-right">
                                        <img src="" id="ImagePreview" class="thumbnail" style="max-height: 150px; display: none;" alt="No Image Preview Available" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <a id="btnAttachImg" class="btn btn-default btnAttachImg"><span class="glyphicon glyphicon-picture"></span></a>
                                <button id="btnSharePost" class="btn btn-primary pull-right">Share</button>
                                <hr/>
                                <div class="hiddenInputs">
                                    <input type="file" class="hidden" id="FeedImage" name="FeedImage" /><!-- temp image / not yet uploaded -->
                                    <!-- uploaded image link only populate when upload then reset after sumission -->
                                    <input type="text" class="hidden" id="ImageURL" name="ImageURL" value="" />

                                    <div id="AlertNewPost" class="alert alert-info" style="display: none;"></div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                         <div class="col col-xs-10">
                            <blockquote>A person who never made a mistake never tried anything new.</blockquote>
                        </div>

                        <div class="col col-xs-2 text-right">
                             <button id="btnPostMode" class="btn btn-danger" title="New Post">Post</button>
                        </div>
                    </div>
                </div>

                <div id="FeedsSection">

                </div>

                <div id="FeedListEndAlert" class="alert alert-info text-center" style="margin: 50px 20px; display:none;"></div>
            </div>

            <!-- Right suggestions column -->
            <!-- Blog Sidebar Widgets Column -->
            <!-- <div id="fixed-right-section" class="col col-md-4 affix hidden-print hidden-xs hidden-sm" style="position: fixed;" role="complimentary" data-spy="affix" data-offset-top="200 ">
                <div class="well">
                    <h3 class="text-primary" style="overflow: auto;">Suggestions</h3>
                    <hr />

                    <div id="SuggListing" >

                    </div>

                    <div id="SuggestionsListEndAlert" class="alert alert-info hidden text-center"></div>
                </div>
            </div> -->
        </div>
        

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

    <script type="text/template" id="FeedTemplate">
        <div class="media feed">
            <input type="hidden" class="FeedID" name="FeedID" value="" />
            <div class="media-left">
                <a href="#">
                  <img class="media-object creatorImage img-circle" style="object-fit: cover;" width="100px" height="100px" src="{{CreatorImage}}" alt="{{UserName}}">
                </a>
            </div>
            <div class="media-body well well-sm">
                <h4 class="media-heading contentHeading">{{User}} shared: </h4>
                <hr />
                <div class="feed-content">
                    <div class="media">
                        <div class="media-body contentMessage">
                            
                        </div>

                         <div>
                            <a class="contentImageLink" data-toggle="lightbox" href="{{ImageURL}}">
                              <img class="media-object contentImage thumbnail" style="max-width: 700px;" src=".{{ImageURL}}" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="feed-actions">
                    <ul class="nav nav-pills">
                        <li role="presentation"><a class="feedLike" href="#">Like</a></li>
                        <li role="presentation"><a class="feedComment" href="#">Comment</a></li>
                        <li role="presentation"><a class="feedShare" href="#">Share</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </script>

<?php
    $Content = ob_get_clean();
    include __DIR__."/../master/index.php";
?>
    <script src="../connections/js/NewConnection.js"></script>
    <script src="../connections/js/SuggestionList.js"></script>
    <script src="../lib/js/FileUpload.js"></script>
    <script src="../lib/ckeditor/ckeditor.js"></script>
    <script src="../lib/lightbox/ekko-lightbox.js"></script>
    <script src="js/NewPost.js"></script>
    <script src="js/Feed.js"></script>
    <script src="js/FeedList.js"></script>
    <script src="js/index.js"></script>
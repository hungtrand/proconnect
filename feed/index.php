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
$HomeActive = 'active';

ob_start();

?>
    <link rel="stylesheet" type="text/css" href="../lib/lightbox/ekko-lightbox.min.css" />
    <link rel="stylesheet" type="text/css" href="../lib/lightbox/dark.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    
        <div class="cover profile">
            <div class="wrapper">
                <div class="cover cover-image-full overlay">
                    <img src="/image/BlurStreet.jpeg" alt="Profile Cover" />
                </div>
            </div>
            <div class="cover-info">
                <div class="avatar">
                    <img src="<?=$ProfileImage?>" alt="<?=$FullName?>" style="object-fit: cover;"/>
                </div>
                <div class="name"><a href="#"><?=$FullName?>&nbsp;-&nbsp;<small><em><?=$JobTitle?></em></small></a>
                </div>
                <ul class="cover-nav">
                    <li class="active"><a href="index.html"><i class="fa fa-fw icon-ship-wheel"></i> Timeline</a>
                    </li>
                    <li><a href="profile.html"><i class="fa fa-fw icon-user-1"></i> About</a>
                    </li>
                    <li><a href="users.html"><i class="fa fa-fw fa-users"></i> Friends</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <!-- Left main content -->
            <div class="col col-xs-11 col-sm-11 col-md-9 col-lg-9">
                <!-- <div id="SelfSection" class="well well-sm">
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
                </div> -->

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
                                <div class="input-group" style="display:none;">
                                    <span class="input-group-addon">YouTube Link</span>
                                    <input type="text" class="form-control" id="YouTubeURL" name="YouTubeURL" placeholder="Past YouTube URL here" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <a id="btnAttachImg" class="btn btn-default btnAttachImg"><span class="glyphicon glyphicon-picture"></span></a>
                                &nbsp;&nbsp;
                                <a id="btnYouTube" class="btn btn-default btnYouTube"><i class="fa fa-youtube" style="font-size: 18px;"></i></a>
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
                         <div class="col col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <blockquote>A person who never made a mistake never tried anything new.</blockquote>
                        </div>

                        <div class="col col-xs-2 text-right">
                             <button id="btnPostMode" class="btn btn-danger" title="New Post">Post</button>
                        </div>
                    </div>
                </div>

                <ul id="FeedsSection" class="">

                </ul>

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


            <!--<div class="affix hidden-print hidden-xs hidden-sm text-right" 
                style="position: fixed; width: 400px; right: 30px; top: 50px;" role="complimentary" data-spy="affix" data-offset-top="50">
                <label class="text-default">People You may know...</label>
                <ul id="SuggListing" class="nav text-right">
                </ul>
            </div>-->

        </div>

    <script type="text/template" id="FeedTemplate">
        <li class="media media-clearfix-xs feed">
            <input type="hidden" class="FeedID" name="FeedID" value="" />
            <div class="media-left">
                <div class="user-wrapper text-center">
                    <img src="/image/user_img.png" alt="people" style="object-fit: cover;"
                    class="img-circle media-object creatorImage hidden-xs" width="80" height="80" />
                    <img src="/image/user_img.png" alt="people" style=""
                    class="img-rounded media-object creatorImage hidden-sm hidden-md hidden-lg" width="80" />
                    <div><a href="#" class="AuthorLink">{{UserName}}</a>
                    </div>
                    <div class="timestamp">19 OCT</div>
                </div>
            </div>
            <div class="media-body">
                <div class="media-body-wrapper">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <div class="panel panel-default share clearfix-xs">
                                <div class="panel-heading panel-heading-gray title contentHeading">
                                    What&acute;s new
                                </div>
                                <div class="panel-body feed-content">
                                    <div class="contentMessage"></div>
                                    <div>
                                        <a class="contentImageLink" data-toggle="lightbox" href="{{ImageURL}}">
                                          <img class="media-object contentImage thumbnail" style="max-width: 800px;" src=".{{ImageURL}}" />
                                        </a>
                                    </div>

                                    <div>
                                        <iframe class="YouTubeFrame" width="560" height="315" src="https://www.youtube.com/embed/{{YouTubeID}}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <i class="fa fa-thumbs-o-up"></i>&nbsp;<a href="#" class="feedLike">Like</a>
                                    <span class="numLikes"></span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-comment"></i>&nbsp;<a href="#" class="feedComment">Comment</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-share-alt"></i>&nbsp;<a href="#" class="feedPropagate">Propagate</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row commentsSection">
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <form class="media media-clearfix-xs NewComment">
                                <input type="hidden" class="CommentID" name="CommentID" value=0 />
                                <div class="media-left">
                                    <div class="user-wrapper text-center">
                                        <img src="/image/user_img.png" alt="people" style="object-fit: cover;"
                                        class="img-circle media-object CommentProfileImage hidden-xs" width="40" height="40" />
                                        <div><small><a href="#" class="CommentAuthor">{{FirstName}}</a></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body CommentMessage">
                                    <textarea class="txtNewComment form-control" name="CommentMessage" placeholder="Type new comment here..."></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <ul class="media-list comments-list">

                            </ul>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </li>
    </script>

    <script type="text/template" id="CommentTemplate">
        <li class="media media-clearfix-xs comment">
            <input type="hidden" class="CommentID" name="CommentID" value="" />
            <div class="media-left">
                <div class="user-wrapper text-center">
                    <img src="/image/user_img.png" alt="people" style="object-fit: cover;"
                    class="img-circle media-object CommentProfileImage hidden-xs" width="40" height="40" />
                    <div><small><a href="#" class="CommentAuthor">{{FirstName}}</a></small>
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
    <script src="../lib/ckeditor/ckeditor.js"></script>
    <script src="../lib/lightbox/ekko-lightbox.js"></script>
    <script src="js/NewPost.js"></script>
    <script src="js/Feed.js"></script>
    <script src="js/FeedList.js"></script>
    <script src="js/index.js"></script>
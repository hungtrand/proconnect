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
    $ProfileImage = '/image/user_img.png';
}

$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];
$Title = "Feed - Proconnect";
$JobTitle = $UData['TITLE'];
$HomeActive = 'active';

ob_start();

?>
    <link rel="stylesheet" type="text/css" href="../lib/lightbox/ekko-lightbox.min.css" />
    <link rel="stylesheet" type="text/css" href="../lib/lightbox/dark.css" />
    <link rel="stylesheet" type="text/css" href="../lib/typeahead/dist/css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    

        <div class="row" style="">
            <!-- Left main content -->
            <div class="col col-xs-12 col-sm-11 col-md-9 col-lg-9">

                <div id="NewPost" class="well well-sm">
                    <div class="row">
                        <div class="col col-xs-12 text-right">
                            <button type="button" class="close hidePostMode" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>

                    <div class="row">
                         <div class="col col-xs-8 col-sm-10 col-md-10 col-lg-10">
							<div class="cover profile">
								<!--<div class="wrapper">
									<div class="cover cover-image-full overlay">
										<img src="/image/BlurStreet.jpeg" alt="Profile Cover" />
									</div>
								</div>-->
								<div class="cover-info">
									<div class="avatar">
										<img src="<?=$ProfileImage?>" alt="<?=$FullName?>" style="object-fit: cover;"/>
									</div>
									<div class="name"><a href="#"><?=$FullName?><small><em class = "hidden-xs">&nbsp;-&nbsp;<?=$JobTitle?></em></small></a>
									</div>
									<!-- <ul class="cover-nav">
										<li class="active"><a href="index.html"><i class="fa fa-fw icon-ship-wheel"></i> Timeline</a>
										</li>
										<li><a href="profile.html"><i class="fa fa-fw icon-user-1"></i> About</a>
										</li>
										<li><a href="users.html"><i class="fa fa-fw fa-users"></i> Friends</a>
										</li>
									</ul> -->
								</div>
							</div>
                            <!--<blockquote>A person who never made a mistake never tried anything new.</blockquote>-->
                        </div>

                        <div class="col col-xs-4  col-sm-2 text-right">
                             <button id="btnPostMode" class="btn btn-danger btnPostMode hidden-xs" title="New Post">Post</button>
                              <button id="btnPostModesm" class="btn btn-danger visible-xs-block btnPostMode" title="New Post">Post</button>
                        </div>
                    </div>
					   <div class="row">
                        <form id="formNewPost" action="feed_controller.php" class="form-horizontal col col-xs-12" style="display: none;">
                            <div class="form-group">
                                <div id = "form-section" class="media">
                                    <div class="media-body" style= "max-width: 100% !important;">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                                                <textarea class="form-control" id="ContentMessage" name="ContentMessage" rows="5" placeholder="share, inspire, motivate,..."></textarea>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                                <img src="" id="ImagePreview" class="thumbnail" style="max-height: 150px; max-width: 100%; display: none;" alt="No Image Preview Available" />
                                            </div>
                                        </div>
                                        
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
                                <div class="col-xs-9">
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <a id="btnAttachImg" class="btn btn-default btnAttachImg">
                                                <span class="glyphicon glyphicon-picture"></span></a>
                                        </div>
                                        <div class="btn-group">
                                            <a id="btnYouTube" class="btn btn-default btnYouTube">
                                                <i class="fa fa-youtube" style="font-size: 18px;"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <i class="fa fa-tag" style="font-size: 18px;"></i>
                                            <input type="text" class="form-control typeahead FeedCategory" name="InterestCategory" maxlength="100" placeholder="Interest Category Tag" />
                                        </div>
                                    </div>
                                                                                                               
                                </div>

                                <div  class="col-xs-3 text-right">
                                    <button id="btnSharePost" class="btn btn-primary">Share</button>
                                </div>

                            </div>

                            <hr/>
                            <div class="form-group">
                                <div class="hiddenInputs col-xs-12">
                                    <input type="file" class="hidden" id="FeedImage" name="FeedImage" /><!-- temp image / not yet uploaded -->
                                    <!-- uploaded image link only populate when upload then reset after sumission -->
                                    <input type="text" class="hidden" id="ImageURL" name="ImageURL" value="" />
                                    <div id="AlertNewPost" class="alert alert-info" style="display: none;"></div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <ul id="FeedsSection" style="padding: 0;">

                </ul>

                <div id="FeedListEndAlert" class="alert alert-info text-center" style="margin: 50px 20px; display:none;"></div>
            </div>

        </div>

    <script type="text/template" id="FeedTemplate">
        <li class="media media-clearfix-xs feed well box" style="border-color: #CCC;">
            <input type="hidden" class="FeedID" name="FeedID" value="" />
            <input type="hidden" class="F2UID" name="F2UID" value="" />
            <div class="media-left">
                <div class="user-wrapper text-center row">
                    <div class="col col-xs-3 col-sm-12">
                        <a href="#" class="AuthorProfileLink">
                            <img src="/image/user_img.png" alt="people" style="object-fit: cover;"
                            class="img-circle media-object creatorImage hidden-xs" width="80" height="80" />
                        </a>
                        <a href="#" class="AuthorProfileLink">
                            <img src="/image/user_img.png" alt="people" style=""
                            class="img-rounded media-object creatorImage hidden-sm hidden-md hidden-lg" width="80" />
                        </a>
                    </div>
                    <div class="col col-xs-9 col-sm-12">
                        <a href="#" class="AuthorLink">{{UserName}}</a>
                        <div class="timestamp">19 OCT</div>
                    </div>
                </div>
            </div>
            <div class="media-body">
                <div class="media-body-wrapper">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-default share clearfix-xs">
                                <div class="panel-heading panel-heading-gray title contentHeading">
                                    What&acute;s new
                                </div>
                                <div class="panel-body feed-content">
                                    <div class="contentMessage"></div>
                                    <div>
                                        <a class="contentImageLink" data-toggle="lightbox" href="{{ImageURL}}">
                                          <img class="media-object contentImage thumbnail" style="max-width: 700px;" src=".{{ImageURL}}" />
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
                                    <label class="label label-default pull-right clearfix labelInterestCategory">
                                        <i class="fa fa-tag"></i>&nbsp;&nbsp;<span class="InterestCategory"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row CommentSection" style="display: none;">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <form class="media media-clearfix-xs NewComment">
                                <input type="hidden" class="CommentID" name="CommentID" value=0 />
                                <div class="media-left">
                                    <div class="user-wrapper text-center">
                                        <a href="#" class="AuthorProfileLink">
                                            <img src="<?=$ProfileImage?>" alt="people" style="object-fit: cover;"
                                            class="img-circle media-object CommentProfileImage hidden-xs" width="40" height="40" />
                                        </a>

                                        <div><small><a href="#" class="CommentAuthor">{{FirstName}}</a></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body CommentMessage">
                                    <textarea class="txtNewComment form-control" name="CommentMessage" style= " background-color: #FFFFFF;" placeholder="Type new comment here..."></textarea>
                                    <br />
                                    <button class="btn btn-default submitComment" disabled>Comment</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="media-list comments-list">

                            </ul>
                            <div class="alert alert-info CommentListEndAlert" style="display: none;"></div>
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
            <input type="hidden" class="CommentFeedID" name="CommentFeedID" value="" />

            <div class="media-left">
                <div class="user-wrapper text-center">
                    <a href="#" class="ProfileLink">
                        <img src="/image/user_img.png" alt="people" style="object-fit: cover;"
                        class="img-circle media-object CreatorImage hidden-xs" width="40" height="40" />
                    </a>
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
    <script src="../lib/ckeditor/ckeditor.js"></script>
    <script src="../lib/typeahead/dist/typeahead.bundle.min.js"></script>
    <script src="../lib/lightbox/ekko-lightbox.js"></script>
    <script src="js/Comment.js"></script>
    <script src="js/CommentList.js"></script>
    <script src="js/NewPost.js"></script>
    <script src="js/Feed.js"></script>
    <script src="js/FeedList.js"></script>
    <script src="js/index.js"></script>
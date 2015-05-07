<?php
session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
if (isset($_COOKIE['__USER_PROFILE_IMAGE__'])) {
    $ProfileImage = $_COOKIE['__USER_PROFILE_IMAGE__'];
} else {
    $ProfileImage = '/image/proconnect/Tab_logo2_100x100.png';
}

$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];
$JobTitle = $UData['TITLE'];
$HomeActive = 'active';
?>
        <div class="media media-clearfix-xs feed well box" style="border-color: #CCC;">
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
        </div>
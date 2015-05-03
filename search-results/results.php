<?php


  include '../signout/php/session_check_signout.php';
  $UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];
$ProfileImage = '/users/'.$UData['USERID'].'/images/'.$UData['PROFILEIMAGE'];
  
  $Title = "Search Results"; //require for front end
  // include '../header/header.php';
  ob_start();
?>
	<link rel="stylesheet" type="text/css" href="css/results.css">

	<template id="SearchResultMediaItemTemplate">
        <div class="media sr-media-item">
		  <div class="media-left">
		    <a class="user-url-anchor" href="#">
		      <img class="media-object" src="/image/user_img.png" alt="" style="max-width: 60px;">
		    </a>
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading">Media Heading</h4>
		    <span class="media-subheading">sub heading</span> <br>
		    <span class="media-description">asdasdas</span>
		  </div>
		   <div class="media-right">
		   	<template id="sr-media-btn">
		   		<button type="button" class="btn btn-primary sr-media-btn">asdas</button>
		   	</template>
		   </div>
		</div>
    </template>
	<div id="main" class="col-xs-12 col-md-8">
		<div id="sr-right-col" class="col-xs-12 col-md-12">
			<div id="iam-loading2" >
		      <div>
		        <img src="/image/FlatPreloaders/64x64/Preloader_1/Preloader_1.gif">
		      </div>
		      <style>
		        #iam-loading2 {
		        	display: none;
			        position: relative; 
			        width: 100%;
			        height: 200px;
		        }
		        #iam-loading2 div {
		          display: block;
		          position: absolute;
		          top: 50%;
		          left: 50%;
		          margin-right: -50%;
		          -webkit-transform: translate(-50%,-50%);
		          -ms-transform: translate(-50%,-50%);
		          transform: translate(-50%,-50%);
		        }
		      </style>
		    </div>
			<ul id="sr-feed-zone" class="nav">
			</ul>
		</div>	
	</div>
<?php
    include_once __DIR__."/../ComponentTemplates/ConnectionSuggestionTemplate.html";
?>

<?php
    $Content = ob_get_clean();
    include $_SERVER["DOCUMENT_ROOT"]."/master/index.php";
?>
	<script type="text/javascript" src="js/SearchResultGetter.js"></script>
	<script type="text/javascript" src="js/SearchResultFactory.js"></script>
	<script type="text/javascript" src="js/search-results.js"></script>
	<script src="/connections/js/NewConnection.js"></script>
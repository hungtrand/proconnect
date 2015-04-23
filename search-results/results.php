<?php


  $page_title = "Search Results"; //require for front end
  include '../header/header.php';
?>
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
	<div id="main" class="container col-xs-12 col-md-8 col-md-offset-2">
		<div id="sr-left-col" class="col-md-2 hidden-xs">
			Lorem ipsum
		</div>
		<div id="sr-right-col" class="col-xs-12 col-md-8">
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
			<div id="sr-feed-zone">
			</div>
		</div>	
	</div>
	<link rel="stylesheet" type="text/css" href="css/results.css">

	<script type="text/javascript" src="js/SearchResultGetter.js"></script>
	<script type="text/javascript" src="js/SearchResultFactory.js"></script>
	<script type="text/javascript" src="js/search-results.js"></script>

</body>
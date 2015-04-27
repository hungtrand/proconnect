<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
include '../signout/php/session_check_signout.php';

$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];
$ProfileImage = '/users/'.$UData['USERID'].'/images/'.$UData['PROFILEIMAGE'];

  $Title = "Profile"; //require for front end
  // include '../header/header.php';
  ob_start();
?>
<div class = "media media-grid media-clearfix-xs">
	`<div class = "media-left">
		  <div class="width-250 width-auto-xs">
			  <div class="panel panel-default widget-user-1 text-center">					   
					<div class="avatar">								
						<img src="http://placehold.it/380x500" alt="" class="img-circle" style="height: 110px; width: 110px; object-fit: cover;" id="preview"/>			
						<h3><span id="user-first" class="first-name"></span> <span id="user-mi"></span> <span id="user-last"></span></h3>
					   <!-- Split button -->
						<div class="btn-group">
							  <button type="button" class="btn btn-info">
								  Connect</button>
							  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								  <span class="caret"></span><span class="sr-only">Social</span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
								  <li><a href="#">View Experience</a></li>
								  <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
								  <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
								  <li class="divider"></li>
								  <li><a href="#">View Skills</a></li>
							  </ul>
						</div>									
					</div>
					<!-- Summary -->
					<div class="panel-body">
						<div class="expandable expandable-indicator-white expandable-trigger">
							<div class="expandable-content">
								<p id="user-summary"></p>
							<div class="expandable-indicator"><i></i></div></div>
						</div>
					</div>	
			  </div>
			  <!-- Contact -->
			  <div class="panel panel-default">
					<div class="panel-heading">
						Contact
					</div>
					<ul class="list-group">
						<li class="list-group-item"><small><cite title=""><span id="user-address"></span><i class="glyphicon glyphicon-map-marker"></i></cite></small>
						</li>
						<li class="list-group-item"><i class="fa fa-envelope fa-fw"></i> <span id="user-email"></span>
						</li>
						<li class="list-group-item"><i class="fa fa-phone fa-fw"></i> <span id="user-phone"></span>
						</li>
						<li class="list-group-item"><i class="fa fa-home fa-fw"></i> <span id="user-home"></span>
						</li>
					</ul>
               </div>
		  </div>
		</div><!--left-->		
	<div class = "media-body">		
		<!--Send Message-->
		<div class="panel panel-default share">
			<div class="input-group">
				<input type="text" class="form-control share-text" placeholder="Write message...">
				<div class="input-group-btn">
					<a class="btn btn-info" href="#"><i class="fa fa-envelope"></i> Send</a>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-gray">
							<i class="fa fa-fw fa-info-circle"></i> About
						</div>
					<div class="panel-body">
							<ul class="list-unstyled">
								<li class="padding-v-4">
									<div class="row">
										<div class="col-sm-4"><span class="text-muted">Job</span>
										</div>
										<div class="col-sm-8"> <span id="about-job"></span></div>
									</div>
								</li>
								<li class="padding-v-4">
									<div class="row">
										<div class="col-sm-4"><span class="text-muted">Lives in</span>
										</div>
										<div class="col-sm-8"> <span id="about-address"></span></div>
									</div>
								</li>
								<li class="padding-v-4">
									<div class="row">
										<div class="col-sm-4"><span class="text-muted">Studied</span>
										</div>
										<div class="col-sm-8"> <span id="about-education"></span></div>
									</div>
								</li>
								<li class="padding-v-4">
									<div class="row">
										<div class="col-sm-4"><span class="text-muted">Connections</span>
										</div>
										<div class="col-sm-8"> <span id="about-connection"></span></div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Skills -->
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-gray">
							<i class="fa fa-wrench "></i>		
							&nbsp;Skills and Endorsements		  
						</div>
						<!-- normal-view -->
						<div id="skills-endorsements" class="normal-view "> 
							<div class="editable" for="skills-endorsements-edit">
							  <!-- <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> -->
								 
							
									<!-- Default panel contents -->
									<!-- List group -->
									  <div id="skill-title" class="panel-heading skill-top" style= "background-color: #f5f5f5; font-weight: 700; color: #5e5e5e;"><b></b></div>
									  <div id="skill-top-list" class="panel-body skill-more">
										<!-- <li class="list-group-item "><span class="badge colored-badge">12</span>Cras justo odio</li> -->
									  </div> 

									  <div id="skill-more-title" class="panel-footer skill-more">
										<b><span class="first-name"></span> also knows about...</b>
									  </div>

									  <!-- Default panel contents -->
									  <!-- List group -->
									  
									  <div id="skill-more-list" class="panel-body skill-more">
										
									  </div>
								
							</div>  
						</div>
					</div>
			</div>
        </div>


		<!-- Experience -->
		<div class="panel panel-default">
			<div class="panel-heading panel-heading-gray">
			<i class="fa fa-briefcase "></i>		
			&nbsp; Experience							  
			</div>
			<div id="user-experiences" class="normal-view outer-ref">
			</div>			  
		</div>
		<!-- Project-->
		<div class="panel panel-default">
			<div class="panel-heading panel-heading-gray">		
				<i class="fa fa-trophy "></i>		
				&nbsp;Projects						  
			</div>
			<div id="user-projects" class="normal-view">     
			</div>
		</div>
		<!-- Education -->
		<div class="panel panel-default">
			<div class="panel-heading panel-heading-gray">	
			<i class="fa fa-graduation-cap "></i>		
			&nbsp;Education
			</div>
			<div id="user-education" class="normal-view">						
			</div>
		</div>
	
	</div>
</div>

   

<?php
    $Content = ob_get_clean();
    include $_SERVER["DOCUMENT_ROOT"]."/master/index.php";
?>
 <!-- </div>/main-container -->

    <!-- Custom styles for this template -->
    <link href="css/profile-user-POV.css" rel="stylesheet">
    <!-- Custom modal handler -->
    <script src="../js/bootbox.min.js"></script>
    <!-- Sortable script -->
    <script src="../js/jquery.sortable.min.js"></script>
    <!-- Custom Script -->
    <script src="js/PublicUser.js"></script>
    <script src="js/init.js"></script>
    <!-- // <script src="js/profile-user-POV.js"></script> -->

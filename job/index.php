<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
// initialize variables with default values
include '/signout/php/session_check_signout.php';

session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

$Title = "Jobs - Proconnect";
$ProfileImage = '/users/'.$UData['USERID'].'/images/'.$UData['PROFILEIMAGE'];
$JobTitle = $UData['TITLE'];

ob_start();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col col-xs-12 well" id="job-page-searching">
            <div>
                <span class="glyphicon glyphicon-briefcase" id="brief-case-logo"></span>
            </div>
            <form id="search-form">
                <div id="header">
                    <div class="row">    
                        <div class="col col-md-1"></div>
                        <div class="col col-md-1" id="job-search-fields">
                            <span>Jobs</span>
                        </div>
                        <div class="col col-md-4 col-md-12">
                            <input type="text" class="form-control" id="search-job-title" placeholder="Job title, keywords, or company names">
                            <br />   
                        </div>
                        <div class="col col-md-4 col-md-12">
                            <input type="text" class="form-control" id="search-location" placeholder="Location">
                            <br />
                        </div>       
                        <div class="col col-md-2 text-center">
                            <a href="#" class="btn btn-primary" id="btn-search-1">Search</a><br />
                            <a href="#" id="adv-searching-btn">
                                Advanced Search  
                            </a> 
                        </div>
                    </div>
                </div>
                <div id="footer">
                    <div class="row">
                        <div class="col col-xs-2 tab-indent"></div>
                        <div class="col col-md-4 col-md-12">
                            <span>Country:</span>
                            <select class="form-control" id="country-dropbox">
                                <!-- Content to be filled with JS -->
                                <option>Country...</option>
                            </select> 
                        </div>
                        <div class="col col-xs-6"></div>
                    </div>
                    <div class="row">
                        <div class="col col-xs-2 tab-indent"></div>
                        <div class="col col-md-4 col-md-12">
                            <span>Industry:</span>
                            <div class="well" id="adv-industry-div">
                            </div>
                        </div>
                        <div class="col col-md-4 col-md-12">
                            <span>Function:</span>
                            <div class="well" id="adv-function-div">
                            </div>
                            <span>Salary:</span>
                            <div class="well" id="adv-salary-div">
                                <input type="checkbox" name="salary" value=""> All Salary Level<br />
                                <input type="checkbox" name="salary" value="$40,000+" id="$40,000"> $40,000+<br />
                                <input type="checkbox" name="salary" value="$60,000+" id="$60,000"> $60,000+<br />
                                <input type="checkbox" name="salary" value="$80,000+" id="$80,000"> $80,000+<br />
                                <input type="checkbox" name="salary" value="$100,000+" id="$100,000"> $100,000+<br />
                                <input type="checkbox" name="salary" value="$120,000+" id="$120,000"> $120,000+<br />
                                <input type="checkbox" name="salary" value="$140,000+" id="$140,000"> $140,000+<br />
                                <input type="checkbox" name="salary" value="$160,000+" id="$160,000"> $160,000+<br />
                                <input type="checkbox" name="salary" value="$180,000+" id="$180,000"> $180,000+<br />
                                <input type="checkbox" name="salary" value="$200,000+" id="$200,000"> $200,000+<br />
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col col-xs-12 text-center well" id="job-page-searching-footer1">
                             <a href="#" id="hideAdvSearch">Hide</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col col-xs-12 alert alert-info text-center" style="display: none;" role="alert" id="alert-div">
            <span><p id="job-page-alert"></p></span>
        </div>
    </div>

    <div class="row">
        <div class="col col-xs-12 col-md-4 visible-xs-block text-center posting-job2 <?php if($UData['ISRECRUITER'] != true){echo 'hidden';}else{echo 'asdasd';}?>" id="">
            <div class="well text-left">
                <p><h4>Are you hiring?</h4></p>
                <hr />
                <p>Reach the right candidates with ProConnect Jobs</p>
                <p><a href="/job-posting/" class="btn btn-primary">Post a Job</a></p>
            </div>
        </div>

        <div class="col col-md-8 col-xs-12" id="job-display">
             <div class="" id="job-display-header"><h4>Jobs You May Be Interested In</h4></div>

            <div class="well">
                <input type="hidden" id="page-counter" name="page-counter" value="1">
                
                <div class="row" id="job-grid">
                    <!-- Job appear here -->
                </div>
            </div>

            <div class="alert alert-default text-center" id="loading-div" style="display:none;">
                <img src="../image/FlatPreloaders/64x64/Preloader_2/Preloader_2.gif">
            </div>
            
            <div class="alert alert-default text-center"><a class="btn btn-sm btn-info" href="#" id="job-display-footer1">Load More</a>
            </div>
            
            <!-- <a href="#" id="load-more2">
                <div class="col col-xs-12 well text-center" id="job-display-footer2">Load More</div>
            </a> -->
        </div>

        <div class="col col-xs-12 col-md-4 hidden-xs text-center posting-job2 <?php if($UData['ISRECRUITER'] != true){echo 'hidden';}else{echo 'asdasd';}?>" id="">
            <div class="well text-left">
                <p><h4>Are you hiring?</h4></p>
                <hr />
                <p>Reach the right candidates with ProConnect Jobs</p>
                <p><a href="/job-posting/" class="btn btn-primary">Post a Job</a></p>
            </div>
        </div>
    </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" id="modalClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Job Preview</h4>
                    </div>
                    <div class="modal-body">
                        <div class="well">
                            <div class="row">
                                <div class="col col-xs-12 col-sm-8">
                                    <span><p id="modalJobTitle"></p></span>
                                    <span><p id="modalJobLocation"></p></span>
                                    <span><p id="modalContactInfo"></p></span>
                                </div>

                                <div class="col col-xs-12 col-sm-4">
                                    <div id="modalImgUpload">
                                        <img id="modalImagePreview" src="../image/companyimg" >
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div>
                            <span><p><STRONG>Job Description</STRONG></p></span>
                            <span><p id="modalJobDescription"></p></span>
                        </div>
                        <hr />
                        <div>
                            <span><p><STRONG>Desired Skills & Experience</STRONG></p></span>
                            <span><p id="modalSkillDescription"></p></span>
                        </div>
                        <hr />
                        <div>
                            <span><p><STRONG>Company Description</STRONG></p></span>
                            <span><p id="modalCompanyDescription"></p></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="jobID" id="jobID" value="">
                        <span><p class="additional">Additional Information</p></span>
                        <div class="col col-xs-12">
                            <div class="col col-xs-4">
                            <span><p class="additional">Type:</p></span>
                                
                            </div>
                            <div class="col col-xs-8">
                            <span><p class="additional-info" id="job-employment-type"></p></span>
                                
                            </div>
                        </div>
                        <div class="col col-xs-12">
                            <div class="col col-xs-4">
                            <span><p class="additional">Functions:</p></span>
                                
                            </div>
                            <div class="col col-xs-8">
                            <span><p class="additional-info" id="job-function"></p></span>
                                
                            </div>
                        </div>
                        <div class="col col-xs-12">
                            <div class="col col-xs-4">
                            <span><p class="additional">Experience:</p></span>
                                
                            </div>
                            <div class="col col-xs-8">
                            <span><p class="additional-info" id="job-experience"></p></span>
                                
                            </div>
                        </div>
                        <div class="col col-xs-12">
                            <div class="col col-xs-4">
                            <span><p class="additional">Industries:</p></span>
                                
                            </div>
                            <div class="col col-xs-8">
                            <span><p class="additional-info" id="industries"></p></span>
                                
                            </div>
                        </div>  
                    </div>
                    <div class="modal-footer-btn">
                        <button id="apply-btn" class="btn btn-primary" data-toggle="modal" data-target="#applyModal">Apply</button>
                        <button class="btn btn-default" type="button" id="modalClose" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

</div>
<?php
    $Content = ob_get_clean();
    include __DIR__."/../master/index.php";
?>

<!-- Custom modal handler -->
<script type="text/template" id="job-container">
    <div class="col col-md-4 col-md-12 well specific-job">
        <div style="width: 100%; height: 175px; overflow: hidden;">
            <a href="#" class="modalCreator img-thumbnail" data-toggle="modal" data-target="#myModal"><img src="../image/pronetwork.jpg" class="companyImg"></a>
        </div>
        <br />
        <span><a href="#"><p class="jobTitle"></p></a></span>
        <span><p class="jobLocation"></p></span>
        <input type="hidden" class="jobID" value="">
        <input type="hidden" class="contactInfo" value="">
        <input type="hidden" class="jobDescription" value="">
        <input type="hidden" class="skillDescription" value="">
        <input type="hidden" class="companyDescription" value="">
        <input type="hidden" class="employmentType" value="">
        <input type="hidden" class="experience" value="">
        <input type="hidden" class="jobFunctions" value="">
        <input type="hidden" class="industry" value="">
    </div>
</script>
<script src="js/index.js"></script>
<script src="js/AdvSearch.js"></script>
<script src="js/IndustryDropbox.js"></script>
<script src="js/CountryDropbox.js"></script>
<script src="js/JobFuncDropbox.js"></script>
<script src="js/JobGrid.js"></script>
<script src="js/ModalFiller.js"></script>
<script src="js/SearchedJobs.js"></script>

<!-- Custom CSS -->
<link href="css/index.css" rel="stylesheet">
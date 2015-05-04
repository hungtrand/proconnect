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

<div class="col col-xs-12 well" id="job-page-searching">
    <div>
        <span class="glyphicon glyphicon-briefcase" id="brief-case-logo"></span>
    </div>
    <form id="search-form">
        <div id="header">
            <div class="col col-xs-12">    
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
                <div class="col col-md-2 text-right">
                    <a href="#" class="btn btn-primary" id="btn-search-1">Search</a>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="col col-xs-12">
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
            <div class="col col-xs-12">
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
                <div class="col col-md-2 text-right" id="btn-search-2">
                    <br />
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>

<a href="#" id="adv-searching-btn`">
    <div class="col col-xs-12 text-center well" id="job-page-searching-footer1">
        Advanced Search    
    </div>
</a>
<a href="#" id="adv-searching-btn2">
    <div class="col col-xs-12 text-center well" id="job-page-searching-footer2" style="display:none;">
        Advanced Search    
    </div>
</a>

<div class="col col-xs-12 alert alert-info text-center" role="alert" id="alert-div">
    <span><p id="job-page-alert"></p></span>
</div>
    <div class="col col-xs-12 well" id="posting-job2">
        <p><h4>Are you hiring?</h4></p>
        <hr />
        <p>Reach the right candidates with ProConnect Jobs</p>
        <p><a href="/job-posting/" class="btn btn-primary">Post a Job</a></p>
    </div>
    <div class="col col-md-8 col-xs-12 well" id="job-display">
        <input type="hidden" id="page-counter" name="page-counter" value="1">
        <div class="col col-xs-12" id="job-display-header"><h4>Jobs You May Be Interested In</h4></div>
        <hr />
        <div class="col col-xs-12" id="job-grid">
            <!-- Job appear here -->
        </div>
        <div class="col col-xs-12 text-center" id="loading-div" style="display:none;">
            <img src="../image/FlatPreloaders/64x64/Preloader_2/Preloader_2.gif">
        </div>
        <a href="#" id="load-more1">
            <div class="col col-xs-12 well text-center" id="job-display-footer1">Load More</div>
        </a>
        <a href="#" id="load-more2">
            <div class="col col-xs-12 well text-center" id="job-display-footer2">Load More</div>
        </a>
    </div>
    <div class="col col-xs-1"></div>
    <div class="col col-md-3 col-xs-12 well" id="posting-job1">
        <p><h4>Are you hiring?</h4></p>
        <hr />
        <p>Reach the right candidates with ProConnect Jobs</p>
        <p><a href="/job-posting/" class="btn btn-primary">Post a Job</a></p>
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
                        <span><p id="modalJobTitle"></p></span>
                        <span><p id="modalJobLocation"></p></span>
                        <span><p id="modalContactInfo"></p></span>
                        <br />
                        <div id="modalImgUpload">
                            <img id="modalImagePreview" src="../image/companyimg" style="height: 150px; width: 200px;"></a>
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

    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="modalClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Apply With Your Profile</h4>
                </div>
                <div class="modal-body">
                    <div class="well">
                        <span><p id="modalUserName"></p></span>
                        <span><p id="modalUserStatus"></p></span>
                        <span><p id="modalCompany"></p></span>
                        <br />
                        <div id="modalImgUpload">
                            <img id="modalImagePreview" src="../image/user_img.png" style="height: 150px; width: 200px;"></a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userID" id="userID" value="">
                    <span>Email Address</span>
                    <span><p id="modalEmailAddress"></p></span>
                    <hr />
                    <span>Phone Number</span>
                    <input type='text' class="form-control" id="modalPhoneNumber" placeholder="###-###-####" value="" style="width: 120px;">
                    <br />
                    <button class="btn btn-primary" id="jobApplication">Submit</button>
                    <button class="btn btn-default" type="button" id="modalClose" data-dismiss="modal">Cancel</button>
                    <br />
                    <span>A complete profile will be included with your application. We will not message your ProConnect network about your application activity.</span>
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
        <div>
            <a href="#" class="modalCreator" data-toggle="modal" data-target="#myModal"><img src="../image/pronetwork.jpg" class="companyImg"></a>
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
<script src="js/jquery.mobile-1.4.5.min.js"></script>
<script src="js/touch.js"></script>
<script src="js/AdvSearch.js"></script>
<script src="js/IndustryDropbox.js"></script>
<script src="js/CountryDropbox.js"></script>
<script src="js/JobFuncDropbox.js"></script>
<script src="js/JobGrid.js"></script>
<script src="js/ModalFiller.js"></script>
<script src="js/ApplyModalFiller.js"></script>
<script src="js/SearchedJobs.js"></script>

<!-- Custom CSS -->
<link href="css/index.css" rel="stylesheet">
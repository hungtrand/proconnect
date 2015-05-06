<?php
// error_reporting(E_ALL); // debug
// ini_set("display_errors", 1); // debug
// initialize variables with default values


include '/signout/php/session_check_signout.php';

session_start();
$UData = json_decode($_SESSION['__USERDATA__'], true);
$FullName = $UData['FIRSTNAME'].' '.$UData['LASTNAME'];

$Title = "Job Posting - Proconnect";
$ProfileImage = '/users/'.$UData['USERID'].'/images/'.$UData['PROFILEIMAGE'];
$JobTitle = $UData['TITLE'];

ob_start();

?>
    <div class="col col-xs-12 col-md-7 well" id="form-div">
        <h4><STRONG><span id="form-title">Build Your Job Posting</span></STRONG></h4>
        <h3><STRONG><span class="glyphicon glyphicon-briefcase"></span> Work Environment</STRONG></h3>
        <br />

        <div class="row">
            <div class="col col-xs-12 col-md-8">
                <h4><STRONG>Company Name</STRONG></h4>
                <input type="text" class="form-control input-box" id="company-name" placeholder="Company Name">
            </div>

            <div class="col col-xs-12 col-md-4 text-center">
                 <div id="imgupload">
                    <div class="form-group">
                        <a id="btnAttachImg" class="btn"><img id="ImagePreview" src="../image/companyimg" style="width:100%;"></a>
                        <div class="hiddenInputs">
                            <form id="formCompanyImage">
                                <input type="file" class="hidden" id="CompanyImage" name="CompanyImage" /><!-- temp image / not yet uploaded -->
                                <!-- uploaded image link only populate when upload then reset after sumission -->
                               <input type="text" class="hidden" id="CompanyImageURL" name="CompanyImageURL" value="" />
                            </form>
                            <div id="AlertNewImg" class="alert alert-info text-center" style="display: none;">
                                <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif" alt="Loading..."/>
                                <div class="alertMsg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br />
        <h4><STRONG>Company Description</STRONG></h4>
        <div class="well-sm">
            <div class="row form-textarea" id="company-desc" >
                <textarea class="form-control" id="companyDesc" name="companyDesc" rows="6"></textarea>
            </div>
        </div>
        <br />
        <h4><STRONG>Industry</STRONG></h4>
        <div class="dropbox-ul row">
            <div id="industry-additional-zero" class="form-group">
                <select class="form-control col col-xs-10 input-box industry-dropbox" id="industry-dropbox-0">
                    <!-- Content to be filled with JS -->
                    <option value="" selected>Select One</option>
                </select>

                <div class="col col-xs-2">
                    <a href="" class="add" id="industry-btn-zero">
                        <span class="glyphicon glyphicon-plus-sign add-text"></span>
                    </a>
                </div>
            </div>
            <div id="industry-additional-one" style="display:none;" class="form-group">
                <select class="form-control input-box industry-dropbox" id="industry-dropbox-1">
                        <!-- Content to be filled with JS -->
                    <option value="" selected>Select One</option>
                </select>

                <a href="" class="add" id="industry-btn-one">
                    <span class="glyphicon glyphicon-minus-sign add-text"></span></a>   
                <br />
            </div>
            <div id="industry-additional-two" style="display:none;" class="form-group">
                <select class="form-control col-xs-10 input-box industry-dropbox" id="industry-dropbox-2">
                        <!-- Content to be filled with JS -->
                    <option value="" selected>Select One</option>
                </select>
                <span class="col-xs-2" id="basic-addon2">
                    <a href="" class="add" id="industry-btn-two">
                        <span class="glyphicon glyphicon-minus-sign add-text"></span>
                    </a>
                </span>
                   
                <br />
            </div>
        </div>
        <hr />
        <h3><STRONG><span class="glyphicon glyphicon-book"></span> Position</STRONG></h3>
        <br />
        <h4><STRONG>Job Title</STRONG></h4>
        <input type="text" class="form-control input-box" id="job-title">
        <br />
        <h4><STRONG>Experience</STRONG></h4>
        <select class="form-control input-box" id="experience-dropbox">
            <option value="1">Choose...</option>
            <option value="2">Executive</option>
            <option value="3">Director</option>
            <option value="4">Mid-Senior Level</option>
            <option value="5">Associate</option>
            <option value="6">Entry Level</option>
            <option value="7">Internship</option>
            <option value="8">Not Applicable</option>
        </select>
        <h4><STRONG>Job Function</STRONG></h4>
        <ul class="dropbox-ul" style="list-style: none;">
            <li id="jobFunc-zero">
                <select class="form-control input-box jobFunc-dropbox" id="jobFunc-dropbox-0">
                    <option value="" selected>Select One</option>
                </select><a href="" class="add" id="jobFunc-btn-zero"><span class="glyphicon glyphicon-plus-sign add-text"></span></a>   
                <br />
            </li>
            <li id="jobFunc-one" style="display:none;">
                <select class="form-control input-box jobFunc-dropbox" id="jobFunc-dropbox-1">
                    <option value="" selected>Select One</option>
                </select><a href="" class="add" id="jobFunc-btn-one"><span class="glyphicon glyphicon-minus-sign add-text"></span></a>   
                <br />
            </li>
            <li id="jobFunc-two" style="display:none;">
                <select class="form-control input-box jobFunc-dropbox" id="jobFunc-dropbox-2">
                    <option value="" selected>Select One</option>
                </select><a href="" class="add" id="jobFunc-btn-two"><span class="glyphicon glyphicon-minus-sign add-text"></span></a>   
                <br />
            </li>
        </ul>
        <h4><STRONG>Employment Type</STRONG></h4>
        <select class="form-control input-box" id="employment-type-dropbox">
            <option value="1">Choose...</option>
            <option value="2">Full-Time</option>
            <option value="3">Part-Time</option>
            <option value="4">Contract</option>
            <option value="5">Temporary</option>
            <option value="6">Volunteer</option>
            <option value="7">Other</option>
            <option value="8">Not Applicable</option>
        </select>
        <br />
        <h4><STRONG>Job Description</STRONG></h4>
        <div class="well-sm">
            <div class="row form-textarea" id="job-desc">
                <textarea class="form-control" id="jobDesc" name="jobDesc" rows="6"></textarea>
            </div>
        </div>
        <br />
        <h4><STRONG>Desired Skills and Expertise</STRONG></h4>
        <div class="well-sm">
            <div class="row form-textarea" id="skill-desc">
                <textarea class="form-control" id="skillDesc" name="skillDesc" rows="6"></textarea>
            </div>
        </div>
        <hr />
        <h3><STRONG><span class="glyphicon glyphicon-book"></span> Finishing Touches</STRONG></h3>
        <h4><STRONG>How Candidates Apply</STRONG></h4>
        <form id="contact-form">
            <input type="radio" name="receiver" value="1" checked="checked"> Collect applications on LinkedIn and be notified by email:<br />
            <input type="text" class="form-control input-box" id="email" placeholder="your_email@email.com">
            Your email address will not be disclosed to candidates<br /><br />
            <input type="radio" name="receiver" value="2"> Direct applicants to an external site to apply:<br />
            <input type="text" class="form-control input-box" id="website" placeholder="company site"><br />
        </form>
        <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">Submit</button>
        <button type="button" class="btn btn-default btn-lg" id="modal-btn"data-toggle="modal" data-target="#myModal">Preview</button>

        <!-- Modal -->
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
                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <span><p id="modalJobTitle"></p></span>
                                    <span><p id="modalJobLocation"></p></span>
                                    <span><p id="modalContactInfo"></p></span>
                                </div>

                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div id="modalImgUpload">
                                        <img id="modalImagePreview" src="../image/companyimg" style="height: 150px; width: 200px;">
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
                        <span><p class="additional">Additional Information</p></span>
                        <div class="row">
                            <div class="col col-xs-4 text-left">
                                <p class="additional">Type:</p>
                                <p class="additional">Experience:</p>
                                <p class="additional">Functions:</p>
                                <p class="additional">Industries:</p>
                            </div>

                            <div class="col col-xs-8 text-left" id="additional-content">
                                <p class="additional-info" id="job-employment-type">&nbsp;</p>
                                <p class="additional-info" id="job-experience">&nbsp;</p>
                                <p class="additional-info" id="job-function">&nbsp;</p>
                                <p class="additional-info" id="industries">&nbsp;</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="toast well"></div>

    <div class="col col-xs-4 col-xs-12" id="guarantee-div">
        <div id="guarantee-seal">
            <span id="guarantee-number">10</span>
            <span id="guarantee-applicants">APPLICANTS</span>
            <span id="guarantee-guaranteed">GUARANTEED</span>
            <img src="../image/seal.png">
        </div>
        <div id="guarantee-ad" class="well">
            <span>Guaranteed Applicants in</span>
            <br />
            <span>3 simple Steps</span>
            <br /><br />
            <ul style="list-style: none;">
                <li>
                    <span><p class="steps">1</p></span>
                    <span><p id="step-words-one">Select a Company from the drop down</p></span>
                </li>
                <li>
                    <span><p class="steps">2</p></span>
                    <span><p id="step-words-two">Select a Job title from the drop down</p></span>
                </li>
                <li>
                    <span><p class="steps">3</p></span>
                    <span><p id="step-words-three">List at least one skill</p></span>
                </li>
            </ul>
        </div>
    </div>

<?php
    $Content = ob_get_clean();
    include __DIR__."/../master/index.php";
?>

<!-- Custom modal handler -->
<script src="../lib/js/FileUpload.js"></script>
<script src="../lib/ckeditor/ckeditor.js"></script>
<script src="js/index.js"></script>
<script src="js/NewPost.js"></script>
<script src="js/IndustryDropBox.js"></script>
<script src="js/JobFunctionDropBox.js"></script>
<script src="js/ModalFiller.js"></script>
<script src="js/JobPost.js"></script>

<!-- Custom CSS -->
<link href="css/index.css" rel="stylesheet">
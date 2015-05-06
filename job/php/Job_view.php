<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";
require_once __DIR__."/../../lib/php/classes/Job.php";
require_once __DIR__."/../../lib/php/utils.php";

/**
*	Job_view - the class create a json format view of one instance of the Feed class
*	The object contains keys matches with Client Tier requests and responses.
*/

class Job_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [
			
		];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function load($job) {
		if (!$job) return false;

		$compImg = strlen(trim($job->getCompanyImage())) > 0 ? $job->getCompanyImage() : "/image/pronetwork.jpg";

		$out = [
			'jobID' =>$job->getID(),
			'JobHiring'=>$job->getJobHiring(),
			'jobLocation'=>$job->getJobLocation(),
			'jobTitle'=>$job->getJobTitle(),
			'jobDescription'=>$job->getJobDescription(),
			'jobFunctions'=>$job->getJobFunction(),
			'industries'=>$job->getIndustry(),
			'companyName'=>$job->getCompanyName(), 
			'companyDescription'=>$job->getCompanyDescription(), 
			'experience'=>$job->getExperience(),
			'skillDescription'=>$job->getSpecialSkill(),
			'employmentType'=>$job-> getEmploymentType(),
			'PreferenceLocation'=>$job->getPreferenceLocation(),
			'PreferenceIndustry'=>$job->getPreferenceIndustry(),
			'PreferenceJobType'=>$job->getPreferenceJobType(),
			'companyImg'=> $compImg,
			"contactInfo"=> $job->getContactInfo(),
			'UserID'=>$job->getUserID()
		];

		$this->FinalView = $out;
		return true;
	}
}
?>
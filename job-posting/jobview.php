<?php
require_once __DIR__."/../../lib/php/interfaces.php";
/**
*	Connections_view - the class inherits the view interface is responsible for 
*	converting data from array of Connection objects into json format data
*	for returning to client tier.
**/
class jobview implements job {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function LoadJob($job) {
		if (!is_array($job) || count($job) < 1) return false;

		foreach ($job as $c) {
			$out = [
			'JobID' =>$c=>getID(),
			 'JobHiring'=>$c=>getJobHiring(),
			 'JobLocation'=>$c=>getJobLoacation(),
			  'JobTitle'=>$c=>getJobTitle(),
			   'Industry'=>$c=>getIndustry(),
			   'CompanyName'=>$c=>getCompanyName(), 
			   'CompanyDescription'=>$c=>getCompanyDescription(), 
			   'Experience'=>$c=>getExperience(),
			    'SpeciallSkill'=>$c=>getSpecialSkill(),
			    'EmploymentType'=>$c=> getEmploymentType(),
			    'PreferenceLocation'=>$c=>getPreferenceLocation(),
			    'PreferenceIndustry'=>$c=>getPreferenceIndustry(),
			    'PreferenceJobType'=>$c=>getPreferenceJobType(),
			    'UserID'=>$c=>getUserID()
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
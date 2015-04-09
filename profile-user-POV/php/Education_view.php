<?php
require_once __DIR__."/../../lib/php/interfaces.php";

class Education_View implements view {
	private $FinalView;


	function __construct() {
		$this->FinalView = [
			"EduID"=>"",
			"position-title"=>'',
			"company-name"=>'',
			"company-location"=>'',
			"work-start-month"=>'',
			"work-start-year"=>'',
			"work-end-month"=>'',
			"work-end-year"=>'',
			"work-present"=>false,
			"experience-description"=>''
		];
	}


	public function load($edu) {
		if (!isset($edu)) return false;

		$data = [
			"EduID"=>$edu->getID(),
			"school-name"=>$edu->getSchool().'',
			"degree"=>$edu->getDegree().'',
			"field-of-study"=>$edu->getFieldOfStudy().'',
			"grade"=>$edu->getGPA().'',
			"school-year-started"=>$edu->getYearStart().'',
			"school-year-ended"=>$edu->getYearEnd().'',
			"activities"=>$edu->getActivities().'',
			"education-description"=>$edu->getDescription().''
		];


		$this->FinalView = $data;
	}

	public function getView() {
		return $this->FinalView;
	}
}
?>
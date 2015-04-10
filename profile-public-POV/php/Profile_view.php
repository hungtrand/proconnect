<?php
require_once __DIR__."/../../lib/php/interfaces.php";

class Profile_View implements view {
	private $FinalView;

	private $PersonalInfo;
	private $Experiences;
	private $Skills;
	private $Projects;
	private $Education;

	function __construct() {
		$this->FinalView = [
			"personalInfo"=>[],
			"experiences"=>[],
			"skill"=>[],
			"projects"=>[],
			"education"=>[]
		];
	}

	public function loadPersonalInfo($User, $Account) {
		$address = $User->getAddress();
		if ($User->getCity())
			$address .= ", ".$User->getCity();
		if ($User->getState())
			$address .= ", ".$User->getState();
		if ($User->getZip()) 
			$address .= ", ".$User->getZip();

		$data = [
			"first-name"=>$User->getFirstName().'',
			"last-name"=>$User->getLastName().'',
			"middle-initial"=>$User->getMiddleName().'',
			"email-address"=>$Account->getEmail().'',
			"alt-email-address"=>$Account->getEmail_Alt().'',
			"phone-number"=>$User->getPhone().'',
			"phone-number-type"=>$User->getPhoneType().'',
			"user-address"=>$address.'',
			"summary"=>$User->getSummary().''
		];

		$this->FinalView['personalInfo'] = $data;
	}

	public function loadExperience($arrExp) {
		if (!isset($arrExp) || count($arrExp) < 1) return false;
		$data = [];

		foreach($arrExp as $exp) {
			$wpresent = "current";
			if (strlen($exp->getEndMonth().'') > 0 
				&& strlen($exp->getEndYear().'') > 0) {
				$wpresent = "";
			}

			$item = [
				"position-title"=>$exp->getTitle().'',
				"company-name"=>$exp->getCompanyName().'',
				"company-location"=>$exp->getLocation().'',
				"work-start-month"=>$exp->getStartMonth().'',
				"work-start-year"=>$exp->getStartYear().'',
				"work-end-month"=>$exp->getEndMonth().'',
				"work-end-year"=>$exp->getEndYear().'',
				"work-present"=>$wpresent,
				"experience-description"=>$exp->getDescription().''
			];

			array_push($data, $item);
		}

		$this->FinalView['experiences'] = $data;
	}

	public function loadProjects($arrProjects) {
		if (!isset($arrProjects) || count($arrProjects) < 1) return false;
		$data = [];

		foreach ($arrProjects as $proj) {
			$item = [
				"project-name"=>$proj->getProjectTitle().'',
				"project-url"=>$proj->getProjectURL().'',
				"team-member"=>[],
				"project-description"=>$proj->getDescription().''
			];

			array_push($data, $item);
		}

		$this->FinalView['projects'] = $data;
	}

	public function loadEducation($arrEdu) {
		if (!isset($arrEdu) || count($arrEdu) < 1) return false;
		$data = [];

		foreach ($arrEdu as $edu) {
			$item = [
				"school-name"=>$edu->getSchool().'',
				"degree"=>$edu->getDegree().'',
				"field-of-study"=>$edu->getFieldOfStudy().'',
				"grade"=>$edu->getGPA().'',
				"school-year-started"=>$edu->getYearStart().'',
				"school-year-ended"=>$edu->getYearEnd().'',
				"activities"=>$edu->getActivities().'',
				"education-description"=>$edu->getDescription().''
			];

			array_push($data, $item);
		}

		$this->FinalView['education'] = $data;
	}

	public function getView() {
		return $this->FinalView;
	}
}
?>
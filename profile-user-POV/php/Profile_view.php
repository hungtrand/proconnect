<?php
require_once __DIR__."/../../lib/php/interfaces.php";

/**
*	Profile_View - convert profile objects into json format 
*	and compile process image paths and user page path for client tier.
*/

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
			"education"=>[],
			"skill"=>[]
		];
	}

	public function loadPersonalInfo($User, $Account) {
		$address = '';
		// if (trim($User->getAddress()))
			// $address = $User->getAddress();
		if (trim($User->getCity()) && $User->getCity() !== 'Select City') {
			if ($address) $address.=', ';
			$address .= $User->getCity();
		}
		if (trim($User->getState()) && $User->getState() !== 'Select State'){
			if ($address) $address.=', ';
			$address .= $User->getState();
		}
		if (trim($User->getZip())){
			if ($address) $address.=' ';
			$address .= $User->getZip();
		}

		$profileImage = "/image/user_img.png";;
		if (strlen(trim($User->getProfileImage())) > 0)
			$profileImage = "/users/".$User->getID()."/images/".$User->getProfileImage();
		$data = [
			"first-name"=>$User->getFirstName().'',
			"last-name"=>$User->getLastName().'',
			"middle-initial"=>$User->getMiddleName().'',
			"email-address"=>$Account->getEmail().'',
			"alt-email-address"=>$Account->getEmail_Alt().'',
			"phone-number"=>$User->getPhone().'',
			"phone-number-type"=>$User->getPhoneType().'',
			// "user-address"=>$address.'',
			"summary"=>$User->getSummary().'',
			'profile-image'=>$profileImage.'',
			'state-name'=>$User->getState().'',
			'address'=>$User->getAddress().'',
			'city-name'=>$User->getCity().'',
			'country-name'=>$User->getCountry().'',
			'inlineRadioOptions-country'=>$User->getCountry().'',
			'postal-code'=>$User->getZip().'',
			'zipcode'=>$User->getZip().''
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
				"ExpID"=>$exp->getID(),
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
				"ProjectID"=>$proj->getID(),
				"project-name"=>$proj->getProjectTitle().'',
				"project-url"=>$proj->getProjectURL().'',
				"team-member"=>[],
				"project-description"=>$proj->getDescription().''
			];

			array_push($data, $item);
		}

		$this->FinalView['projects'] = $data;
	}

	public function loadSkills($skills) {

		$arrSkills = array_fill(0, count($skills), '0'); //initialize an fixed size array

		foreach($skills as $skill) {	//sort array by position order
			$pos = intval( trim($skill->getOrderPosition()) );
			$arrSkills[$pos] = $skill;
		}

		if (!isset($arrSkills) || count($arrSkills) < 1) return false;
		$data = [];

		foreach ($arrSkills as $skill) {
			$SkillName = $skill->getSkillName();
			$nEndorse = $skill->getEndorsements();
			if (!array_key_exists($SkillName, $data))
				$data[$SkillName] = $nEndorse;
		}

		$this->FinalView['skill'] = $data;
	}

	public function loadEducation($arrEdu) {
		if (!isset($arrEdu) || count($arrEdu) < 1) return false;
		$data = [];

		foreach ($arrEdu as $edu) {
			$item = [
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

			array_push($data, $item);
		}

		$this->FinalView['education'] = $data;
	}

	public function getView() {
		return $this->FinalView;
	}
}
?>
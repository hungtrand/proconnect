<?php
require_once __DIR__."/../../lib/php/interfaces.php";

/**
*	Experience_view - the class convert server data of the Experience object into
*	json format that can be understood by the Client Tier. They key and value of the
*	json matches with requests and responses from Client Tier. 
*/
class Experience_View implements view {
	private $FinalView;


	function __construct() {
		$this->FinalView = [];
	}


	public function load($exp) {
		if (!isset($exp)) return false;

		$wpresent = "current";
		if (strlen($exp->getEndMonth().'') > 0 
			&& strlen($exp->getEndYear().'') > 0) {
			$wpresent = "";
		}

		$data = [
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


		$this->FinalView = $data;
	}

	public function getView() {
		return $this->FinalView;
	}
}
?>
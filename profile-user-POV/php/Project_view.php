<?php
require_once __DIR__."/../../lib/php/interfaces.php";

class Project_View implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}


	public function load($proj) {
		if (!isset($proj)) return false;

		$data = [
			"ProjectID"=>$proj->getID(),
			"project-name"=>$proj->getProjectTitle().'',
			"project-url"=>$proj->getProjectURL().'',
			"team-member"=>[],
			"project-description"=>$proj->getDescription().''
		];

		$this->FinalView = $data;
	}

	public function getView() {
		return $this->FinalView;
	}
}
?>
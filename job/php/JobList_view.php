<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Job.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/Job_view.php";

/**
*	JobList_view - the class convert an array of jobs saved in the database
*	under Feed objects. The output data is in json format where the client side can
*	display and manipulate easier.
*/

class JobList_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function load($jobs) {
		if (!is_array($jobs) || count($jobs) < 1) return false;


		foreach ($jobs as $j) {
			$jobview = new Job_view();
			$jobview->load($j);
			$out = $jobview->getView();

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
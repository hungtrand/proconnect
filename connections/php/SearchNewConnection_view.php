<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";

class SearchNewConnection_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function load($Accounts) {
		if (!is_array($Accounts) || count($Accounts) < 1) return false;

		foreach ($Accounts as $a) {
			$profile = new Profile($a->getUserID());

			$out = [
				'UserID'=>$profile->getID(),
				'Name'=>$profile->getName(),
				'JobTitle'=>$profile->getTitle(),
				'CompanyName'=>$profile->getOrganization(),
				'Location'=>$profile->getLocation(),
				'Email'=>$profile->getEmail()
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
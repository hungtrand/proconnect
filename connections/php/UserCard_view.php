<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";

class UserCard_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function load($Profiles) {
		if (!is_array($Profiles) || count($Profiles) < 1) return false;

		foreach ($Profiles as $profile) {

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
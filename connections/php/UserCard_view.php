<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";

/**
*	UserCard_view - convert data from Profile objects into client tier json format objects to display as business cards format.
*/
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
			$profileImage = '';
			if ($profile->getProfileImage()) {
				$profileImage = '/users/'.$profile->getID().'/images/'.$profile->getProfileImage();
			}

			$out = [
				'UserID'=>$profile->getID(),
				'Name'=>$profile->getName(),
				'JobTitle'=>$profile->getTitle(),
				'CompanyName'=>$profile->getOrganization(),
				'Location'=>$profile->getLocation(),
				'Email'=>$profile->getEmail(),
				'ProfileImage'=>$profileImage
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
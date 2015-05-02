<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";
require_once __DIR__."/../../lib/php/classes/Connection.php";

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

	public function load($InitUserID, $Profiles) {
		if (!is_array($Profiles) || count($Profiles) < 1) return false;

		foreach ($Profiles as $profile) {
			$profileImage = '';
			if ($profile->getProfileImage()) {
				$profileImage = '/users/'.$profile->getID().'/images/'.$profile->getProfileImage();
			}

			$connected = 0;
			$conn = new Connection();
			if ($conn->loadByUsers((int)$InitUserID, (int)$profile->getID())) { 
				$connected = 1;
			} else {
				$connected = 0;
			}

			$out = [
				'UserID'=>$profile->getID(),
				'FirstName'=>$profile->getFirstName(),
				'Name'=>$profile->getName(),
				'JobTitle'=>$profile->getTitle(),
				'CompanyName'=>$profile->getOrganization(),
				'Location'=>$profile->getLocation(),
				'Email'=>$profile->getEmail(),
				'ProfileImage'=>$profileImage,
				'Connected'=>$connected
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
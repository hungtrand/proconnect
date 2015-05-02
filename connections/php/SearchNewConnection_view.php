<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";
require_once __DIR__."/../../lib/php/classes/Connection.php";

class SearchNewConnection_view implements view {
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
			$connected = false;
			$conn = new Connection();
			if ($conn->loadByUsers($uid, $CUserID)) { 
				$connected = 1;
			} else {
				$connected = 0;
			}

			$out = [
				'UserID'=>$profile->getID(),
				'Name'=>$profile->getName(),
				'JobTitle'=>$profile->getTitle(),
				'CompanyName'=>$profile->getOrganization(),
				'Location'=>$profile->getLocation(),
				'Email'=>$profile->getEmail(), 
				'Connected'=>$connected
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
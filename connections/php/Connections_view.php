<?php
require_once __DIR__."/../../lib/php/interfaces.php";
/**
*	Connections_view - the class inherits the view interface is responsible for 
*	converting data from array of Connection objects into json format data
*	for returning to client tier.
**/
class Connections_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function loadUserConnections($uconn) {
		if (!is_array($uconn) || count($uconn) < 1) return false;

		foreach ($uconn as $c) {
			$profileImage = '';
			if ($c->getProfileImage()) {
				$profileImage = '/users/'.$c->getConnectionUserID().'/images/'.$c->getProfileImage();
			}

			$out = [
				'UserID'=>$c->getConnectionUserID(),
				'Name'=>$c->getConnectionName(),
				'JobTitle'=>$c->getConnectionTitle(),
				'CompanyName'=>$c->getConnectionOrganization(),
				'Location'=>$c->getConnectionLocation(),
				'Email'=>$c->getConnectionEmail(),
				'ProfileImage'=> $profileImage
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
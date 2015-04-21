<?php
require_once __DIR__."/../../lib/php/interfaces.php";

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
			$out = [
				'UserID'=>$c->getConnectionUserID(),
				'Name'=>$c->getConnectionName(),
				'JobTitle'=>$c->getConnectionTitle(),
				'CompanyName'=>$c->getConnectionOrganization(),
				'Location'=>$c->getConnectionLocation(),
				'Email'=>$c->getConnectionEmail()
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
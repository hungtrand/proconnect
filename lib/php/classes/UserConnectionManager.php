<?php
//require_once "../sqlConnection.php"; // for testing
//require_once __DIR__."/User.php"; // for testing

/*
	UserConnectionManager
	Responsibilities: Get Connections belong to the user
*/
require_once __DIR__."/ConnectionManager.php";
require_once __DIR__."/UserConnection.php";

class UserConnectionManager extends ConnectionManager {
	private $UserConnectionsData  = [];
	private $UserConnections = [];

	public $err;

	function __construct($User) {
		parent::__construct($User);
	}

	// Override to return UserConnection format instead with name and company
	public function getData() {
		if (isset($this->data)) $this->convertToUserConnections();
		if (!isset($this->UserConnectionsData) 
			|| count($this->UserConnectionsData) < 1 || !$this->UserConnectionsData)
			return false;

		return $this->UserConnectionsData;
	}

	public function getAll() {
		if (isset($this->data)) $this->convertToUserConnections();
		if (!isset($this->UserConnections) || count($this->UserConnections) < 1 
			|| !$this->UserConnections) 
			return false;

		return $this->UserConnections;
	}

	private function convertToUserConnections() {
		$this->UserConnectionsData = [];
		$this->UserConnection = [];
		if (isset($this->data) && count($this->data) > 0) {
			foreach($this->data as $row) {
				$uc = new UserConnection($this->User, $row['CONNID']);
				array_push($this->UserConnectionsData, $uc->getData());
				array_push($this->UserConnections, $uc);
			}
		}
	}
}

/*$u = new User(10);
$ucm = new UserConnectionManager($u);
$arr = $ucm->getAll();
foreach ($arr as $a) {
	echo "\n".json_encode($a->getData())."\n";
}
echo "\n".json_encode($ucm->getData())."\n";*/
?>
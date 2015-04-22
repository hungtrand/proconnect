<?php
//include "../sqlConnection.php"; // For testing
require_once __DIR__."/ActiveRecord.php";
//$u = new Experience(1); echo $u->get('Description').'\n'; // For testing
//$u->update(['Username'=>'Feb2015']); echo $u->get('Username'); // For Testing

/**
*	Connection - performs logic for connections of the users, 
*	@params: @ID - UserID
*	Responsibilities: Make connection from a user to another user. User can find the other user by first name, last name. Adding other to current user connection.  
*/
class Connection extends ActiveRecord {
	public static $TableName = 'Connections';
	public static $PrimaryKey = 'CONNID';
	public static $Columns = ['CONNID', 'INITUSERID', 'TARGETUSERID', 'ACCEPTED',
				'CREATEDDATE', 'MESSAGE', 'DECLINED'];
	
	private $data = [];
	private $ConnID;
	public $err;

	function __construct($ID = null) {
		parent::__construct();

		if (isset($ID)) {
			$this->ConnID = $ID;
			if (!$this->data = $this->fetch($ID)) {
				$this->err = "Record not found.";
				return false;
			};
		} else {
			$data['MESSAGE'] = "I'd like to connect with you on ProConnect";
			$data['ACCEPTED'] = false;
		}
	}

	/* Implementing Abstract Methods */
	// OVERRIDE
	public function getData() {
		return $this->data;
	}

	// OVERRIDE
	public function getID() {
		return $this->ConnID;
	}

	// OVERRIDE
	protected function getPrimaryKey() {
		return self::$PrimaryKey;
	}

	// OVERRIDE
	protected function getTableName() {
		return self::$TableName;
	}

	protected function getColumns() {
		return self::$Columns;
	}

	// OVERRIDE
	public function load($ID) {
		if (!$ID) return false;

		if (!$this->data = $this->fetch($ID)) {
			$this->err = "Could not fetch connection from id.";
			return false;
		}

		$this->ConnID = $ID;

		return true;
	}

	public function loadByUsers($firstID, $secondID) {
		if (!is_integer($firstID) || !is_integer($secondID)) {
			$this->err = "Wrong parameter types";
			return false;
		}

		$params = ['INITUSERID'=>$firstID, 'TARGETUSERID'=>$secondID];
		$params2 = ['INITUSERID'=>$secondID, 'TARGETUSERID'=>$firstID];
		if ($this->data = $this->fetchBy($params)) {
			$this->ConnID = $this->data['CONNID'];
			return true;
		} else if($this->data = $this->fetchBy($params2)) {
			$this->ConnID = $this->data['CONNID'];
			return true;
		} else {
			return false;
		}
	}
	/* End of Implementing Abstract Methods */

	// Get methods
	public function getInitUserID() {
		return $this->data['INITUSERID'];
	}

	public function getTargetUserID() {
		return $this->data['TARGETUSERID'];
	}

	public function getAccepted() {
		return $this->data['ACCEPTED'];
	}

	public function getCreatedDate() {
		return $this->data['CREATEDDATE'];
	}

	public function getMessage() {
		return $this->data['MESSAGE'];
	}

	public function getDeclined() {
		return $this->data['DECLINED'];
	}

	// Set methods
	public function setInitUserID($intVal) {
		$this->data['INITUSERID'] = $intVal;

		return true;
	}

	public function setTargetUserID($intVal) {
		$this->data['TARGETUSERID'] = $intVal;

		return true;
	}

	public function setAccepted($boolVal = false) {
		if ($boolVal) $this->data['ACCEPTED'] = true;
		else $this->data['ACCEPTED'] = false;

		return true;
	}

	public function setMessage($strVal) {
		$this->data['MESSAGE'] = $strVal;

		return true;
	}

	public function setDeclined($boolVal = false) {
		if ($boolVal) $this->data['DECLINED'] = true;
		else $this->data['DECLINED'] = false;

		return true;
	}
}
?>

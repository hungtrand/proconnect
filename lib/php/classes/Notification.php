<?php
 //include "../sqlConnection.php"; // For testing
 require_once __DIR__."/ActiveRecord.php";

 //$u = new Education(1); echo $u->get('School').'\n'; // For testing
 //$u->update(['Grade'=>'3.8']); echo $u->get('Grade'); // For Testing

/**
*	Notification - performs logic for Notification class. 
*	@params: $UserID
*	Responsibilities: get message info then notify to the associated UserID .   
*/
class Notification extends ActiveRecord {
	public static $TableName = 'Notification';
	public static $PrimaryKey = 'NOTIFICATIONID';
	public static $Columns = ['NOTIFICATIONID', 'MESSAGE', 'TYPE', 
							'TIMESTAMP', 'USERID'];
	
	private $data = [];
	private $NotiID;
	public $err;

	function __construct($ID = null) {

		parent::__construct();

		if (isset($ID)) {
			$this->NotiID = $ID;
			if (!$this->data = $this->fetch($ID)) {
				$this->err = "Record not found.";
				return false;
			};
		}
	}

	/* Implementing Abstract Methods */
	// OVERRIDE
	public function getData() {
		return $this->data;
	}

	// OVERRIDE
	public function getID() {
		return $this->NotiID;
	}

	// OVERRIDE
	protected function getPrimaryKey() {
		return self::$PrimaryKey;
	}

	// OVERRIDE
	protected function getTableName() {
		return self::$TableName;
	}

	// OVERRIDE
	protected function getColumns() {
		return self::$Columns;
	}

	// OVERRIDE
	public function load($ID) {
		if (!$ID) return false;

		if (!$this->data = $this->fetch($ID)) {
			$this->err = "Could not fetch education from id.";
			return false;
		}

		$this->NotiID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// GET METHODS
	public function getMessage() {
		return $this->data['MESSAGE'];
	}

	public function getType() {
		return $this->data['TYPE'];
	}
	public function getTimestamp(){
		return $this->data['TIMESTAMP'];
	}
	public function getUserID() {
		return $this->data['USERID'];
	}


	// SET METHODS
	public function setMessage($strVal) {
		$this->data['MESSAGE'] = $strVal;

		return true;
	}

	public function setType($strVal) {
		$this->data['TYPE'] = $strVal;

		return true;
	}

	public function setUserID($intVal) {
		$this->data['USERID'] = $intVal;

		return true;
	}

	
}
?>

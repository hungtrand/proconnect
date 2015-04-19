<?php
 //include "../sqlConnection.php"; // For testing
 require_once __DIR__."/ActiveRecord.php";

 

/**
*	Message - performs logic for Message class. 
*	@params: $ID (messageID)
*	Responsibilities: get attributes in message table or set up attributes in message table,    
*/
class Message extends ActiveRecord {
	public static $TableName = 'Message';
	public static $PrimaryKey = 'MESSAGEID';
	public static $Columns = ['MESSAGEID', 'SUBJECT', 'BODY', 
							'CREATOR', 'DATECREATED'];
	
	private $data = [];
	private $MessageID;
	public $err;

	function __construct($ID = null) {

		parent::__construct();

		if (isset($ID)) {
			$this->MessageID = $ID;
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
		return $this->MessageID;
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

		$this->MessageID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// GET METHODS
	public function getMessageID() {
		return $this->data['MESSAGEID'];
	}

	public function getSubject() {
		return $this->data['SUBJECT'];
	}

	public function getBody() {
		return $this->data['BODY'];
	}

	public function getCreator() {
		return $this->data['CREATOR'];
	}

	public function getDateCreated() {
		return $this->data['DATECREATED'];
	}

	

	// SET METHODS
	public function setMessageID($strVal) {
		$this->data['MESSAGEID'] = $strVal;

		return true;
	}

	public function setSubject($strVal) {
		$this->data['SUBJECT'] = $strVal;

		return true;
	}

	public function setBody($strVal) {
		$this->data['BODY'] = $strVal;

		return true;
	}

	public function setCreator($strVal) {
		$this->data['CREATOR'] = $strVal;

		return true;
	}

	public function setDateCreated($intVal) {
		$this->data['DATECREATED'] = $intVal;

		return true;
	}

	//  $u = new Message(1); echo $u->getBody().'\n'; // For testing
    //  $u->update(['SUBJECT'=>'khanh nguyen update']); echo $u->get('SUBJECT'); // For Testing
	
}
?>

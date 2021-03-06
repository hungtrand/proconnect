<?php
//include "../sqlConnection.php"; // For testing
require_once __DIR__."/ActiveRecord.php";
//$u = new Experience(1); echo $u->get('Description').'\n'; // For testing
//$u->update(['Username'=>'Feb2015']); echo $u->get('Username'); // For Testing
/**
*	Skill - contains one record of data for a user's skill. update endorsement and save ordering positions fron client tier.
*	Responsibilites: get all skills from the database, can narrow by specific skill name
*/
class Skill extends ActiveRecord {
	public static $TableName = 'Skills';
	public static $PrimaryKey = 'SKILLID';
	public static $Columns = ['SKILLID', 'SKILLNAME', 'ENDORSEMENTS', 
					'USERID', 'DATECREATED', 'ORDERPOSITION'];
	
	private $data = [];
	private $SkillID;
	public $err;

	function __construct($ID = null) {
		parent::__construct();

		if (isset($ID)) {
			$this->SkillID = $ID;
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
		return $this->SkillID;
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
			$this->err = "Could not fetch skill from id.";
			return false;
		}

		$this->SkillID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	public function loadBySkillName($UserID, $SkillName) {
		if(!isset($UserID) || !isset($SkillName) || strlen($SkillName) < 1) {
			$this->err = "Missing parameters: [load by skill name need id and skill name]";
			return false;
		}

		$params = ["USERID"=>$UserID, "SKILLNAME"=>$SkillName];
		if (!$this->data = $this->fetchBy($params)) {
			$this->err = "Could not fetch skill".$SkillName."for user ".$UserID;
			return false;
		}

		$this->SkillID = $this->data['SKILLID'];
		return true;
	}

	// Get methods
	public function getSkillName() {
		return $this->data['SKILLNAME'];
	}

	public function getUserID() {
		return $this->data['USERID'];
	}

	public function getEndorsements() {
		return $this->data['ENDORSEMENTS'];
	}

	public function getOrderPosition() {
		return $this->data['ORDERPOSITION'];
	}

	public function getDateCreated() {
		return $this->data['DATECREATED'];
	}

	// Set methods
	public function setSkillName($strVal) {
		$this->data['SKILLNAME'] = $strVal;

		return true;
	}

	public function setUserID($intVal) {
		$this->data['USERID'] = $intVal;

		return true;
	}

	public function setEndorsements($intVal) {
		$this->data['ENDORSEMENTS'] = $intVal;

		return true;
	}

	public function setOrderPosition($intVal) {
		$this->data['ORDERPOSITION'] = $intVal;

		return true;
	}

}
?>

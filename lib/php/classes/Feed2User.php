<?php
 //require_once "../sqlConnection.php"; // For testing
 require_once __DIR__."/ActiveRecord.php";
/**
*	Feed2User - performs logic for user's feed.
*	@params: $ID (userid)
*	Responsibilities: getting or setting the data of user's feed to database. 
*/
class Feed2User extends ActiveRecord {
	public static $TableName = 'Feed2User';
	public static $PrimaryKey = 'UFID';
	public static $Columns = ['UFID', 'FEEDID', 'USERID', 
							'STATUS', 'LIKED', 'DATECREATED', 'ISCREATOR'];
	
	private $data = [];
	private $UFID;
	public $err;

	function __construct($ID = null) {

		parent::__construct();

		if (isset($ID)) {
			$this->UFID = $ID;
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
		return $this->UFID;
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

		$this->UFID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// GET METHODS
	public function getFeedID() {
		return $this->data['FEEDID'];
	}

	public function getUserID() {
		return $this->data['USERID'];
	}

	public function getStatus() {
		return $this->data['STATUS'];
	}

	public function getLiked() {
		return (bool)$this->data['LIKED'];
	}

	public function getDateCreated() {
		return $this->data['DATECREATED'];
	}

	public function isCreator() {
		return (bool)$this->data['ISCREATOR'];
	}

	// SET METHODS
	public function setFeedID($intVal) {
		$this->data['FEEDID'] = (int) $intVal;

		return true;
	}

	public function setUserID($intVal) {
		$this->data['USERID'] = (int) $intVal;

		return true;
	}

	public function setStatus($strVal) {
		$this->data['STATUS'] = $strVal;

		return true;
	}

	public function setLiked($boolVal = false) {
		if ($boolVal) $this->data['LIKED'] = true;
		else $this->data['LIKED'] = false;

		return true;
	}

	public function setIsCreator($boolVal = false) {
		if ($boolVal) $this->data['ISCREATOR'] = true;
		else $this->data['ISCREATOR'] = false;

		return true;
	}
}

/*$f = new Feed2User(1);
// $f->setFeedID(1);
// $f->setUserID(7);
$f->setStatus("READ");
$f->setLiked(true);
$f->update();*/
?>

<?php
 // include "../sqlConnection.php"; // For testing
 require_once __DIR__."/ActiveRecord.php";

class Feed extends ActiveRecord {
	public static $TableName = 'Feed';
	public static $PrimaryKey = 'FEEDID';
	public static $Columns = ['FEEDID', 'CONTENT', 'IMAGEURL', 
							'EXTERNALURL', 'INTERNALURL', 'CREATOR', 
							'TYPE', 'DATECREATED'];
	
	private $data = [];
	private $FeedID;
	public $err;

	function __construct($ID = null) {

		parent::__construct();

		if (isset($ID)) {
			$this->FeedID = $ID;
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
		return $this->FeedID;
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

		$this->FeedID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// GET METHODS
	public function getContent() {
		return $this->data['CONTENT'];
	}

	public function getImageURL() {
		return $this->data['IMAGEURL'];
	}

	public function getExternalURL() {
		return $this->data['EXTERNALURL'];
	}

	public function getInternalURL() {
		return $this->data['INTERNALURL'];
	}

	public function getCreator() {
		return $this->data['CREATOR'];
	}

	public function getType() {
		return $this->data['TYPE'];
	}

	public function getDateCreated() {
		return $this->data['DATECREATED'];
	}

	// SET METHODS
	public function setContent($strVal) {
		$this->data['CONTENT'] = $strVal;

		return true;
	}

	public function setImageURL($strVal) {
		$this->data['IMAGEURL'] = $strVal;

		return true;
	}

	public function setExternalURL($strVal) {
		$this->data['EXTERNALURL'] = $strVal;

		return true;
	}

	public function setInternalURL($strVal) {
		$this->data['INTERNALURL'] = $strVal;

		return true;
	}

	public function setCreator($intVal) {
		$this->data['CREATOR'] = $intVal;

		return true;
	}

	public function setType($strVal) {
		$this->data['TYPE'] = $strVal;

		return true;
	}
}

/*
$f = new Feed(1);
$f->setContent("<div>This is sparta</div>");
$f->setExternalURL("http://www.google.com");
$f->setInternalURL("/Profile-public-POV/");
$f->setImageURL("http://www.google.com/dog.jpg");
$f->setCreator(7);
$f->update();*/
?>
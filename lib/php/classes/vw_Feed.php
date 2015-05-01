<?php
//require_once "../sqlConnection.php"; // For testing
require_once __DIR__."/ViewRecord.php";
require_once __DIR__."/Feed.php";

/**
*	vw_FeedManager - select from vw_Feed database view table. See all feeds with calculated number of likes a feed received
*	@params: $FeedID
*	Responsibilities: representation of vw_Feed database view table 
*/
class vw_Feed extends ViewRecord {
	public static $TableName = 'vw_Feed';
	public static $PrimaryKey = 'FEEDID';
	public static $Columns = ['FEEDID', 'CONTENT', 'IMAGEURL', 
							'EXTERNALURL', 'INTERNALURL', 'INTERESTCATEGORY', 'CREATOR', 
							'TYPE', 'DATECREATED', 'NLIKED'];/*
	public static $PseudoColumns = ['TITLE', 'ORGANIZATION', 'LOCATION'];*/
	
	private $data = [];
	private $FeedID;
	public $err;

	function __construct($ID = null) {
		parent::__construct();

		if (isset($ID)) {
			$this->UserID = $ID;
			if (!$this->data = $this->fetch($ID)) {
				$this->err = "Record not found.";
				return false;
			};

			$this->load($ID);
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
			$this->err = "Could not fetch Feed from id.";
			return false;
		}

		$this->FeedID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// Get methods
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

	public function getInterestCategory() {
		return $this->data['INTERESTCATEGORY'];
	}

	public function getDateCreated() {
		return $this->data['DATECREATED'];
	}

	public function getNLiked() {
		return (int) $this->data['NLIKED'];
	}

}

?>

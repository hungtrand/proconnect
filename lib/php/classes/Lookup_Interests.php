<?php
//require_once "../sqlConnection.php"; // For testing
require_once __DIR__."/ViewRecordSet.php";

/**
*	vw_FeedManager - select from vw_Feed database view table. See all feeds with calculated number of likes a feed received
*	@params: $FeedID
*	Responsibilities: representation of vw_Feed database view table 
*/
class Lookup_Interests extends ViewRecordSet {
	protected $TableName;
	protected $PrimaryKey;
	protected $Columns;/*
	public static $PseudoColumns = ['TITLE', 'ORGANIZATION', 'LOCATION'];*/
	
	private $data = [];
	public $err;

	function __construct() {
		$this->PrimaryKey = 'INTERESTID';
		$this->TableName = 'Lookup_Interests';
		$this->Columns = ['INTERESTID', 'INTEREST'];

		parent::__construct();
	}

	/* Implementing Abstract Methods */
	// OVERRIDE
	public function getData() {
		return $this->data;
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	// OVERRIDE
	public function load($limit = false) {
		if (is_int($limit)) $this->setLimit($limit);

		$cond = 'ORDER BY `INTEREST` ';
		if (!$this->data = $this->fetchCustom($cond)) {
			
			return false;
		}

		return true;
	}
	/* End of Implementing Abstract Methods */
}

?>

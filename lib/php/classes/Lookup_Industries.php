<?php
//require_once "../sqlConnection.php"; // For testing
require_once __DIR__."/ViewRecordSet.php";

/**
*	vw_FeedManager - select from vw_Feed database view table. See all feeds with calculated number of likes a feed received
*	@params: $FeedID
*	Responsibilities: representation of vw_Feed database view table 
*/
class Lookup_Industries extends ViewRecordSet {
	protected $TableName;
	protected $PrimaryKey;
	protected $Columns;/*
	public static $PseudoColumns = ['TITLE', 'ORGANIZATION', 'LOCATION'];*/
	
	private $data = [];
	public $err;

	function __construct() {
		$this->PrimaryKey = 'INDUSTRYID';
		$this->TableName = 'Lookup_Industries';
		$this->Columns = ['INDUSTRYID', 'INDUSTRYNAME'];

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

		$cond = 'ORDER BY `INDUSTRYNAME` ';
		if (!$this->data = $this->fetchCustom($cond)) {
			
			return false;
		}

		return true;
	}
	/* End of Implementing Abstract Methods */
}

?>

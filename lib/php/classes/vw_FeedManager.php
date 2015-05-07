<?php
//require_once "../sqlConnection.php"; // For testing
require_once __DIR__."/ViewRecordSet.php";
require_once __DIR__."/vw_Feed.php";

/**
*	vw_FeedManager - select from vw_Feed database view table. See all feeds with calculated number of likes a feed received
*	@params: $FeedID
*	Responsibilities: representation of vw_Feed database view table 
*/
class vw_FeedManager extends ViewRecordSet {
	protected $TableName;
	protected $PrimaryKey;
	protected $Columns;/*
	public static $PseudoColumns = ['TITLE', 'ORGANIZATION', 'LOCATION'];*/
	
	private $data = [];
	public $err;

	function __construct($User = null) {
		$this->PrimaryKey = 'FEEDID';
		$this->TableName = 'vw_Feed';
		$this->Columns = ['FEEDID', 'CONTENT', 'IMAGEURL', 'EXTERNALURL', 'INTERNALURL', 
						'INTERESTCATEGORY', 'CREATOR', 'TYPE', 'DATECREATED', 'NLIKED'];

		parent::__construct();

		if (isset($User))
			$this->User = $User;
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

	public function getAll() {
		if (!isset($this->data) || count($this->data) < 1 || !$this->data) 
			return false;

		$arr = [];
		foreach ($this->data as $row) {
			$id = $row[$this->PrimaryKey];
			$obj = new vw_Feed($id);
			array_push($arr, $obj);
		}

		return $arr;
	}

	// OVERRIDE
	public function load($page, $numRows, $interest = '', $orderby="DATECREATED DESC, NLIKED DESC") {
		if (!is_integer($page) || !is_integer($numRows)) {
			$this->err = "Parameters must be integers";
			return false;
		}

		$offset = $page * $numRows - $numRows;

		$cleanKW = str_replace("'", "''", $interest);
		$cleanKW = str_replace([",", ";"], "", $cleanKW);
		$cleanKW = trim($cleanKW);

		$cond = "WHERE CREATOR <> ? ";
		if (isset($interest) && $interest != '')
			$cond .= "AND INTERESTCATEGORY LIKE '%$cleanKW%' ";

		$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
		$params = ['USERID'=>$this->User->getID()];
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;

	}
	/* End of Implementing Abstract Methods */
}

?>

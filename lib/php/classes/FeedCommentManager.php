<?php
// require_once "../sqlConnection.php"; // for testing
// require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/FeedComment.php";
require_once __DIR__."/RecordSet.php";

/**
*	FeedCommentManager - fetch comments for a feed, fetch by paging or fetch newer. 
* 	@params: $Feed
*	Responsibilities: load comments belonged to a feed from the database. 
*/

class FeedCommentManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	protected $Feed;
	protected $data;

	public $err;

	function __construct($Feed) {
		$this->PrimaryKey = Feedcomment::$PrimaryKey;
		$this->TableName = Feedcomment::$TableName;
		$this->Columns = Feedcomment::$Columns;
		$this->Feed = $Feed;

		parent::__construct();

		$this->load($Feed);
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	public function load($Feed) {
		$this->Feed = $Feed;
		if (!$this->loadPage(1, 10)) return false; // default: load page 1 on initialization

		return true;
	}

	public function loadPage($page, $numRows, $orderby="TIMESTAMP DESC") {
		if (!is_integer($page) || !is_integer($numRows)) {
			$this->err = "Parameters must be integers";
			return false;
		}

		$offset = $page * $numRows - $numRows;

		$cond = "WHERE FEEDID = ? ";
		$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
		$params = ['FEEDID'=>$this->Feed->getID()];
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;

	}

	public function loadNewer($newerThanID, $orderby="TIMESTAMP DESC") {
		if (!is_integer($newerThanID)) {
			$this->err = "Parameters must be integers";
			return false;
		}

		$cond = "WHERE FEEDID = ? and COMMENTID > ? ";
		$cond.= "ORDER BY ".$orderby;
		$params = ['FEEDID'=>$this->Feed->getID(), 'COMMENTID'=>$newerThanID];
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;

	}

	public function getData() {
		if (!isset($this->data) || count($this->data) < 1) return false;

		return $this->data;
	}

	public function getAll() {
		if (!isset($this->data) || count($this->data) < 1 || !$this->data) 
			return false;

		$arr = [];
		foreach ($this->data as $row) {
			$id = $row[$this->PrimaryKey];
			$obj = new FeedComment($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}

?>
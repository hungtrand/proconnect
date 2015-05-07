<?php
// require_once "../sqlConnection.php"; // for testing
// require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Feed.php";
require_once __DIR__."/RecordSet.php";

/**
*	Feed2UserManager - performs the users' feed class which helps other class to be able to access user's feed data through this manager class. 
* 	@params: $User
*	Responsibilities: load the user's feed data or get the data from database. 
*/

class FeedManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	protected $User;
	protected $data;

	public $err;

	function __construct($User = null) {
		$this->PrimaryKey = Feed::$PrimaryKey;
		$this->TableName = Feed::$TableName;
		$this->Columns = Feed::$Columns;
		$this->User = $User;

		parent::__construct();

		if (isset($User))
			$this->User = $User;
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	public function load($User = null) {
		if (isset($this->User))
			$this->User = $User;

		if (!$this->loadPage(1, 10)) return false; // default: load page 1 on initialization

		return true;
	}

	public function loadPage($page, $numRows, $orderby="DATECREATED DESC") {
		if (!is_integer($page) || !is_integer($numRows)) {
			$this->err = "Parameters must be integers";
			return false;
		}

		$offset = $page * $numRows - $numRows;

		$cond = "WHERE USERID = ? ";
		$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
		$params = ['USERID'=>$this->User->getID()];
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;

	}

	public function loadNewer($newerThanID, $orderby="DATECREATED DESC") {
		if (!is_integer($newerThanID)) {
			$this->err = "Parameters must be integers";
			return false;
		}

		$cond = "WHERE USERID = ? and FEEDID > ? ";
		$cond.= "ORDER BY ".$orderby;
		$params = ['USERID'=>$this->User->getID(), 'FEEDID'=>$newerThanID];
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
			$obj = new Feed2User($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}

/*$u = new User(7);
$fum = new Feed2UserManager($u);
//echo $cm->err;
echo "\n".json_encode($fum->getData())."\n";*/
?>
<?php
// require_once "../sqlConnection.php"; // for testing
// require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Feed2User.php";
require_once __DIR__."/RecordSet.php";

/**
*	Feed2UserManager - performs the users' feed class which helps other class to be able to access user's feed data through this manager class. 
* 	@params: $User
*	Responsibilities: load the user's feed data or get the data from database. 
*/

class Feed2UserManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	protected $User;
	protected $data;

	public $err;

	function __construct($User) {
		$this->PrimaryKey = Feed2User::$PrimaryKey;
		$this->TableName = Feed2User::$TableName;
		$this->Columns = Feed2User::$Columns;
		$this->User = $User;

		parent::__construct();

		$this->load($User);
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	public function load($User) {
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
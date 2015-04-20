<?php
//require_once "../sqlConnection.php"; // for testing
//require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Account.php";
require_once __DIR__."/RecordSet.php";


/**
*	AccountManager - performs management of the Account
*	@params: $UserID
*	Resposibilities: get Data from database, load the user from database by userID, search and load the data from database by keyword,datecreated, or email. 
*	
*/




class AccountManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	private $data;
	private $User;

	public $err;

	function __construct($User=null) {
		$this->PrimaryKey = Account::$PrimaryKey;
		$this->TableName = Account::$TableName;
		$this->Columns = Account::$Columns;

		parent::__construct();
		if (isset($User)) $this->User = $User;

		$this->load();
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	public function load($User=null) {
		if (isset($User)) $this->User = $User;
		if (isset($this->User)) {
			$params = ['USERID'=>$this->User->getID()];
			if (!$this->data = $this->fetchBy($params)) return false;
		} else {
			if (!$this->data = $this->fetch()) return false;
		}

		return true;
	}

	public function loadBySearch($keywords, $page, $numRows, $orderby="DATECREATED") {
		if (!is_integer($page) || !is_integer($numRows) || !is_array($keywords)) {
			$this->err = "Parameters are of wrong types";
			return false;
		}
		/*echo json_encode($keywords);*/
		$offset = $page * $numRows - $numRows;
		$params = [];
		$delimiter = "";

		$cond = "WHERE ACTIVE = 1 AND VERIFIED = 1 AND ";
		if (isset($this->User)) {
			$cond.= "USERID != ? AND ";
			$params['USERID'] = $this->User->getID();
		}

		$cond.="(";

		for($i=0; $i<count($keywords);$i++) {
			$cleanKW = str_replace("'", "''", $keywords[$i]);
			$cleanKW = str_replace([",", ";"], "", $cleanKW);
			$cleanKW = trim($cleanKW);
			if (strlen($cleanKW) < 1) continue;

			$cond.= $delimiter."EMAIL LIKE '%$cleanKW%' OR EMAIL_ALT LIKE '%$cleanKW%'";

			$delimtier = "AND ";
		}

		$cond.= ") ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
		
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;

	}

	public function getData() {
		if (!isset($this->data) || count($this->data) < 1) return false;

		return $this->data;
	}

	public function getAll() {
		if (!isset($this->data) || count($this->data) < 1|| !$this->data) 
			return false;

		$arr = [];
		foreach ($this->data as $row) {
			$id = $row[$this->PrimaryKey];
			$obj = new Account($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}

/*$u = new User(7);
$kw = ["hung"];
$am = new AccountManager($u);
$am->loadBySearch($kw, 1, 10);
echo $am->err."\n";
echo json_encode($am->getData())."\n";*/
?>
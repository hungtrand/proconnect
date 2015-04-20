<?php
//require_once "../sqlConnection.php"; // for testing
//require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Connection.php";
require_once __DIR__."/RecordSet.php";

/**
*	ConnectionManager - performs management of the Connection class.  
*	@params: $User
*	Resposibilities: get Data from database, load the user from database by userID, search and load the data from database by keyword,datecreated, or email.
* 						get the data from database, get all or current user data.  
*/


class ConnectionManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	protected $User;
	protected $data;

	public $err;

	function __construct($User) {
		$this->PrimaryKey = Connection::$PrimaryKey;
		$this->TableName = Connection::$TableName;
		$this->Columns = Connection::$Columns;
		$this->User = $User;

		parent::__construct();

		$this->load($User);
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	public function load($User) {
		$params = ['INITUSERID'=>$User->getID(), 'TARGETUSERID'=>$User->getID()];
		if (!$this->data = $this->fetchBy($params, 'OR')) return false;

		$this->User = $User;

		return true;
	}

	public function loadCurrent() {
		$cond = "WHERE (INITUSERID = ? OR TARGETUSERID = ?) AND ACCEPTED = 1 ";
		$params = ['INITUSERID'=>$this->User->getID(), 
				'TARGETUSERID'=>$this->User->getID()];
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;
	}

	public function loadPage($page, $numRows, $orderby="CREATEDDATE") {
		if (!is_integer($page) || !is_integer($numRows)) {
			$this->err = "Parameters must be integers";
			return false;
		}

		$offset = $page * $numRows - $numRows;

		$cond = "WHERE (INITUSERID = ? OR TARGETUSERID = ?) AND ACCEPTED = 1 ";
		$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
		$params = ['INITUSERID'=>$this->User->getID(), 
				'TARGETUSERID'=>$this->User->getID()];
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;

	}

	public function loadBySearch($keywords, $page, $numRows, $orderby="CREATEDDATE") {
		if (!is_integer($page) || !is_integer($numRows) || !is_array($keywords)) {
			$this->err = "Parameters are of wrong types";
			return false;
		}
		
		$offset = $page * $numRows - $numRows;
		$params = [];
		$delimiter = "";
		$uid = $this->User->getID();
		// This query primary conerns with finding connections that match with the keywords
		// it find the connections user have, ignore matchings with user's own records
		$cond = "INNER JOIN vw_PersonalInfo AS IUser ON Connections.INITUSERID = IUser.USERID ";
		$cond.= "INNER JOIN vw_PersonalInfo AS TUser ON Connections.TARGETUSERID = TUser.USERID ";
		$cond.= "WHERE ACCEPTED = 1 AND IUser.ACTIVE = 1 AND TUser.ACTIVE = 1 ";
		$cond.= "AND IUser.VERIFIED = 1 AND IUser.VERIFIED = 1 AND (";

		$cond.= "(IUser.USERID = $uid AND (";
		for($i=0; $i<count($keywords);$i++) {
			$cleanKW = str_replace("'", "''", $keywords[$i]);
			$cleanKW = str_replace([",", ";"], "", $cleanKW);
			$cond.= $delimiter."(TUser.EMAIL LIKE '%$cleanKW%' OR TUser.EMAIL_ALT LIKE '%$cleanKW%' ";
			$cond.= "OR TUser.FIRSTNAME LIKE '%$cleanKW%' OR TUser.LASTNAME LIKE '%$cleanKW%')";

			$delimtier = "AND ";
		}
		$cond.=")) OR (TUser.USERID = $uid AND (";
		for($i=0; $i<count($keywords);$i++) {
			$cleanKW = str_replace("'", "''", $keywords[$i]);
			$cleanKW = str_replace([",", ";"], "", $cleanKW);
			$cond.= $delimiter."(IUser.EMAIL LIKE '%$cleanKW%' OR IUser.EMAIL_ALT LIKE '%$cleanKW%' ";
			$cond.= "OR IUser.FIRSTNAME LIKE '%$cleanKW%' OR IUser.LASTNAME LIKE '%$cleanKW%')";

			$delimtier = "AND ";
		}

		$cond.= "))) ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
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
			$obj = new Connection($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}
/*
$u = new User(10);
$cm = new ConnectionManager($u);
$cm->loadBySearch(["wayne"], 1, 10);
//echo $cm->err;
echo "\n".json_encode($cm->getData())."\n";*/
?>
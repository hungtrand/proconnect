<?php
//require_once "../sqlConnection.php"; // for testing

require_once __DIR__."/Profile.php";
require_once __DIR__."/RecordSet.php";

/**
*	ProfileManager - performs logic for ProfileManager class. 
*	@params: $UserID
*	Responsibilities: load the user and get the user data from the database.  
*/
class ProfileManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	private $data;

	public $err;

	function __construct() {
		$this->PrimaryKey = Profile::$PrimaryKey;
		$this->TableName = Profile::$TableName;
		$this->Columns = Profile::$Columns;

		parent::__construct();
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	public function load() {
		if (!$this->data = $this->fetch()) return false;

		return true;
	}

	public function loadBySearch($keywords, $page, $numRows, $orderby="NAME") {
		if (!is_integer($page) || !is_integer($numRows) || !is_array($keywords)) {
			$this->err = "Parameters are of wrong types";
			return false;
		}
		/*echo json_encode($keywords);*/
		$offset = $page * $numRows - $numRows;
		$params = [];
		$delimiter = "";

		$cond = "WHERE ACTIVE = 1 AND VERIFIED = 1 AND ";

		$cond.="(";

		for($i=0; $i<count($keywords);$i++) {
			$cleanKW = str_replace("'", "''", $keywords[$i]);
			$cleanKW = str_replace([",", ";"], "", $cleanKW);
			$cleanKW = trim($cleanKW);
			if (strlen($cleanKW) < 1) continue;

			$cond.= $delimiter."EMAIL LIKE '%$cleanKW%' OR EMAIL_ALT LIKE '%$cleanKW%' OR NAME LIKE '%$cleanKW%'";

			$delimtier = "AND ";
		}

		$cond.= ") ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
		
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;

	}

	public function loadSuggestionsByCommon($UserID, $page, $numRows) {
		if (!is_integer($page) || !is_integer($numRows) || !is_integer($UserID)) {
			$this->err = "Parameters are of wrong types";
			return false;
		}

		$offset = $page * $numRows - $numRows;

		$sql = 'Call sp_select_common_connections(?, ?, ?);';
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $UserID);
				$stmt->bindParam(2, $offset);
				$stmt->bindParam(3, $numRows);
				//echo $sql;
				$stmt->execute();
				
				if ( $rs = $stmt->fetchAll(PDO::FETCH_ASSOC) ){
					$this->data = $rs;
				} else {
					$this->err = "No Data found.";
					return false;
				}
				
				
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			return false;
		}

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
			$obj = new Profile($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}

/*$kw = ["natasha"];
$pm = new ProfileManager();
$pm->loadBySearch($kw, 1, 10);
echo $pm->err."\n";
echo json_encode($pm->getData())."\n";*/
?>
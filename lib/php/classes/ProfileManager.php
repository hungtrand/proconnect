<?php
//require_once "../sqlConnection.php"; // for testing

require_once __DIR__."/Profile.php";
require_once __DIR__."/RecordSet.php";

/**
*	ProfileManager - performs logic for ProfileManager class. This class extend RecordSet class, and it will return information of  user profile based on userId input.
*	@params: $UserID
*	Responsibilities: load the user and get the user data from the database.  
*/
class ProfileManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	private $data;
	private $filters;

	public $err;

	function __construct() {
		$this->PrimaryKey = Profile::$PrimaryKey;
		$this->TableName = Profile::$TableName;
		$this->Columns = Profile::$Columns;

		$this->filters = [];

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

			$cond .= $delimiter."EMAIL LIKE '%$cleanKW%' OR EMAIL_ALT LIKE '%$cleanKW%' OR NAME LIKE '%$cleanKW%' ";

			$delimiter = 'OR ';
		}
		$cond.=") ";

		$filtersCond = '';
		foreach ($this->filters as $field => $arrKeywords) {
			$fieldCond = ''; // reset every iteration
			$delimiter = '';
			if (is_array($arrKeywords)) {
				for($i=0; $i<count($arrKeywords); $i++) {
					if (strlen(trim($arrKeywords[$i])) == 0) continue;
					$cleanKW = str_replace("'", "''", $arrKeywords[$i]);
					$cleanKW = str_replace([",", ";"], "", $cleanKW);
					$cleanKW = trim($cleanKW);
					if (strlen($cleanKW) < 1) continue;

					$fieldCond .= $delimiter.$field." LIKE '%$cleanKW%' ";

					$delimiter = 'OR ';
				}
			}

			if (strlen($fieldCond) > 4) $filtersCond .= 'AND (' . $fieldCond . ') ';
		}

		if (strlen($filtersCond) > 0) $cond .= $filtersCond;

		$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;

		//echo $cond;
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

	public function setFiltersByEducation($keywords) {
		if (is_array($keywords)) {
			$this->filters['ALLSTUDIES'] = $keywords;
			return true;
		} else {
			$this->err = 'keywords must be an array';
			return false;
		}
	}

	public function setFiltersBySchool($keywords) {
		if (is_array($keywords)) {
			$this->filters['ALLSCHOOLS'] = $keywords;
			return true;
		} else {
			$this->err = 'keywords must be an array';
			return false;
		}
	}
	
}

/*$kw = ["natasha"];
$pm = new ProfileManager();
$pm->loadBySearch($kw, 1, 10);
echo $pm->err."\n";
echo json_encode($pm->getData())."\n";*/
?>
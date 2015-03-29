<?php
// include "../sqlConnection.php";

abstract class RecordSet {
	private $db;
	private $PrimaryKey;
	private $TableName;
	private $Columns;
	private $Limit;
	private $err;

	function __construct($TableName, $PrimaryKey, $Columns) {
		$this->db = connect('ProConnect');
		$this->PrimaryKey = $PrimaryKey;
		$this->Columns = $Columns;
	}

	public function setLimit($intLimit) {
		if (!isset($intLimit) || !is_int($intLimit)) return false;
			
		$this->Limit = $intLimit;

		return true;
	}

	protected function fetch() {
		$sqlLimit = '';
		if (isset($this->Limit) && is_int($this->Limit)) 
			$sqlLimit = " LIMIT ". (string)$this->Limit;

		$sql = 'SELECT ' . implode(', ', $this->Columns);
		$sql .=' FROM '.$this->TableName.$sqlLimit;

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $ID);

				$stmt->execute();
				
				if ( $rs = $stmt->fetchAll(PDO::FETCH_ASSOC) ){
					return $rs;
				} else {
					$this->err = "No data found.";
					return false;
				}
				
				
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			return false;
		}
	}

	protected function fetchBy($params, $Logic = "AND") {
		$sqlLimit = '';
		if (isset($this->Limit) && is_int($this->Limit)) 
			$sqlLimit = " LIMIT ". (string)$this->Limit;

		$cond = ' WHERE ';
		$delimiter = '';

		foreach($params as $param=>$paramVal) {
			$cond .= $delimiter . $param . ' = ? ';
			$delimiter = $Logic." ";
		}

		$sql = 'SELECT ' . implode(', ', $this->Columns);
		$sql .=' FROM '.$this->TableName.$cond.$sqlLimit;
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($params as $param=>&$paramVal) {
					$stmt->bindParam($i, $paramVal);
					$i++;
				}

				$stmt->execute();
				
				if ( $rs = $stmt->fetchAll(PDO::FETCH_ASSOC) ){
					return $rs;
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
	}
}
?>
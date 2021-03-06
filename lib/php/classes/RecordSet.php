<?php
/**
*	RecordSet - Connect to the database, fetch data for desired request such as fetchby and Custom fetch and return an array of recors.
*	
*/
abstract class RecordSet {
	protected $db;
	private $Limit;
	public $err;

	function __construct() {
		$this->db = connect('ProConnect');
		$this->db->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
	}

	abstract public function getData();
	abstract protected function getColumns();

	public function setLimit($intLimit) {
		if (!isset($intLimit) || !is_int($intLimit)) return false;
			
		$this->Limit = $intLimit;

		return true;
	}

	protected function fetch() {
		$sqlLimit = '';
		$cols = $this->getColumns();

		if (isset($this->Limit) && is_int($this->Limit)) 
			$sqlLimit = " LIMIT ". (string)$this->Limit;

		$sql = 'SELECT ' . $this->TableName.'.`'.implode('`, '.$this->TableName.'.`', $cols).'`';
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
		$cols = $this->getColumns();

		if (isset($this->Limit) && is_int($this->Limit)) 
			$sqlLimit = " LIMIT ". (string)$this->Limit;

		$cond = ' WHERE ';
		$delimiter = '';

		foreach($params as $param=>$paramVal) {
			if (isset($paramVal))
				$cond .= $delimiter . $param . ' = ? ';
			else
				$cond .= $delimiter . $param . ' IS NULL ';

			$delimiter = $Logic." ";
		}

		$sql = 'SELECT ' . $this->TableName.'.`'.implode('`, '.$this->TableName.'.`', $cols).'`';
		$sql .=' FROM '.$this->TableName.$cond.$sqlLimit;
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($params as $param=>&$paramVal) {
					if (!isset($paramVal)) continue;
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

	protected function fetchCustom($cond, $params = null) {
		if (!isset($cond)) $cond = "";
		$cols = $this->getColumns();

		$sql = 'SELECT ' . $this->TableName.'.`'.implode('`, '.$this->TableName.'.`', $cols).'`';
		$sql .=' FROM '.$this->TableName.' '.$cond;
		if ($stmt = $this->db->prepare($sql)) {

			try {
				if (isset($params)) {
					$i = 1;
					foreach($params as $param=>&$paramVal) {
						$stmt->bindParam($i, $paramVal);
						$i++;
					}
				}
				// echo $sql;
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

	protected function fetchCount($cond, $params = null) {
		if (!isset($cond)) $cond = "";
		$cols = $this->getColumns();

		$sql = 'SELECT COUNT(`'.$this->getPrimaryKey().'`) AS COUNT';
		$sql .=' FROM '.$this->TableName.' '.$cond;
		if ($stmt = $this->db->prepare($sql)) {

			try {
				if (isset($params)) {
					$i = 1;
					foreach($params as $param=>&$paramVal) {
						$stmt->bindParam($i, $paramVal);
						$i++;
					}
				}
				// echo $sql;
				$stmt->execute();
				
				if ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ){
					//echo var_dump($rs);
					return $rs['COUNT'];
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
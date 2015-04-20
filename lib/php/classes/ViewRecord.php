<?php
/*
	Represent a record from the a View table from the database
*/
abstract class ViewRecord {
	private $db;
	private $id;
	public $err;

	function __construct() {
		$this->db = connect('ProConnect');
		$this->db->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
	}

	abstract public function getData();
	abstract public function getID();
	abstract protected function getPrimaryKey();
	abstract protected function getTableName();
	abstract protected function getColumns();

	// TODO call fetch and save the new ID to the extended class
	abstract public function load($ID); 

	public function reload() {
		$this->fetch($this->getID());
	}

	protected function fetch($ID) {
		$data = $this->getData();
		$table = $this->getTableName();
		$pk = $this->getPrimaryKey();
		$cols = $this->getColumns();

		$sql = 'SELECT ' . $table.'.'.implode(', '.$table.'.', $cols);
		$sql .=' FROM '.$table.' WHERE '.$pk.'= ? LIMIT 1 ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $ID);
				//echo $sql;
				$stmt->execute();
				
				if ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ){
					foreach ($rs as $col => $value) {
						$data[strtoupper($col)] = $value;
					}
				} else {
					$this->err = "Record not found.";
				}
				
				
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
			
			return $data;
		} else {
			return false;
		}
	}

	protected function fetchBy($params, $Logic = "AND") {
		$cond = ' WHERE ';
		$delimiter = '';
		$data = [];

		$table = $this->getTableName();
		$pk = $this->getPrimaryKey();
		$cols = $this->getColumns();

		foreach($params as $param=>$paramVal) {
			$cond .= $delimiter . $param . ' = ? ';
			$delimiter = $Logic." ";
		}

		$sql = 'SELECT ' . $table.'.'.implode(', '.$table.'.', $cols);
		$sql .=' FROM '.$table.$cond.' LIMIT 1 ';
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($params as $param=>&$paramVal) {
					$stmt->bindParam($i, $paramVal);
					$i++;
				}
//echo $sql."\n".json_encode($params)."\n";
				$stmt->execute();
				
				if ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ){
					foreach ($rs as $col => $value) {
						$data[strtoupper($col)] = $value;
					}
				} else {
					$this->err = "Record not found.";
				}
				
				
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
			
			return $data;
		} else {
			return false;
		}
	}
}
?>
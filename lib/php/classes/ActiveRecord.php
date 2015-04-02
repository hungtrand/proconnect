<?php
 //require_once "../sqlConnection.php"; // For testing
 //$u = new Account(1); echo $u->get('Username').'\n'; // For testing
// $u->update(['Username'=>'Feb2015']); echo $u->get('Username'); // For Testing

/*
	The user class retrieve data of Account from the provided AccountID
	@params: $AccountID
	$data: an associated array that act as the main property of the class Account
			this array holds all data from the database of instance user with AccountID
			the key is the exact name of column in database, and the value is the field value
	@update: public function update allow Account to update its own data
			after updating, the object Account would reload itself with new data
*/
abstract class ActiveRecord {
	private $db;
	private $id;
	public $err;

	function __construct() {
		$this->db = connect('ProConnect');
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

	public function save() {
		$data = $this->getData();

		$table = $this->getTableName();
		$pk = $this->getPrimaryKey();
		$cols = $this->getColumns();

		if (isset($data[$pk])) {
			$this->err="Cannot insert a new record with existing ID.";
			return false;
		}

		$delimiter = "";

		$fields = '(';
		$values = 'VALUES (';
		foreach($data as $col=>$value) {
			$fields .= $delimiter . $col . ' ';
			$values .= $delimiter . '? ';

			$delimiter = ', '; 
		}

		$fields .= ') ';
		$values .= ') ';

		$sql = 'INSERT INTO ' . $table . $fields . $values;
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;  // echo "\n".$sql."\n";
				foreach($data as $col => &$value) {
					$stmt->bindParam($i, $value);
					$i++;
				}

				$stmt->execute();
				$insertedID = $this->db->lastInsertId();
				$this->load($insertedID);
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}			

			return true;
		} else {
			return false;
		}
	}

	public function update() {
		$data = $this->getData(); //echo json_encode($data);

		$table = $this->getTableName();
		$pk = $this->getPrimaryKey();
		$cols = $this->getColumns();

		$setStmt = "SET ";
		$delimiter = "";

		foreach($data as $col => $value) {
			if ($col == $pk) continue;

			$setStmt .= $delimiter . $col . ' = ? ';
			$delimiter = ", ";
		}
		$setStmt .= " ";

		$sql = "UPDATE ".$table." " . $setStmt . "WHERE ".$pk." = ? ";

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($data as $col => &$value) {
					if ($col == $pk) continue;

					$stmt->bindParam($i, $value);
					$i++;
				}

				$id = $this->getID();
				$stmt->bindParam($i, $id);
				//echo $sql; //for testing
				$stmt->execute();
				$this->reload();
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}			

			return true;
		} else {
			return false;
		}
	}

	public function delete() {
		if (!$this->getID()) {
			$this->err = "Object uninitialized. Missing ID.";
			return false;
		}

		$table = $this->getTableName();
		$pk = $this->getPrimaryKey();

		$sql = 'DELETE FROM ' . $table . ' WHERE '.$pk.' = ? ';
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $this->getID());

				$stmt->execute();
				unset($this);
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}			

			return true;
		} else {
			return false;
		}
	}
}
?>
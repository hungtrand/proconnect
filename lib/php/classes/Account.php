<?php
 //include "../sqlConnection.php"; // For testing
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
class Account {
	private $db;
	private $data;
	private $id;
	private $PrimaryKey;
	private $TableName;
	private $Columns;
	public $err;

	function __construct($ID) {
		$this->db = connect('ProConnect');
		$this->TableName = 'Account';
		$this->PrimaryKey = 'ACCOUNTID';
		$this->Columns = array('ACCOUNTID', 'USERNAME', 'PASSWORD', 'EMAIL',
				'EMAIL_ALT', 'SECURITYQUESTION', 'SECURITYANSWER', 
				'DATECREATED', 'LASTLOGIN', 'ACTIVE', 'USERID', 'VERIFIED',
				'ISRECRUITER');

		if (isset($ID)) {
			$this->id = $ID;
			$this->load($ID);
		}
	}

	private function load($ID) {
		$sql = 'SELECT ' . implode(', ', $this->Columns);
		$sql .=' FROM '.$this->TableName.' WHERE '.$this->PrimaryKey.'= ? LIMIT 1 ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $ID);

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);

				foreach ($rs as $col => $value) {
					$this->data[strtoupper($col)] = $value;
				}
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
			

			if (is_array($this->data)) return true;
		} else {
			return false;
		}
	}

	public function get($field) {
		if (!is_array($this->data)) return false;
		if (!array_key_exists(strtoupper($field), $this->data)) return false;

		return $this->data[strtoupper($field)];
	}

	public function set($field, $value) {
		if (!isset($this->data[$field])) return false;

		$this->data[strtoupper($field)] = $value;
	}

	public function getData() {
		return $this->data;
	}

	public function save() {
		$delimiter = "";

		$fields = '(';
		$values = 'VALUES (';
		foreach($this->data as $col=>$value) {
			$fields .= $delimiter . $col . ' ';
			$values .= $delimiter . '? ';

			$delimiter = ', '; 
		}

		$fields .= ') ';
		$values .= ') ';

		$sql .= 'INSERT INTO ' . $this->TableName . $fields . $values;
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($this->data as $col => $value) {
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
		$setStmt = "SET ";
		$delimiter = "";

		foreach($this->data as $col => $value) {
			$setStmt .= $delimiter . $col . ' = ? ';
			$delimiter = ", ";
		}

		$sql = "UPDATE ".$this->TableName." " . $setStmt . "WHERE ".$this->PrimaryKey." = ? ";

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($this->data as $col => $value) {
					$stmt->bindParam($i, $value);
					$i++;
				}

				$stmt->bindParam($i, $this->get($this->PrimaryKey));
				$stmt->execute();
				$this->load($this->get($this->PrimaryKey));
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
		if (!$this->get($this->PrimaryKey)) {
			$this->err = "Object uninitialized. Missing ID.";
			return false;
		}

		$sql .= 'DELETE FROM ' . $this->TableName . ' WHERE '.$this->PrimaryKey.' = ? ';
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $this->get($this->PrimaryKey));

				$stmt->execute();
				$this->load($this->get($this->PrimaryKey));
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

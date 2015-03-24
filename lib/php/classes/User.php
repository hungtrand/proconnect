<?php
 //include "../sqlConnection.php"; // For testing
 require_once __DIR__."/../interfaces.php";
 require_once __DIR__."/EducationManager.php";

/* $u = new User(1); echo $u->get('firstname').'\n'; // For testing
 $arrEdu = $u->getTopEducation(2);

for ($i=0; $i<count($arrEdu);$i++) {
	$edu = $arrEdu[$i];
	echo $edu->get('school');
}*/

/*
	The user class retrieve data of user from the provided UserID
	@params: $UserID
	$data: an associated array that act as the main property of the class user
			this array holds all data from the database of instance user with UserID
			the key is the exact name of column in database, and the value is the field value
	@update: public function update allow user to update its own data
			after updating, the object user would reload itself with new data
*/
class User implements ActiveRecord {
	private $db;
	private $data;
	private $id;
	private $PrimaryKey;
	private $EducationManager;
	private $TableName;
	private $Columns;
	private $err;

	function __construct($ID) {
		$this->db = connect('ProConnect');
		$this->TableName = 'User';
		$this->PrimaryKey = 'USERID';
		$this->Columns = array('USERID', 'FIRSTNAME', 'MIDDLENAME', 'LASTNAME',
				'GENDER', 'BIRTHDAY', 'ADDRESS', 'CITY', 'STATE', 'ZIP');

		if (isset($ID)) {
			$this->id = $ID;
			$this->load($ID);
			$this->EducationManager = new EducationManager($this);
		}
	}

	private function load($ID) {
		$sql = 'SELECT ' . implode(', ', $this->Columns);
		$sql .=' FROM `User` WHERE `UserID` = ? LIMIT 1 ';

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
		if (!isset($this->data[strtoupper($field)])) {
			$this->err = "Field does not exist.";
			return false;
		}

		return $this->data[strtoupper($field)];
	}

	public function set($field, $value) {
		if (!isset($this->data[$field])) return false;

		$this->data[strtoupper($field)] = $value;
	}

	public function getData() {
		return $this->data;
	}

	/*
	@param $newData: an associated array $column=>$value
	$column must exists in the table User
	*/
	public function setData($newData) {
		if (!isset($newData)) return false;
		$tempData = array();

		foreach($newData as $col=>$value) {
			if (!in_array(strtoupper($col), $this->Columns)) {
				$this->err = "Invalid Column to set data.";
				return false;
			} else {
				$tempData[strtoupper($col)] = $value;
			}
		}

		$this->data = $tempData;
		return true;
	}

	public function getCurrentEducation() {
		return $this->EducationManager->getOne();
	}

	public function getAllEducation() {
		return $this->EducationManager->getAll();
	}

	public function getTopEducation($num) {
		return $this->EducationManager->getTop($num);
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

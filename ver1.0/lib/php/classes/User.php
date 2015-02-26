<?php
 include "../sqlConnection.php"; // For testing
 require_once "EducationManager.php";

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
class User {
	private $data;
	private $db;
	private $EducationManager;

	function __construct($UserID) {
		$this->db = connect('ProConnect');

		$this->load($UserID);
		$this->EducationManager = new EducationManager($this);
	}

	private function load($UserID) {
		$sql = 'SELECT `UserID`, `FirstName`, `MiddleName`, `LastName`,
				`Gender`, `Birthday`, `Address`, `City`, `State`, `Zip`
				FROM `User` WHERE `UserID` = ? LIMIT 1 ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $UserID);

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);

				foreach ($rs as $col => $value) {
					$this->data[strtoupper($col)] = $value;
				}
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
			

			if (is_array($this->data)) return true;
		} else {
			return false;
		}
	}

	public function get($field) {
		return $this->data[strtoupper($field)];
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

	public function update($newData) {
		$setStmt = "SET ";
		$delimiter = "";

		foreach($newData as $col => $value) {
			$setStmt .= $delimiter . $col . ' = ? ';
			$delimiter = ", ";
		}

		$sql = "UPDATE `User` " . $setStmt . "WHERE `UserID` = ? ";

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($newData as $col => $value) {
					$stmt->bindParam($i, $value);
					$i++;
				}

				$stmt->bindParam($i, $this->get('UserID'));
				$stmt->execute();
				$this->load($this->get('UserID'));
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}			

			return true;
		} else {
			return false;
		}
	}
}
?>

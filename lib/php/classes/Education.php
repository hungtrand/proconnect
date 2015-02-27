<?php
 //include "../sqlConnection.php"; // For testing
 //$u = new Education(1); echo $u->get('School').'\n'; // For testing
 //$u->update(['Grade'=>'3.8']); echo $u->get('Grade'); // For Testing

/*
	Load education data from the database
*/
class Education {
	private $data;
	private $db;

	function __construct($ID) {
		$this->db = connect('ProConnect');

		$this->load($ID);
	}

	private function load($ID) {
		$sql = 'SELECT `EduID`, `School`, `Degree`, `FieldOfStudy`,
				`Grade`, `Activities`, `UserID`
				FROM `Education` WHERE `EduID` = ? LIMIT 1 ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $ID);

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

	public function update($newData) {
		$setStmt = "SET ";
		$delimiter = "";

		foreach($newData as $col => $value) {
			$setStmt .= $delimiter . $col . ' = ? ';
			$delimiter = ", ";
		}

		$sql = "UPDATE `Education` " . $setStmt . "WHERE `EduID` = ? ";

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($newData as $col => $value) {
					$stmt->bindParam($i, $value);
					$i++;
				}

				$stmt->bindParam($i, $this->get('EduID'));
				$stmt->execute();
				$this->load($this->get('EduID'));
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

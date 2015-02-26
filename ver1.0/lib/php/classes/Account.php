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
	private $data;
	private $db;

	function __construct($ID) {
		$this->db = connect('ProConnect');

		$this->load($ID);
	}

	private function load($ID) {
		$sql = 'SELECT `AccountID`, `Username`, `Password`, `Email`,
				`Email_Alt`, `SecurityQuestion`, `SecurityAnswer`, 
				`DateCreated`, `LastLogin`, `Active`, `UserID`, `Verified`
				FROM `Account` WHERE `AccountID` = ? LIMIT 1 ';

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

		$sql = "UPDATE `Account` " . $setStmt . "WHERE `AccountID` = ? ";

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($newData as $col => $value) {
					$stmt->bindParam($i, $value);
					$i++;
				}

				$stmt->bindParam($i, $this->get('AccountID'));
				$stmt->execute();
				$this->load($this->get('AccountID'));
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

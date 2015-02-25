<?php
// include "../sqlConnection.php"; // For testing
// $u = new Account(1); echo $u->get('Username').'\n'; // For testing
// $u->update(['Username'=>'Feb2015']); echo $u->get('Username'); // For Testing

/*
	Account admin
	Responsibilities: Account signup, Account validation, send verification email, login, logout
*/
class AccountAdmin {
	private $db;

	function __construct() {
		$this->db = connect('ProConnect');

	}

	/* $data must contains the following keys: 
		Username => ?
		Password => ?
		Email => ?
		FirstName => ?
		LastName => ?
	*/
	public function signup($data) {
		$insertedID = 0;

		$sql = 'INSERT INTO `User` (`FirstName`, `LastName`)
				VALUES (?, ?)';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $data['FirstName']);
				$stmt->bindParam(2, $data['LastName']);

				$stmt->execute();
				$insertedID = $db->lastInsertId();
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}

		} else {
			return false;
		}

		if ($insertedID == 0) return false;

		$sql = 'INSERT INTO `Account` (`Username`, `Password`, `Email`, `UserID`)
				VALUES (?, ?, ?, ?)';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $data['Username']);
				$stmt->bindParam(2, $data['Password']);
				$stmt->bindParam(3, $data['Email']);
				$stmt->bindParam(4, $insertedID);

				$stmt->execute();
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
		} else {
			return false;
		}

		return true;
	}
}
?>

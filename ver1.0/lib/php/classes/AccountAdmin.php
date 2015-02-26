<?php
include "../sqlConnection.php"; // For testing
require_once "Email.php";
/* Test scripts
$u = ["FirstName"=>"Iron", "LastName"=>"Man", 
		"Username"=>"iman", "Password"=>"robots",
		"Email"=>"hungtrand0929@gmail.com"];
$aa = new AccountAdmin();
$aa->signup($u);
echo $aa->err;
*/
/*
	Account admin
	Responsibilities: Account signup, Account validation, send verification email, login, logout
*/
class AccountAdmin {
	private $db;
	public $err;

	function __construct() {
		$this->db = connect('ProConnect');

	}

	/*** method: signup
		$data must contains the following keys: 
		Username => ?
		Password => ?
		Email => ?
		FirstName => ?
		LastName => ?
	*/
	public function signup($data) {
		$this->err = null;

		// routine check
		if (!isset($data)) return false;
		if (strlen($data['Email'].'') == 0 || strlen($data['Password'].'') == 0
			|| strlen($data['Username'].'') == 0 || strlen($data['FirstName'].'') == 0
			|| strlen($data['LastName'].'') == 0) return false;

		if ($this->AccountExists($data['Username'], $data['Email'])) {
			$this->err = "Account already exists";
			return false;
		}

		$insertedID = 0;

		$sql = 'INSERT INTO `User` (`FirstName`, `LastName`)
				VALUES (?, ?)';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $data['FirstName']);
				$stmt->bindParam(2, $data['LastName']);

				$stmt->execute();
				$insertedID = $this->db->lastInsertId();
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}

		} else {
			return false;
		}

		if ($insertedID == 0) return false;

		$sql = 'INSERT INTO `Account` (`Username`, `Password`, `Email`, 
										`UserID`, `VerificationKey`)
				VALUES (?, ?, ?, ?, ?)';

		$VerificationKey = sha1(mt_rand(10000,99999). str_replace(' ', '', date("Y-m-d H:i:s")).$data['Email']);
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $data['Username']);
				$stmt->bindParam(2, $data['Password']);
				$stmt->bindParam(3, $data['Email']);
				$stmt->bindParam(4, $insertedID);
				$stmt->bindParam(5, $VerificationKey);

				$stmt->execute();
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			return false;
		}

		// send email with verification link
		$mailVar = ["{{FullName}}" => $data['FirstName'].' '.$data['LastName'], 
					"{{VerificationLink}}" => "https://www.proconnect.com/ver1.0/signup/EmailVerification.php?VerificationKey=".urlencode($VerificationKey)];
		$m = new Email(["EMAILTO"=>$data['Email']]);
		$m->loadTemplate(1, $mailVar);
		$m->send();

		return true;
	}

	public function AccountExists($username, $email) {
		$sql = 'SELECT COUNT(`AccountID`) AS cnt FROM `Account` 
				WHERE `Username` LIKE ? OR `Email` LIKE ? ';
		$cnt;

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $username);
				$stmt->bindParam(2, $email);

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$cnt = $rs['cnt'];
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			return false;
		}

		if (!isset($cnt)) return false;
		elseif ($cnt == 0) {
			return false;
		} else {
			return true;
		}
	}
}
?>

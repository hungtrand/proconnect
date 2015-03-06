<?php
//include "../sqlConnection.php"; // For testing
require_once __DIR__."/Email.php";
require_once __DIR__."/Account.php";
//$aa = new AccountAdmin();
//echo $aa->UpdatePassword("abc");
/* Test scripts
$u = ["FirstName"=>"Iron", "LastName"=>"Man", 
		"Username"=>"iman", "Password"=>"robots",
		"Email"=>"hungtrand0929@gmail.com"];

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

		// routine check / Validation
		if (!isset($data)) return false;
		if (strlen($data['Email'].'') == 0 || strlen($data['Password'].'') == 0
			|| strlen($data['Username'].'') == 0 || strlen($data['FirstName'].'') == 0
			|| strlen($data['LastName'].'') == 0) return false;

		if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
			$this->err = "Invalid Email Address";
			return false;
		}

		if ($this->AccountExists($data['Username'], $data['Email'])) {
			$this->err = "Account already exists";
			return false;
		}
		// End of validation

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
			$this->err = "signup err: fail to prepare the database.";
			return false;
		}

		if ($insertedID == 0) return false;

		$sql = 'INSERT INTO `Account` (`Username`, `Password`, `Email`, 
										`UserID`, `VerificationKey`)
				VALUES (?, ?, ?, ?, ?)';

		$VerificationKey = sha1(mt_rand(10000,99999). str_replace(' ', '', date("Y-m-d H:i:s")).$data['Email']);
		if ($stmt = $this->db->prepare($sql)) {

			$data['Password'] = sha1($data['Password']);
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
					"{{VerificationLink}}" => "http://71.6.84.70:8080/signup/EmailVerification.php?Email=".urlencode($data['Email'])."&VerificationKey=".urlencode($VerificationKey)];
		$m = new Email(["EMAILTO"=>$data['Email']]);
		$m->loadTemplate(1, $mailVar);
		$m->send();

		return true;
	}
	
	public function ForgotPassword($email){

		if (!$this->AccountExists($email, $email)) return false;
		$VerificationKey = sha1(mt_rand(10000,99999). str_replace(' ', '', date("Y-m-d H:i:s")).$email);
		$sql = 'UPDATE `Account` SET ForgotPasswordKey = ? WHERE `Email` = ? ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $VerificationKey);
				$stmt->bindParam(2, $email);
				$stmt->execute();
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			$this->err = "verify Err: failed to update database.";
			return false;
		}
				
		$mailVar = ["{{VerificationLink}}" => "http://71.6.84.70:8080/signin/php/ForgotPasswordVerification.php?Email=".$email."ForgotPasswordKey=".urlencode($VerificationKey)];
		$m = new Email(["EMAILTO"=> $email]);
		$m->loadTemplate(2, $mailVar);
		$m->send();

		return true;

	}
	
	public function VerifyForgotPasswordKey($email,$ForgotPasswordKey){
		if (!(isset($email) && isset($ForgotPasswordKey))) return false;

		$sql = 'SELECT `AccountID` FROM `Account`
				WHERE `Email` LIKE ? AND `ForgotPasswordKey` = ? ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $email);
				$stmt->bindParam(2, $ForgotPasswordKey);

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				
				//echo json_encode($rs);
				$id = $rs['AccountID'];
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			$this->err = "verify Err: failed to prepare database.";
			return false;
		}

		if(isset($id)){
			return true;
		} else {
			return false;
		}

	}

	public function UpdatePassword($ForgotPasswordKey, $passWord){
		//$email = ?;
		if(!isset($ForgotPasswordKey)) return false;

		$sql = 'SELECT COUNT (`AccountID`) AS cnt FROM `Account`
				WHERE `ForgotPasswordKey` LIKE ?';
		
		if ($stmt = $this->db->prepare($sql)) {

			try {
				
				$stmt->bindParam(1, $ForgotPasswordKey);
				
				$stmt->execute();
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
			return true;

		} else {
			$this->err = "verify Err: failed to update database.";
			return false;
		}

		$sql = 'UPDATE `Account` SET Password = ? AND ForgotPasswordKey = ? WHERE `ForgotPasswordKey` = ? ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				
				$stmt->bindParam(1, $passWord);
				$stmt->bindParam(2, null);
				$stmt->bindParam(3, $ForgotPasswordKey);
				$stmt->execute();
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
			return true;
		} else {
			$this->err = "verify Err: failed to update database.";
			return false;
		}
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
			$this->err = "exists err: fail to prepare the database.";
			return false;
		}

		if (!isset($cnt)) return false;
		elseif ($cnt == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function getAccount($login, $password) {
		if (!(isset($login) && isset($password))) return false;

		$sql = 'SELECT `AccountID` FROM `Account` 
				WHERE (`Username` LIKE ? OR `Email` LIKE ?) 
				AND `Password` = ? AND `Active` = 1 ';

		$password = sha1($password);
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $login);
				$stmt->bindParam(2, $login);
				$stmt->bindParam(3, $password);

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$id = $rs['AccountID'];
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			return false;
		}

		if (!isset($id)) return false;
		else {
			return new Account($id);
		}
	}

	public function verifyAccount($email, $VerificationKey) {
		if (!(isset($email) && isset($VerificationKey))) return false;

		$sql = 'SELECT `AccountID` FROM `Account`
				WHERE `Email` LIKE ? AND `VerificationKey` = ? 
        		AND `Active` = 1 AND `Verified` = 0;';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $email);
				$stmt->bindParam(2, $VerificationKey);

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				
				//echo json_encode($rs);
				$id = $rs['AccountID'];
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			$this->err = "verify Err: failed to prepare database.";
			return false;
		}

		if (!isset($id)) {
			$this->err = "verify Err: failed to obtain associated account.";
			return false;
		} 

		$acc = new Account($id);
		if (!$acc->get("AccountID")) return false;

		$sql = 'UPDATE `Account` SET `Verified` = 1, `Active` = 1 WHERE `AccountID` = ? ';
		
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $id);

				$stmt->execute();
			} catch (Exception $e) {
				$this->err = $e->getMessage();
				return false;
			}
		} else {
			$this->err = "verify Err: failed to update database.";
			return false;
		}

		return $acc;
	}
}
?>

<?php
//error_reporting(E_ALL); // debug
//ini_set("display_errors", 1); // debug
require_once __DIR__."/ActiveRecord.php";
 //include "../sqlConnection.php"; // For testing
 //$u = new Account(1); echo $u->get('Username').'\n'; // For testing
// $u->update(['Username'=>'Feb2015']); echo $u->get('Username'); // For Testing

/**
* 	Account - Model (MVC) - fetch & stores email, password, alternate email, verification key, 
*	password reset key, account type and login timestamps
*	@params: $AccountID
*	$data: an associated array that act as the main property of the class Account
*	this array holds all data from the database of instance user with AccountID
*	the key is the exact name of column in database, and the value is the field value
*	@update: public function update allow Account to update its own data
*	after updating, the object Account would reload itself with new data
**/
class Account extends ActiveRecord {
	public static $PrimaryKey = 'ACCOUNTID';
	public static $TableName = 'Account';
	public static $Columns = ['ACCOUNTID', 'USERNAME', 'PASSWORD', 
				'EMAIL', 'EMAIL_ALT', 'SECURITYQUESTION', 
				'SECURITYANSWER', 'DATECREATED', 'LASTLOGIN', 
				'ACTIVE', 'USERID', 'VERIFIED', 'ISRECRUITER',
				'VERIFICATIONKEY', 'FORGOTPASSWORDKEY'];


	private $data  = [];
	private $AccountID;
	public $err;

	function __construct($ID = null) {
		parent::__construct();

		if (isset($ID) == true) {
			$this->AccountID = $ID; // Primary Key
			if (!$this->data = $this->fetch($ID)) {
				$this->err = "Record not found.";
				return false;
			};
		}
	}

	/* Implementing Abstract Methods */
	// OVERRIDE
	public function getData() {
		return $this->data;
	}

	// OVERRIDE
	public function getID() {
		return $this->AccountID;
	}

	// OVERRIDE
	protected function getPrimaryKey() {
		return self::$PrimaryKey;
	}

	// OVERRIDE
	protected function getTableName() {
		return self::$TableName;
	}

	// OVERRIDE
	protected function getColumns() {
		return self::$Columns;
	}

	// OVERRIDE
	public function load($ID) {
		if (!$this->data = $this->fetch($ID)) {
			$this->err = "Could not fetch the account with that id.";
			return false;
		}

		$this->AccountID = $ID;

		return true;
	}
	/* End Of Implementing Abstract Methods */

	public function loadByEmail($Email) {
		if (!$this->data = $this->fetchBy(["EMAIL"=>$Email])) {
			return false;
		}

		$this->AccountID = $this->data['ACCOUNTID'];

		return true;
	}

	public function loadByLogin($email, $password) {
		$params = ["EMAIL"=>$email, "PASSWORD"=>sha1($password)];
		if (!$this->data = $this->fetchBy($params) ) {
			
			return false;
		}

		$this->AccountID = $this->data['ACCOUNTID'];

		return true;
	}

	public function loadByUserID($UserID) {
		if (!$this->data = $this->fetchBy(["USERID"=>$UserID])) {
			return false;
		}

		$this->AccountID = $this->data['ACCOUNTID'];

		return true;
	}

	public function getUsername() {
		return $this->data['USERNAME'];
	}

	public function getPassword() {
		return $this->data['PASSWORD'];
	}

	public function isActive() {
		if ((string)$this->data['ACTIVE'] == "1" 
			|| (string)$this->data['ACTIVE'] == "true")
			return true;
		else
			return false;
	}

	public function getUserID() {
		return $this->data['USERID'];
	}
	
	public function getEmail() {
		return $this->data['EMAIL'];
	}

	public function getEmail_Alt() {
		return $this->data['EMAIL_ALT'];
	}

	public function getSecurityQuestion() {
		return $this->data['SECURITYQUESTION'];
	}

	public function getSecurityAnswer() {
		return $this->data['SECURITYANSWER'];
	}

	public function isVerified() {
		if ((string)$this->data['VERIFIED'] == "1" 
			|| (string)$this->data['VERIFIED'] == "true")
			return true;
		else
			return false;
	}
	
	public function getVerificationKey() {
		return $this->data['VERIFICATIONKEY'];
	}

	public function isRecruiter() {
		if ((string)$this->data['ISRECRUITER'] == "1" 
			|| (string)$this->data['ISRECRUITER'] == "true")
			return true;
		else
			return false;
	}

	public function getForgotPasswordKey() {
		return $this->data['FORGOTPASSWORDKEY'];
	}

	public function getLastLogin() {
		return date('m/d/Y', strtotime($this->data['LastLogin']));
	}

	// This is foreign key not primary key of Account table
	public function setUserID($UserID) {
		if (!$UserID = (int) $UserID) {
			$this->err = "ID must be int.";
			return false;
		}

		$this->data['USERID'] = $UserID;

		return true;
	}

	public function setUsername($newUsername) {
		$this->data['USERNAME'] = $newUsername;

		return true;
	}

	public function setPassword($newPassword) {
		$this->data['PASSWORD'] = sha1($newPassword);

		return true;
	}

	public function setEmail($newEmail) {
		$this->data['EMAIL'] = $newEmail;

		return true;
	}

	public function setEmail_Alt($newEmailAlt) {
		$this->data['EMAIL_ALT'] = $newEmailAlt;

		return true;
	}

	public function setSecurityQuestion($SecQues) {
		$this->data['SECURITYQUESTION'] = $SecQues;

		return true;
	}

	public function setSecurityAnswer($SecAns) {
		$this->data['SECURITYANSWER'] = $SecAns;

		return true;
	}

	public function setVerificationKey($extra = null) {
		if (isset($extra)) {
			$this->data['VERIFICATIONKEY'] = sha1(mt_rand(10000,99999)
				. str_replace(' ', '', date("Y-m-d H:i:s")).$extra);
		} else {
			$this->data['VERIFICATIONKEY'] = sha1(mt_rand(10000,99999)
				. str_replace(' ', '', date("Y-m-d H:i:s")));
		}
		
		return true;
	}

	public function setForgotPasswordKey($extra = null) {
		if (isset($extra)) {
			$this->data['FORGOTPASSWORDKEY'] = sha1(mt_rand(10000,99999)
				. str_replace(' ', '', date("Y-m-d H:i:s")).$extra);
		} else {
			$this->data['FORGOTPASSWORDKEY'] = sha1(mt_rand(10000,99999)
				. str_replace(' ', '', date("Y-m-d H:i:s")));
		}
		
		return true;
	}

	public function setLastLogin($LastLogin = null) {
		if (!isset($LastLogin)) {
			date_default_timezone_set('America/Los_Angeles');
			$LastLogin = date('Y-m-d H:i:s', time());
			
		} elseif (!date('Y-m-d H:i:s', $LastLogin)) {
			$this->err = "Parameter must be a date.";

			return false;
		} else {
			$LastLogin = date('Y-m-d H:i:s', $LastLogin);
		}

		$this->data['LASTLOGIN'] = $LastLogin;

		return true;
	}

	public function setActive($isActive) {
		if ($isActive == true) $this->data['ACTIVE'] = true;
		else $this->data['ACTIVE'] = false;

		return true;
	}

	public function setVerified($isVerified) {
		if ($isVerified == true) $this->data['VERIFIED'] = true;
		else $this->data['VERIFIED'] = false;

		return true;
	}

	public function setIsRecruiter($isRecruiter) {
		if ($isRecruiter == true) $this->data['ISRECRUITER'] = true;
		else $this->data['ISRECRUITER'] = false;

		return true;
	}
}
?>

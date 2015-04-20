<?php
require_once __DIR__."/../sqlConnection.php"; // For testing
require_once __DIR__."/Email.php";
require_once __DIR__."/Account.php";
require_once __DIR__."/User.php";

/*$aa = new AccountAdmin();
//echo $aa->UpdatePassword("abc");
// Test scripts
$u = ["FirstName"=>"Iron", "LastName"=>"Man", 
		"Username"=>"iman", "Password"=>"robots",
		"Email"=>"hung_duy_tran@yahoo.com"];

$aa->signup($u);
echo $aa->err;*/

/**
*	AccountAdmin - performs logic for user sign up, sign in, reset password, 
*	and email verification. AccountAdmin also communicates with System_Email package to send out 
*	email regarding the user’s account changes. 
*	Responsibilities: Account signup, Account validation, send verification email, login, logout
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

		$newAcc = new Account();

		if ($newAcc->loadByEmail($data['Email'])) {
			$this->err = "Account already exists";
			return false;
		}
		// End of validation

		$newUser = new User();
		$newUser->setName($data['FirstName'], $data['LastName'], '');
		if (!$newUser->save()) {
			$this->err = "Cannot save new User. Err: ".$newUser->err;
			return false;
		} 

		$newAcc = new Account();
		$newAcc->setUsername($data['Email']);
		$newAcc->setEmail($data['Email']);
		$newAcc->setPassword($data['Password']);
		$newAcc->setUserID($newUser->getID());
		$newAcc->setVerificationKey($data['Email']);
		$newAcc->setActive(true);
		$newAcc->setVerified(false);

		//echo "\n".json_encode($newAcc->getData())."\n";
		if (!$newAcc->save()) {
			$this->err = "Cannot save new account. Err: ".$newAcc->err;
			return false;
		}

		// send email with verification link
		$mailVar = ["{{FullName}}" => $newUser->getName(), 
					"{{VerificationLink}}" => "http://71.6.84.70:8080/signup/EmailVerification.php?Email="
					.urlencode($newAcc->getEmail())."&VerificationKey=".urlencode($newAcc->getVerificationKey())];
		$m = new Email(["EMAILTO"=>$newAcc->getEmail()]);
		$m->loadTemplate(1, $mailVar);
		$m->send();

		return true;
	}
	
	public function ForgotPassword($email){
		$acc = new Account();

		if (!$acc->loadByEmail($email)) return false;
		
		$acc->setForgotPasswordKey($email);
		$acc->update();
				
		$ForgotPasswordKey = $acc->getForgotPasswordKey();

		$mailVar = ["{{VerificationLink}}"=>"http://71.6.84.70:8080/signin/php/ForgotPasswordVerification.php?Email=".$email."&ForgotPasswordKey=".urlencode($ForgotPasswordKey)];
		$m = new Email(["EMAILTO"=>$email]);
		$m->loadTemplate(2, $mailVar);
		$m->send();

		return true;

	}
	
	public function VerifyForgotPasswordKey($email,$ForgotPasswordKey){
		if (!(isset($email) && isset($ForgotPasswordKey))) return false;

		$acc = new Account();
		if ( !$acc->loadByEmail($email) ) {
			$this->err = "Account does not exist with that email.";
			return false;
		}

		$actualKey = $acc->getForgotPasswordKey();

		if ($actualKey == $ForgotPasswordKey)
			return true;
		else
			return false;
	}

	public function UpdatePassword($Email, $ForgotPasswordKey, $newPassword){
		//$email = ?;
		if(!isset($ForgotPasswordKey) || !isset($Email) || !isset($newPassword)) return false;

		if ( !$this->VerifyForgotPasswordKey($Email, $ForgotPasswordKey) )return false;

		$acc = new Account();
		$acc->loadByEmail($Email);
		$acc->setPassword($newPassword);

		return $acc->update();
	}

	public function AccountExists($email) {
		$acc = new Account();

		return $acc->loadByEmail($email);
	}

	public function getAccount($login, $password) {
		if (!(isset($login) && isset($password))) return false;

		$acc = new Account();

		if ( !$acc->loadByLogin($login, $password) ) {
			$this->err = $acc->err;
			return false;
		}

		return $acc;
	}

	public function verifyAccount($email, $VerificationKey) {

		$acc = new Account();
		if ( !$acc->loadByEmail($email)) {
			$this->err = $acc->err;
			return false;
		}

		$actualKey = $acc->getVerificationKey();

		if ( $actualKey != $VerificationKey) {
			$this->err = "Invalid Key";
			return false;
		}

		$acc->setVerified(true);
		$acc->setActive(true);
		$acc->update();

		return $acc;
	}
}
?>

<?php
//require_once "../sqlConnection.php"; // For testing
/*
	UserConnection
	Responsibilities: determine the connection is initiator or target in the connection, 
*/
require_once __DIR__."/Connection.php";
require_once __DIR__."/User.php";
require_once __DIR__."/Account.php";
require_once __DIR__."/ExperienceManager.php";
require_once __DIR__."/EducationManager.php";

class UserConnection extends Connection {
	private $User;
	private $Connection; // OVERRIDE
	public $err;

	function __construct($User, $ConnID = null) {
		parent::__construct($ConnID);
		$this->User = $User;

		$this->Connection = ['CONNID'=>null, 'USERID'=>null, 'CUSERID'=>null
							, 'CFULLNAME'=>null, 'CEMAIL'=>null ,'CTITLE'=>null
							, 'CORGANIZATION'=>null, 'CLOCATION'=>null, 'PROFILEIMAGE'=>''];

		if (!isset($ConnID)) {
			$this->setInitUserID($User->getID());
		} else {
			// determine the connection is initiator or target in the connection
			$ConnIsInit = null;
			if ($this->getInitUserID() == $this->User->getID())
				$ConnIsInit = false;
			else if ($this->getTargetUserID() == $this->User->getID())
				$ConnIsInit = true;

			$this->loadConnectionData($ConnIsInit);
		}
	}

	// Override: return name, company and location as well
	public function getData() {
		return $this->Connection;
	}

	private function loadConnectionData($ConnIsInit = null) {
		if (!isset($ConnIsInit)) {
			$this->err = "Connection is invalid for current user.";
			return false;
		} 

		$this->Connection['CONNID'] = $this->getID();
		$this->Connection['USERID'] = $this->User->getID();

		if($ConnIsInit) {
			$CUserID = $this->getInitUserID();
		} else {
			$CUserID = $this->getTargetUserID();
		}

		$CUser = new User($CUserID);
		$CAcc = new Account();
		$CAcc->loadByUserID($CUserID);
		$CExpMan = new ExperienceManager($CUser);
		$CExpMan->loadCurrent();
		$CEduMan = new EducationManager($CUser);
		$CEduMan->loadCurrent();

		$CTitle = "";
		$COrg = "";
		$CLoc = "";

		// if there's a current job then display that as connection's information
		if ($arrExp = $CExpMan->getAll()) {
			$CTitle = $arrExp[0]->getTitle();
			$COrg = $arrExp[0]->getCompanyName();
			$CLoc = $arrExp[0]->getLocation();
		} // Elseif the connection is student then display as student with location from User table
		else if ($arrEdu = $CEduMan->getAll()) {
			$CTitle = 'Student';
			$COrg = $arrEdu[0]->getSchool(); 

			// Since educatoin table does not have location, use the User table instead
			$CLoc = $CUser->getCity();
			if (strlen($CUser->getCity().'') > 0 
				&& strlen($CUser->getState().'') > 0) $CLoc .= ', ';
			$CLoc .=$CUser->getState();
		}

		$this->Connection['CUSERID'] = $CUserID;
		$this->Connection['CFULLNAME'] = $CUser->getName();
		$this->Connection['CEMAIL'] = $CAcc->getEmail();
		$this->Connection['CTITLE'] = $CTitle;
		$this->Connection['CORGANIZATION'] = $COrg;
		$this->Connection['CLOCATION'] = $CLoc;
		$this->Connection['PROFILEIMAGE'] = $CUser->getProfileImage();

		return true;
	}

	public function getID() {
		return $this->Connection['CONNID'];
	}

	public function getUserID() {
		return $this->Connection['USERID'];
	}

	public function getConnectionUserID() {
		return $this->Connection['CUSERID'];
	}

	public function getConnectionName() {
		return $this->Connection['CFULLNAME'];
	}

	public function getConnectionEmail() {
		return $this->Connection['CEMAIL'];
	}
	
	public function getConnectionTitle() {
		return $this->Connection['CTITLE'];
	}

	public function getConnectionOrganization() {
		return $this->Connection['CORGANIZATION'];
	}

	public function getConnectionLocation() {
		return $this->Connection['CLOCATION'];
	}

	public function getProfileImage() {
		return $this->Connection['PROFILEIMAGE'];
	}
}

/*$u = new User(7);
$c = new UserConnection($u, 1);
echo "\n".json_encode($c->getData())."\n";
print_r($c->err);*/
?>

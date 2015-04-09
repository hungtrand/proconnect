<?php
//require_once "../sqlConnection.php"; // For testing
require_once __DIR__."/ViewRecord.php";
require_once __DIR__."/User.php";
require_once __DIR__."/ExperienceManager.php";
require_once __DIR__."/EducationManager.php";

class Profile extends ViewRecord {
	public static $TableName = 'vw_PersonalInfo';
	public static $PrimaryKey = 'USERID';
	public static $Columns = ['USERID', 'FIRSTNAME', 'MIDDLENAME', 'LASTNAME', 'NAME'
							, 'GENDER', 'BIRTHDAY', 'ADDRESS', 'CITY', 'STATE', 'ZIP'
							, 'SUMMARY', 'PHONE', 'PHONETYPE', 'EMPLOYMENTSTATUS'
							, 'COUNTRY', 'ACCOUNTID', 'EMAIL', 'EMAIL_ALT'
							, 'USERNAME', 'PASSWORD', 'ACTIVE', 'VERIFIED'];
	public static $PseudoColumns = ['TITLE', 'ORGANIZATION', 'LOCATION'];
	
	private $data = [];
	private $UserID;
	public $err;

	function __construct($ID = null) {
		parent::__construct();

		if (isset($ID)) {
			$this->UserID = $ID;
			if (!$this->data = $this->fetch($ID)) {
				$this->err = "Record not found.";
				return false;
			};

			$this->load($ID);
		}
	}

	/* Implementing Abstract Methods */
	// OVERRIDE
	public function getData() {
		return $this->data;
	}

	// OVERRIDE
	public function getID() {
		return $this->UserID;
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
		if (!$ID) return false;

		if (!$this->data = $this->fetch($ID)) {
			$this->err = "Could not fetch Profile from id.";
			return false;
		}

		$this->UserID = $ID;

		// Get title, organization and location
		$u = new User($this->getID());
		$ExpMan = new ExperienceManager($u);
		$ExpMan->loadCurrent();
		$EduMan = new EducationManager($u);
		$EduMan->loadCurrent();

		$Title = "";
		$Org = "";
		$Loc = "";

		// if there's a current job then display that as connection's information
		if ($arrExp = $ExpMan->getAll()) {
			$Title = $arrExp[0]->getTitle();
			$Org = $arrExp[0]->getCompanyName();
			$Loc = $arrExp[0]->getLocation();
		} // Elseif the connection is student then display as student with location from User table
		else if ($arrEdu = $EduMan->getAll()) {
			$Title = 'Student';
			$Org = $arrEdu[0]->getSchool(); 

			// Since educatoin table does not have location, use the User table instead
			$Loc = $u->getCity();
			if (strlen($u->getCity().'') > 0 
				&& strlen($u->getState().'') > 0) $Loc .= ', ';
			$Loc .=$u->getState();
		}

		$this->data['TITLE'] = $Title;
		$this->data['ORGANIZATION'] = $Org;
		$this->data['LOCATION'] = $Loc;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// Get methods
	public function getName($isFullName=null) {
		if ($isFullName)
			return $this->data['NAME'];
		else
			return $this->data['FIRSTNAME'].' '.$this->data['LASTNAME'];
	}

	public function getFirstName() {
		return $this->data['FIRSTNAME'];
	}

	public function getLastName() {
		return $this->data['LASTNAME'];
	}

	public function getMiddleName() {
		return $this->data['MIDDLENAME'];
	}

	public function getBirthday() {
		return date("m/d/Y",strtotime($this->data['BIRTHDAY']));
	}

	public function getGender() {
		return $this->data['GENDER'];
	}

	public function getAddress() {
		return $this->data['ADDRESS'];
	}

	public function getCity() {
		return $this->data['CITY'];
	}

	public function getState() {
		return $this->data['STATE'];
	}

	public function getZip() {
		return $this->data['ZIP'];
	}

	public function getCountry() {
		return $this->data['COUNTRY'];
	}

	public function getPhone() {
		return $this->data['PHONE'];
	}

	public function getPhoneType() {
		return $this->data['PHONETYPE'];
	}

	public function getSummary() {
		return $this->data['SUMMARY'];
	}

	public function getEmploymentStatus() {
		return $this->data['EMPLOYMENTSTATUS'];
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

	public function isVerified() {
		if ((string)$this->data['VERIFIED'] == "1" 
			|| (string)$this->data['VERIFIED'] == "true")
			return true;
		else
			return false;
	}

	public function getTitle() {
		return $this->data['TITLE'];
	}

	public function getOrganization() {
		return $this->data['ORGANIZATION'];
	}

	public function getLocation() {
		return $this->data['LOCATION'];
	}

}

/*$p  = new Profile(10);
echo "\n".$p->err;
echo "\n".$p->getLocation()."\n";*/
?>

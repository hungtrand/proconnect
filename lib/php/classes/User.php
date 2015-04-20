<?php
 //include "../sqlConnection.php"; // For testing
 require_once __DIR__."/ActiveRecord.php";
 require_once __DIR__."/EducationManager.php";


 /*$arrEdu = $u->getTopEducation(2);

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
class User extends ActiveRecord {
	public static $TableName = 'User';
	public static $PrimaryKey = 'USERID';
	public static $Columns = ['USERID', 'FIRSTNAME', 'MIDDLENAME', 'LASTNAME',
				'GENDER', 'BIRTHDAY', 'ADDRESS', 'CITY', 'STATE', 'ZIP', 'COUNTRY',
				'PHONE', 'PHONETYPE', 'SUMMARY', 'EMPLOYMENTSTATUS', 'PROFILEIMAGE'];
	
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
			$this->err = "Could not fetch the user with that id.";
			return false;
		}

		$this->UserID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	public function getName($isFullName=null) {
		if ($isFullName)
			return $this->data['FIRSTNAME'].' '.$this->data['MIDDLENAME'].' '.$this->data['LASTNAME'];
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

	public function getProfileImage() {
		return $this->data['PROFILEIMAGE'];
	}

	public function setName($FirstName, $LastName, $MidName) {
		$this->data['FIRSTNAME'] = $FirstName;
		$this->data['LASTNAME'] = $LastName;
		$this->data['MIDDLENAME'] = $MidName;

		return true;
	}

	public function setGender($Gender) {
		$this->data['GENDER'] = $Gender;

		return true;
	}

	public function setBirthday($Birthday) {
		$this->data['BIRTHDAY'] = date("Y-m-d",strtotime($Birthday));

		return true;
	}

	public function setAddress($Address, $City, $State, $Zip, $Country) {
		$this->data['ADDRESS'] = $Address;
		$this->data['CITY'] = $City;
		$this->data['STATE'] = $State;
		$this->data['ZIP'] = $Zip;
		$this->data['COUNTRY'] = $Country;

		return true;
	}

	public function setPhone($Phone, $PhoneType="Home") {
		$this->data['PHONE'] = $Phone;
		$this->data['PHONETYPE'] = $PhoneType;
	}

	public function setSummary($strSummary) {
		$this->data['SUMMARY'] = $strSummary;

		return true;
	}

	public function setEmploymentStatus($strStatus) {
		$this->data['EMPLOYMENTSTATUS'] = $strStatus;

		return true;
	}

	public function setProfileImage($strURL) {
		$this->data['PROFILEIMAGE'] = $strURL;

		return true;
	}
}
?>

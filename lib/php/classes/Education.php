<?php
 //include "../sqlConnection.php"; // For testing
 require_once __DIR__."/ActiveRecord.php";

 //$u = new Education(1); echo $u->get('School').'\n'; // For testing
 //$u->update(['Grade'=>'3.8']); echo $u->get('Grade'); // For Testing

/**
*	Education - performs logic for Education class.  Store data to or Load education data from the database. 
*	@params: $UserID
*	Responsibilities: setup user's school, degree, fieldofstudy, activites, gpa, yearstarts, yearend, and user's description of this education.  
*/
class Education extends ActiveRecord {
	public static $TableName = 'Education';
	public static $PrimaryKey = 'EDUID';
	public static $Columns = ['EDUID', 'SCHOOL', 'DEGREE', 
							'FIELDOFSTUDY', 'ACTIVITIES', 'USERID', 
							'GPA', 'YEARSTART', 'YEAREND', 'DESCRIPTION'];
	
	private $data = [];
	private $EduID;
	public $err;

	function __construct($ID = null) {

		parent::__construct();

		if (isset($ID)) {
			$this->EduID = $ID;
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
		return $this->EduID;
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
			$this->err = "Could not fetch education from id.";
			return false;
		}

		$this->EduID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// GET METHODS
	public function getSchool() {
		return $this->data['SCHOOL'];
	}

	public function getDegree() {
		return $this->data['DEGREE'];
	}

	public function getFieldOfStudy() {
		return $this->data['FIELDOFSTUDY'];
	}

	public function getActivities() {
		return $this->data['ACTIVITIES'];
	}

	public function getUserID() {
		return $this->data['USERID'];
	}

	public function getGPA() {
		return $this->data['GPA'];
	}

	public function getYearStart() {
		return $this->data['YEARSTART'];
	}

	public function getYearEnd() {
		return $this->data['YEAREND'];
	}

	public function getDescription() {
		return $this->data['DESCRIPTION'];
	}

	// SET METHODS
	public function setSchool($strVal) {
		$this->data['SCHOOL'] = $strVal;

		return true;
	}

	public function setDegree($strVal) {
		$this->data['DEGREE'] = $strVal;

		return true;
	}

	public function setFieldOfStudy($strVal) {
		$this->data['FIELDOFSTUDY'] = $strVal;

		return true;
	}

	public function setActivities($strVal) {
		$this->data['ACTIVITIES'] = $strVal;

		return true;
	}

	public function setUserID($intVal) {
		$this->data['USERID'] = $intVal;

		return true;
	}

	public function setGPA($decVal) {
		$this->data['GPA'] = $decVal;

		return true;
	}

	public function setYearStart($intVal) {
		$this->data['YEARSTART'] = $intVal;

		return true;
	}

	public function setYearEnd($intVal) {
		$this->data['YEAREND'] = $intVal;

		return true;
	}

	public function setDescription($txtVal) {
		$this->data['DESCRIPTION'] = $txtVal;

		return true;
	}
}
?>

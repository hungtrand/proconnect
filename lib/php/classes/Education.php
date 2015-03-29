<?php
 //include "../sqlConnection.php"; // For testing
 require_once __DIR__."/ActiveRecord.php";

 //$u = new Education(1); echo $u->get('School').'\n'; // For testing
 //$u->update(['Grade'=>'3.8']); echo $u->get('Grade'); // For Testing

/*
	Load education data from the database
*/
class Education extends ActiveRecord {
	private $data;
	private $EduID;
	public $err;

	function __construct($ID = null) {
		$TableName = 'Education';
		$PrimaryKey = 'EDUID';
		$this->data = ['EDUID'=>'', 'SCHOOL'=>'', 'DEGREE'=>'', 'FIELDOFSTUDY'=>'',
				'ACTIVITIES'=>'', 'USERID'=>'', 'GPA'=>'', 
				'YEARSTART'=>'', 'YEAREND'=>''];

		parent::__construct($TableName, $PrimaryKey);

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
		return $this->UserID;
	}

	// OVERRIDE
	public function load($ID) {
		if (!$ID) return false;

		if (!$this->data = $this->fetch($ID)) {
			$this->err = "Could fetch the user with that id.";
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

	public function getDateStart() {
		return $this->data['DATESTART'];
	}

	public function getDateEnd() {
		return $this->data['DATEEND'];
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
}
?>

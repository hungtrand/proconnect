<?php
//include "../sqlConnection.php"; // For testing
require_once __DIR__."/ActiveRecord.php";
//$u = new Experience(1); echo $u->get('Description').'\n'; // For testing
//$u->update(['Username'=>'Feb2015']); echo $u->get('Username'); // For Testing

class Project extends ActiveRecord {
	private $data;
	private $ProjectID;
	public $err;

	function __construct($ID = null) {
		$TableName = 'Projects';
		$PrimaryKey = 'ProjectID';
		$this->data = ['PROJECTID'=>'', 'PROJECTITLE'=>'', 'PROJECTURL'=>'', 'OCCUPATION'=>'',
				'DESCRIPTION'=>'', 'USERID'=>'', 'DATECREATED'=>'', 
				'STARTMONTH'=>null, 'STARTYEAR'=>null, 'ENDMONTH'=>null,'ENDYEAR'=>null];

		parent::__construct($TableName, $PrimaryKey);

		if (isset($ID)) {
			$this->ProjectID = $ID;
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
		return $this->ProjectID;
	}

	// OVERRIDE
	public function load($ID) {
		if (!$ID) return false;

		if (!$this->data = $this->fetch($ID)) {
			$this->err = "Could fetch the user with that id.";
			return false;
		}

		$this->ProjectID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// Get methods
	public function getProjectTitle() {
		return $this->data['PROJECTITLE'];
	}

	public function getUserID() {
		return $this->data['USERID'];
	}

	public function getProjectURL() {
		return $this->data['PROJECTURL'];
	}

	public function getOccupation() {
		return $this->data['OCCUPATION'];
	}

	public function getDescription() {
		return $this->data['DESCRIPTION'];
	}

	public function getDateCreated() {
		return $this->data['DATECREATED'];
	}

	public function getStartMonth() {
		return $this->data['STARTMONTH'];
	}

	public function getStartYear() {
		return $this->data['STARTYEAR'];
	}

	public function getEndMonth() {
		return $this->data['ENDMONTH'];
	}

	public function getEndYear() {
		return $this->data['ENDYEAR'];
	}

	// Set methods
	public function setProjectTitle($strVal) {
		$this->data['PROJECTITLE'] = $strVal;

		return true;
	}

	public function setUserID($intVal) {
		$this->data['USERID'] = $intVal;

		return true;
	}

	public function setProjectURL($strVal) {
		$this->data['PROJECTURL'] = $strVal;

		return true;
	}

	public function setOccupation($strVal) {
		$this->data['OCCUPATION'] = $strVal;

		return true;
	}

	public function setDescription($strVal) {
		$this->data['DESCRIPTION'] = $strVal;

		return true;
	}

	public function setStartMonth($intVal) {
		$this->data['STARTMONTH'] = $intVal;

		return true;
	}

	public function setStartYear($intVal) {
		$this->data['STARTYEAR'] = $intVal;

		return true;
	}

	public function setStartDate($intMonth, $intYear) {
		$this->data['STARTMONTH'] = $intVal;
		$this->data['STARTYEAR'] = $intYear;

		return true;
	}

	public function setEndMonth($intVal) {
		$this->data['ENDMONTH'] = $intVal;

		return true;
	}

	public function setEndYear($intVal) {
		$this->data['ENDYEAR'] = $intVal;

		return true;
	}

	public function setEndDate($intMonth, $intYear) {
		$this->data['ENDMONTH'] = $intMonth;
		$this->data['ENDYEAR'] = $intYear;

		return true;
	}
}
?>

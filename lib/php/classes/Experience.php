<?php
//include "../sqlConnection.php"; // For testing
require_once __DIR__."/ActiveRecord.php";
//$u = new Experience(1); echo $u->get('Description').'\n'; // For testing
//$u->update(['Username'=>'Feb2015']); echo $u->get('Username'); // For Testing
/**
*	Experience - performs logic for experience class.
* 	@params: $ID (userid)
*	Responsiblities: get or setup the user's data to database, such as companyname, title, location,
*						user's description of this experience, starting month and year, ending month and year. 
*/
class Experience extends ActiveRecord {
	public static $TableName = 'Experience';
	public static $PrimaryKey = 'EXPID';
	public static $Columns = ['EXPID', 'COMPANYNAME', 'TITLE', 'LOCATION',
				'DESCRIPTION', 'USERID', 'DATECREATED', 
				'STARTMONTH', 'STARTYEAR', 'ENDMONTH','ENDYEAR'];
	
	private $data = [];
	private $ExpID;
	public $err;

	function __construct($ID = null) {
		parent::__construct();

		if (isset($ID)) {
			$this->ExpID = $ID;
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
		return $this->ExpID;
	}

	// OVERRIDE
	protected function getPrimaryKey() {
		return self::$PrimaryKey;
	}

	// OVERRIDE
	protected function getTableName() {
		return self::$TableName;
	}

	protected function getColumns() {
		return self::$Columns;
	}

	// OVERRIDE
	public function load($ID) {
		if (!$ID) return false;

		if (!$this->data = $this->fetch($ID)) {
			$this->err = "Could not fetch experience from id.";
			return false;
		}

		$this->ExpID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// Get methods
	public function getCompanyName() {
		return $this->data['COMPANYNAME'];
	}

	public function getUserID() {
		return $this->data['USERID'];
	}

	public function getTitle() {
		return $this->data['TITLE'];
	}

	public function getLocation() {
		return $this->data['LOCATION'];
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
	public function setCompanyName($strVal) {
		$this->data['COMPANYNAME'] = $strVal;

		return true;
	}

	public function setUserID($intVal) {
		$this->data['USERID'] = $intVal;

		return true;
	}

	public function setTitle($strVal) {
		$this->data['TITLE'] = $strVal;

		return true;
	}

	public function setLocation($strVal) {
		$this->data['LOCATION'] = $strVal;

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

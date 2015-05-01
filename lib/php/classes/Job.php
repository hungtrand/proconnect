<?php
	require_once __DIR__."/ActiveRecord.php";

/**
*		Job - this Class performs the logical information for job class. Including Load and Store data from the database.
*		@params: JobID
*		Responsibilities: setup user interest of job and job posting based on companyname, location, industry, title, experiences, and skills.
*							The sql table will be get and set based on the JobHiring status. If jobhiring is 'yes', it will call set methods to updated the field on most of the columns such as companyname, type, etc.
*							also based on userid, which is based on user type. If regular user, there will be jobhiring 'no'. 
*/

	class Job extends ActiveRecord{
		public static $TableName = 'Job';
		public static $PrimaryKey = 'JobID';
		public static $Columns = ['JOBID', 'JOBLOCATION', 'JOBTITLE', 'INDUSTRY', 'COMPANYNAME', 'COMPANYDESCRIPTION', 'EXPERIENCE', 'SPECIALSKILL',
									'EMPLOYMENTTYPE', 'JOBHIRING', 'PREFERENCELOCATION', 'PREFERENCEINDUSTRY', 'PREFERENCEJOBTYPE', 'USERID', 'DATECREATED'];

		private $data = [];
		private $JobID;
		public $err;

		function __construct($ID = null){
			parent::__construct();
			if(isset($ID)){
			$this->JobID = $ID;
			if(!$this->data = $this->fetch($ID)){
				$this->err = "Record Not Found!";
				return false;
			};
		}
	}
	

	//Implementing the abstract methods
	//OVERRIDE
	public function getData(){
		return $this->data;
	}

	public function getID(){
		return $this->JobID;
	}

	public function getPrimaryKey(){
		return self::$PrimaryKey;

	}

	public function getTableName(){
		return self::$TableName;
	}

	public function getColumns(){
		return self::$Columns;
	}

	public function load($ID){
		if(!$ID) return false;

		if(!$this->data = $this->fetch($ID)){
			$this->err = "Could not fetch this ID.";
			return false;
		}
		$this->JobID = $ID;
		return true;
	}

	//GetMethods for job class

	public function getJobHiring(){
		return $this->data['JOBHIRING'];
	}
	public function getJobLoacation(){
		return $this->data['JOBLOCATION'];
	}

	public function getJobTitle(){
		return $this->data['JOBTITLE'];
	}

	public function getIndustry(){
		return $this->data['INDUSTRY'];
	}

	public function getCompanyName(){
		return $this->data['COMPANYNAME'];
	}

	public function getCompanyDescription(){
		return $this->data['COMPANYDESCRIPTION'];
	}

	public function getExperience(){
		return $this->data['EXPERIENCE'];
	}

	public function getSpecialSkill(){
		return $this->data['SPECIALSKILL'];
	}

	public function getEmploymentType(){
		return $this->data['EMPLOYMENTTYPE'];
	}

	public function getPreferenceLocation(){
		return $this->data['PREFERENCELOCATION'];
	}

	public function getPreferenceIndustry(){
		return $this->data['PREFERENCEINDUSTRY'];
	}

	public function getPreferenceJobType(){
		return $this->data['PREFERENCEJOBTYPE'];
	}

	public function getUserID(){
		return $this->data['USERID'];
	}

	public function getDateCreated(){
		return $this->data['DATECREATED'];
	}

	//SET METHODS

	public function setJobHiring($strVal){
		$this->data['JOBHIRING'] = $strVal;
	}

	public function setJobLocation($strVal){
		$this->data['JOBLOCATION'] = $strVal;
	}

	public function setJobTitle($strVal){
		$this->data['JOBTITLE'] = $strVal;
	}
	public function setIndustry($strVal){
		$this->data['INDUSTRY'] = $strVal;
	}
	public function setCompanyName($strVal){
		$this->data['COMPANYNAME'] = $strVal;
	}
	public function setCompanyDescription($txtVal){
		$this->data['COMPANYDESCRIPTION'] = $txtVal;
	}

	public function setExperience($strVal){
		$this->data['EXPERIENCE'] = $strVal;
	}

	public function setSpecialSkill($strVal){
		$this->data['SPECIALSKILL'] = $strVal;
	}

	public function setEmploymentType($strVal){
		$this->data['EMPLOYMENTTYPE'] = $strVal;
	}

	public function setPreferenceLocation($strVal){
		$this->data['PREFERENCELOCATION'] = $strVal;
	}

	public function setPreferenceIndustry($strVal){
		$this->data['PREFERENCEINDUSTRY'] = $strVal;
	}

	public function setPreferenceJobType($strVal){
		$this->data['PREFERENCEJOBTYPE'] = $strVal;
	}

	public function setUserID($intVal){
		$this->data['USERID'] = $intVal;
	}

}
?>
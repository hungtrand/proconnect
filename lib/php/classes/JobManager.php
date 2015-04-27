<?php

	require_once "../sqlConnection.php"; //testing
	require_once __DIR__."/User.php"; //testing
	require_once __DIR__."/Job.php";
	require_once __DIR__."/RecordSet.php";

/** JobManager - perform management for job class which help other classes to be able to access Job data through this manager. 
*	@params: $User
*	Responsibilities: load the data base on userId. Also, others to get the job data from database.
*/

	class JobManager extends RecordSet{
		protected $PrimaryKey;
		protected $TableName;
		protected $Columns;
		protected $User;
		Protected $data;

		public $err;
		function __construct($User){
			$this->PrimaryKey = Job::$PrimaryKey;
			$this->TableName = Job::$TableName;
			$this->Columns = Job::$Columns;
			$this->User = $User;

			parent::__construct();

			$this->load($User);

		}

		//OVERRIDE

		protected function getColumns(){
			return $this->Columns;
		}

		public function load($User){
			$params = ['USERID'=>$User->getID()];
			if(!$this->data = $this->fetchBy($params)) return false;
			$this->User = $User;
			return true;
		}

		public function loadCurrent() {
			$cond = "WHERE USERID = ? AND DATECREATED IS NOT NULL ";
			$cond .="ORDER BY DATECREATED DESC LIMIT 1 ";

			$params = ['USERID'=>$this->User->getID()];
			if (!$this->data = $this->fetchCustom($cond, $params)) return false;

			return true;
		}



		public  function getData(){
			if(!isset($this->data) || count($this->data) < 1) return false;

			return $this->data;
		}

		public function getAll(){
			if(!isset($this->data) || count($this->data) < 1 || !$this->data) return false;
			$arr = [];
			foreach($this->getData() as $row){
				$id = $row[$this->PrimaryKey];
				$obj = new Job($id);
				array_push($arr, $obj);

			}
			return $arr;
		}
	}

//Test
$u = new User(10);
$edu = new Job();
//$edu->load(6);
$edu->setCompanyName('Proconnect');
$edu->setUserID(10);
//$edu->setFieldOfStudy('Computer Science');
//$edu->setUserID($u->getID());
//$edu->setGPA(3.9);
//$edu->setYearStart(2011);
//$edu->setYearEnd(2013);

$edu->save();

$em = new Jobmanager($u);
echo "\n";
echo json_encode($em->getData());
echo $em->err;
echo"\n";
?>
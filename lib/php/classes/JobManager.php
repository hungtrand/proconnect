<?php

	// require_once "../sqlConnection.php"; //testing
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
		function __construct($User=null){
			$this->PrimaryKey = Job::$PrimaryKey;
			$this->TableName = Job::$TableName;
			$this->Columns = Job::$Columns;
			$this->User = $User;

			parent::__construct();

			if (isset($User))
				$this->load($User);

		}

		//OVERRIDE

		protected function getColumns(){
			return $this->Columns;
		}

		public function load($User=null){
			if (isset($User)) {
				$params = ['USERID'=>$User->getID()];
				if(!$this->data = $this->fetchBy($params)) return false;
				$this->User = $User;
			} else {
				if(!$this->data = $this->fetch()) return false;
			}
			
			
			return true;
		}

		public function loadHiring($page, $numRows, $orderby="DATECREATED") {
			if (!is_integer($page) || !is_integer($numRows)) {
				$this->err = "Parameters must be integers";
				return false;
			}

			$offset = $page * $numRows - $numRows;
			$params = [];
			
			$cond = "WHERE JOBHIRING = 1 ";
			$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
			//$params = ['USERID'=>$this->User->getID()];
			if (!$this->data = $this->fetchCustom($cond, $params)) return false;

			return true;
		}

		public function loadbysearch($keyword, $page, $numRows, $orderby="DATECREATED"){
			if(!is_integer($page) || !is_integer($numRows) || !is_array($orderby)){
				$this->err = "Parameter of the wrong type!";
				return false;
			}

			$offset = $page * $numRows - $numRows;
			$params = [];
			$delimiter = "";

			$cond = "";
			for ($i=0; $i<count($keyword); $i++){
				$cleanKW = str_replace("'", "''", $keyword[$i]);
				$cleanKW = str_replace(",", ";", $cleanKW);

				$delimiter = "AND";
			}

			$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;

			//echo $cond;
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

	
/*
//Test
$u = new User(10);
$edu = new Job();
//$edu->load(6);
$edu->setCompanyName('Proconnect');
$edu->setPreferenceIndustry('HCG');
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
echo"\n";*/
?>
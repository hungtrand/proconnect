<?php
//require_once "../sqlConnection.php"; // for testing
//require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Education.php";
require_once __DIR__."/RecordSet.php";

class EducationManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	private $User;
	private $data;

	public $err;

	function __construct($User) {
		$this->PrimaryKey = Education::$PrimaryKey;
		$this->TableName = Education::$TableName;
		$this->Columns = Education::$Columns;
		$this->User = $User;

		parent::__construct();

		$this->load($User);
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	public function load($User) {
		$params = ['USERID'=>$User->getID()];
		if (!$this->data = $this->fetchBy($params)) return false;

		$this->User = $User;

		return true;
	}

	public function getData() {
		if (!isset($this->data) || count($this->data) < 1) return false;

		return $this->data;
	}

	public function getAll() {
		if (!isset($this->data) || count($this->data) < 1) return false;

		$arr = [];
		foreach ($this->getData() as $row) {
			$id = $row[$this->PrimaryKey];
			$obj = new Education($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}
//Test
/*$u = new User(10);
$edu = new Education();
$edu->setSchool('Alameda College');
$edu->setFieldOfStudy('Computer Science');
$edu->setUserID($u->getID());
$edu->setGPA(3.9);
$edu->setYearStart(2011);
$edu->setYearEnd(2013);

$edu->save();

$em = new EducationManager($u);
echo "\n";
echo json_encode($em->getData());
echo $em->err;
echo"\n";*/
?>
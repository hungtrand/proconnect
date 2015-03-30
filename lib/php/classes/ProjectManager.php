<?php
//require_once "../sqlConnection.php"; // for testing
//require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Project.php";
require_once __DIR__."/RecordSet.php";

class ProjectManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	private $User;
	private $data;

	public $err;

	function __construct($User) {
		$this->PrimaryKey = Project::$PrimaryKey;
		$this->TableName = Project::$TableName;
		$this->Columns = Project::$Columns;
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
		foreach ($this->data as $row) {
			$id = $row[$this->PrimaryKey];
			$obj = new Project($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}
//Test
/*$u = new User(10);
$proj = new Project();
$proj->setProjectTitle('UAV (Cloud Seeding)');
$proj->setOccupation('Firmware Developer');
$proj->setUserID($u->getID());
$proj->setDescription("Program an autonomous airplane to make it rain.");
$proj->setStartMonth(11);
$proj->setStartYear(2013);

$proj->save();
echo $proj->err;

$pm = new ProjectManager($u);
echo "\n";
echo json_encode($pm->getData());
echo $pm->err;
echo"\n";*/
?>
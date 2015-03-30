<?php
//require_once "../sqlConnection.php"; // for testing
//require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Experience.php";
require_once __DIR__."/RecordSet.php";

class ExperienceManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	private $User;
	private $data;

	public $err;

	function __construct($User) {
		$this->PrimaryKey = Experience::$PrimaryKey;
		$this->TableName = Experience::$TableName;
		$this->Columns = Experience::$Columns;
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
			$obj = new Experience($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}
//Test
/*$u = new User(10);
$exp = new Experience();
$exp->setCompanyName('Google Inc.');
$exp->setTitle('Web Application Developer');
$exp->setUserID($u->getID());
$exp->setLocation("Mountain View");
$exp->setStartMonth(11);
$exp->setStartYear(2013);

$exp->save();

$em = new ExperienceManager($u);
echo "\n";
echo json_encode($em->getData());
echo $em->err;
echo"\n";*/
?>
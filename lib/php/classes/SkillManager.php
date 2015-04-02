<?php
//require_once "../sqlConnection.php"; // for testing
//require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Skill.php";
require_once __DIR__."/RecordSet.php";

class SkillManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	private $User;
	private $data;

	public $err;

	function __construct($User) {
		$this->PrimaryKey = Skill::$PrimaryKey;
		$this->TableName = Skill::$TableName;
		$this->Columns = Skill::$Columns;
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
		if (!isset($this->data) || count($this->data) < 1|| !$this->data) 
			return false;

		$arr = [];
		foreach ($this->data as $row) {
			$id = $row[$this->PrimaryKey];
			$obj = new Skill($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}
//Test
/*$u = new User(10);
$skill = new Skill();
$skill->setSkillName('PHP)');
$skill->setOrderPosition(1);
$skill->setUserID($u->getID());

$skill->save();
echo $skill->err;

$sm = new SkillManager($u);
echo "\n";
echo json_encode($sm->getData());
echo $sm->err;
echo"\n";*/
?>
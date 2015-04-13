<?php
//require_once "../sqlConnection.php"; // for testing
//require_once __DIR__."/User.php"; // for testing
require_once __DIR__."/Message.php";
require_once __DIR__."/RecordSet.php";

class MessageManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	protected $User;
	protected $data;

	public $err;

	function __construct($User) {
		$this->PrimaryKey = Message::$PrimaryKey;
		$this->TableName = Message::$TableName;
		$this->Columns = Message::$Columns;
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

	public function loadCurrent() {
		$cond = "WHERE USERID = ? AND DATECREATED IS NOT NULL ";
		$cond .="ORDER BY DATECREATED DESC LIMIT 1 ";

		$params = ['USERID'=>$this->User->getID()];
		if (!$this->data = $this->fetchCustom($cond, $params)) return false;

		return true;
	}

	public function getData() {
		if (!isset($this->data) || count($this->data) < 1) return false;

		return $this->data;
	}

	public function getAll() {
		if (!isset($this->data) || count($this->data) < 1 || !$this->data) 
			return false;

		$arr = [];
		foreach ($this->data as $row) {
			$id = $row[$this->PrimaryKey];
			$obj = new Message($id);
			array_push($arr, $obj);
		}

		return $arr;
	}
	
}
//Test
/*$u = new User('10');
$mes = new Message('10');
$mes->setMessageID('khanh nguyen testing');
$mes->setSubject('testng1');
$mes->setBody('testing 2');
$mes->setCreator($u->getID());
echo $u->getID();
$mes->setDateCreated('10-20-2015');

$mes->save();

$mesm = new MessageManager($u);
echo "\n";
echo json_encode($mesm->getData());
echo $mesm->err;
echo"\n";*/
?>
<?php
//require_once "../sqlConnection.php"; // for testing
require_once __DIR__."/RecordSet.php";


/**
*	lookup_StatesManager - performs logic for lookup_StatesManager class. 
*	@params: $city
*	Responsibilities: look for state by city name.   
*/
class Lookup_StatesManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	protected $User;
	protected $data;

	public $err;

	function __construct() {
		$this->PrimaryKey = "STATE";
		$this->TableName = "Lookup_States";
		$this->Columns = ['STATE', 'STATE_CODE'];

		parent::__construct();
	}

	// OVERRIDE
	protected function getColumns() {
		return $this->Columns;
	}

	public function load() {
		if (!$this->data = $this->fetch()) return false;

		return true;
	}

	public function getData() {
		if (!isset($this->data) || count($this->data) < 1) return false;

		return $this->data;
	}
	
}
//Test
/*$sm = new Lookup_StatesManager();
echo json_encode($sm->getData());*/
?>
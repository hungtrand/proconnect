<?php
//require_once "../sqlConnection.php"; // for testing
require_once __DIR__."/RecordSet.php";


/**
*	lookup_CitiesManager - performs logic for lookup_CitiesManager class. This class extend RecordSet, and it will return set of city base on state-code input. 
*	@params: $Statecode
*	Responsibilities: look for city by state code.   
*/
class Lookup_CitiesManager extends RecordSet {
	protected $PrimaryKey;
	protected $TableName;
	protected $Columns;

	protected $data;

	public $err;

	function __construct() {
		$this->PrimaryKey = "CITY";
		$this->TableName = "Lookup_Cities";
		$this->Columns = ['CITY', 'STATE_CODE'];

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

	public function loadByState($statecode) {
		if (!isset($statecode)) return false;

		$params = ["STATE_CODE"=>$statecode];

		if (!$this->data = $this->fetchBy($params)) return false;

		return $this->data;

	}
	
}
//Test
/*$cm = new Lookup_CitiesManager();
$cm->loadByState('CA');
echo json_encode($cm->getData());*/
?>
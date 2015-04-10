<?php

require_once __DIR__."/User.php";
require_once __DIR__."/ActiveRecord.php";

class Notification extends ActiveRecord{
	public static $TableName = 'Notification';
	public static $PrimaryKey = 'NotificationID';
	public static $Columns = ['NotificationID', 'Message', 'Type', 'DateCreated', 'AssocUser'];
	private $data = [];
	private $NotificationID;
	public $err;

	function __construct($ID = null){
		parent:: __construct();
		if(isset($ID)){
			$this->NotificationID = $ID;
			if(!$this->$data = $this->fetch($ID)){
				$this->err = "No Message Found!";
				return false;
			};
		}
	}

	//OVERRIDE
	public function getID(){
		return $this->NotificationID;
	}
	//OVERRIDE
	public function getTableName(){
		return self::$TableName;
	}
	//OVERRIDE
	public function getPrimaryKey(){
		return self::$PrimaryKey;
	}
	//OVERRIDE
	public function getColumns(){
		return self::$Columns;
	}
	//OVERRIDE
	public function getData(){
		return $this->data;
	}
	//OVERRIDE
	public function load($ID){
		if(!$ID){
			return false;
		} 
		if(!$this->data = $this->fetch($ID)){
			$this->err = "Could not fetch this id";
			return false;
		}
		$this->NotificationID = $ID;
		return true;
	}

	//get methods
	public function getUMessage(){
		return $this->data['MESSAGE'];
	}
	public function getType(){
		return $this->data['TYPE'];
	}
	public function getDateCreated(){
		return $this->data['DATECREATED'];
	}
	public function getAssocUser(){
		return $this->data['ASSOCUSER'];
	}

	//set methods
	public function setUMessage($strVal){
		$this->data['MESSAGE'] = $strVal;
		return true;
	}
	public function setType($strVal){
		$this->data['TYPE'] = $strVal;
		return true;
	}
	public function setAssocUser($intVal){
		$this->data['ASSOCUSER'] = $intVal;
		return true;
	}

};

	

?>
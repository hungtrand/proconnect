<?php
require_once __DIR__."/ActiveRecord.php";


/**
*	MessageView - map data between a user and message to identify which user is allowed to receive a message.
*	@params: $UserID
*	Responsibilities: set information for a message (like messageID, USERID, Date created, notificationID ), and also get information about the message.   
*/
class MessageView extends ActiveRecord{
	public static $TableName = 'MessageView';
	public static $PrimaryKey = 'MESSAGEVIEWID';
	public static $Columns = ['MESSAGEVIEWID', 'MESSAGEID', 'USERID', 'TIMESTAMP', 
								'READ', 'ARCHIVED', 'DELETED', 'ISCREATOR'];
	private $data= [];
	private $MessageViewID;
	public $err;

	function __construct($ID = null){
		parent:: __construct();
		if(isset($ID)){
			$this->MessageViewID =$ID;
			if(!$this->data = $this->load($ID)){
				$this->err = "Record not found!";
				return false;
			}; 
		}
	}

	//Implementign Abstruct Methods
	//OVERRIDE
	public function getData(){
		return $this->data;
	}
	//OVERRIDE
	public function getID(){
		return $this->MessageViewID;
	}
	//OVERRIDE
	public function getPrimaryKey(){
		return self::$PrimaryKey;
	}
	//OVERRIDE
	public function getTableName(){
		return self::$TableName;
	}
	//OVERRIDE
	public function getColumns(){
		return self::$Columns;
	}

	//OVERRIDE
	public function load($ID){
		if(!$ID) return false;
		if(!$this->data = $this->fetch($ID)){
			$this->err = "Could not fetch this ID!";
			return false;
		}
		$this->MessageViewID = $ID;
		return true;
	}

	//Get Methods
	public function getMessageID(){
		return $this->data['MESSAGEID'];
	}

	public function getUserID(){
		return $this->data['USERID'];
	}

	public function getTimestamp(){
		return $this->data['TIMESTAMP'];
	}

	public function getRead(){
		if ((bool)trim($this->data['READ']))
			return true;
		else
			return false;
	}

	public function getArchived(){
		if ((bool)trim($this->data['ARCHIVED']))
			return true;
		else
			return false;
	}

	public function getDeleted(){
		if ((bool)trim($this->data['DELETED']))
			return true;
		else
			return false;
	}

	public function isCreator() {
		if ((bool)trim($this->data['ISCREATOR']))
			return true;
		else
			return false;
	}

	//Set Methods

	public function setMessageID($intVal){
		$this->data['MESSAGEID'] = (int)$intVal;
		return true;
	}

	public function setUserID($intVal){
		$this->data['USERID'] = (int)$intVal;
		return true;
	}

	public function setRead($boolVal = false){
		if ($boolVal) $this->data['READ'] = true;
		else $this->data['READ'] = false;

		return true;
	}

	public function setArchived($boolVal = false){
		if ($boolVal) $this->data['ARCHIVED'] = true;
		else $this->data['ARCHIVED'] = false;

		return true;
	}

	public function setDeleted($boolVal = false){
		if ($boolVal) $this->data['DELETED'] = true;
		else $this->data['DELETED'] = false;

		return $this->data['DELETED'];
	}

	public function setIsCreator($boolVal = false) {
		if ($boolVal) $this->data['ISCREATOR'] = true;
		else $this->data['ISCREATOR'] = false;

		return true;
	}

}
?>
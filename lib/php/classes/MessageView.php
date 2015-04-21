<?php
require_once __DIR__."/ActiveRecord.php";


/**
*	MessageView - performs logic for MessageView class. This class extend ActiveRecord class. This class provides detail information and attribute names of the MessageView tables, and it can temporarily edit info of the MessageView table in database like update a row or insert new row.
*	@params: $UserID
*	Responsibilities: set information for a message (like messageID, USERID, Date created, notificationID ), and also get information about the message.   
*/
class MessageView extends ActiveRecord{
	public static $TableName = 'MessageView';
	public static $PrimaryKey = 'MessageViewID';
	public static $Columns = ['MessageViewID', 'MessageID', 'UserID', 'DateCreated', 'NotificationID'];
	private $data= [];
	private $MessageViewID;
	public $err;

	function __construct($ID = null){
		parent:: __construct();
		if(isset($ID)){
			$this->MessageViewID =$ID;
			if(!$this->data = $this->fetch($ID)){
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
	public function getMessageViewID(){
		return $this->data['MESSAGEVIEWID'];
	}

	public function getMessageID(){
		return $this->data['MESSAGEID'];
	}

	public function getUserID(){
		return $this->data['USERID'];
	}

	public function getNotificationID(){
		return $this->data['NOTIFICATIONID'];
	}

	public function getDateCreated(){
		return $this->data['DATECREATED'];
	}

	//Set Methods

	public function setMessageID($strVal){
		$this->data['MESSAGEID'] = $strVal;
		return true;
	}

	public function setUserID($strVal){
		$this->data['USERID'] = $strVal;
		return true;
	}

	public function setNotificationID($strVal){
		$this->data['NOTIFICATIONID'] = $strVal;
		return true;
	}



}
?>
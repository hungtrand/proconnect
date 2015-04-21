<?php 
	

	require_once __DIR__."/Notification.php";
	require_once __DIR__."/ActiveRecord.php";
	require_once __DIR__."/User.php";

	
/**
*	NotificationView - performs logic for NotificationView class. This class extend ActiveRecord class. This class provides detail information and attribute names of the NOTIFICATIONVIEW tables, and it can temporarily edit info of the NOTIFICATIONVIEW table in database like update a row or insert new row.
*	@params: $UserID
*	Responsibilities: This is Notification Relationship class for NotificationView Table in SQL   
*/	
	class NotificationView extends ActiveRecord{
		public static $PrimaryKey = 'NotificationViewID';
		public static $TableName = 'NotificationView';
		public static $Columns = ['NOTIFICATIONVIEWID', 'NOTIFICATIONID', 'USERID', 'Date'];
		private $data = [];
		private $NotificationViewID;
		private $UserID;
		public $err;
		function __construct($ID = null){
			parent::__construct();
			if(isset($ID)){
			$this->NotificationViewID = $ID;
			if(!$this->$data = $this->fetch($ID)){
				$this->err = "No NotificationRelationship Found!";
				return false;
			};

		}
		//OVERRIDE
		public function getData(){
			return $this->data;
		}
		//OVERRIDE
		public function getID(){
			return $this->UserID;
		}
		//OVERRIDE
		public function getColumns(){
			return self::$Columns;
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
		public function load($ID){ 
			if(!$ID){
				return false;
			}
			if(!$this->data = $this->fetch($ID)){
				$this->err = "Could not fetch this ID!";
				return false;
			}
			$this->NotificationViewID = $ID;
			return true;
		}
		//getMethods
		public function getNotificationViewID(){
			return $this->data['NotificationViewID'];
		}

		public function getNotificationID(){
			return $this->data['NotificationID'];
		}

		public function getDate(){
			return $this->data['Date'];
		}

		public function getUserID(){
			return $this->data['UserID'];
		}

		//setMethods
		public function setNotificationViewID($NotiViewID){
			$this->data['NotificationViewID'] = $NotiViewID;
		}

		public function setNotificationID($NotiID){
			$this->data['NotificationID'] = $NotiID;
		}

		public function setUserID($UsrID){  //@UsrID the UserID.
			$this->data['UserID'] = $UsrID;
		}


	}


	
?>
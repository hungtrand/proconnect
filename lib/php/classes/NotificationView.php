<?php 
	require_once __DIR__."/Notification.php";
	require_once __DIR__."/ActiveRecord.php";
	require_once __DIR__."/User.php";
	
/**
*	NotificationView - represent the relationship between notifications and users.
*	also contains data representing the status between user and the notification as `Read` 
*	@params: $UserID
*	Responsibilities: This is Notification Relationship class for NotificationView Table in SQL   
*/	
	class NotificationView extends ActiveRecord {
		public static $PrimaryKey = 'NOTIFICATIONVIEWID';
		public static $TableName = 'NotificationView';
		public static $Columns = ['NOTIFICATIONVIEWID', 'NOTIFICATIONID', 'USERID', 'READ','TIMESTAMP'];
		private $data = [];
		private $NotificationViewID;
		private $UserID;
		public $err;

		function __construct($ID = null){
			parent::__construct();
			if(isset($ID)){
				$this->NotificationViewID = $ID;

				if(!$this->data = $this->fetch($ID)){
					$this->err = "No Notification Relationship Found!";
					return false;
				}
			}

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
			return $this->data['NOTIFICATIONVIEWID'];
		}

		public function getNotificationID(){
			return $this->data['NOTIFICATIONID'];
		}

		public function getRead(){
			return $this->data['READ'];
		}

		public function getTimestamp(){
			return $this->data['TIMESTAMP'];
		}

		public function getUserID(){
			return $this->data['USERID'];
		}

		public function setNotificationID($NotiID){
			$this->data['NOTIFICATIONID'] = $NotiID;

			return true;
		}

		public function setUserID($UsrID){  //@UsrID the UserID.
			$this->data['USERID'] = $UsrID;

			return true;
		}

		public function setRead($boolVal = false){
			if ($boolVal) $this->data['READ'] = true;
			else $this->data['READ'] = false;

			return true;
		}


	}


	
?>
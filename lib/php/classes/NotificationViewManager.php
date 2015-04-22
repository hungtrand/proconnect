<?php
	
	require_once __DIR__."/Notification.php";
	require_once __DIR__."/NotificationView.php";
	require_once __DIR__."/RecordSet.php";
	
/**
*	NotificationViewManager - performs logic for NotificationViewManager class. 
*	@params: $UserID
*	Responsibilities: load the user and get the user data from the database.  
*/
	class NotificationViewManager extends RecordSet{
		protected $PrimaryKey;
		protected $TableName;
		protected $Columns;
		protected $User;
		protected $data;
		public $err;
		function __construct($User){
			$this->PrimaryKey = NotificationView::$PrimaryKey;
			$this->TableName = NotificationView::$TableName;
			$this->Columns = NotificationView::$Columns;
			$this->User = $User;
			parent::__construct();

			$this->load($User);
		}

		//OVERRIDE
		protected function getColumns(){
			return $this->Columns;
		}

		protected function getPrimaryKey() {
			return $this->PrimaryKey;
		}

		public function load($User){
			$params = ['USERID'=>$User->getID()];
			if(!$this->data = $this->fetchBy($params)) return false;
			
			$this->User = $User;
			return true;
		}

		public function loadPage($page, $numRows, $orderby="`READ` DESC, TIMESTAMP DESC") {
			if (!is_integer($page) || !is_integer($numRows)) {
				$this->err = "Parameters must be integers";
				return false;
			}

			$offset = $page * $numRows - $numRows;

			$cond = "WHERE (USERID = ?) ";
			$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
			$params = ['USERID'=>$this->User->getID()];
			if (!$this->data = $this->fetchCustom($cond, $params)) return false;

			return true;

		}

		public function getData(){
			if(!isset($this->data) || count($this->data) < 1) return false;
			
			return $this->data;
		}
		public function getAll(){
			if(!isset($this->data) || count($this->data) < 1 || !$this->data) return false;
			
			$arr = [];
			foreach($this->getData() as $row){
				$id = $row[$this->PrimaryKey];
				$obj = new NotificationView($id);
				array_push($arr,$obj);
			} 
			return $arr;
		}

		public function getUnreadCount() {
			$count = 0;

			$cond = "WHERE USERID = ? AND `READ` = 0 ";
			$params = ['USERID'=>$this->User->getID()];
			if (!$count = $this->fetchCount($cond, $params)) return false;

			return $count;
		}
	}


?>
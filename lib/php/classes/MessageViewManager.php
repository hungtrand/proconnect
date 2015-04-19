<?php 
 	//require_once "../sqlConnection.php"; // for testing
	//require_once __DIR__."/User.php"; // for testing
 	require_once __DIR__."/MessageView.php";
 	require_once __DIR__."/RecordSet.php";

/**
*	MessageViewManager - performs logic for MessageViewManager class. 
*	@params: $UserID
*	Responsibilities: load the user and get the user data from the database.   
*/	
 	class MessageViewManager extends RecordSet{
 		protected $PrimaryKey;
 		protected $TableName;
 		protected $Columns;

 		protected $User;
 		protected $data;
 		public $err;
 		function __construct($User) {
			$this->PrimaryKey = MessageView::$PrimaryKey;
			$this->TableName = MessageView::$TableName;
			$this->Columns = MessageView::$Columns;
			$this->User = $User;

			parent::__construct();

			$this->load($User);
		}
		//OVERRIDE
		protected function getColumns(){
			return $this->Columns;
		}

		public function load($User){
			$params = ['USERID'=>$User->getID()];
			if(!$this->data = $this->fetchBy($params)) return false;
			
			$this->User = $User;
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
				$obj = new MessageView($id);
				array_push($arr,$obj);
			} 
			return $arr;
		}		

 	}

?>
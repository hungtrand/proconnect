<?php 
 	//require_once "../sqlConnection.php"; // for testing
	//require_once __DIR__."/User.php"; // for testing
 	require_once __DIR__."/MessageView.php";
 	require_once __DIR__."/RecordSet.php";

/**
*	MessageViewManager - get messages in relationship to user. Fetch messsages for inbox, outbox, archived, or trash mailbox types. 
*	@params: $UserID
*	Responsibilities: load messages belonged to a user depending on the status of message requested.   
*/	
 	class MessageViewManager extends RecordSet{
 		protected $PrimaryKey;
 		protected $TableName;
 		protected $Columns;
 		private $Mailbox;

 		protected $User;
 		protected $data;
 		public $err;
 		function __construct($User) {
			$this->PrimaryKey = MessageView::$PrimaryKey;
			$this->TableName = MessageView::$TableName;
			$this->Columns = MessageView::$Columns;
			$this->User = $User;
			$this->Mailbox = 'inbox';

			parent::__construct();

			//$this->load($User);
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

			switch ($this->Mailbox) {
				case 'inbox':
					$mailCond = "DELETED = 0 AND ARCHIVED = 0 AND ISCREATOR = 0 ";
					break;
				case 'outbox':
					$mailCond = "ISCREATOR = 1 AND DELETED = 0 AND ARCHIVED = 0 ";
					break;
				case 'archive':
					$mailCond = "ARCHIVED = 1 AND DELETED = 0 ";
					break;
				case 'trash':
					$mailCond = "DELETED = 1 ";
					break;
				default:
					$this->err = "Cannot load mailbox. Mailbox type is not set. Use setMailbox($mailbox) method.";
					return false;
			}

			$cond = "WHERE (USERID = ?) AND ".$mailCond;
			$cond.= "ORDER BY ".$orderby." LIMIT ". $offset .", ". $numRows;
			$params = ['USERID'=>$this->User->getID()];
			if (!$this->data = $this->fetchCustom($cond, $params)) return false;

			return true;

		}

		public function getData(){
			if(!isset($this->data) || count($this->data) < 1) return false;
			
			return $this->data;
		}

		public function getUnreadCount() {
			$count = 0;


			switch ($this->Mailbox) {
				case 'inbox':
					$mailCond = "DELETED = 0 AND ARCHIVED = 0 AND ISCREATOR = 0 AND `READ` = 0 ";
					break;
				default:
					$this->err = "Cannot load mailbox. Mailbox type is not set. Use setMailbox($mailbox) method.";
					return false;
			}

			$cond = "WHERE (USERID = ?) AND ".$mailCond;
			$params = ['USERID'=>$this->User->getID()];
			if (!$count = $this->fetchCount($cond, $params)) return false;

			return $count;
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

		public function setMailbox($mailbox = '') {

			switch ($mailbox) {
				case 'inbox':
				case 'archive':
				case 'trash':
				case 'outbox':
					$this->Mailbox = $mailbox;
					return true;
				break;
				default:
					$this->err = "Mailbox type not recognize. Use inbox, archive, or trash.";
					return false;
			}
		}		

 	}

?>
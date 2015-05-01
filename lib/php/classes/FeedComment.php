<?php
 // include "../sqlConnection.php"; // For testing
 require_once __DIR__."/ActiveRecord.php";


/**
*	FeedComment - represent a comment a user made on a post. Map to Feed and User table.
*	@params: $ID (CommentID)
*	Responsibilities: contains user's comments and relationship with the user and the feed. 
*/

class FeedComment extends ActiveRecord {
	public static $TableName = 'Feed_Comments';
	public static $PrimaryKey = 'COMMENTID';
	public static $Columns = ['COMMENTID', 'FEEDID', 'USERID', 'COMMENT', 
							'TIMESTAMP'];
	
	private $data = [];
	private $CommentID;
	public $err;

	function __construct($ID = null) {

		parent::__construct();

		if (isset($ID)) {
			$this->CommentID = $ID;
			if (!$this->data = $this->fetch($ID)) {
				$this->err = "Record not found.";
				return false;
			};
		}
	}

	/* Implementing Abstract Methods */
	// OVERRIDE
	public function getData() {
		return $this->data;
	}

	// OVERRIDE
	public function getID() {
		return $this->CommentID;
	}

	// OVERRIDE
	protected function getPrimaryKey() {
		return self::$PrimaryKey;
	}

	// OVERRIDE
	protected function getTableName() {
		return self::$TableName;
	}

	// OVERRIDE
	protected function getColumns() {
		return self::$Columns;
	}

	// OVERRIDE
	public function load($ID) {
		if (!$ID) return false;

		if (!$this->data = $this->fetch($ID)) {
			$this->err = "Could not fetch education from id.";
			return false;
		}

		$this->CommentID = $ID;

		return true;
	}
	/* End of Implementing Abstract Methods */

	// GET METHODS
	public function getFeedID() {
		return $this->data['FEEDID'];
	}

	public function getUserID() {
		return $this->data['USERID'];
	}

	public function getComment() {
		return $this->data['COMMENT'];
	}

	public function getTimestamp() {
		return $this->data['TIMESTAMP'];
	}

	// SET METHODS
	public function setFeedID($intVal) {
		$this->data['FEEDID'] = (int) $intVal;

		return true;
	}

	public function setUserID($intVal) {
		$this->data['USERID'] = (int) $intVal;

		return true;
	}

	public function setComment($strVal) {
		$this->data['COMMENT'] = $strVal;

		return true;
	}
}


/*$fc = new FeedComment();
$fc->setFeedID(86);
$fc->setUserID(7);
$fc->setComment('I like this project. I will try it.');
$fc->save();*/
?>
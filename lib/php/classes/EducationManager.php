<?php
// include "../sqlConnection.php";
require_once __DIR__."/Education.php";
require_once __DIR__."/RecordSet.php";

class EducationManager extends RecordSet {
	private $User;

	function __construct($User) {
		$this->User = $User;
		$PrimaryKey = Education::PrimaryKey;
		$TableName = Education::TableName;
		$Columns = Education::getColumns();
	}

	
}
?>
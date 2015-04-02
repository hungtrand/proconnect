<?php
// include "../sqlConnection.php";
require_once __DIR__."/../interfaces.php";

abstract class ActiveRecordManager implements manager {
	private $User;
	private $db;

	function __construct($TableName, $PrimaryKey) {
		$this->db = connect('ProConnect');
		$this->User = $User;
	}

	public function getOne() {
		$sql = 'SELECT `EduID` FROM `Education` WHERE `UserID` = ? 
				ORDER BY `EduID` DESC LIMIT 1 ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $this->User->getID());

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($rs) {
					$EduID = $rs['EduID'];
				}
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
			

			if (isset($EduID)) {
				$Edu = new Education($EduID);
				return $Edu;
			}
		} else {
			return false;
		}
	}

	public function getAll() {
		$Edus = [];

		$sql = 'SELECT `EduID` FROM `Education` WHERE `UserID` = ? 
				ORDER BY `EduID` DESC ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $this->User->getID());

				$stmt->execute();
				$rs = $stmt->fetchAll();

				for ($i=0;$i<count($rs);$i++) {
					$row = $rs[$i];
					$Edu = new Education($row['EduID']);
					array_push($Edus, $Edu);
				}		
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
			
			return $Edus;
		} else {
			return false;
		}
	}

	public function getTop($num) {
		if (!is_integer($num)) return false;
		
		$Edus = [];
		
		$sql = 'SELECT `EduID` FROM `Education` WHERE `UserID` = ? 
				ORDER BY `EduID` DESC LIMIT ' . $num;

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $this->User->getID());
				//$stmt->bindParam(2, $num);

				$stmt->execute();
				$rs = $stmt->fetchAll();
				
				for ($i=0;$i<count($rs);$i++) {
					$row = $rs[$i];
					$Edu = new Education($row['EduID']);
					array_push($Edus, $Edu);
				}				
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
			
			return $Edus;
		} else {
			return false;
		}
	}
}
?>
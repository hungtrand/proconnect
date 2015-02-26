<?php
// include ../sqlConnection.php
require_once "../interfaces.php"

class EducationManager implements manager {
	private User;
	private $db;

	function __construct($User) {
		$this->db = connect('ProConnect');
		$this->User = $User;

	public function getOne() {
		$sql = 'SELECT `EduID` FROM `Education` WHERE `UserID` = ? 
				ORDER BY `EduID` DESC LIMIT 1 ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $this->User->get('UserID'));

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($rs) {
					$EduID = $rs['EduID'];
				}
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
			

			if (isset($EduID) {
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
				$stmt->bindParam(1, $this->User->get('UserID'));

				$stmt->execute();
				$rs = $stmt->fetchAll();

				
				for ($rs as $row) {
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
		$Edus = [];
		
		$sql = 'SELECT `EduID` FROM `Education` WHERE `UserID` = ? 
				ORDER BY `EduID` DESC LIMIT ? ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $this->User->get('UserID'));
				$stmt->bindParam(2, $num);

				$stmt->execute();
				$rs = $stmt->fetchAll();

				
				for ($rs as $row) {
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
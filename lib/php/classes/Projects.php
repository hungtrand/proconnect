<?php
 include "../sqlConnection.php"; // For testing
 $u = new Projects(1); echo $u->get('TeamMembers').'\n'; // For testing
// $u->update(['Username'=>'Feb2015']); echo $u->get('Username'); // For Testing

/**
*	Project -Load all information of the project, get Projects by the field, update project information 
*/
class Projects {
	private $data;
	private $db;

	function __construct($ProjectID) {
		$this->db = connect('ProConnect');

		$this->load($ProjectID);
	}

	private function load($ProjectID) {
		$sql = 'SELECT `ProjectID`, `ProjectTitle`, `ProjectURL`, `Occupation`,
				`Department`, `Role`, `TeamMembers`, `Description`, `Date`
				FROM `Projects` WHERE `ProjectID` = ? LIMIT 1 ';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $ProjectID);

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				
				foreach ($rs as $col => $value) {
					$this->data[strtoupper($col)] = $value;
				}
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
			

			if (is_array($this->data)) return true;
		} else {
			return false;
		}
	}

	public function get($field) {
		return $this->data[strtoupper($field)];
	}

	public function update($newData) {
		$setStmt = "SET ";
		$delimiter = "";

		foreach($newData as $col => $value) {
			$setStmt .= $delimiter . $col . ' = ? ';
			$delimiter = ", ";
		}

		$sql = "UPDATE `Projects` " . $setStmt . "WHERE `ProjectID` = ? ";

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$i = 1;
				foreach($newData as $col => $value) {
					$stmt->bindParam($i, $value);
					$i++;
				}

				$stmt->bindParam($i, $this->get('ProjectID'));
				$stmt->execute();
				$this->load($this->get('ProjectID'));
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}			

			return true;
		} else {
			return false;
		}
	}
}
?>

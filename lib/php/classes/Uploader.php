<?php 

/**
*	Uploader - create user directory if not already exists, and upload file, modify accessing persmissions for file.
*	Responsibilites: Upload file to database, validate the file before upload
*/
class Uploader {
	private $db;
	private $uploadDir;
	private $file;

	public $err;

	function __construct($upDir) {
		if (isset($upDir)) $this->uploadDir = $upDir;
	}

	public function setUploadDir($upDir) {
		$this->uploadDir = $upDir;
	}

	public function upload($file) {
		$this->err = null;
		$this->file = $file;
		// 1. Check if any image was transferred at all, if not exit
		if (!$this->validate()) return false;

		// 3. Validate: remove any special characters in the file name
		$FileName = preg_replace("/[^A-Z0-9._-]/i", "_", $this->file["name"]);

		// 4. Check if file already exists
		$i = 0;
		$parts = pathinfo($FileName);
		while (file_exists($this->uploadDir . $FileName))
		{
			$i++;
	        $FileName=$parts["filename"] . "-" . $i . "." . $parts["extension"];
		}

		// Upload to the product images folder
	    $success = move_uploaded_file($this->file["tmp_name"],
	        $this->uploadDir . $FileName);

	    if ($success) { 
	    	// set proper permissions on the new file
	    	chmod($this->uploadDir . $FileName, 0755);
	    	return true;
	    } else {
	    	$this->err = 'Unable to save file.';
	    }
	 	
	 	return false;
	}

	private function validate() {
		if (!isset($this->uploadDir)) {
			$this->err = "No directory is set.";
			return false;
		} elseif (!isset($this->file) || empty($this->file)) {
			$this->err = "No file received.";
			return false;
		} elseif ($this->file["error"] !== UPLOAD_ERR_OK) {
			$this->err = "An error occurred during transfer.";
			return false;
		}

		return true;
	}

}
	
?>
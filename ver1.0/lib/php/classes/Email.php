<?php
//require_once __DIR__."/../sqlConnection.php"; // For testing

// We are using PHPMailer library to send out email
// Documentation here: https://github.com/PHPMailer/PHPMailer
require_once __DIR__."/../../PHPMailer/PHPMailerAutoload.php";

// $m = new Email(['EMAILTO'=>'hung.d.tran@sjsu.edu']); 
// $m->loadTemplate(1, ['{{FullName}}'=>'Hung Tran', '{{VerificationLink}}'=>'http://www.google.com']);
// $m->send(); // For Testing

/*
	The Email class will initiate an instance of an empty Email
	Change its properties and call send method to send the email
*/
class Email {
	public $EQID;
	public $EmailSubject;
	public $EmailBody;
	public $EmailTo;
	public $EmailCC;
	public $EmailBCC;
	public $EmailFrom;
	public $EmailReplyTo;
	public $Status;
	public $SentDate;

	public $data;
	private $err;

	function __construct($params = null) {
		$this->db = connect('ProConnect');
		$this->EmailFrom = 'quriousdesigns@gmail.com';
		$this->EmailReplyTo = 'quriousdesigns@gmail.com';

		if (isset($params)) $this->compose($params);
	}

	public function loadTemplate($ID, $Variables = null) {
		$sql = 'SELECT `ETemplateID`, `TemplateName`, `Description`,
				`EmailSubject`, `EmailBody`
				FROM `EmailTemplates` WHERE `ETemplateID` = ? LIMIT 1 ';

		$template = [];
		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $ID);

				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);

				foreach ($rs as $col => $value) {
					$template[strtoupper($col)] = $value;
				}
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
			

			if (is_array($template)) {
				$this->compose($template);

				if (isset($Variables)) $this->replaceVariables($Variables);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	// replace any variable of certain format such as {{FullName}}
	public function replaceVariables($Variables) {
		foreach ($Variables as $evar => $replace) {
			$this->EmailSubject = str_replace($evar, $replace,  $this->EmailSubject);
			$this->EmailBody = str_replace($evar, $replace, $this->EmailBody);
		}
	}

	public function compose($params) {
		foreach ( $params as $col => $value) {
			switch (strtoupper($col)) {
				case 'EMAILSUBJECT':
					$this->EmailSubject = $value;
				break;
				case 'EMAILBODY':
					$this->EmailBody = $value;
				break;
				case 'EMAILTO':
					$this->EmailTo = $value;
				break;
				case 'EMAILCC':
					$this->EmailCC = $value;
				break;
				case 'EMAILBCC':
					$this->EmailBCC = $value;
				break;
				case 'EMAILFROM':
					$this->EmailFrom = $value;
				break;
				case 'EMAILREPLYTO':
					$this->EmailReplyTo = $value;
				break;
			}
		}

		if (!isset($this->EmailTo)) return false;
	}

	public function log() {
		$insertedID = 0;

		$sql = 'INSERT INTO `EmailQueue` (`EmailTo`, `EmailSubject`, `EmailBody`, `EmailCC`, `EmailBCC`, `Status`, `SentDate`, `FailMessage`)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

		if ($stmt = $this->db->prepare($sql)) {

			try {
				$stmt->bindParam(1, $this->EmailTo);
				$stmt->bindParam(2, $this->EmailSubject);
				$stmt->bindParam(3, $this->EmailBody);
				$stmt->bindParam(4, $this->EmailCC);
				$stmt->bindParam(5, $this->EmailBCC);
				$stmt->bindParam(6, $this->Status);
				$stmt->bindParam(7, $this->SentDate);
				$stmt->bindParam(8, $this->err);

				$stmt->execute();
				$insertedID = $this->db->lastInsertId();
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}

		} else {
			return false;
		}
	}

	public function send($params  = null) {
		if (isset($params)) {
			if (!$this->compose($params)) return false;
		}

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'quriousdesigns@gmail.com';                 // SMTP username
		$mail->Password = 'qdproconnect';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->From = $this->EmailFrom;
		$mail->FromName = 'ProConnect';
		//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		$mail->addAddress($this->EmailTo);               // Name is optional
		$mail->addReplyTo($this->EmailReplyTo);
		
		if (isset($this->EmailCC)) {
			$mail->addCC($this->EmailCC);
		}
		
		if (isset($this->EmailBCC)) {
			$mail->addBCC($this->EmailBCC);
		}

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $this->EmailSubject;
		$mail->Body    = $this->EmailBody;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    $this->err .= 'Message could not be sent.';
		    $this->err .= 'Mailer Error: ' . $mail->ErrorInfo;
		    $this->Status = "failed";
		    $this->log();
		    return false;
		} else {
			$this->Status = "sent";
			$this->SentDate = date("Y-m-d H:i:s");
			$this->log();
		    return true;
		}
	}
}
?>
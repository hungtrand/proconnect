<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Message.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";

class Messages_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	// requires an array of MessageView objects
	public function load($MessageViews) {
		
		foreach ($MessageViews as $mv) {
			$message = new Message($mv->getMessageID());
			$sender = new Profile($message->getCreator());

			$out = [
				'messageID'=>$mv->getID(),
				'sender-ID'=>$sender->getID(),
				'sender-picture'=>'/users/'.$sender->getID().'/images/'.$sender->getProfileImage(),
				'sender-name'=>$sender->getName(),
				'sender-href'=>'/profile-public-POV/?UserID='.$sender->getID(),
				'message-subject'=>$message->getSubject(),
				'message-time'=>$message->getDateCreated(),	
				'sender-message'=>$message->getBody()
			];

			$this->FinalView['message'.$mv->getID()] = $out;
		}

		return true;
	}
}
?>
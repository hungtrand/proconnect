<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Message.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";
require_once __DIR__."/../../lib/php/utils.php";

/**
*	Messages_view - the class resopnsible for converting an array of 
*	Messages objects into json friendly format. The response and requests
*/
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

			$timestamp = '';
			if ($message->getDateCreated())
				$timestamp = timetostr($message->getDateCreated());

			$out = [
				'messageID'=>$mv->getID(),
				'sender-ID'=>$sender->getID(),
				'sender-picture'=>'/users/'.$sender->getID().'/images/'.$sender->getProfileImage(),
				'sender-name'=>$sender->getName(),
				'sender-href'=>'/profile-public-POV/?UserID='.$sender->getID(),
				'message-subject'=>$message->getSubject(),
				'message-time'=>$timestamp,	
				'sender-message'=>$message->getBody()
			];

			$this->FinalView['message'.$mv->getID()] = $out;
		}

		return true;
	}
}
?>
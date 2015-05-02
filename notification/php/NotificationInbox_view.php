<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Notification.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";
require_once __DIR__."/../../lib/php/utils.php";

/**
*	NotificationInbox_view - list all relationships between notifications users and their status.
*/
class NotificationInbox_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	// requires an array of MessageView objects
	public function load($NotificationViews) {
		
		foreach ($NotificationViews as $nv) {
			$notif = new Notification($nv->getNotificationID());
			$originator = new Profile($notif->getUserID());

			$timestamp = '';
			if ($notif->getTimestamp())
				$timestamp = timetostr($notif->getTimestamp());

			//convert bit to integer
			if ( (bool)trim($nv->getRead()) ) {
				$read = 1;
			} else {
				$read = 0;
			}
			$out = [
				'NotificationViewID'=>$nv->getID(),
				'picture'=>'/users/'.$originator->getID().'/images/'.$originator->getProfileImage(),
				'message'=>$notif->getMessage(),
				'href'=>'/profile-public-POV/?UserID='.$originator->getID(),
				'timestamp'=>$timestamp,
				'notificationType'=>$notif->getType(),
				'read'=>$read
				// 'read'=>$nv->getRead()
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
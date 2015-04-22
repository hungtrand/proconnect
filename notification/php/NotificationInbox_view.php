<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Notification.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";

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

			$out = [
				'NotificationViewID'=>$nv->getID(),
				'picture'=>'/users/'.$originator->getID().'/images/'.$originator->getProfileImage(),
				'message'=>$notif->getMessage(),
				'href'=>'/profile-public-POV/?UserID='.$originator->getID(),
				'timestamp'=>$notif->getTimestamp(),
				'notificationType'=>$notif->getType()
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
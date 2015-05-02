<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";
require_once __DIR__."/../../lib/php/utils.php";

/**
*	Feed_view - the class create a json format view of one instance of the Feed class
*	The object contains keys matches with Client Tier requests and responses.
*/

class Comment_view implements view {
	private $FinalView;
	public $err;

	function __construct() {
		$this->FinalView = [
			'CommentID'=>'',
			'FeedID'=>'',
			'CreatorID'=>'',
			'CreatorName'=>'',
			'CreatorFirstName'=>'',
			'CreatorImage'=>'',
			'CommentMessage'=>'',
			'Timestamp'=>''
		];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function load($comment) {
		if (!$comment) return false;

		$User = new User();
		$CreatorImage = "/image/user_img.png";
		if ($User->load($comment->getUserID())) {
			if (strlen(trim($User->getProfileImage())) > 0)
				$CreatorImage = "/users/".$User->getID()."/images/".$User->getProfileImage();
		}

		$out = [
			'CommentID'=>$comment->getID(),
			'FeedID'=>$comment->getFeedID(),
			'CreatorID'=>$comment->getUserID(),
			'CreatorName'=>$User->getName(),
			'CreatorFirstName'=>$User->getFirstName(),
			'CreatorImage'=>$CreatorImage,
			'CreatorLink'=>'/profile-public-POV/?UserID='.$User->getID(),
			'CommentMessage'=>$comment->getComment(),
			'Timestamp'=>timetostr($comment->getTimestamp())
		];

		$this->FinalView = $out;
		return true;
	}
}
?>
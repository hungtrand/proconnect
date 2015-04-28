<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/vw_Feed.php";
require_once __DIR__."/../../lib/php/classes/Profile.php";
require_once __DIR__."/../../lib/php/utils.php";

/**
*	Feed_view - the class create a json format view of one instance of the Feed class
*	The object contains keys matches with Client Tier requests and responses.
*/

class Feed_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [
			'FeedID'=>'',
			'UserID'=>'',
			'Creator'=>'',
			'CreatorFirstName'=>'',
			'Status'=>'',
			'DateCreated'=>'',
			'Type'=>'',
			'CreatorImage'=>'',
			'ImageURL'=>'',
			'YouTubeID'=>'',	
			'ContentMessage'=>'',
			'Liked'=>0, 
			'nLiked'=>0
		];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function load($f2u) {
		if (!$f2u) return false;

		$feed = new vw_Feed();
		if (!$feed->load($f2u->getFeedID())) {
			echo "Feed not found";
			return false;
		}

		$User = new User();
		$CreatorImage = "/image/user_img.png";
		if ($User->load($feed->getCreator())) {
			if ($User->getProfileImage())
				$CreatorImage = "/users/".$User->getID()."/images/".$User->getProfileImage();
		}

		$FeedLink='';
		if ($feed->getInternalURL()) {
			$FeedLink=$feed->getInternalURL();
		}

		$TimeAgo = '';
		if ($f2u->getDateCreated()) {
			$TimeAgo = timetostr($f2u->getDateCreated());
		}

		$Liked = 0;
		if ($f2u->getLiked()) $Liked = 1;

		$out = [
			'FeedID'=>$f2u->getID(),
			'Creator'=>$User->getName(),
			'CreatorFirstName'=>$User->getFirstName(),
			'Timestamp'=>$TimeAgo,
			'Type'=>$feed->getType(),
			'CreatorImage'=>$CreatorImage,
			'ImageURL'=>$feed->getImageURL(),
			'FeedLink'=>$FeedLink,	
			'YouTubeID'=>$feed->getExternalURL(),
			'ContentMessage'=>$feed->getContent(),
			'Liked'=> $Liked,
			'nLiked'=> $feed->getNLiked()
		];

		$this->FinalView = $out;
		return true;
	}
}
?>
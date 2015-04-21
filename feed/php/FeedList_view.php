<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Feed.php";
require_once __DIR__."/../../lib/php/classes/Feed2User.php";
require_once __DIR__."/../../lib/php/classes/User.php";

class FeedList_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function load($feeds2User) {
		if (!is_array($feeds2User) || count($feeds2User) < 1) return false;


		foreach ($feeds2User as $f2u) {
			$feed = new Feed($f2u->getFeedID());
			$User = new User();
			$CreatorImage = "/image/user_img.png";
			if ($User->load($feed->getCreator())) {
				if ($User->getProfileImage())
					$CreatorImage = "/users/".$User->getID()."/images/".$User->getProfileImage();
			}

			if ($feed->getInternalURL())
				$FeedLink=$feed->getInternalURL();
			else {
				$FeedLink=$feed->getExternalURL();
				if (strpos($FeedLink, "http") != 0) {
					$FeedLink = "http://".$FeedLink;
				}
			}


			$out = [
				'FeedID'=>$f2u->getFeedID(),
				'Creator'=>$User->getName(),
				'DateCreated'=>$f2u->getDateCreated(),
				'Type'=>$feed->getType(),
				'CreatorImage'=>$CreatorImage,
				'ImageURL'=>$feed->getImageURL(),
				'FeedLink'=>$FeedLink,	
				'ContentMessage'=>$feed->getContent()
			];

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
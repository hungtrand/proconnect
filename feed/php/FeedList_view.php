<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/Feed.php";
require_once __DIR__."/../../lib/php/classes/Feed2User.php";
require_once __DIR__."/../../lib/php/classes/User.php";
require_once __DIR__."/Feed_view.php";

/**
*	FeedList_view - the class convert an array of feeds or posts saved in the database
*	under Feed objects. The output data is in json format where the client side can
*	display and manipulate easier.
*/

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
			$f2uView = new Feed_view();
			$f2uView->load($f2u);
			$out = $f2uView->getView();

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
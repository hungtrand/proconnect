<?php
require_once __DIR__."/../../lib/php/interfaces.php";
require_once __DIR__."/../../lib/php/classes/FeedComment.php";
require_once __DIR__."/Comment_view.php";

/**
*	Comment_view - the class convert an array of comments to Comment Objects
*	The output data is in json format where the client side can
*	display and manipulate easier.
*/

class CommentList_view implements view {
	private $FinalView;

	function __construct() {
		$this->FinalView = [];
	}

	public function getView() {
		return $this->FinalView;
	}

	public function load($Comments) {
		if (!is_array($Comments) || count($Comments) < 1) return false;


		foreach ($Comments as $c) {
			$commentView = new Comment_view();
			$commentView->load($c);
			$out = $commentView->getView();

			array_push($this->FinalView, $out);
		}

		return true;
	}
}
?>
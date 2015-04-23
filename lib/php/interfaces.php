<?php
interface manager {
	public function getOne();
	public function getAll();
	public function getTop($num);
}

interface view {
	public function getView();
}
?>
<?php
interface manager {
	public function getOne();
	public function getAll();
	public function getTop($num);
}

interface ActiveRecord {
	public function get($field);
	public function set($field, $value);
	public function getData();
	public function setData($newData);
	public function save();
	public function update();
	public function delete();
}
?>
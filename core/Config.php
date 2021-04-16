<?php

class Config {

	private $hostname = "localhost";
	private $database = "villiers";
	private $username = "root";
	private $password = "";
	private static $_instance = null;

	public static function getInstance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new Config();
		}
		return self::$_instance;
	}

	public function get($key) {
		if (isset($this->$key)) {
			return $this->$key;
		}
	}

}

?>

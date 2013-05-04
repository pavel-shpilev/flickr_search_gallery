<?php

/**
* Config wrapper class. Parses config.ini.
*/
final class Config {
	
	private $data = array();
	
	function __construct() {
		$settings = parse_ini_file('settings.ini');
		foreach ($settings as $param => $value) {
			$this->data[$param] = $value;
		}
	}
	
	function getParam($param) {
		return $this->data[$param];
	}

}

?>
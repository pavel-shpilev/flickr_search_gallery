<?php

/**
 * Handles API requests.
 */
class ApiRequest {
	
	private $encoded_params = array();
	
	function __construct($extra_params) {
		global $config;

		$params = array(
			'api_key'	=> $config->getParam('api_key'),
			'format'	=> 'php_serial'
		);
		foreach ($extra_params as $k => $v) {
			$params[$k] = $v;
		}
		
		$encoded_params = array();
		foreach ($params as $k => $v) {
			$this->encoded_params[] = urlencode($k).'='.urlencode($v);
		}
	}

	function getResponse() {
		$url = "http://api.flickr.com/services/rest/?".implode('&', $this->encoded_params);
		$rsp = file_get_contents($url);
		return unserialize($rsp);
	}
	
}

?>
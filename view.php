<?php

abstract class AbstractView {
	
	function redirect($url) {
		header('Location: ' . $url);
	}
	
}

?>
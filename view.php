<?php

abstract class AbstractView {
	
	function redirect($url) {
		header('Location: ' . $url);
	}
	
	function render_to_response($templatename, $args=array()) {
		$template = new Template('templates' . DIRECTORY_SEPARATOR . $templatename, $args);
		return $template->render();
	}
	
}

?>
<?php

/**
 * Page 404 view.
 */
class View extends AbstractView {
	
	function index() {
		return self::render_to_response('404.phtml');
	}

}

?>
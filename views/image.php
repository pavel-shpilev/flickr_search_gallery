<?php

/**
 * Single image view.
 */
class View extends AbstractView {
	
	function index() {
		// Return 404 if no arguments passed.
		if (!isset($_GET['photo_id']) || !isset($_GET['secret'])) {
			return self::render_to_response('404.phtml');
		}
		
		else {
			$search_request_params = array(
				'method'	=> 'flickr.photos.getInfo',
				'photo_id'	=> $_GET['photo_id'],
				'secret'	=> $_GET['secret']
			);
			
			// Sending request.
			$search_request = new ApiRequest($search_request_params);
			$response = $search_request->getResponse();
			
			// Rendering output.
			if ($response['stat'] == 'ok') {
				return self::render_to_response('image.phtml', array(
						'photo' => $response['photo']
				));
			} else {
			// Display error.
				return self::render_to_response('image.phtml', array(
						'error_msg' => $response['message']
				));
			}
		}
	}

}

?>
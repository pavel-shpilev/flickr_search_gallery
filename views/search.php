<?php

class View extends AbstractView {
	
	function index() {
		// No arguments passed. Return empty search form.
		if (empty($_POST) && empty($_GET)) {
			return self::render_to_response('search.php');
		}
		
		// New search query passed.
		if (isset($_POST['search_query']) && $_POST['search_query'] != '') {
			$search_request_params = array(
				'method'	=> 'flickr.photos.search',
				'per_page'	=> 5,
				'page'		=> 1,
				'text'		=> $_POST['search_query']
			);
		}
		
		// Navigating over previous search results.
		elseif (isset($_GET['search_query']) && $_GET['search_query'] != '') {
			$page_num = 1;
			if (isset($_GET['page_num'])) $page_num = (int)$_GET['page_num'];
			$search_request_params = array(
				'method'	=> 'flickr.photos.search',
				'per_page'	=> 5,
				'page'		=> $page_num,
				'text'		=> $_GET['search_query']
			);
		}
		
		// Sending request.
		$search_request = new ApiRequest($search_request_params);
		$response = $search_request->getResponse();
		
		// Rendering output.
		if ($response['stat'] == 'ok') {
			return self::render_to_response('search.php', array(
				'photos' => $response['photos']['photo'],
				'page' => $response['photos']['page'],
				'pages' => $response['photos']['pages'],
				'total' => $response['photos']['total'],
			));
		} else {
			return self::render_to_response('search.php', array(
				'error_msg' => 'Error sending API request.'
			));
		}
	}

}

?>
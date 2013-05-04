<?php

/**
 * Search page view.
 */
class View extends AbstractView {
	
	function index() {
		// No arguments passed. Return empty search form.
		if ((!isset($_POST['search_query']) || $_POST['search_query'] === '') &&
		(!isset($_GET['search_query']) || $_GET['search_query'] === '')) {
			return self::render_to_response('search.phtml');
		}
		
		// New search query.
		elseif (isset($_POST['search_query']) && $_POST['search_query'] != '') {
			$searched_text = $_POST['search_query'];
			$search_request_params = array(
				'method'	=> 'flickr.photos.search',
				'per_page'	=> 5,
				'page'		=> 1,
				'text'		=> $_POST['search_query']
			);
		}
		
		// Navigating over previous search results.
		elseif (isset($_GET['search_query']) && $_GET['search_query'] != '') {
			$searched_text = $_GET['search_query'];
			$page_num = 1;
			if (isset($_GET['page'])) $page_num = (int)$_GET['page'];
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
			return self::render_to_response('search.phtml', array(
				'photos' => $response['photos']['photo'],
				'page' => $response['photos']['page'],
				'pages' => $response['photos']['pages'],
				'total' => $response['photos']['total'],
				'searched_text' => isset($searched_text) ? $searched_text : ''
			));
		// Displaying error.
		} else {
			return self::render_to_response('search.phtml', array(
				'error_msg' => $response['message']
			));
		}
	}

}

?>
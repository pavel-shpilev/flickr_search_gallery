<?php

require_once 'config.php';
require_once 'api.php';

$config = new Config();

$search_request_params = array(
	'method'	=> 'flickr.photos.search',
	'per_page'	=> $config->getParam('photos_per_page'),
	'page'		=> 1,
	'text'		=> 'cat'
);
$search_request = new ApiRequest($search_request_params);
$response = $search_request->getResponse();

if ($response['stat'] == 'ok') {
	$photo_title = $response['photo']['title']['_content'];
	echo "Title is $photo_title!";
} else{
	echo "Call failed!";
}

?>

<?php

require_once 'config.php';
require_once 'api.php';
require_once 'template.php';
require_once 'view.php';

$config = new Config();

// Get request url and script url.
$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
$script_url = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
$script_url = explode('/', $script_url);
$script_url = $script_url[1];
$url = $request_url;
// Get the url path and trim the / of the left and the right.
if ($request_url != $script_url && $request_url != '/') {
	$url = substr(str_replace('/'.$script_url, '', $request_url), 1);
}
// Split the url into segments.
$arguments_str = substr($url, strpos($url, '?'));
$segments = explode('/', str_replace($arguments_str, '', $url));

// Getting view and action.
if (isset($segments[0]) && $segments[0] != '') {
	$view = $segments[0];
} else {
	// Default view.
	$view = 'search';
}
if (isset($segments[1]) && $segments[1] != '') {
	$action = $segments[1];
} else {
	// Default action on the view.
	$action = 'index';
}
$view_path = 'views' . DIRECTORY_SEPARATOR . $view . '.php';
if (file_exists($view_path)) {
	require_once($view_path);
} else {
	// Handling 404.
	require_once('views' . DIRECTORY_SEPARATOR . '404.php');
	$action = 'index';
}

// Call the requested action.
echo call_user_func(array('View', $action));

?>

<?php
/**
 * Front controller for default Minify implementation
 * 
 * DO NOT EDIT! Configure this utility via config.php and groupsConfig.php
 * 
 * @package Minify
 */
 
if (isset($_GET['f'])) {

	//set dirs:
	define('MINIFY_MIN_DIR', dirname(__FILE__));
	$_SERVER['DOCUMENT_ROOT'] = substr(__FILE__, 0, -27); //path to public_html folder.
	$min_libPath = MINIFY_MIN_DIR . '/lib'; //path to Minify's lib folder

	// load Opencart config
	require $_SERVER['DOCUMENT_ROOT'] . '/config.php';
	
	// load Cache & Opencart config;
	require MINIFY_MIN_DIR . '/cache.php';

	global $get_url; //avoid url encoding:
	if(URL_COMPRESSION != 'enabled') $get_url= $_GET['f'];
	else { //try url encoding:
		$get_url = base64_decode(str_replace(' ','+',$_GET['f']),true); //decode
		if ($get_url != false)
		{
			if (function_exists('gzdecode')) {
				$get_url = gzdecode($get_url); //uncompress
			} else {
				$get_url = gzinflate($get_url); //uncompress
			}
			$get_url = substr($get_url,0,strpos($get_url, '&')); //remove &
		} else $get_url= $_GET['f'];
		//DEBUG:
		//if (preg_match('/^[^,]+\\.(css|js)(?:,[^,]+\\.\\1)*$/', $get_url, $m)) echo serialize($m); exit();
		//echo $get_url;exit();//*/
	}
	// load Minify config
	require MINIFY_MIN_DIR . '/config.php';

	// setup include path
	set_include_path($min_libPath . PATH_SEPARATOR . get_include_path());

	require 'Minify.php';

	$min_serveOptions['minifierOptions']['text/css']['symlinks'] = $min_symlinks;
    // serve!   
    Minify::serve('MinApp', $min_serveOptions);
} else {
    header("Location: /");
    exit();
}

<?php
//v.1.02
if(!isset($_SESSION)) session_start();

//require_once(DIR_SYSTEM . 'library/cache_file.php'); /* 
if (extension_loaded('apc')) require_once(DIR_SYSTEM . 'library/cache_apc.php');
elseif (extension_loaded('Memcache')) require_once(DIR_SYSTEM . 'library/cache_memcache.php');
else require_once(DIR_SYSTEM . 'library/cache_file.php');
//*/

global $cache;
global $routeId;
$cache = new Cache();
//debug:
	//$cache->flush();
	//$_SESSION['encoding'] = 'none';

//get browser encoding
function getEncoding()
{
	if (! isset($_SERVER['HTTP_ACCEPT_ENCODING'])) return 'none';
	$acepted_encoding = $_SERVER['HTTP_ACCEPT_ENCODING'];
	
	// fast gzip
	if (function_exists('gzencode') && strpos($acepted_encoding, 'gzip') !== false) return 'gzip';

	//fast deflate
	if (function_exists('gzdeflate') && strpos($acepted_encoding, 'deflate') !== false) return 'deflate';
		
	return 'none';
}
//set browser encoding
if(!isset($_SESSION['encoding'])) $_SESSION['encoding'] = getEncoding();

//set device
if(!isset($_SESSION['device'])) //$_SESSION['device'] = 'desktop';/*
{
	$_SESSION['device'] = 'desktop';
	if(isset($_SERVER['HTTP_USER_AGENT'])) {
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(?i)msie [1-8]/',$user_agent)) {
			if (preg_match('/(?i)msie 8/',$user_agent)) $_SESSION['device'] = 'ie8';
			else $_SESSION['device'] = 'ie7';
		}
	}
}//*/
//set routeId
$routeId= 'minify.' . md5($_GET['f']) . '.' . $_SESSION['device'];

if ($headers = $cache->get($routeId . '.headers.' . $_SESSION['encoding'])) {
	//echo "/* #SUCCESS: Minification cached! " . $routeId . "." . $_SESSION["encoding"] . " *\\ \r\n\r\n"; exit();
	foreach ($headers as $name => $val) {
		header($name . ': ' . $val);
	}
	echo $cache->get($routeId . '.' . $_SESSION['encoding']);
	flush(); // @ob_flush();  // to make sure that all output is sent in real-time
	exit();
}
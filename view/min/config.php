<?php
/**
 * Configuration for "min", the default application built with the Minify
 * library
 * 
 * @package Minify
 */

/**
 * Combining multiple CSS files can place @import declarations after rules, which
 * is invalid. Minify will attempt to detect when this happens and place a
 * warning comment at the top of the CSS output. To resolve this you can either 
 * move the @imports within your CSS files, or enable this option, which will 
 * move all @imports to the top of the output. Note that moving @imports could 
 * affect CSS values (which is why this option is disabled by default).
 */
$min_serveOptions['bubbleCssImports'] = false;

/**
 * To use Google's Closure Compiler API (falling back to JSMin on failure),
 * uncomment the following lines:
 */
if(JS_PROFILE=='experimental') {
	function closureCompiler($js) {
		require_once 'Minify/JS/ClosureCompiler.php';
		return Minify_JS_ClosureCompiler::minify($js);
	}
	$min_serveOptions['minifiers']['application/x-javascript'] = 'closureCompiler';
}
//*/

/**
 * By default, Minify will not minify files with names containing .min or -min
 * before the extension. E.g. myFile.min.js will not be processed by JSMin
 * 
 * To minify all files, set this option to null. You could also specify your
 * own pattern that is matched against the filename.
 */
//$min_serveOptions['minApp']['noMinPattern'] = '@[-\\.]min\\.(?:js|css)$@i';
$min_serveOptions['minApp']['noMinPattern'] = NULL;

/**
 * If you minify CSS files stored in symlink-ed directories, the URI rewriting
 * algorithm can fail. To prevent this, provide an array of link paths to
 * target paths, where the link paths are within the document root.
 * 
 * Because paths need to be normalized for this to work, use "//" to substitute 
 * the doc root in the link paths (the array keys). E.g.:
 * <code>
 * array('//symlink' => '/real/target/path') // unix
 * array('//static' => 'D:\\staticStorage')  // Windows
 * </code>
 */
$min_symlinks = array();

/**
 * If you'd like to restrict the "f" option to files within/below
 * particular directories below DOCUMENT_ROOT, set this here.
 * You will still need to include the directory in the
 * f or b GET parameters.
 * 
 * // = shortcut for DOCUMENT_ROOT 
 */
//$min_serveOptions['minApp']['allowDirs'] = array('//js', '//css');

// try to disable output_compression (may not have an effect)
ini_set('zlib.output_compression', '0');
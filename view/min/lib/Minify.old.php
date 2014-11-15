<?php
/**
 * Class Minify  
 * @package Minify
 */

/**
 * Minify_Source
 */
require_once 'Minify/Source.php';
 
/**
 * Minify - Combines, minifies, and caches JavaScript and CSS files on demand.
 *
 * See README for usage instructions (for now).
 *
 * This library was inspired by {@link mailto:flashkot@mail.ru jscsscomp by Maxim Martynyuk}
 * and by the article {@link http://www.hunlock.com/blogs/Supercharged_Javascript "Supercharged JavaScript" by Patrick Hunlock}.
 *
 * Requires PHP 5.1.0.
 * Tested on PHP 5.1.6.
 *
 * @package Minify
 * @author Ryan Grove <ryan@wonko.com>
 * @author Stephen Clay <steve@mrclay.org>
 * @copyright 2008 Ryan Grove, Stephen Clay. All rights reserved.
 * @license http://opensource.org/licenses/bsd-license.php  New BSD License
 * @link http://code.google.com/p/minify/
 */
class Minify {
    
	
    const VERSION = '2.1.3';
    const TYPE_CSS = 'text/css';
    const TYPE_HTML = 'text/html';
    // there is some debate over the ideal JS Content-Type, but this is the
    // Apache default and what Yahoo! uses..
    const TYPE_JS = 'application/x-javascript';

    public static function serve($controller, $options = array())
    {
		if (is_string($controller)) {
            // make $controller into object
            $class = 'Minify_Controller_' . $controller;
            if (! class_exists($class, false)) {
                require_once "Minify/Controller/" 
                    . str_replace('_', '/', $controller) . ".php";    
            }
            $controller = new $class();
        }
        
        // set up controller sources and mix remaining options with
        // controller defaults
        $options = $controller->setupSources($options);
        $options = $controller->analyzeSources($options);
        self::$_options = $controller->mixInDefaultOptions($options);
        
        self::$_controller = $controller;
		
        if (self::$_options['contentType'] === self::TYPE_CSS
            && self::$_options['rewriteCssUris']) {
            foreach($controller->sources as $key => $source) {
                if ($source->filepath 
                    && !isset($source->minifyOptions['currentDir'])
                    && !isset($source->minifyOptions['prependRelativePath'])
                ) {
                    $source->minifyOptions['currentDir'] = dirname($source->filepath);
                }
            }
        }
		// using cache
		global $cache;
		$encoding_level=9;		
		global $routeId;
		// generate & cache content
		try {
				if ($_SESSION['encoding'] == 'none' || !extension_loaded('zlib')) {
					$_SESSION['encoding'] = 'none';
					$content = self::_combineMinify();
				} else {		
					$headers['Content-Encoding'] = $_SESSION['encoding'];
					if ($_SESSION['encoding'] == 'deflate') $content = gzdeflate(self::_combineMinify(), $encoding_level);
					else $content = gzencode(self::_combineMinify(), $encoding_level);
				}	
				$contentLength = (function_exists('mb_strlen') && ((int)ini_get('mbstring.func_overload') & 2))
						? mb_strlen($content, '8bit')
						: strlen($content);
				// add headers
				$headers['Content-Length'] = $contentLength;
				$headers['Content-Type'] = self::$_options['contentTypeCharset']
					? self::$_options['contentType'] . '; charset=' . self::$_options['contentTypeCharset']
					: self::$_options['contentType'];
				if (self::$_options['encodeOutput']) $headers['Vary'] = 'Accept-Encoding';
				//$headers['Connection'] = 'Keep-Alive';
				//$headers['Keep-Alive'] = 'timeout=15, max=100';
				
				// DEBUG:
				//foreach ($headers as $name => $val) {echo "<br>header: " . $name . ": " . $val;} exit();
				
				// output headers & content
				foreach ($headers as $name => $val) {
					header($name . ': ' . $val);
				}
				echo $content;
				//cache it!
				$cache->set($routeId . '.' . $_SESSION['encoding'],$content);	
				$cache->set($routeId . '.headers.' . $_SESSION['encoding'],$headers);
				flush();
				exit();
				
		} catch (Exception $e) {
			self::$_controller->log($e->getMessage());
			//self::_errorExit(self::$_options['errorHeader'], self::URL_DEBUG);
			throw $e;
		}
 
    }
    
    /**
     * Return combined minified content for a set of sources
     *
     * No internal caching will be used and the content will not be HTTP encoded.
     * 
     * @param array $sources array of filepaths and/or Minify_Source objects
     * 
     * @param array $options (optional) array of options for serve. By default
     * these are already set: quiet = true, encodeMethod = '', lastModifiedTime = 0.
     * 
     * @return string
     */
    public static function combine($sources, $options = array())
    {
        $cache = self::$_cache;
        self::$_cache = null;
        $options = array_merge(array(
            'files' => (array)$sources
            ,'quiet' => true
            ,'encodeMethod' => ''
            //,'lastModifiedTime' => 0
        ), $options);
        $out = self::serve('Files', $options);
        self::$_cache = $cache;
        return $out['content'];
    }
    
    /**
     * On IIS, create $_SERVER['DOCUMENT_ROOT']
     * 
     * @param bool $unsetPathInfo (default false) if true, $_SERVER['PATH_INFO']
     * will be unset (it is inconsistent with Apache's setting)
     * 
     * @return null
     */
    public static function setDocRoot($unsetPathInfo = false)
    {
        if (isset($_SERVER['SERVER_SOFTWARE'])
            && 0 === strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS/')
        ) {
            $_SERVER['DOCUMENT_ROOT'] = rtrim(substr(
                $_SERVER['PATH_TRANSLATED']
                ,0
                ,strlen($_SERVER['PATH_TRANSLATED']) - strlen($_SERVER['SCRIPT_NAME'])
            ), '\\');
            if ($unsetPathInfo) {
                unset($_SERVER['PATH_INFO']);
            }
        }
    }
    
    /**
     * @var Minify_Controller active controller for current request
     */
    protected static $_controller = null;
    
    /**
     * @var array options for current request
     */
    protected static $_options = null;
    
    /**
     * Combines sources and minifies the result.
     *
     * @return string
     */
    protected static function _combineMinify()
    {
        $type = self::$_options['contentType']; // ease readability
        
        // when combining scripts, make sure all statements separated and
        // trailing single line comment is terminated
        $implodeSeparator = ($type === self::TYPE_JS)
            ? "\n;"
            : '';
        // allow the user to pass a particular array of options to each
        // minifier (designated by type). source objects may still override
        // these
        $defaultOptions = isset(self::$_options['minifierOptions'][$type])
            ? self::$_options['minifierOptions'][$type]
            : array();
        // if minifier not set, default is no minification. source objects
        // may still override this
        $defaultMinifier = isset(self::$_options['minifiers'][$type])
            ? self::$_options['minifiers'][$type]
            : false;
       
        if (Minify_Source::haveNoMinifyPrefs(self::$_controller->sources)) {
            // all source have same options/minifier, better performance
            // to combine, then minify once
            foreach (self::$_controller->sources as $source) {
                $pieces[] = $source->getContent();
            }
            $content = implode($implodeSeparator, $pieces);
            if ($defaultMinifier) {
                self::$_controller->loadMinifier($defaultMinifier);
                $content = call_user_func($defaultMinifier, $content, $defaultOptions);    
            }
        } else {
            // minify each source with its own options and minifier, then combine
            foreach (self::$_controller->sources as $source) {
                // allow the source to override our minifier and options
                $minifier = (null !== $source->minifier)
                    ? $source->minifier
                    : $defaultMinifier;
                $options = (null !== $source->minifyOptions)
                    ? array_merge($defaultOptions, $source->minifyOptions)
                    : $defaultOptions;
                if ($minifier) {
                    self::$_controller->loadMinifier($minifier);
                    // get source content and minify it
                    $pieces[] = call_user_func($minifier, $source->getContent(), $options);     
                } else {
                    $pieces[] = $source->getContent();     
                }
            }
            $content = implode($implodeSeparator, $pieces);
        }
        
        if ($type === self::TYPE_CSS && false !== strpos($content, '@import')) {
            $content = self::_handleCssImports($content);
        }
        
        // do any post-processing (esp. for editing build URIs)
        if (self::$_options['postprocessorRequire']) {
            require_once self::$_options['postprocessorRequire'];
        }
        if (self::$_options['postprocessor']) {
            $content = call_user_func(self::$_options['postprocessor'], $content, $type);
        }
        return $content;
    }
  
    /**
     * Bubble CSS @imports to the top or prepend a warning if an
     * @import is detected not at the top.
     */
    protected static function _handleCssImports($css)
    {
		/* with bubbleCssImports:
		// bubble CSS imports
		preg_match_all('/@import.*?;/', $css, $imports);
		$css = implode('', $imports[0]) . preg_replace('/@import.*?;/', '', $css);
		*/
		//without bubbleCssImports:
		$noCommentCss = preg_replace('@/\\*[\\s\\S]*?\\*/@', '', $css); // remove comments so we don't mistake { in a comment as a block
		$lastImportPos = strrpos($noCommentCss, '@import');
		$firstBlockPos = strpos($noCommentCss, '{');
		if (false !== $lastImportPos && false !== $firstBlockPos && $firstBlockPos < $lastImportPos) {		
			// '{' appears before @import : prepend warning
			$css = "/* [WARNING] IMPORTED CSS: See http://code.google.com/p/minify/wiki/CommonProblems#@imports_can_appear_in_invalid_locations_in_combined_CSS_files*/ \n\n" . $css;
		}	
        return $css;
    }
}

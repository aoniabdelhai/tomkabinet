<?php
/**
 * Class Minify_CSS_UriRewriter  
 * @package Minify
 */

/**
 * Rewrite file-relative URIs as root-relative in CSS files
 *
 * @package Minify
 * @author Stephen Clay <steve@mrclay.org>
 */
class Minify_CSS_UriRewriter {
    
    /**
     * Defines which class to call as part of callbacks, change this
     * if you extend Minify_CSS_UriRewriter
     * @var string
     */
    protected static $className = 'Minify_CSS_UriRewriter';
    
    /**
     * rewrite() and rewriteRelative() append debugging information here
     * @var string
     */
    public static $debugText = '';
    
    /**
     * Rewrite file relative URIs as root relative in CSS files
     * 
     * @param string $css
     * 
     * @param string $currentDir The directory of the current CSS file.
     * 
     * @param string $docRoot The document root of the web site in which 
     * the CSS file resides (default = $_SERVER['DOCUMENT_ROOT']).
     * 
     * @param array $symlinks (default = array()) If the CSS file is stored in 
     * a symlink-ed directory, provide an array of link paths to
     * target paths, where the link paths are within the document root. Because 
     * paths need to be normalized for this to work, use "//" to substitute 
     * the doc root in the link paths (the array keys). E.g.:
     * <code>
     * array('//symlink' => '/real/target/path') // unix
     * array('//static' => 'D:\\staticStorage')  // Windows
     * </code>
     * 
     * @return string
     */
	public static function data_uri($path = '',$uri) {
		if ($_SESSION['device'] != 'ie7') { //chech if browser support DATA URI and file exist
			try {
				//$path = is_file($uri) ? $uri : $path . $uri;
				$path = is_file($_SERVER['DOCUMENT_ROOT'] . $uri) ? ($_SERVER['DOCUMENT_ROOT'] . $uri) : $path . $uri;
				$path = is_file($path)? $path : strtr($path, '/', DIRECTORY_SEPARATOR);
				if (!is_file($path)) return $uri;
				//green light, go ahead!
				//Get the max image size supported by this browser
				$max_size= 16384;
				//$max_size= ($_SESSION['device'] != 'desktop')? 32768 : 1048576; //limit to 32kb (IE8 max) or 1MB (memcache max).
				$size = filesize($path); // strlen(unserialize(file_get_contents($path)))
				
				if (isset($size) && $size < $max_size){
					$info = pathinfo($path);
					$extension = strtolower($info['extension']);
					if($extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "ico") {
						$uri = 'data:image/' . $extension . ';base64,' . base64_encode(file_get_contents($path));
					}
				}
			} catch (Exception $e) {
			//self::data_uri('',$uri);
			}
		}
		return $uri;
	}
    public static function rewrite($css, $currentDir, $docRoot = null, $symlinks = array()) 
    {
        self::$_docRoot = self::_realpath(
            $docRoot ? $docRoot : $_SERVER['DOCUMENT_ROOT']
        );
        self::$_currentDir = self::_realpath($currentDir);
        self::$_symlinks = array();
        
        // normalize symlinks
        foreach ($symlinks as $link => $target) {
            $link = ($link === '//')
                ? self::$_docRoot
                : str_replace('//', self::$_docRoot . '/', $link);
            $link = strtr($link, '/', DIRECTORY_SEPARATOR);
            self::$_symlinks[$link] = self::_realpath($target);
        }
        
        self::$debugText .= "docRoot    : " . self::$_docRoot . "\n"
                          . "currentDir : " . self::$_currentDir . "\n";
        if (self::$_symlinks) {
            self::$debugText .= "symlinks : " . var_export(self::$_symlinks, 1) . "\n";
        }
        self::$debugText .= "\n";
        
        $css = self::_trimUrls($css);
        
        // rewrite
        $css = preg_replace_callback('/@import\\s+([\'"])(.*?)[\'"]/'
            ,array(self::$className, '_processUriCB'), $css);
        $css = preg_replace_callback('/url\\(\\s*([^\\)\\s]+)\\s*\\)/'
            ,array(self::$className, '_processUriCB'), $css);

        return $css;
    }
    
    /**
     * Prepend a path to relative URIs in CSS files
     * 
     * @param string $css
     * 
     * @param string $path The path to prepend.
     * 
     * @return string
     */
    public static function prepend($css, $path)
    {
        self::$_prependPath = $path;
        
        $css = self::_trimUrls($css);
        
        // append
        $css = preg_replace_callback('/@import\\s+([\'"])(.*?)[\'"]/'
            ,array(self::$className, '_processUriCB'), $css);
        $css = preg_replace_callback('/url\\(\\s*([^\\)\\s]+)\\s*\\)/'
            ,array(self::$className, '_processUriCB'), $css);

        self::$_prependPath = null;
        return $css;
    }
    
    
    /**
     * @var string directory of this stylesheet
     */
    private static $_currentDir = '';
    
    /**
     * @var string DOC_ROOT
     */
    private static $_docRoot = '';
    
    /**
     * @var array directory replacements to map symlink targets back to their
     * source (within the document root) E.g. '/var/www/symlink' => '/var/realpath'
     */
    private static $_symlinks = array();
    
    /**
     * @var string path to prepend
     */
    private static $_prependPath = null;
    
    private static function _trimUrls($css)
    {
        return preg_replace('/
            url\\(      # url(
            \\s*
            ([^\\)]+?)  # 1 = URI (assuming does not contain ")")
            \\s*
            \\)         # )
        /x', 'url($1)', $css);
    }
    
    private static function _processUriCB($m)
    {
        // $m matched either '/@import\\s+([\'"])(.*?)[\'"]/' or '/url\\(\\s*([^\\)\\s]+)\\s*\\)/'
        $isImport = ($m[0][0] === '@');
        // determine URI and the quote character (if any)
        if ($isImport) {
            $quoteChar = $m[1];
            $uri = $m[2];
        } else {
            // $m[1] is either quoted or not
            $quoteChar = ($m[1][0] === "'" || $m[1][0] === '"')
                ? $m[1][0]
                : '';
            $uri = ($quoteChar === '')
                ? $m[1]
                : substr($m[1], 1, strlen($m[1]) - 2);
        }
        // analyze URI
        if ('/' !== $uri[0]                  // root-relative
            && false === strpos($uri, '//')  // protocol (non-data)
            && 0 !== strpos($uri, 'data:')   // data protocol
        ) {
            // URI is file-relative: rewrite depending on options
            $uri = (self::$_prependPath !== null)
                ? (self::$_prependPath . $uri)
                : self::rewriteRelative($uri, self::$_currentDir, self::$_docRoot, self::$_symlinks);
        }
		
		$uri = self::data_uri(self::$_docRoot,$uri);
		return "url({$quoteChar}{$uri}{$quoteChar})";
        /* return $isImport
            ? "@import {$quoteChar}{$uri}{$quoteChar}"
            : "url({$quoteChar}{$uri}{$quoteChar})";*/
    }
    
    /**
     * Rewrite a file relative URI as root relative
     *
     * <code>
     * Minify_CSS_UriRewriter::rewriteRelative(
     *       '../img/hello.gif'
     *     , '/home/user/www/css'  // path of CSS file
     *     , '/home/user/www'      // doc root
     * );
     * // returns '/img/hello.gif'
     * 
     * // example where static files are stored in a symlinked directory
     * Minify_CSS_UriRewriter::rewriteRelative(
     *       'hello.gif'
     *     , '/var/staticFiles/theme'
     *     , '/home/user/www'
     *     , array('/home/user/www/static' => '/var/staticFiles')
     * );
     * // returns '/static/theme/hello.gif'
     * </code>
     * 
     * @param string $uri file relative URI
     * 
     * @param string $realCurrentDir realpath of the current file's directory.
     * 
     * @param string $realDocRoot realpath of the site document root.
     * 
     * @param array $symlinks (default = array()) If the file is stored in 
     * a symlink-ed directory, provide an array of link paths to
     * real target paths, where the link paths "appear" to be within the document 
     * root. E.g.:
     * <code>
     * array('/home/foo/www/not/real/path' => '/real/target/path') // unix
     * array('C:\\htdocs\\not\\real' => 'D:\\real\\target\\path')  // Windows
     * </code>
     * 
     * @return string
     */
    public static function rewriteRelative($uri, $realCurrentDir, $realDocRoot, $symlinks = array())
    {
        // prepend path with current dir separator (OS-independent)
        $path = strtr($realCurrentDir, '/', DIRECTORY_SEPARATOR)  
            . DIRECTORY_SEPARATOR . strtr($uri, '/', DIRECTORY_SEPARATOR);
        
        self::$debugText .= "file-relative URI  : {$uri}\n"
                          . "path prepended     : {$path}\n";
        
        // "unresolve" a symlink back to doc root
        foreach ($symlinks as $link => $target) {
            if (0 === strpos($path, $target)) {
                // replace $target with $link
                $path = $link . substr($path, strlen($target));
                
                self::$debugText .= "symlink unresolved : {$path}\n";
                
                break;
            }
        }
        // strip doc root
        $path = substr($path, strlen($realDocRoot));
        
        self::$debugText .= "docroot stripped   : {$path}\n";
        
        // fix to root-relative URI

        $uri = strtr($path, '/\\', '//');


        // remove /./ and /../ where possible
        $uri = str_replace('/./', '/', $uri);
        // inspired by patch from Oleg Cherniy
        do {
            $uri = preg_replace('@/[^/]+/\\.\\./@', '/', $uri, 1, $changed);
        } while ($changed);
      
        self::$debugText .= "traversals removed : {$uri}\n\n";
        
        return $uri;
    }
    
    /**
     * Get realpath with any trailing slash removed. If realpath() fails,
     * just remove the trailing slash.
     * 
     * @param string $path
     * 
     * @return mixed path with no trailing slash
     */
    protected static function _realpath($path)
    {
        $realPath = realpath($path);
        if ($realPath !== false) {
            $path = $realPath;
        } else return false; //luismaf: added else
        return rtrim($path, '/\\');
    }
}

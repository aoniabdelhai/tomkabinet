<?php
/**
 * Class Minify_CSS  
 * @package Minify
 */

/**
 * Minify CSS
 *
 * This class uses Minify_CSS_Compressor and Minify_CSS_UriRewriter to 
 * minify CSS and rewrite relative URIs.
 * 
 * @package Minify
 * @author Stephen Clay <steve@mrclay.org>
 * @author http://code.google.com/u/1stvamp/ (Issue 64 patch)
 */
class Minify_CSS {
    public static function minify($css, $options = array()) 
    {
        require_once 'Minify/CSS/Compressor.php';
        $css = Minify_CSS_Compressor::process($css, $options);
        
        require_once 'Minify/CSS/UriRewriter.php';
        return Minify_CSS_UriRewriter::rewrite(
                $css
                ,$options['currentDir']
                ,$_SERVER['DOCUMENT_ROOT']
                ,$options['symlinks']
            );  
    }
}

<?php
/**
 * Class Minify_Controller_MinApp  
 * @package Minify
 */

require_once 'Minify/Controller/Base.php';

/**
 * Controller class for requests to /min/index.php
 * 
 * @package Minify
 * @author Stephen Clay <steve@mrclay.org>
 */
class Minify_Controller_MinApp extends Minify_Controller_Base {
    
    /**
     * Set up groups of files as sources
     * 
     * @param array $options controller and Minify options
     * @return array Minify options
     * 
     */
    public function setupSources($options) {
        // filter controller options
        $cOptions = array_merge(
            array(
                'allowDirs' => '//'
                ,'groupsOnly' => false
                ,'groups' => array()
                ,'maxFiles' => 10                
            )
            ,(isset($options['minApp']) ? $options['minApp'] : array())
        );
        unset($options['minApp']);
        $sources = array();
        if (isset($_GET['f'])) {
            // try user files
            // The following restrictions are to limit the URLs that minify will
            // respond to. Ideally there should be only one way to reference a file.
            if (// verify at least one file, files are single comma separated, 
                // and are all same extension
                ! preg_match('/^[^,]+\\.(css|js)(?:,[^,]+\\.\\1)*$/', $_GET['f'])
                // no "//"
                || strpos($_GET['f'], '//') !== false
                // no "\"
                || strpos($_GET['f'], '\\') !== false
                // no "./"
                || preg_match('/(?:^|[^\\.])\\.\\//', $_GET['f'])
            ) {
                echo "GET param 'f' invalid (see MinApp.php line 37)";
                return $options;
            }
            $files = explode(',', $_GET['f']);
            foreach ($files as $file) {
                $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $file;
                $file = realpath($path);
                if (is_file($file)) {
                    $sources[] = new Minify_Source(array(
                        'filepath' => $file
                    ));
                } else {
					 //echo "Path \"{$path}\" failed realpath()";
                    //return $options;
                }
            }
        }
        if ($sources) {
            $this->sources = $sources;
        } else {
            echo "No sources to serve";
        }
        return $options;
    }
}

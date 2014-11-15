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

            )
            ,(isset($options['minApp']) ? $options['minApp'] : array())
        );
        unset($options['minApp']);
        $sources = array();
		$firstMissingResource = null;
		global $get_url;
        if (isset($get_url)) {
            // try user files
            // The following restrictions are to limit the URLs that minify will
			// respond to.
            if (// verify at least one file, files are single comma separated, 
                // and are all same extension
                ! preg_match('/^[^,]+\\.(css|js)(?:,[^,]+\\.\\1)*$/', $get_url, $m)
                // no "//"
                || strpos($get_url, '//') !== false
                // no "\"
                || strpos($get_url, '\\') !== false

            ) {
                //echo "GET param 'f' invalid (see MinApp.php line 63)";
                $this->log("GET param 'f' invalid (see MinApp.php line 63)");
				return $options;
            }
			$ext = ".{$m[1]}";
            try {
                $this->checkType($m[1]);
            } catch (Exception $e) {
                $this->log($e->getMessage());
                return $options;
            }
            $files = array_unique(explode(',', $get_url));
            if ($files != array_unique($files)) {
                $this->log("Duplicate files were specified");
                return $options;
            }
			foreach ($files as $file) {
                $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $file;
                $realpath = realpath($path);
				//detect short path.
                if (false === $realpath) $realpath = realpath(DIR_APPLICATION . 'view/javascript/' . $path);
				if (false === $realpath) {
                    $this->log("The path \"{$path}\" (realpath \"{$realpath}\") could not be found (or was not a file)");
					//echo "Path \"{$path}\" failed realpath()";
                    if (null === $firstMissingResource) {
                        $firstMissingResource = $realpath;
                        continue;
                    } else {
						$secondMissingResource = $realpath;
                        //echo "More than one file was missing: '$firstMissingResource', '$secondMissingResource`'";
                        $this->log("More than one file was missing: '$firstMissingResource', '$secondMissingResource`'");
                        return $options;
                    }
                } else {
                    $sources[] = new Minify_Source(array(
                        'filepath' => $realpath
                    ));
                }
            }
        }
        if ($sources) {
            if (null !== $firstMissingResource) {
                array_unshift($sources, new Minify_Source(array(
                    'id' => 'missingFile'
                    // should not cause cache invalidation
                    ,'lastModified' => 0
                    // due to caching, filename is unreliable.
                    ,'content' => "/* Minify: at least one missing files */\n"
                    ,'minifier' => ''
                )));
            }
            $this->sources = $sources;
        } else {
            //echo "No sources to serve";
            $this->log("No sources to serve");
		}
        return $options;
    }
	protected $_type = null;
    /**
     * Make sure that only source files of a single type are registered
     *
     * @param string $sourceOrExt
     *
     * @throws Exception
     */
    public function checkType($sourceOrExt)
    {
        if ($sourceOrExt === 'js') {
            $type = Minify::TYPE_JS;
        } elseif ($sourceOrExt === 'css') {
            $type = Minify::TYPE_CSS;
        } elseif ($sourceOrExt->contentType !== null) {
            $type = $sourceOrExt->contentType;
        } else {
            return;
        }
        if ($this->_type === null) {
            $this->_type = $type;
        } elseif ($this->_type !== $type) {
            throw new Exception('Content-Type mismatch');
        }
    }
}

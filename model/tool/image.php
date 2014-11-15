<?php
class ModelToolImage extends Model {
	/**
	*	
	*	@param filename string
	*	@param width 
	*	@param height
	*	@param type char [default, w, h]
	*				default = scale with white space, 
	*				w = fill according to width, 
	*				h = fill according to height
	*	
	*/
	public function resize($filename, $width, $height, $type = "a") {
        //Change sponiza, resize no white borders
	//public function resize($filename, $width, $height, $type = "") {
		if (!file_exists(DIR_IMAGE . $filename) || !is_file(DIR_IMAGE . $filename)) {
			return;
		} 
		
		$info = pathinfo($filename);
		
		$extension = $info['extension'];
		
		$old_image = $filename;
		$new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . $type .'.' . $extension;
		
		if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {
			$path = '';
			
			$directories = explode('/', dirname(str_replace('../', '', $new_image)));
			
			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;
				
				if (!file_exists(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}		
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $old_image);
                                //Change sponiza, based on http://www.opencartnews.com/tutorials/auto-type-opencart-image-resize/
				//$image->resize($width, $height, $type);
                                if ($type == 'a') {
                                    if ($width/$height > $width_orig/$height_orig) {
                                        $image->resize($width, $height, 'w');
                                    } elseif ($width/$height < $width_orig/$height_orig) {
                                        $image->resize($width, $height, 'h');
                                    }
                                } else {
                                    $image->resize($width, $height, $type);
                                }
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			return $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			return $this->config->get('config_url') . 'image/' . $new_image;
		}	
	}
	
	
	#######################################################################################
	# Image resizing extended - Jerome Bohg - fuel@d-engine.nl
	# Added on 19-05-2014
	#######################################################################################
	
	// Function to crop an image with given dimensions. What doesn/t fit will be cut off.
	function cropsize($filename, $width, $height) {
	
		if (!file_exists(DIR_IMAGE . $filename) || !is_file(DIR_IMAGE . $filename)) {
			//return;
			$filename = 'no_image.jpg';
		} 
		
		$info = pathinfo($filename);
		$extension = $info['extension'];
		
		$old_image = $filename;
		$new_image = 'cache/' . substr($filename, 0, strrpos($filename, '.')) . '-cr-' . $width . 'x' . $height . '.' . $extension;
		
		if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {
			$path = '';
			
			$directories = explode('/', dirname(str_replace('../', '', $new_image)));
			
			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;
				
				if (!file_exists(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}		
			}
			
			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);
			
			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $old_image);
				$image->cropsize($width, $height);
				$image->save(DIR_IMAGE . $new_image);
			} else {
			
				//echo '######## we maken een copy ipv resizen ########<br>';
				//echo DIR_IMAGE . $old_image .'<br>';
				//echo DIR_IMAGE . $new_image .' <br><br><br>';
				
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
				
			}
			
		}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			return $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			return $this->config->get('config_url') . 'image/' . $new_image;
		}
			
	}
	
	// Function to resize image with one given max size.
	function onesize($filename, $maxsize, $setmax='w') {
	
		if (!file_exists(DIR_IMAGE . $filename) || !is_file(DIR_IMAGE . $filename)) {
			//return;
			$filename = 'no_image.jpg';
		} 
		
		$info = pathinfo($filename);
		$extension = $info['extension'];
		
		$old_image = $filename;
		$new_image = 'cache/' . substr($filename, 0, strrpos($filename, '.')) . '-max-' . $setmax . $maxsize . '.' . $extension;
		
		if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {
			$path = '';
			
			$directories = explode('/', dirname(str_replace('../', '', $new_image)));
			
			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;
				
				if (!file_exists(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}		
			}
			
			
			$image = new Image(DIR_IMAGE . $old_image);
			$image->onesize($maxsize,$setmax);
			$image->save(DIR_IMAGE . $new_image);
			
		}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			return $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			return $this->config->get('config_url') . 'image/' . $new_image;
		}
			
	}
	
}
?>

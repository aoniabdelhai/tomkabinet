<?php

class MsFileChecker {

	private static $imageTargetDir = "image/data/EPUB";

        private static $downloadTempDir = "./download/tmp/";

	private static $dataTargetDir  = "./download/tmp/details/";

	private static $validatorJar   = "/var/www/html/test71/epubcheck/epubcheck-3.0.1/epubcheck-3.0.1.jar";

	public function doAction($file) {
		if ($this->ScanFile($file)){
			$errors[] = "File infected, please make sure you are not trying to
			do malicious things.";
			return $errors;
		}

		$targetDir = $this::$downloadTempDir . uniqid('', true) . '_ebook_zipdir';
		$this->unzipFile($this::$downloadTempDir . $file['fileName'], $targetDir);
		$bookInfo = $this->getXMLData($targetDir);

		if ($bookInfo['image']) {
                        $bookInfoImage = $bookInfo['image'];
                        $bookend = explode('.',$bookInfoImage);
			$newFileName = $this::$imageTargetDir . '/' . uniqid() . '.' . end($bookend);
			rename($targetDir . '/OEBPS/' . $bookInfo['image'], $newFileName);
			$bookInfo['image'] = substr($newFileName, 6);
                }

                $this->packEpub($this::$downloadTempDir . $file['fileName'], $targetDir);

		$this->deleteDir($targetDir);

		//if (false && $this->validateEPUB($this::$downloadTempDir . $file['fileName'])) {
			//$errors[] = "EPUB did not validate. Please try again.";
			//return $errors;
		//}

		$bookInfo['datafile'] = $this::$dataTargetDir . uniqid() . '_' . $bookInfo['title'] . '.xml';
		$bookInfo['hash'] = md5_file($this::$downloadTempDir . $file['fileName']);
		$this->writeXMLFile($bookInfo, $bookInfo['datafile']);

                //Shorten description for the view. Be aware this information is passed through JavaScript, and we do not want to modify it there.
                $string = strip_tags($bookInfo['description']);

                if (strlen($string) > 500) {

                   // truncate string
                   $stringCut = substr($string, 0, 500);

                   // make sure it ends in a word so assassinate doesn't become ass...
                   $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
                }
                $bookInfo['description'] = str_replace("\n", "<br/>", $string);

		return $bookInfo;
	}

	private function writeXMLFile($data, $file) {
		$xml = new SimpleXMLElement('<root/>');
		//array_walk_recursive(array_flip($data), array ($xml, 'addChild'));
                foreach ($data as $key => $value) {

                   $xml->addChild($key, $value);

                }

		//$xml->asXML($this::$dataTargetDir . '/' . $file);
		$xml->asXML($file);
	}

	private function checkISBN($str) {
		$regex = '/\b(?:ISBN(?:: ?| ))?((?:97[89])?\d{9}[\dx])\b/i';

		if (preg_match($regex, str_replace('-', '', $str), $matches)) {
			return true;
		}
		return false;
	}

	private function validateEPUB($file) {
		$command = 'java -jar ' . $this::$validatorJar . ' ' . escapeshellarg($file);
		$command = escapeshellcmd($command) . ' 2>&1 1>/dev/null';

		echo exec($command, $out, $err);
                //echo "error " . $err . $command;
                //printf("Something went wrong: %s (%s)", join('<br />', $out), $err);

		$numerr = 0;

		foreach ($out as $line) {
			$numerr = substr($line, 0, 5) == 'ERROR' ? $numerr + 1 : $numerr;
		}

		return $numerr;
	}

        private function getImageTag($xml) {
                $imagename = '';
                foreach ($xml->meta as $xm) {
                   $namefound = false;
                   $content = '';
                   foreach ($xm->attributes() as $key=>$value ) {
                   
                      if ($value == 'cover') {
                         $namefound = true;
                      }

                      if ($key = 'content') {
                          $content = $value;
                      }
                   }
                   if ($namefound) {
                      $imagename = $content;
                   }
                }
                return $imagename;
        }

	private function getXMLData($dir) {
		$data = array();

		$targetFile = $dir . '/OEBPS/content.opf';
		$xml = simplexml_load_file($targetFile);

                $xmlmeta = $xml->metadata;

                $imagename = $this->getImageTag($xmlmeta);

		$metadata = $xml->metadata->children('dc', true);
		$manifest = $xml->manifest;

		$data['isbn'] = NULL;
		try {
			foreach ($metadata->identifier as $identifier) {
				if ($this->checkISBN($identifier)) {
					$data['isbn'] = $identifier->__toString();
					break;
				}
			}
		} catch (Exception $e) {
			$data['isbn'] = NULL;
		}

		try {
			$data['title'] = $metadata->title->__toString();
		} catch (Exception $e) {
			$data['title'] = NULL;
		}

		try {
			$data['authorstring'] = $metadata->creator->__toString();
		} catch (Exception $e) {
			$data['authorstring'] = NULL;
		}

		try {
			$data['book_language'] = $metadata->language->__toString();
		} catch (Exception $e) {
			$data['book_language'] = NULL;
		}

		try {
                        $pdate = new DateTime($metadata->date->__toString());
			//$data['date_published'] = date_format($pdate, 'd-m-Y');
			$data['date_published'] = $metadata->date->__toString();
		} catch (Exception $e) {
			$data['date_published'] = NULL;
		}

		try {
			$data['description'] = $metadata->description->__toString();
		} catch (Exception $e) {
			$data['description'] = NULL;
		}

		$data['image'] = '';
		try {
			foreach ($manifest->item as $manitem) {
                                $manitemattrs = $manitem->attributes();
				if (((string)$manitemattrs['id']) == $imagename) {
					$data['image'] = $manitemattrs->href->__toString();
					break;
				}
			}
		} catch (Exception $e) {
			$data['image'] = NULL;
		}

		return $data;
	}

	private function deleteDir($dirPath) {
		if (!is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}

		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}

		$files = glob($dirPath . '*', GLOB_MARK);

		foreach ($files as $file) {
			if (is_dir($file)) {
				$this->deleteDir($file);
			} else {
				unlink($file);
			}
		}

		rmdir($dirPath);
	}
	
	private function ScanFile($file, $clamserver='localhost', $clamavport='3310') {
		return false;

		if ($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)){
			if (socket_connect($sock, $clamserver, intval($clamavport))){
				$in = "SCAN " . $file;
				socket_write($sock, $in, strlen($in));

				while ($out = socket_read($sock, 2048)){
					$results .= $out;
				}

				$results = explode(': ', $results);

				if (strtolower(trim($results[1])) != 'ok'){
					## Infected!
					return $results[1];
				} else{
					## Clean
					return false;
				}
			} else {
				die('Could not connect to clamd server: ' . socket_strerror(socket_last_error($sock)));
			}
		} else {
			die('Could not open a socket: ' . socket_strerror(socket_last_error()));
		}
	}
	
	private function unzipFile($file, $targetdir) {
		$zip = new ZipArchive();
		$res = $zip->open($file);
		if ($res === TRUE) {
			$zip->extractTo($targetdir);
			$zip->close();
		} else {
			throw new InvalidArgumentException("Invalid zip file");
		}
	}

        function packEpub($fileName, $dir) {
	        $escFileName = escapeshellarg($fileName);

                
	        $cmd = 'pushd > /dev/null ' .  escapeshellarg($dir) . ' && ' . 'zip -q -X -0 ' . $escFileName . ' mimetype && zip -q -r -X -9 -g ' . $escFileName . ' OEBPS/ META-INF/' . ' && ' . 'popd > /dev/null';
                error_log($cmd); echo($cmd);
	        print(shell_exec('bash -c ' .  escapeshellarg($cmd)));
	        rename($fileName, './download/' . $fileName);
        }
}

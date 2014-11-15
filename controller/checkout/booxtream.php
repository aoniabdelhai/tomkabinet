<?php

class ControllerCheckoutBooxtream extends Controller {
//class ControllerBooxtream {

   public function index() {
   }

   private function createXML($file, $order) {
       // set parameters
       $aParams = array(
           'customeremailaddress' => $order->email,
           'customername' => $order->firstname . ' ' . $order->lastname,
           'languagecode' => '1043',
           'expirydays' => 30,
           'downloadlimit' => 3,
           'exlibris' => 0,
           'chapterfooter' => 0 ,
           'disclaimer' => 1,
           // as a best practice, referenceid should be unique
           'referenceid' => 'xxx',
           // the use of @ sends the file instead of the path as a string
           // the path to the file refers to the file system not to the (public)
           // url. Setting an url will not work.
           // See: http://php.net/manual/en/function.curl-setopt.php
           // CURLOPT_POSTFIELDS
           //
           //'epubfile' => '@/var/www/html/test3/admin/test.epub',
           'epubfile' => '@'.$file,
           //
           // if a custom Ex Libris image is necessary, use a path
           // to the image file in the file system.
           // Setting an url will not work.
           //
           //'exlibrisfile' => '@/var/data/customexlibris.png'
       );
       return $aParams;
   }

   private function send_msg($array) {
       $sUrl = 'http://service.booxtream.com/booxtream.epub';
       $sUserName = 'tomkabinettest';
       $sKey = 'Oe6GdPVrMk0ah60Xz89jbkUHzepghY';

       // initialize c
       $rCurl = curl_init();
       // set username and key for basic authentication
       curl_setopt($rCurl, CURLOPT_USERPWD, $sUserName.':'.$sKey);
       // set the url
       curl_setopt($rCurl, CURLOPT_URL, $sUrl);
       // we need to POST the parameters
       curl_setopt($rCurl, CURLOPT_POST, true);
       curl_setopt($rCurl, CURLOPT_POSTFIELDS, $array);
       // follow redirects and return response
       curl_setopt($rCurl, CURLOPT_FOLLOWLOCATION, true);
       curl_setopt($rCurl, CURLOPT_RETURNTRANSFER, true);
       // execute the call
       $sOutput = curl_exec($rCurl);
       // check the status
       $nStatus = (int)curl_getinfo($rCurl, CURLINFO_HTTP_CODE);
       // Close CURL
       curl_close($rCurl);

       /*
       $sOutput now contains xml, depending on the status code we can
       determine if the call was successful.
       */
       if($nStatus === 200) {
           // success
           echo $sOutput;
       } else {
           // error
           echo "error: ".$nStatus . ' xxx  ';
           echo $sOutput;
       }
       return $sOutput;
   }

   private function booxstream($file, $order) {
      $xml = $this->createXML($file, $order);
      return $this->send_msg($xml);
   }

   private function processHash($pid, $file) {
      $this->load->model('log/auditlog');
      //1. calculate hash
      $hashstring = hash_file("sha512",$file);
      //2. store hash auditlog
      $this->model_log_auditlog->createTable();
      $this->model_log_auditlog->addHash($pid, $hashstring);
   }

   function testBooxtream() {
      $order->firstname = 'sophie';
      $order->lastname = 'fischer';
      $order->email = 'sophiemail@ziggo.nl';
      //$order = array('firstname' => 'sophie', 'lastname' => 'fischer', 'email'=>'sophiemail@ziggo.nl');
      $xml = $this->createXML("/var/www/html/test3/admin/test.epub", $order);
      //echo 'roept de functie aan - stap 3 '; print_r($xml); die();
      $wmfc = $this->send_msg($xml);
      $fp = fopen('/var/www/html/uploads/testoutput.epub', 'w');
      fwrite($fp, $wmfc);
      fclose($fp);
      echo 'roept de functie aan - stap 5 ';
   }

   function createSecureDownload() {
       //echo 'in secure '; die();
       if (isset($product['download'])) {
          foreach ($product['download'] as $product_download) {
             $file = DIR_DOWNLOAD . $product_download['filename'];
             //if ($product_download['filename'] endswith .epub) {
             if (true) {
                $watermarkfile = $this->booxstream($file, $order);
                $this->processHash($watermarkfile);
                copy($watermarkfile, $file);
             } else {
                $this->processHash($file);
             }
          }//end foreach
       }//endif
   }//end function createSecureDownload

}//end class

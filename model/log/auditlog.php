<?php
class ModelLogAuditLog extends Model {
        public function createTable() {
           $querystring = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_to_hash` ( 
                           auditlog_id INT NOT NULL AUTO_INCREMENT, 
                           product_id INT(11) DEFAULT -1 NOT NULL, 
                           seller_id INT(11) DEFAULT -1 NOT NULL, 
                           customer_id INT(11) DEFAULT -1 NOT NULL, 
                           hashid INT DEFAULT -1 NOT NULL, 
                           prevhashkey VARCHAR(512) DEFAULT '' NOT NULL, 
                           newhashkey VARCHAR(512) DEFAULT '' NOT NULL,
                           PRIMARY KEY(`auditlog_id`),
                           FOREIGN KEY (product_id) REFERENCES product(product_id),
                           FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
                           FOREIGN KEY (seller_id) REFERENCES ms_seller(seller_id) )
                           ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
           //echo $querystring;
           $this->db->query($querystring);
        }

        public function getEntry($hashkey) {
                $querystring = "SELECT * 
                                FROM `" . DB_PREFIX . "product_to_hash` 
                                WHERE hashkey = '" . $hashkey . "'";
                $this->db->query($querystring);

                return $query->row;
        }

        public function addLogEntry($pid, $cid, $sid, $hashkey) {
                $this->db->query("INSERT
                                  INTO `" . DB_PREFIX . "product_to_hash`  
                                  SET product_id = " . $pid . ",  
                                  newhashkey = '" . $hashkey . "'");
        }

        public function isBoughtHere($hashkey)
        {
            $queryselect = "
              SELECT
                NULL
              FROM `" . DB_PREFIX . "product_to_hash`
              WHERE newhashkey = '" . $hashkey . "'
            ";
            $result = $this->db->query($queryselect);
            return ($result->num_rows > 0);
        }
        
        public function processHash($pid, $hashkey, $customerid) {
            //Select entry for pid -> there can be only one entry as each product is sold only once
            $queryselect = "SELECT *
                            FROM `" . DB_PREFIX . "product_to_hash`
                            WHERE product_id = " . $pid . "
                            AND newhashkey = ''
                            AND customer_id = -1";
            $result = $this->db->query($queryselect);
            //print_r($row);
            //echo 'test xxxx ' .$row['auditlog_id']; die();

            if($result->num_rows == 1) {
                 //Update
                 $row = $result->row;
                 $queryupdate = "UPDATE `" . DB_PREFIX . "product_to_hash`
                                 SET customer_id = '" . $customerid . "', newhashkey = '" . $hashkey . "'
                                 WHERE auditlog_id = " . $row['auditlog_id'];
                 $this->db->query($queryupdate);
             } else {
                //Alarmbellen
                //$this->addLogEntry($pid, $hashkey);
             }
        }

        public function testHash($hashkey, $sellerid) {
            //Select entry for pid -> there can be only one entry as each product is sold only once
            /*
            $queryselect = "SELECT *
                            FROM `" . DB_PREFIX . "product_to_hash`
                            WHERE prevhashkey = '" . $hashkey . "'
                            AND seller_id = " . $sellerid;
            */
            
            
            // also check for other sellers with the same paypal account
            $queryselect = "
              SELECT
                *
              FROM `" . DB_PREFIX . "product_to_hash`
              WHERE prevhashkey = '" . $hashkey . "'
              AND `seller_id` IN (
                SELECT
                  `seller_id`
                FROM
                  `" . DB_PREFIX . "ms_seller`
                WHERE `paypal` = (
                  SELECT
                    `paypal`
                  FROM
                    `" . DB_PREFIX . "ms_seller`
                  WHERE `seller_id` = " . $sellerid . "
                )
              )
            ";
            if (count($this->db->query($queryselect)->row) < 1) {
               return true;
            } else {
               return false;
            }
        }

        public function testLatestOwnerHash($hashkey, $sellerid) {
            //Select entry for pid -> there can be only one entry as each product is sold only once
            $queryselect = "SELECT *
                            FROM `" . DB_PREFIX . "product_to_hash`
                            WHERE newhashkey = '" . $hashkey . "'
                            ORDER BY auditlog_id DESC";
            
            $row = $this->db->query($queryselect)->row;
            if (count($row) < 1) {
              // hash not found
              return true;
            } else if ($row['customer_id'] == $sellerid) {
              // seller is current owner
              return true;
            } else {
              // hash found, but seller is not current owner
              return false;
            }
        }

        public function createHash($pid, $hashkey, $sellerid) {
            if($this->testHash($hashkey, $sellerid)) {
                 //Update
                 $queryinsert = "INSERT INTO `" . DB_PREFIX . "product_to_hash`
                                 SET product_id = " . $pid . ", seller_id = " . $sellerid . ", prevhashkey = '" . $hashkey . "'";
                 $this->db->query($queryinsert);
                 return true;
             } else {
                //Alarmbellen
                return false;
             }
        }

}

<?php
class ModelAccountForgotten extends Model {
	public function insertRecovery($data) {
		// Add a recovery request to the database
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . 
			"recovercodes` WHERE email='" . $this->db->escape($data['email']) . 
			"';");

		if ($query->num_rows) {
			$this->db->query("UPDATE `" . DB_PREFIX . 
			"recovercodes` SET `ip`=" . ip2long($data['ip']) .
			", `code1`='" . $data['code1'] .
			"', `code2`='" . $data['code2'] .
			"', `timestamp`=" . $data['time'] .
			" WHERE `email`='" . $this->db->escape($data['email']) . "';");
		} else {
			$this->db->query("INSERT INTO `" . DB_PREFIX . 
			"recovercodes` (email, ip, timestamp, code1, code2) VALUES ('" .
				$this->db->escape($data['email']) . "', " .
				ip2long($data['ip']) . ", " .
				$data['time'] . ", '" .
				$this->db->escape($data['code1']) . "', '" .
				$this->db->escape($data['code2']) . "');");
		}
	}

	public function verifyCodes($data) {
		// Verify if the user entered the right details, works together with 
		// validatecodes() from the controller.
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . 
			"recovercodes` WHERE email='" . $this->db->escape($data['email']) .
			"';");

		if ($query->num_rows) {
			if ($query->rows[0]["code1"] != $data['c1'] || 
				$query->rows[0]["code2"] != $data['c2']) {
				// Incorrect codes
				return 2;
			}
			if (long2ip($query->rows[0]["ip"]) != $data['ip']) {
				// No IP match
				return 3;
			}
			// Success!
			return 0;
		} else {
			// No such recovery request
			return 1;
		}
	}

	public function removeRequest($email) {
		// Remove a request from the DB after it is finished.
		$this->db->query("DELETE FROM `" . DB_PREFIX . 
			"recovercodes` WHERE email='" . $this->db->escape($email) . "';");
	}

	public function getRequestTimestamp($email) {
		// Get the timestamp of a request.
		return $this->db->query("SELECT * FROM `" . DB_PREFIX . 
			"recovercodes` WHERE email='" . $this->db->escape($email) .
			"';")->rows[0]['timestamp'];
	}
}
?>
<?php
class ModelModuleConfirmDelete extends Model {
	public function confirmDeletion($productid) {
		$query = $this->db->query("INSERT INTO " . DB_PREFIX . "confirmed_deleted (product_id, deleted) VALUES (" . (int)$productid . ", 1)");
	}

	public function getDeletion($productid) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "confirmed_deleted WHERE product_id = " . (int)$productid . " AND deleted = 1");
		
		return !(empty($query->rows));
	}
}
?>
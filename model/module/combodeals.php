<?php 
class ModelModuleComboDeals extends Model {
	public function getComboDeals($product_id) {
		$deals = array();
		$get_combo_ids = $this->db->query("SELECT combo_id FROM " . DB_PREFIX . "product_combo_slaves WHERE product_id = " . $product_id);
		$get_combo_ids_non_slave = $this->db->query("SELECT product_combo_id AS combo_id FROM " . DB_PREFIX . "product_combo WHERE product_id = " . $product_id);

		foreach (array_merge($get_combo_ids->rows, $get_combo_ids_non_slave->rows) as $combodeal) {
			$combo = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_combo WHERE product_combo_id = " . $combodeal['combo_id'])->rows[0];

			$other_items = array();

			$other_items[] = $combo['product_id'];

			$other_items_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_combo_slaves WHERE combo_id = " . $combodeal['combo_id']);

			foreach ($other_items_query->rows as $other_item) {
				$other_items[] = $other_item['product_id'];
			}

			$deals[] = array(
				'price' => $combo['price'],
				'items' => $other_items
			);
		}

		return $deals;
	}
}
?>
<?php
class ModelCatalogRefused extends Model
{
	public function addRefused($fileName, $reason)
	{
		$query = $this->db->query("
			INSERT INTO
				`" . DB_PREFIX . "book_refused`
			SET
				`date`		= NOW(),
				`filename`	= '" . $this->db->escape($fileName) . "',
				`reason`	= '" . $this->db->escape($reason) . "'
		");
	}
}
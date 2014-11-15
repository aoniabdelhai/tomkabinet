<?php
class ModelCatalogProductauthor extends Model {

    public function removeAuthors($data, $product_id) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_author WHERE product_id = '" . (int)$product_id . "'");

            if (isset($data['authors'])) {
                foreach ($data['authors'] as $product_author) {
                    if ($product_author['author_id']) {
                        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_author WHERE product_id = '" . (int)$product_id . "' AND author_id = '" . (int)$product_author['author_id'] . "'");

                    }
                }
            }
    }

    public function insertAuthors($data, $product_id) {
        if (isset($data['authors'])) {
            foreach ($data['authors'] as $product_author) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_author SET product_id = '" . (int)$product_id . "', author_id = '" . (int)$product_author['author_id'] . "'");
            }
        }
    }

    public function modifyAuthors($data, $product_id) {
        error_log("MODIFYAUTHORS!!!!!!:::");
        error_log($product_id, 0);
        error_log(var_export($data, true), 0);
        $this->removeAuthors($data, $product_id);
        $this->insertAuthors($data, $product_id);
    }

}
?>

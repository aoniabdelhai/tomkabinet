<?php
class ModelCatalogAuthor extends Model {
    public function getAuthor($author_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "author a LEFT JOIN " . DB_PREFIX . "author_description ad ON (a.author_id = ad.author_id) LEFT JOIN " . DB_PREFIX . "author_to_store a2s ON (a.author_id = a2s.author_id) WHERE a.author_id = '" . (int)$author_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND a2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND a.status = '1'");

        return $query->row;
    }

    public function getAuthors($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "author a LEFT JOIN " . DB_PREFIX . "author_description ad ON (a.author_id = ad.author_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";

            if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
                $sql .= " AND LCASE(ad.name) LIKE '" . $this->db->escape(mb_strtolower($data['filter_name'], 'UTF-8')) . "%'";
            }

            $sort_data = array(
                'ad.name',
                'a.date_added',
                'a.status',
                'a.sort_order'
            );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY ad.name";
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }

            $query = $this->db->query($sql);

            return $query->rows;
        } else {
            $author_data = $this->cache->get('author.' . $this->config->get('config_language_id'));

            if (!$author_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "author a LEFT JOIN " . DB_PREFIX . "author_description ad ON (a.author_id = ad.author_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ad.name ASC");

                $author_data = $query->rows;

                $this->cache->set('author.' . $this->config->get('config_language_id'), $author_data);
            }

            return $author_data;
        }
    }

    public function getAuthorLayoutId($author_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "author_to_layout WHERE author_id = '" . (int)$author_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

        if ($query->num_rows) {
            return $query->row['layout_id'];
        } else {
            return $this->config->get('config_layout_author');
        }
    }

    public function addAuthor($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "author SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

        $author_id = $this->db->getLastId();

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "author SET image = '" . $this->db->escape($data['image']) . "' WHERE author_id = '" . (int)$author_id . "'");
        }

        foreach ($data['author_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "author_description SET author_id = '" . (int)$author_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }

        if (isset($data['author_store'])) {
            foreach ($data['author_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "author_to_store SET author_id = '" . (int)$author_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        if (isset($data['author_layout'])) {
            foreach ($data['author_layout'] as $store_id => $layout) {
                if ($layout['layout_id']) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "author_to_layout SET author_id = '" . (int)$author_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
                }
            }
        }

        if (isset($data['keyword'])) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'author_id=" . (int)$author_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }

        $this->cache->delete('author');
    }
}
?>

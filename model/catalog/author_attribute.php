<?php
class ModelCatalogAuthorAttribute extends Model {
    public function addAuthorAttribute($data) {
        foreach ($data['author_attribute'] as $language_id => $value) {
            if (isset($author_attribute_id)) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "author_attribute SET author_attribute_id = '" . (int)$author_attribute_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
            } else {
                $this->db->query("INSERT INTO " . DB_PREFIX . "author_attribute SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

                $author_attribute_id = $this->db->getLastId();
            }
        }

        $this->cache->delete('author_attribute');
    }

    public function editAuthorAttribute($author_attribute_id, $data) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "author_attribute WHERE author_attribute_id = '" . (int)$author_attribute_id . "'");

        foreach ($data['author_attribute'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "author_attribute SET author_attribute_id = '" . (int)$author_attribute_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        $this->cache->delete('author_attribute');
    }

    public function deleteAuthorAttribute($author_attribute_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "author_attribute WHERE author_attribute_id = '" . (int)$author_attribute_id . "'");

        $this->cache->delete('author_attribute');
    }

    public function getAuthorAttribute($author_attribute_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "author_attribute WHERE author_attribute_id = '" . (int)$author_attribute_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row;
    }

    public function getAuthorsAttribute($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "author_attribute WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

            if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
                $sql .= " AND LCASE(name) LIKE '" . $this->db->escape(mb_strtolower($data['filter_name'], 'UTF-8')) . "%'";
            }

            $sql .= " ORDER BY name";

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
            $author_attribute_data = $this->cache->get('author_attribute.' . $this->config->get('config_language_id'));

            if (!$author_attribute_data) {
                $query = $this->db->query("SELECT author_attribute_id, name FROM " . DB_PREFIX . "author_attribute WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

                $author_attribute_data = $query->rows;

                $this->cache->set('author_attribute.' . $this->config->get('config_language_id'), $author_attribute_data);
            }

            return $author_attribute_data;
        }
    }

    public function getAuthorAttributeDescriptions($author_attribute_id) {
        $author_attribute_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "author_attribute WHERE author_attribute_id = '" . (int)$author_attribute_id . "'");

        foreach ($query->rows as $result) {
            $author_attribute_data[$result['language_id']] = array('name' => $result['name']);
        }

        return $author_attribute_data;
    }

    public function getTotalAuthorAttributes() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "author_attribute WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row['total'];
    }
}
?>
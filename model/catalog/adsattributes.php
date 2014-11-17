<?php

class ModelCatalogAdsattributes extends Model
{

    public function getProduct($product_id)
    {
        if ($this->customer->isLogged())
        {
            $customer_group_id = $this->customer->getCustomerGroupId();
        } else
        {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $querystring = "SELECT *, pd.name AS name, p.image, m.name AS manufacturer, 
                                (SELECT price 
                                 FROM " . DB_PREFIX . "product_discount pd2 
                                 WHERE pd2.product_id = p.product_id AND 
                                       pd2.customer_group_id = '" . (int) $customer_group_id . "' AND 
                                       pd2.quantity = '1' AND 
                                       ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND 
                                       (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) 
                                 ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, 
                                 (SELECT price 
                                  FROM " . DB_PREFIX . "product_special ps 
                                  WHERE ps.product_id = p.product_id AND 
                                        ps.customer_group_id = '" . (int) $customer_group_id . "' AND 
                                        ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND 
                                        (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) 
                                  ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, 
                                 (SELECT points 
                                  FROM " . DB_PREFIX . "product_reward pr 
                                  WHERE pr.product_id = p.product_id AND 
                                        customer_group_id = '" . (int) $customer_group_id . "') AS reward, 
                                 (SELECT ss.name 
                                  FROM " . DB_PREFIX . "stock_status ss 
                                  WHERE ss.stock_status_id = p.stock_status_id AND 
                                        ss.language_id = '" . (int) $this->config->get('config_language_id') . "') AS stock_status, 
                                 (SELECT wcd.unit 
                                  FROM " . DB_PREFIX . "weight_class_description wcd 
                                  WHERE p.weight_class_id = wcd.weight_class_id AND 
                                        wcd.language_id = '" . (int) $this->config->get('config_language_id') . "') AS weight_class, 
                                 (SELECT lcd.unit 
                                  FROM " . DB_PREFIX . "length_class_description lcd 
                                  WHERE p.length_class_id = lcd.length_class_id AND 
                                        lcd.language_id = '" . (int) $this->config->get('config_language_id') . "') AS length_class, 
                                 (SELECT AVG(rating) AS total 
                                  FROM " . DB_PREFIX . "review r1 
                                  WHERE r1.product_id = p.product_id AND 
                                        r1.status = '1' 
                                  GROUP BY r1.product_id) AS rating, 
                                 (SELECT COUNT(*) AS total 
                                  FROM " . DB_PREFIX . "review r2 
                                  WHERE r2.product_id = p.product_id AND 
                                        r2.status = '1' GROUP BY r2.product_id) AS reviews 
                              FROM " . DB_PREFIX . "product p 
                              LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
                              LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
                              LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) 
                              WHERE p.product_id = '" . (int) $product_id . "' AND 
                                    pd.language_id = '" . (int) $this->config->get('config_language_id') . "' AND 
                                    p.status = '1' AND 
                                    p.date_available <= NOW() AND 
                                    p2s.store_id = '" . (int) $this->config->get('config_store_id') . "'";
        // echo $querystring."<br />";

        $query = $this->db->query($querystring);

        if ($query->num_rows)
        {
            return array(
                'product_id' => $query->row['product_id'],
                'name' => $query->row['name'],
                'description' => $query->row['description'],
                'meta_description' => $query->row['meta_description'],
                'meta_keyword' => $query->row['meta_keyword'],
                'title' => $query->row['name'],
                'isbn' => $query->row['isbn'],
                'sku' => $query->row['sku'],
                'location' => $query->row['location'],
                'quantity' => $query->row['quantity'],
                'stock_status' => $query->row['stock_status'],
                'image' => $query->row['image'],
                'manufacturer_id' => $query->row['manufacturer_id'],
                'manufacturer_id' => $query->row['manufacturer_id'],
                'manufacturer' => $query->row['manufacturer'],
                'price' => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
                'special' => $query->row['special'],
                'reward' => $query->row['reward'],
                'points' => $query->row['points'],
                'tax_class_id' => $query->row['tax_class_id'],
                'date_available' => $query->row['date_available'],
                'weight' => $query->row['weight'],
                'weight_class' => $query->row['weight_class'],
                'length' => $query->row['length'],
                'width' => $query->row['width'],
                'height' => $query->row['height'],
                'length_class' => $query->row['length_class'],
                'subtract' => $query->row['subtract'],
                'rating' => (int) $query->row['rating'],
                'reviews' => $query->row['reviews'],
                'minimum' => $query->row['minimum'],
                'sort_order' => $query->row['sort_order'],
                'status' => $query->row['status'],
                'date_added' => $query->row['date_added'],
                'date_modified' => $query->row['date_modified'],
                'viewed' => $query->row['viewed']
            );
        } else
        {
            return false;
        }
    }

    public function getProducts($data = array())
    {
        $customer_group_id = $this->config->get('config_customer_group_id');

        if ($this->customer->isLogged())
        {
            $customer_group_id = $this->customer->getCustomerGroupId();
        }

        $sql = "SELECT p.product_id,
		          (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating
			    FROM " . DB_PREFIX . "product p
			    LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
			    LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) ";

        if ((!empty($data['filter_groups']) AND $data['filter_groups'] != '') OR ( !empty($data['filter_attribute']) AND $data['filter_attribute'] != ''))
        {
            $sql .= "  LEFT JOIN " . DB_PREFIX . "product_attribute pa ON (pa.product_id = p.product_id)
		               LEFT JOIN " . DB_PREFIX . "attribute a ON (a.attribute_id = pa.attribute_id)
		               LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (ag.attribute_group_id = a.attribute_group_id)";
        }

        if (!empty($data['filter_author']) AND $data['filter_author'] != '')
        {
            $sql .= "  LEFT JOIN " . DB_PREFIX . "product_to_author pta ON (p.product_id = pta.product_id)
		               LEFT JOIN " . DB_PREFIX . "author auth ON (pta.author_id = auth.author_id)
		               LEFT JOIN " . DB_PREFIX . "author_description atd ON (auth.author_id = atd.author_id)";
        }

        $sql .= " WHERE p.image <>'' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        if ((!empty($data['filter_groups']) AND $data['filter_groups'] != '') OR ( !empty($data['filter_attribute']) AND $data['filter_attribute'] != ''))
        {
            $sql .= " AND  pa.language_id = '" . (int) $this->config->get('config_language_id') . "'";
        }
        $sql .= " AND p.status = '1'
			 AND p.date_available <= NOW()
			 AND p2s.store_id = '" . (int) $this->config->get('config_store_id') . "'";


        if (!empty($data['filter_groups']) AND $data['filter_groups'] != '')
        {
            $sql .= " AND ag.attribute_group_id = '" . (int) $data['filter_groups'] . "'";
        }

        if (!empty($data['filter_attribute']) AND $data['filter_attribute'] != '')
        {
            $sql .= " AND a.attribute_id = '" . (int) $data['filter_attribute'] . "'";
        }




        if (isset($data['quicksearch']) && $data['quicksearch'] == 1)
        {
            $sql.=" AND MATCH(atd.name) AGAINST('{$this->db->escape(mb_strtolower($data['filter_author'], 'utf-8'))}') OR  MATCH(pd.name) AGAINST('{$this->db->escape(mb_strtolower($data['filter_author'], 'utf-8'))}')";
            //$sql .= " AND ((LCASE(atd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_author'], 'utf-8')) . "%') OR  (LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%')) ";
        } else
        {

            if (isset($data['filter_author']) && $data['filter_author'])
            {
                $sql .= " AND LCASE(atd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_author'], 'utf-8')) . "%'";
            }

            if (isset($data['filter_name']) && $data['filter_name'])
            {
                if (isset($data['filter_description']) && $data['filter_description'])
                {
                    $sql .= " AND MATCH(pd.name) AGAINST('{$this->db->escape(mb_strtolower($data['filter_name'], 'utf-8'))}')
					    OR LCASE(pd.description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%')";
                } else
                {
                    $sql .= " AND MATCH(pd.name) AGAINST('{$this->db->escape(mb_strtolower($data['filter_name'], 'utf-8'))}')";
                }
            }

            if (isset($data['filter_title']) && $data['filter_title'])
            {
                $sql .= " AND MATCH(pd.name) AGAINST('{$this->db->escape(mb_strtolower($data['filter_title'], 'utf-8'))}')";
            }
        }

        //=============================================
        if (isset($data['filter_category_id']) && $data['filter_category_id'])
        {
            if ($data['filter_category_id'] == 0)
                $data['filter_sub_category'] = true;
            if ($data['filter_sub_category'] == 'true')
            {
                $implode_data = array();
                $categories = $this->getCategoriesByParentId($data['filter_category_id']);
                $implode_data = implode(',', $categories);
            } else
            {
                $implode_data = implode(',', array('0' => $data['filter_category_id']));
            }
            //=============================================

            if (isset($data['filter_category_id']) && $data['filter_category_id'])
            {
                $sql .= " AND p.product_id IN (SELECT p2c.product_id FROM " . DB_PREFIX . "product_to_category p2c WHERE  p2c.category_id IN(" . $implode_data . "))";
            } else
            {
                $sql .= " AND p.product_id IN (SELECT p2c.product_id FROM " . DB_PREFIX . "product_to_category p2c WHERE p2c.category_id = '" . (int) $data['filter_category_id'] . "')";
            }
        }

        if (isset($data['filter_language']) && $data['filter_language'])
        {
            $sql .= " AND LCASE(p.book_language) = '" . $this->db->escape(mb_strtolower($data['filter_language'], 'utf-8')) . "'";
        }

        if (isset($data['filter_isbn']) && $data['filter_isbn'])
        {
            $sql .= " AND LCASE(p.isbn) = '" . $this->db->escape(mb_strtolower($data['filter_isbn'], 'utf-8')) . "'";
        }

        if (isset($data['filter_pricemin']) && $data['filter_pricemin'])
        {
            $sql .= " AND p.price >= '" . (int) $data['filter_pricemin'] . "'";
        }

        if (isset($data['filter_pricemax']) && $data['filter_pricemax'])
        {
            $sql .= " AND p.price <= '" . (int) $data['filter_pricemax'] . "'";
        }

        if ($this->config->get("searchat_viewproduct") != '')
        {
            $sql .= " AND p.stock_status_id <> '" . (int) $this->config->get("searchat_viewproduct") . "'";
        }

        $sort_data = array(
            'pd.name',
            'p.title',
            'p.author',
            'p.isbn',
            'p.quantity',
            'p.price',
            'rating',
            'p.sort_order',
            'p.date_added',
            'RAND()'
        );
        $sql .=' GROUP BY pd.name';
        if (isset($data['sort']) && in_array($data['sort'], $sort_data))
        {
            if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model')
            {
                $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
            } else
            {
                $sql .= " ORDER BY " . $data['sort'];
            }
        } else
        {
            $sql .= " ORDER BY p.sort_order";
        }



        if (isset($data['order']) && ($data['order'] == 'DESC'))
        {
            $sql .= " DESC";
        } else
        {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit']))
        {
            if ($data['start'] < 0)
            {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1)
            {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }

        if (isset($data['quantity']))
        {
            $sql .= " LIMIT " . (int) $data['quantity'];
        }

        $product_data = array();
        //echo "<pre>";
        //echo $sql;
        //echo "</pre>";
        $query = $this->db->query($sql);

        foreach ($query->rows as $result) {
            $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
        }

        return $product_data;
    }

//	public function getProductSpecials($data = array()) {
//		if ($this->customer->isLogged()) {
//			$customer_group_id = $this->customer->getCustomerGroupId();
//		} else {
//			$customer_group_id = $this->config->get('config_customer_group_id');
//		}
//
//		$sql = "SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id";
//
//		$sort_data = array(
//			'pd.name',
//			'p.model',
//			'ps.price',
//			'rating',
//			'p.sort_order'
//		);
//
//		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
//			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
//				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
//			} else {
//				$sql .= " ORDER BY " . $data['sort'];
//			}
//		} else {
//			$sql .= " ORDER BY p.sort_order";
//		}
//
//		if (isset($data['order']) && ($data['order'] == 'DESC')) {
//			$sql .= " DESC";
//		} else {
//			$sql .= " ASC";
//		}
//
//		if (isset($data['start']) || isset($data['limit'])) {
//			if ($data['start'] < 0) {
//				$data['start'] = 0;
//			}
//
//			if ($data['limit'] < 1) {
//				$data['limit'] = 20;
//			}
//
//			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
//		}
//
//		$product_data = array();
//
//		$query = $this->db->query($sql);
//
//		foreach ($query->rows as $result) {
//			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
//		}
//
//		return $product_data;
//	}
//	public function getLatestProducts($limit) {
//		$product_data = $this->cache->get('product.latest.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit);
//
//		if (!$product_data) {
//			$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);
//
//			foreach ($query->rows as $result) {
//				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
//			}
//
//			$this->cache->set('product.latest.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit, $product_data);
//		}
//
//		return $product_data;
//	}
//	public function getPopularProducts($limit) {
//		$product_data = array();
//
//		$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed, p.date_added DESC LIMIT " . (int)$limit);
//
//		foreach ($query->rows as $result) {
//			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
//		}
//
//		return $product_data;
//	}
//	public function getBestSellerProducts($limit) {
//		$product_data = $this->cache->get('product.bestseller.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit);
//
//		if (!$product_data) {
//			$product_data = array();
//
//			$query = $this->db->query("SELECT op.product_id FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY COUNT(op.product_id) DESC LIMIT " . (int)$limit);
//
//			foreach ($query->rows as $result) {
//				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
//			}
//
//			$this->cache->set('product.bestseller.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit, $product_data);
//		}
//
//		return $product_data;
//	}

    public function getProductAttributes($product_id)
    {
        $product_attribute_group_data = array();

        $product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.product_id = '" . (int) $product_id . "' AND agd.language_id = '" . (int) $this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

        foreach ($product_attribute_group_query->rows as $product_attribute_group) {
            $product_attribute_data = array();

            $product_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int) $product_id . "' AND a.attribute_group_id = '" . (int) $product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int) $this->config->get('config_language_id') . "' AND pa.language_id = '" . (int) $this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

            foreach ($product_attribute_query->rows as $product_attribute) {
                $product_attribute_data[] = array(
                    'attribute_id' => $product_attribute['attribute_id'],
                    'name' => $product_attribute['name'],
                    'text' => $product_attribute['text']
                );
            }

            $product_attribute_group_data[] = array(
                'attribute_group_id' => $product_attribute_group['attribute_group_id'],
                'name' => $product_attribute_group['name'],
                'attribute' => $product_attribute_data
            );
        }

        return $product_attribute_group_data;
    }

    public function getProductOptions($product_id)
    {
        $product_option_data = array();

        $product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int) $product_id . "' AND od.language_id = '" . (int) $this->config->get('config_language_id') . "' ORDER BY o.sort_order");

        foreach ($product_option_query->rows as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox')
            {
                $product_option_value_data = array();

                $product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int) $product_id . "' AND pov.product_option_id = '" . (int) $product_option['product_option_id'] . "' AND ovd.language_id = '" . (int) $this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

                foreach ($product_option_value_query->rows as $product_option_value) {
                    $product_option_value_data[] = array(
                        'product_option_value_id' => $product_option_value['product_option_value_id'],
                        'option_value_id' => $product_option_value['option_value_id'],
                        'name' => $product_option_value['name'],
                        'quantity' => $product_option_value['quantity'],
                        'subtract' => $product_option_value['subtract'],
                        'price' => $product_option_value['price'],
                        'price_prefix' => $product_option_value['price_prefix'],
                        'weight' => $product_option_value['weight'],
                        'weight_prefix' => $product_option_value['weight_prefix']
                    );
                }

                $product_option_data[] = array(
                    'product_option_id' => $product_option['product_option_id'],
                    'option_id' => $product_option['option_id'],
                    'name' => $product_option['name'],
                    'type' => $product_option['type'],
                    'option_value' => $product_option_value_data,
                    'required' => $product_option['required']
                );
            } else
            {
                $product_option_data[] = array(
                    'product_option_id' => $product_option['product_option_id'],
                    'option_id' => $product_option['option_id'],
                    'name' => $product_option['name'],
                    'type' => $product_option['type'],
                    'option_value' => $product_option['option_value'],
                    'required' => $product_option['required']
                );
            }
        }

        return $product_option_data;
    }

//	public function getProductDiscounts($product_id) {
//		if ($this->customer->isLogged()) {
//			$customer_group_id = $this->customer->getCustomerGroupId();
//		} else {
//			$customer_group_id = $this->config->get('config_customer_group_id');
//		}
//
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$customer_group_id . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");
//
//		return $query->rows;
//	}
//	public function getProductImages($product_id) {
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
//
//		return $query->rows;
//	}
//
//	public function getProductRelated($product_id) {
//		$product_data = array();
//
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
//
//		foreach ($query->rows as $result) {
//			$product_data[$result['related_id']] = $this->getProduct($result['related_id']);
//		}
//
//		return $product_data;
//	}
//	public function getProductLayoutId($product_id) {
//		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");
//
//		if ($query->num_rows) {
//			return $query->row['layout_id'];
//		} else {
//			return	$this->config->get('config_layout_product');
//		}
//	}


    public function getLanguages()
    {
        $sql = "SELECT DISTINCT(book_language) ";

        $sql .= "FROM " . DB_PREFIX . "product c";
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getCategories($parent_id = 0)
    {
        $sql = "SELECT c.category_id, cd.name ";

        $sql .= ", (SELECT count(*) FROM " . DB_PREFIX . "product_to_category p2c
		LEFT JOIN " . DB_PREFIX . "product p1 ON (p1.product_id = p2c.product_id)
	       WHERE p2c.category_id = c.category_id ";

        if ($this->config->get("searchat_viewproduct") != '')
        {
            $sql .= " AND p1.stock_status_id <> '" . (int) $this->config->get("searchat_viewproduct") . "'";
        }

        $sql .= " ) AS countproduct ";

        $sql .= "FROM " . DB_PREFIX . "category c
		    LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id)
		    LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id)
		 WHERE c.parent_id = '" . (int) $parent_id . "'
		     AND cd.language_id = '" . (int) $this->config->get('config_language_id') . "'
		     AND c2s.store_id = '" . (int) $this->config->get('config_store_id') . "'
		     AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)";

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalProducts($data = array())
    {

//		echo '<pre>';
//		print_r($data);
//		echo '</pre>';

        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product p
			    LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
				LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) ";

        if ((!empty($data['filter_groups']) AND $data['filter_groups'] != '') OR ( !empty($data['filter_attribute']) AND $data['filter_attribute'] != ''))
        {
            $sql .= "  LEFT JOIN " . DB_PREFIX . "product_attribute pa ON (pa.product_id = p.product_id)
		               LEFT JOIN " . DB_PREFIX . "attribute a ON (a.attribute_id = pa.attribute_id)
		               LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (ag.attribute_group_id = a.attribute_group_id)";
        }

        if (!empty($data['filter_author']) AND $data['filter_author'] != '')
        {
            $sql .= "  LEFT JOIN " . DB_PREFIX . "product_to_author pta ON (p.product_id = pta.product_id)
		               LEFT JOIN " . DB_PREFIX . "author auth ON (pta.author_id = auth.author_id)
		               LEFT JOIN " . DB_PREFIX . "author_description atd ON (auth.author_id = atd.author_id)";
        }

        $sql .= " WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";


        if ((!empty($data['filter_groups']) AND $data['filter_groups'] != '') OR ( !empty($data['filter_attribute']) AND $data['filter_attribute'] != ''))
        {
            $sql .= " AND  pa.language_id = '" . (int) $this->config->get('config_language_id') . "'";
        }
        $sql .= " AND p.status = '1'
			 AND p.date_available <= NOW()
			 AND p2s.store_id = '" . (int) $this->config->get('config_store_id') . "'";




        if (isset($data['quicksearch']) && $data['quicksearch'] == 1)
        {

            $sql .= " AND ((LCASE(atd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_author'], 'utf-8')) . "%') OR  (LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%')) ";
        } else
        {

            if (isset($data['filter_author']) && $data['filter_author'])
            {
                $sql .= " AND LCASE(atd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_author'], 'utf-8')) . "%'";
            }

            if (isset($data['filter_name']) && $data['filter_name'])
            {
                if (isset($data['filter_description']) && $data['filter_description'])
                {
                    $sql .= " AND (LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%'
					    OR LCASE(pd.description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%')";
                } else
                {
                    $sql .= " AND (LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%')";
                }
            }

            if (isset($data['filter_title']) && $data['filter_title'])
            {
                $sql .= " AND (LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_title'], 'utf-8')) . "%')";
            }
        }




//		if (isset($data['filter_name']) && !empty($data['filter_name'])) {
//			if (isset($data['filter_description']) && $data['filter_description']) {
//				$sql .= " AND (LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%'
//				    OR LCASE(pd.description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%')";
//			} else {
//				$sql .= " AND (LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'utf-8')) . "%')";
//			}
//		}
//		
//		if (isset($data['filter_title']) && $data['filter_title']) {
//		    $sql .= " AND (LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_title'], 'utf-8')) . "%')";
//		}
//
//		if (isset($data['filter_author']) && $data['filter_author']) {
//			//$sql .=  " AND LCASE(p.author) = '" . $this->db->escape(mb_strtolower($data['filter_author'], 'utf-8')) . "'";
//		}

        if (isset($data['filter_isbn']) && $data['filter_isbn'])
        {
            $sql .= " AND LCASE(p.isbn) = '" . $this->db->escape(mb_strtolower($data['filter_isbn'], 'utf-8')) . "'";
        }

        //=============================================
        if (isset($data['filter_category_id']) && $data['filter_category_id'])
        {

            if ($data['filter_category_id'] == 0)
                $data['filter_sub_category'] = true;

            if ($data['filter_sub_category'] == 'true')
            {
                $implode_data = array();
                $categories = $this->getCategoriesByParentId($data['filter_category_id']);
                $implode_data = implode(',', $categories);
            } else
            {
                $implode_data = implode(',', array('0' => $data['filter_category_id']));
            }
            //=============================================

            if (isset($data['filter_category_id']) && $data['filter_category_id'])
            {
                $sql .= " AND p.product_id IN (SELECT p2c.product_id FROM " . DB_PREFIX . "product_to_category p2c WHERE  p2c.category_id IN(" . $implode_data . ")) ";
            } else
            {
                $sql .= " AND p.product_id IN (SELECT p2c.product_id FROM " . DB_PREFIX . "product_to_category p2c WHERE p2c.category_id = '" . (int) $data['filter_category_id'] . "') ";
            }
        }

        //echo 'filterlanguage ' . $data['filter_language']; die();
        if (isset($data['filter_language']) && $data['filter_language'])
        {
            $sql .= " AND p.book_language = '" . $this->db->escape($data['filter_language']) . "'";
        }

        if (!empty($data['filter_groups']) AND $data['filter_groups'] != '')
        {
            $sql .= " AND ag.attribute_group_id = '" . (int) $data['filter_groups'] . "'";
        }

        if (!empty($data['filter_attribute']) AND $data['filter_attribute'] != '')
        {
            $sql .= " AND a.attribute_id = '" . (int) $data['filter_attribute'] . "'";
        }

        if (isset($data['filter_pricemin']) && $data['filter_pricemin'])
        {
            $sql .= " AND p.price >= '" . (int) $data['filter_pricemin'] . "'";
        }

        if (isset($data['filter_pricemax']) && $data['filter_pricemax'])
        {
            $sql .= " AND p.price <= '" . (int) $data['filter_pricemax'] . "'";
        }

        if ($this->config->get("searchat_viewproduct") != '')
        {
            $sql .= " AND p.stock_status_id <> '" . (int) $this->config->get("searchat_viewproduct") . "'";
        }

        //echo '##########  TOTAL QUERY '.$sql.' ##########<br><br>';

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

//	public function getTotalProductSpecials() {
//		if ($this->customer->isLogged()) {
//			$customer_group_id = $this->customer->getCustomerGroupId();
//		} else {
//			$customer_group_id = $this->config->get('config_customer_group_id');
//		}
//
//		$query = $this->db->query("SELECT COUNT(DISTINCT ps.product_id) AS total FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");
//
//		if (isset($query->row['total'])) {
//			return $query->row['total'];
//		} else {
//			return 0;
//		}
//	}



    public function getCategoriesByParentId($category_id)
    {
        $category_data = array();
        $category_data[] = $category_id;
        $category_query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category WHERE parent_id = '" . (int) $category_id . "'");

        foreach ($category_query->rows as $category) {
            $children = $this->getCategoriesByParentId($category['category_id']);

            if ($children)
            {
                $category_data = array_merge($children, $category_data);
            }
        }
        return $category_data;
    }

    public function getManufacturers($data = array())
    {
        //=============================================
        if (empty($data['filter_category_id']))
            $data['filter_category_id'] = 0;
        if ($data['filter_category_id'] == 0)
            $data['filter_sub_category'] = true;
        if ($data['filter_sub_category'])
        {
            $categories = $this->getCategoriesByParentId($data['filter_category_id']);
            $implode_data = implode(',', $categories);
        } else
        {
            $implode_data = implode(',', array('0' => $data['filter_category_id']));
        }
        //=============================================
        $sql = "SELECT  m.name, p.manufacturer_id, count(*) AS countproduct ";
        $sql .= " FROM " . DB_PREFIX . "manufacturer m ";
        $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (m.manufacturer_id = p.manufacturer_id)";
        $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = p.product_id )";
        $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)";

        $sql .= "  WHERE p.status = '1' AND p2c.category_id in(" . $implode_data . ")";

        if ($this->config->get("searchat_viewproduct") != '')
        {
            $sql .= " AND p.stock_status_id <> '" . (int) $this->config->get("searchat_viewproduct") . "'";
        }


        $sql .= " GROUP BY m.manufacturer_id ORDER BY LCASE(m.name) ASC";

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getGroups($data)
    {
        if ($data['filter_sub_category'] != '' OR $data['filter_category_id'] == 0)
        {
            $category_id = $this->getCategoriesByParentId($data['filter_category_id']);
        } else
        {
            $category_id[0] = $data['filter_category_id'];
        }

        $sql = "SELECT *,
		    (SELECT count(*) FROM " . DB_PREFIX . "product_attribute pa1
		      LEFT JOIN " . DB_PREFIX . "product_to_category p2c1 ON (p2c1.product_id = pa1.product_id)
		      LEFT JOIN " . DB_PREFIX . "product p1 ON (p1.product_id = pa1.product_id)
		      LEFT JOIN " . DB_PREFIX . "product_to_store p2s1 ON (p1.product_id = p2s1.product_id)
			WHERE pa1.attribute_id = a.attribute_id
			AND  pa1.language_id = '" . (int) $this->config->get('config_language_id') . "'
			AND p2c1.category_id IN(" . implode(',', $category_id) . ")";
        //if($data['filter_manufacturer_id'] != '') {
        if (false)
        {
            $sql .= " AND p1.manufacturer_id =" . (int) $data['filter_manufacturer_id'];
        }

        if ($this->config->get("searchat_viewproduct") != '')
        {
            $sql .= " AND p1.stock_status_id <> '" . (int) $this->config->get("searchat_viewproduct") . "'";
        }

        $sql .= ") AS countproduct

		    FROM " . DB_PREFIX . "attribute_group_description agd
		    LEFT JOIN " . DB_PREFIX . "attribute a ON (a.attribute_group_id = agd.attribute_group_id)
		    WHERE  agd.language_id = '" . (int) $this->config->get('config_language_id') . "'

			AND a.attribute_id IN (SELECT pa.attribute_id FROM " . DB_PREFIX . "product_attribute pa
					  LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = pa.product_id)
					  LEFT JOIN " . DB_PREFIX . "product p ON (p.product_id = pa.product_id)
					  LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
			    WHERE  pa.language_id = '" . (int) $this->config->get('config_language_id') . "'
				AND p2c.category_id IN(" . implode(',', $category_id) . ")";
        //if($data['filter_manufacturer_id'] != '') {
        if (false)
        {
            $sql .= " AND p.manufacturer_id =" . (int) $data['filter_manufacturer_id'];
        }

        if ($this->config->get("searchat_viewproduct") != '')
        {
            $sql .= " AND p.stock_status_id <> '" . (int) $this->config->get("searchat_viewproduct") . "'";
        }

        $sql .= " ) GROUP BY  agd.name  ORDER BY agd.name ASC";


        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getAttributes($data = array())
    {
        if ($data['filter_sub_category'] != '' OR $data['filter_category_id'] == 0)
        {
            $category_id = $this->getCategoriesByParentId($data['filter_category_id']);
        } else
        {
            $category_id[0] = $data['filter_category_id'];
        }
        $sql = "SELECT *,
		    (SELECT count(*) FROM " . DB_PREFIX . "product_attribute pa1
		      LEFT JOIN " . DB_PREFIX . "product_to_category p2c1 ON (p2c1.product_id = pa1.product_id)
		      LEFT JOIN " . DB_PREFIX . "product p1 ON (p1.product_id = pa1.product_id)
		      LEFT JOIN " . DB_PREFIX . "product_to_store p2s1 ON (p1.product_id = p2s1.product_id)
		      LEFT JOIN " . DB_PREFIX . "attribute a1 ON (a1.attribute_id = pa1.attribute_id)
			WHERE pa1.attribute_id = a.attribute_id
			AND  pa1.language_id = '" . (int) $this->config->get('config_language_id') . "'
			AND p2c1.category_id IN(" . implode(',', $category_id) . ")";
        //if($data['filter_manufacturer_id'] != '') {
        if (false)
        {
            $sql .= " AND p1.manufacturer_id =" . (int) $data['filter_manufacturer_id'];
        }

        if ($this->config->get("searchat_viewproduct") != '')
        {
            $sql .= " AND p1.stock_status_id <> '" . (int) $this->config->get("searchat_viewproduct") . "'";
        }

        if ($data['filter_groups'] != '')
        {
            $sql .= "  AND a1.attribute_group_id = '" . (int) $data['filter_groups'] . "'";
        }
        $sql .= ") AS countproduct

		    FROM " . DB_PREFIX . "attribute a
		    LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (ad.attribute_id = a.attribute_id)
		    WHERE  ad.language_id = '" . (int) $this->config->get('config_language_id') . "'
			   AND a.attribute_id IN (SELECT pa.attribute_id FROM " . DB_PREFIX . "product_attribute pa
			      LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p2c.product_id = pa.product_id)
			      LEFT JOIN " . DB_PREFIX . "product p ON (p.product_id = pa.product_id)
			      LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
			    WHERE  pa.language_id = '" . (int) $this->config->get('config_language_id') . "'
				AND p2c.category_id IN(" . implode(',', $category_id) . ")";
        //if($data['filter_manufacturer_id'] != '') {
        if (false)
        {
            $sql .= " AND p.manufacturer_id =" . (int) $data['filter_manufacturer_id'];
        }

        if ($this->config->get("searchat_viewproduct") != '')
        {
            $sql .= " AND p.stock_status_id <> '" . (int) $this->config->get("searchat_viewproduct") . "'";
        }

        if ($data['filter_groups'] != '')
        {
            $sql .= "  AND a.attribute_group_id = '" . (int) $data['filter_groups'] . "'";
        }
        $sql .= ") GROUP BY ad.name ORDER BY ad.name ASC";

        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getAutocomplete($data = array())
    {
        $sql = "SELECT pd.name, p.title, p.price, p.image FROM " . DB_PREFIX . "product p
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (pd.product_id = p.product_id)
	    WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "' ";

        if ($data['filter_name'])
        {
            if ($data['filter_description'])
            {
                $sql .= " AND  LCASE(pd.description) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'UTF-8')) . "%'";
            } else
            {
                $sql .= " AND  LCASE(pd.name) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_name'], 'UTF-8')) . "%'";
            }
        }

        if ($this->config->get("searchatt_viewproduct") != '')
        {
            $sql .= " AND p.stock_status_id <> '" . (int) $this->config->get("searchatt_viewproduct") . "'";
        }

        if ($data['filter_title'])
        {
            $sql .= " AND	LCASE(p.model) LIKE '%" . $this->db->escape(mb_strtolower($data['filter_title'], 'UTF-8')) . "%'";
        }


        $sql .= " ORDER BY pd.name ASC";
        $sql .= " LIMIT 0,20";

        $query = $this->db->query($sql);
        return $query->rows;
    }

}

class PaginationAdsAttributes
{

    public $total = 0;
    public $page = 1;
    public $limit = 20;
    public $num_links = 10;
    public $url = '';
    public $text = 'Showing {start} to {end} of {total} ({pages} Pages)';
    public $text_first = '|&lt;';
    public $text_last = '&gt;|';
    public $text_next = '&gt;';
    public $text_prev = '&lt;';
    public $style_links = 'links';
    public $style_results = 'results';

    public function render()
    {
        $total = $this->total;

        if ($this->page < 1)
        {
            $page = 1;
        } else
        {
            $page = $this->page;
        }

        if (!(int) $this->limit)
        {
            $limit = 10;
        } else
        {
            $limit = $this->limit;
        }

        $num_links = $this->num_links;
        $num_pages = ceil($total / $limit);

        $output = '';

        if ($page > 1)
        {
            $output .= ' <a onclick="paginationlink(\'' . 'page=1' . $this->url . '\')">' . $this->text_first . '</a> <a	onclick="paginationlink(\'' . 'page=' . ($page - 1) . $this->url . '\')">' . $this->text_prev . '</a> ';
        }

        if ($num_pages > 1)
        {
            if ($num_pages <= $num_links)
            {
                $start = 1;
                $end = $num_pages;
            } else
            {
                $start = $page - floor($num_links / 2);
                $end = $page + floor($num_links / 2);

                if ($start < 1)
                {
                    $end += abs($start) + 1;
                    $start = 1;
                }

                if ($end > $num_pages)
                {
                    $start -= ($end - $num_pages);
                    $end = $num_pages;
                }
            }

            if ($start > 1)
            {
                $output .= ' .... ';
            }

            for ($i = $start; $i <= $end; $i++) {
                if ($page == $i)
                {
                    $output .= ' <b>' . $i . '</b> ';
                } else
                {
                    $output .= ' <a  onclick="paginationlink(\'' . 'page=' . $i . $this->url . '\')">' . $i . '</a> ';
                }
            }

            if ($end < $num_pages)
            {
                $output .= ' .... ';
            }
        }

        if ($page < $num_pages)
        {
            $output .= ' <a  onclick="paginationlink(\'' . 'page=' . ($page + 1) . $this->url . '\')">' . $this->text_next . '</a> <a  onclick="paginationlink(\'' . 'page=' . $num_pages . $this->url . '\')">' . $this->text_last . '</a> ';
        }

        $find = array(
            '{start}',
            '{end}',
            '{total}',
            '{pages}'
        );

        $replace = array(
            ($total) ? (($page - 1) * $limit) + 1 : 0,
            ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit),
            $total,
            $num_pages
        );

        return ($output ? '<div class="' . $this->style_links . '">' . $output . '</div>' : '') . '<div class="' . $this->style_results . '">' . str_replace($find, $replace, $this->text) . '</div>';
    }

}

?>

<?php
/*
 * @copyright Copyright (c) Shilovsky Andrej (an911@ukr.net)
 * http://quartzstore.com
 */
class ControllerModuleAdsattributes extends Controller {
	protected function index($module) {
	    $this->data['position'] = $module['position'];

		$this->language->load('module/adsattributes');
		$this->load->model('catalog/adsattributes');

		if (isset($this->request->post['search'])) {
			$filter_name = $this->request->post['search'];
		}

		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->post['filter_tag'])) {
			$filter_tag = $this->request->post['filter_tag'];
		} else {
			$filter_tag = '';
		}

		if (isset($this->request->post['filter_category_id'])) {
			$filter_category_id = $this->request->post['filter_category_id'];
		} else {
			$filter_category_id = 0;
		}

		if (isset($this->request->post['filter_sub_category'])) {
			$filter_sub_category = $this->request->post['filter_sub_category'];
		} else {
			$filter_sub_category = '';
		}

		if (isset($this->request->post['filter_language'])) {
			$filter_language = $this->request->post['filter_language'];
		} else {
			$filter_language = '';
		}

		if (isset($this->request->post['filter_title'])) {
			$filter_title = $this->request->post['filter_title'];
		} else {
			$filter_title = '';
		}

		if (isset($this->request->post['filter_author'])) {
			$filter_author = $this->request->post['filter_author'];
		} else {
			$filter_author = '';
		}

		if (isset($this->request->post['filter_isbn'])) {
			$filter_isbn = $this->request->post['filter_isbn'];
		} else {
			$filter_isbn = '';
		}

		if (isset($this->request->post['filter_pricemin'])) {
			$filter_pricemin = $this->request->post['filter_pricemin'];
		} else {
			$filter_pricemin = '';
		}

		if (isset($this->request->post['filter_pricemax'])) {
			$filter_pricemax = $this->request->post['filter_pricemax'];
		} else {
			$filter_pricemax = '';
		}

		if (isset($this->request->post['filter_description'])) {
			$filter_description = $this->request->post['filter_description'];
		} else {
			$filter_description = '';
		}

		if (isset($this->request->post['filter_groups'])) {
			$filter_groups = $this->request->post['filter_groups'];
		} else {
			$filter_groups = '';
		}

		if (isset($this->request->post['filter_attribute'])) {
			$filter_attribute = $this->request->post['filter_attribute'];
		} else {
			$filter_attribute = '';
		}


	    if(!$this->config->get("searchat_showterms")) {
		    $filter_name = '';
		    $filter_description = '';
		    $filter_title = '';
		    $filter_author = '';
		    $filter_isbn = '';
		    $filter_tag = '';
		    $filter_language = '';
		    $filter_category_id = 0;
		    $filter_sub_category = '';
		    $filter_pricemin = '';
		    $filter_pricemax = '';
		    $filter_groups = '';
		    $filter_attribute = '';
	    }

	    $this->data['heading_title'] = $this->language->get('heading_title');

	    $this->data['text_critea'] = $this->language->get('text_critea');
	    $this->data['text_search'] = $this->language->get('text_search');
	    $this->data['text_keyword'] = $this->language->get('text_keyword');
	    $this->data['text_language'] = $this->language->get('text_language');
	    $this->data['text_category'] = $this->language->get('text_category');
	    $this->data['text_empty'] = $this->language->get('text_empty');
	    $this->data['text_sort'] = $this->language->get('text_sort');
	    $this->data['text_price'] = $this->language->get('text_price');
	    $this->data['text_pricemin'] = $this->language->get('text_pricemin');
	    $this->data['text_pricemax'] = $this->language->get('text_pricemax');
	    $this->data['text_sub_category'] = $this->language->get('text_sub_category');
	    $this->data['text_groups'] = $this->language->get('text_groups');
	    $this->data['text_attributes'] = $this->language->get('text_attributes');

	    $this->data['entry_search'] = $this->language->get('entry_search');
	    $this->data['entry_description'] = $this->language->get('entry_description');
	    $this->data['entry_title'] = $this->language->get('entry_title');
	    $this->data['entry_author'] = $this->language->get('entry_author');
	    $this->data['entry_isbn'] = $this->language->get('entry_isbn');
	    $this->data['entry_language'] = $this->language->get('entry_language');
	    $this->data['entry_category'] = $this->language->get('entry_category');
	    $this->data['entry_groups_attribute'] = $this->language->get('entry_groups_attribute');
	    $this->data['entry_attribute'] = $this->language->get('entry_attribute');
	    $this->data['entry_attribute_value'] = $this->language->get('entry_attribute_value');

	    $this->data['button_search'] = $this->language->get('button_search');
	    $this->data['waitload'] = DIR_TEMPLATE."image/ajax_load.gif";
	    $this->data['action'] = $this->url->link('product/adsattributes', '', 'SSL');

		$data['filter_language'] = $filter_language;
		$data['filter_category_id'] = $filter_category_id;
		$data['filter_sub_category'] = $filter_sub_category;
		$data['filter_groups'] = $filter_groups;
		$data['filter_attribute'] = $filter_attribute;


		$this->data['languages'] = array();
		$this->data['languages'] = $this->getLanguagesSelect();

		$this->data['categories'] = array();
		$this->data['categories'] = $this->getCategoriesSelect(0);

	     $this->data['groups'] = '';
	    $groups = $this->model_catalog_adsattributes->getGroups($data);

		  $this->data['groups'] .= '<select name="filter_groups" id="filter_groups">';
		  $this->data['groups'] .= '<option value="">' . $this->language->get('text_groups')  . '</option>';
	    foreach ($groups as $group) {
		if (is_array($this->config->get("searchat_att_group")) and in_array($group["attribute_group_id"], $this->config->get("searchat_att_group"))) {

		if(!empty($filter_groups) and $filter_groups==$group['attribute_group_id']) {
		     $this->data['groups'] .= '<option selected value="' . $group['attribute_group_id'] . '">' . $group['name']   . (($this->config->get("searchat_countproduct"))?' (' . $group['countproduct'] . ')':'') . '</option>';
		   } else {
		     $this->data['groups'] .= '<option value="' . $group['attribute_group_id'] . '">' . $group['name']	 . (($this->config->get("searchat_countproduct"))?' (' . $group['countproduct'] . ')':'') . '</option>';
		   }
		}
	    }
	    $this->data['groups'] .= '</select>';



		 $this->data['attributes'] = '';
		$attributes = $this->model_catalog_adsattributes->getAttributes($data);
		  $this->data['attributes'] .= '<select name="filter_attribute" id="filter_attribute">';
		  $this->data['attributes'] .= '<option value="">' . $this->language->get('text_attributes')  . '</option>';

	       foreach ($attributes as $attribute) {
		if (is_array($this->config->get("searchat_att_group")) and in_array($attribute["attribute_group_id"], $this->config->get("searchat_att_group"))) {
		  if(!empty($filter_attribute) and $filter_attribute==$attribute['attribute_id']) {
		     $this->data['attributes'] .= '<option selected value="' . $attribute['attribute_id'] . '">' . $attribute['name']	. (($this->config->get("searchat_countproduct"))?' (' . $attribute['countproduct'] . ')':'') . '</option>';
		   } else {
		      $this->data['attributes'] .= '<option value="' . $attribute['attribute_id'] . '">' . $attribute['name']	. (($this->config->get("searchat_countproduct"))?' (' . $attribute['countproduct'] . ')':'') . '</option>';
		   }
		 }
	       }
	     $this->data['attributes'] .= '</select>';

  //	      var_dump($filter_groups);

		$this->data['filter_name'] = $filter_name;
		$this->data['filter_description'] = $filter_description;
		$this->data['filter_title'] = $filter_title;
		$this->data['filter_author'] = $filter_author;
		$this->data['filter_isbn'] = $filter_isbn;
		$this->data['filter_language'] = $filter_language;
		$this->data['filter_category_id'] = $filter_category_id;
		$this->data['filter_sub_category'] = $filter_sub_category;
		$this->data['filter_pricemin'] = $filter_pricemin;
		$this->data['filter_pricemax'] = $filter_pricemax;
		$this->data['filter_groups'] = $filter_groups;
		$this->data['filter_attribute'] = $filter_attribute;



		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/adsattributes.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/adsattributes.tpl';
		} else {
			$this->template = 'default/template/module/adsattributes.tpl';
		}

		$this->render();
	}


	private function getLanguagesSelect() {
		$data = array();
		$results = $this->model_catalog_adsattributes->getLanguages();

		foreach ($results as $result) {
			$data[] = array(
				'language' => $result['book_language'],
			);
		}
		return $data;
	}

	private function getCategoriesSelect($parent_id, $level = 0) {
		$data = array();
		$results = $this->model_catalog_adsattributes->getCategories($parent_id);

		foreach ($results as $result) {
			$product = array(
				'filter_category_id'  => $result['category_id'],
				'filter_sub_category' => FALSE
			);
			$product_total = $this->model_catalog_adsattributes->getTotalProducts($product);
			$data[] = array(
				'category_id' => $result['category_id'],
				'name'	      => str_repeat('&nbsp;&nbsp;&nbsp;', $level) . '˪ ' . $result['name'] . (($this->config->get("searchat_countproduct"))?' (' . $product_total . ')':'')
			);
			$children = $this->getCategoriesSelect($result['category_id'], $level + 1);
			if ($children) {
			  $data = array_merge($data, $children);
			}
		}
		return $data;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
			$this->load->model('catalog/adsattributes');
			$this->load->model('tool/image');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_title'])) {
				$filter_title = $this->request->get['filter_title'];
			} else {
				$filter_title = '';
			}

			if (isset($this->request->get['filter_author'])) {
				$filter_author = $this->request->get['filter_author'];
			} else {
				$filter_author = '';
			}

			if (isset($this->request->get['filter_isbn'])) {
				$filter_isbn = $this->request->get['filter_isbn'];
			} else {
				$filter_isbn = '';
			}

			if (isset($this->request->get['filter_description'])) {
				$filter_description = $this->request->get['filter_description'];
			} else {
				$filter_description = '';
			}

			$data = array(
				'filter_name'	      => $filter_name,
				'filter_title'	      => $filter_title,
				'filter_author'	      => $filter_author,
				'filter_isbn'	      => $filter_isbn,
				'filter_description'  => $filter_description
			);

			$results = $this->model_catalog_adsattributes->getAutocomplete($data);

			foreach ($results as $result) {
			    if ($result['image']) {
				    $image = $this->model_tool_image->resize($result['image'], 40, 40);
			    } else {
				    $image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			    }
				$json[] = array(
					'name'	     => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'title'      => $result['title'],
					'author'      => $result['author'],
					'isbn'      => $result['isbn'],
					'price'      => $result['price'],
					'image'      => $image
				);
			}
		}

		$this->response->setOutput(json_encode($json));
	}

	public function search() {

		$this->language->load('module/adsattributes');
		$this->load->model('catalog/adsattributes');

		$json = array();

			$data = array(
				'filter_category_id'	     => $this->request->post['filter_category_id'],
				'filter_sub_category'	     => $this->request->post['filter_sub_category'],
				'filter_manufacturer_id'     => isset($this->request->post['filter_manufacturer_id'])? $this->request->post['filter_manufacturer_id']:false,
				'filter_groups' 	     => isset($this->request->post['filter_groups'])? $this->request->post['filter_groups']:false,
			);

			switch ($this->request->post['id']) {
			    case 1:
				    if($this->config->get("searchat_att_group")) {
					$json['groups'] = $this->groups($data);
					$json['attributes'] = $this->attributes($data);
				    }
				break;
			    case 2:
				    if($this->config->get("searchat_att_group")) {
					$json['groups'] = $this->groups($data);
					$json['attributes'] = $this->attributes($data);
				    }
				break;
			    case 3:
				    $json['attributes'] = $this->attributes($data);
				break;
			}

// var_dump($json);
		$this->response->setOutput(json_encode($json));
	}


	private function groups($data) {
	      $output = '';
	    $groups = $this->model_catalog_adsattributes->getGroups($data);

		  $output .= '<option value="">' . $this->language->get('text_groups')	. '</option>';
	    foreach ($groups as $group) {
	      if (is_array($this->config->get("searchat_att_group")) and in_array($group["attribute_group_id"], $this->config->get("searchat_att_group"))) {

		     $output .= '<option value="' . $group['attribute_group_id'] . '">' . $group['name']   . (($this->config->get("searchat_countproduct"))?' (' . $group['countproduct'] . ')':'') . '</option>';
		   }
		}

	   RETURN $output;
	}


	private function attributes($data) {
		  $output = '';
	    $attributes = $this->model_catalog_adsattributes->getAttributes($data);

		  $output .= '<option value="">' . $this->language->get('text_attributes')  . '</option>';

	       foreach ($attributes as $attribute) {
		if (is_array($this->config->get("searchat_att_group")) and in_array($attribute["attribute_group_id"], $this->config->get("searchat_att_group"))) {
		      $output .= '<option value="' . $attribute['attribute_id'] . '">' . $attribute['name']   . (($this->config->get("searchat_countproduct"))?' (' . $attribute['countproduct'] . ')':'') . '</option>';
		   }
	       }

	   RETURN $output;
	}

}
?>

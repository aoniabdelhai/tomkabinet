<?php
class ControllerModuleLatest extends Controller {
	protected function index($setting) {
		$this->language->load('module/latest');
                //Change sponiza, vqmod
                $this->load->model('catalog/author');
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['button_cart'] = $this->language->get('button_cart');
				
		$this->load->model('catalog/product');
		
		$this->load->model('tool/image');
		
		$this->data['products'] = array();
		
		$data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProducts($data);

		foreach ($results as $result) {

                        //Change sponiza vqmod
                        if (EPUB_USE_AMAZON_S3 && $result['image'])
						{
							$image = S3_COVER_URL . 'resized/' . image_resize_name(basename($result['image']), $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
						}
						else if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                                $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                        } else {
                                $image = $this->model_tool_image->resize("data/noimage.jpg", $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                        }

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}
					
			if ((float)$result['special']) {
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$special = false;
			}
			
			if ($this->config->get('config_review_status')) {
				$rating = $result['rating'];
			} else {
				$rating = false;
			}

                        //Change sponiza, to vqmod, line with the authorstring
                        $authorstring = '';
                        if ($result['product_id']) {
                            $authors = $this->model_catalog_author->getAuthorsFromProduct($result['product_id']);
                            $authorstring = $authors['authorstring'];
                        }
			
			$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'thumb'   	 => $image,
				'name'    	 => $result['name'],
				'price'   	 => $price,
				'special' 	 => $special,
				'authorstring' 	 => $authorstring,
				'rating'     => $rating,
				'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/latest.tpl';
		} else {
			$this->template = 'default/template/module/latest.tpl';
		}

		$this->render();
	}
}
?>

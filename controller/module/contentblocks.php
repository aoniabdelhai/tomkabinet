<?php
/*
 * @copyright Copyright (c) Shilovsky Andrej (an911@ukr.net)
 * http://quartzstore.com
 */
class ControllerContentBlocks extends Controller {
	protected function index($module) {
	    
	}

	public function getAuthorEbooks($authorid) {
                $this->load->model('catalog/product');	
                $this->load->model('catalog/author');	
		$data = array();
		$results = $this->model_catalog_product->getDisplayProductsByAuthorId($authorid);

		foreach ($results as $result) {
                        $authors = $this->model_catalog_author->getAuthorsFromProduct($result['product_id']);
			$data[] = array(
				'productid' => $result['product_id'],
                                'price' => $result['price'],
                                'title' => $result['title'],
                                'authorstring' => $authors['authorstring']
			);
		}
		return $data;
	}

	public function getSellerEbooks($sellerid) {
                $this->load->model('catalog/product');	
                $this->load->model('catalog/author');	
                
		$data = array();
		$products = $this->MsLoader->MsProduct->getProducts(
			array(
				'seller_id' => $sellerid,
				'language_id' => $this->config->get('config_language_id'),
				'product_status' => array(MsProduct::STATUS_ACTIVE)
			),
			array(
				'order_by'	=> 'pd.name',
				'order_way'	=> 'ASC',
				'offset'	=> 0,
				'limit'		=> 5
			)
		);
                
                foreach ($products as $product) {
                        $authors = $this->model_catalog_author->getAuthorsFromProduct($product['product_id']);
			$data[] = array(
				'productid' => $result['product_id'],
                                'price' => $result['p.price'],
                                'title' => $result['pd.name'],
                                'authorstring' => $authors['authorstring']
			);
		}
                
		return $data;
	}
        
        public function getCategoryEbooks($category_id) {
                $this->load->model('catalog/product');	
                
		$this->data['products'] = array();

		$data = array(
			'filter_category_id' => $category_id,
		);

		$results = $this->model_catalog_product->getProducts($data);
                foreach ($results as $result) {
			$data[] = array(
				'productid' => $result['product_id'],
                                'price' => $result['price'],
                                'title' => $result['title'],
                                'authorstring' => $result['authorstring']
			);
		}        
		return $data;
	}

}

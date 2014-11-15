<?php
class ControllerModuleTopAuthor extends Controller {
	protected function index($setting) {
		$this->language->load('module/top_author'); 

      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_total'] = $this->language->get('text_total');
		$this->data['text_sales'] = $this->language->get('text_sales');
		$this->data['text_more'] = $this->language->get('text_more');
		
		$this->load->model('catalog/author'); 
		
		$this->load->model('tool/image');
		
		$this->data['position'] = $setting['position'];
		
		$this->data['authors'] = array();

		$top_authors = $this->model_catalog_author->getTopAuthors($setting['limit']);
		
		foreach ($top_authors as $result) {
			$total_sales = $this->model_catalog_author->getTotalSalesByAuthorId($result['author_id']);
			
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', $setting['image_width'], $setting['image_height']);
			}
			
			$this->data['authors'][] = array(
				'author_id' 	=> $result['author_id'],
				'thumb'   	 	=> $image,
				'name'    	 	=> $result['name'],
				'sales'			=> $total_sales .' '. $this->data['text_sales'],
				'description' 	=> utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
				'href'    	 	=> $this->url->link('product/author', 'author_id=' . $result['author_id'])
			);
			
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/top_author.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/top_author.tpl';
		} else {
			$this->template = 'default/template/module/top_author.tpl';
		}

		$this->render();
	}
}
?>
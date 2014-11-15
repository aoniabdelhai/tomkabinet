<?php
require_once(DIR_SYSTEM . 'helper/amazon/S3.php');

class ControllerAccountDownload extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/download', '', 'SSL');

			$this->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->language->load('account/download');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),        	
			'separator' => false
		);

                //Change sponiza, vqmod
                $linkhref = $this->url->link('account/account', '', 'SSL');
                if ($this->MsLoader->MsSeller->isCustomerSeller($this->customer->getId())) {
                   $linkhref = $this->url->link('seller/account-dashboard', '', 'SSL');
                }

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_account'),
			'href'      => $linkhref,
			'separator' => $this->language->get('text_separator')
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_downloads'),
			'href'      => $this->url->link('account/download', '', 'SSL'),       	
			'separator' => $this->language->get('text_separator')
		);

		$this->load->model('account/download');
		$this->load->model('account/order');

		$download_total = $this->model_account_download->getTotalDownloads();

		if ($download_total) {
			$this->data['heading_title'] = $this->language->get('heading_title');

			$this->data['text_order'] = $this->language->get('text_order');
			$this->data['text_date_added'] = $this->language->get('text_date_added');
			$this->data['text_product'] = $this->language->get('text_product');
			$this->data['text_name'] = $this->language->get('text_name');
			$this->data['text_remaining'] = $this->language->get('text_remaining');
			$this->data['text_size'] = $this->language->get('text_size');

			$this->data['button_download'] = $this->language->get('button_download');
			$this->data['button_continue'] = $this->language->get('button_continue');

			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}			

			$this->data['downloads'] = array();

			$results = $this->model_account_download->getDownloads(($page - 1) * $this->config->get('config_catalog_limit'), $this->config->get('config_catalog_limit'));

			foreach ($results as $result) {
				
				// @edit maarten@rdrd.nl removed file_exists check because epubs are stored on amazon S3
				//if (file_exists(DIR_DOWNLOAD . $result['filename'])) {
				if (true) {
					/*
					$size = filesize(DIR_DOWNLOAD . $result['filename']);

					$i = 0;

					$suffix = array(
						'B',
						'KB',
						'MB',
						'GB',
						'TB',
						'PB',
						'EB',
						'ZB',
						'YB'
					);

					while (($size / 1024) > 1) {
						$size = $size / 1024;
						$i++;
					}
					*/
					# GET PRODUCT NAME FROM ORDER
					$product = $this->model_account_order->getOrderProduct($result['order_id'],$result['order_product_id']);
					

					$this->data['downloads'][] = array(
						'order_id'   => $result['order_id'],
						'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
						'product'    => $product['name'],
						'name'       => $result['name'],
						'remaining'  => $result['remaining'],
						//'size'       => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
						'href'       => $this->url->link('account/download/download', 'order_download_id=' . $result['order_download_id'], 'SSL')
					);
				}
			}

			$pagination = new Pagination();
			$pagination->total = $download_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_catalog_limit');
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('account/download', 'page={page}', 'SSL');

			$this->data['pagination'] = $pagination->render();

			$this->data['continue'] = $this->url->link('account/account', '', 'SSL');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/download.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/account/download.tpl';
			} else {
				$this->template = 'default/template/account/download.tpl';
			}

			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'		
			);

			$this->response->setOutput($this->render());				
		} else {
			
			$this->data['heading_title'] = $this->language->get('heading_title');
			$this->data['text_error'] = $this->language->get('text_empty');
			$this->data['button_continue'] = $this->language->get('button_continue');
			$this->data['continue'] = $this->url->link('account/account', '', 'SSL');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . '/1.1 404 Not Found');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}

			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'		
			);

			$this->response->setOutput($this->render());
		}
	}

	public function download() {
		/*
		// @temp for local development
		$this->load->model('checkout/order');
		$this->model_checkout_order->confirm(634, $this->config->get('sisowideal_status_success'));
		die();
		*/
		
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/download', '', 'SSL');

			$this->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->model('account/download');

		if (isset($this->request->get['order_download_id'])) {
			$order_download_id = $this->request->get['order_download_id'];
		} else {
			$order_download_id = 0;
		}

		$download_info = $this->model_account_download->getDownload($order_download_id);

		if ($download_info) {
			$file = DIR_DOWNLOAD . $download_info['filename'];
			$mask = basename($download_info['mask']);
			
			$this->model_account_download->updateRemaining($this->request->get['order_download_id']);
			
			if (!headers_sent()) {
				
				//session_cache_limiter('public');
				//header('Cache-Control: public, max-age=3');
				
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="' . ($mask ? $mask : basename($file)) . '"');
				// header('Expires: 0');
				// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				// header('Pragma: public');
				// header('Content-Length: ' . filesize($file));
				
				//if (ob_get_level()) ob_end_clean();
				
				if (true === EPUB_USE_AMAZON_S3)
				{
					S3::setAuth(S3_ACCESS_KEY, S3_SECRET_KEY);
					S3::getObject(S3_BUCKET, 'epubs/' . $download_info['filename'], fopen('php://output', 'wb'));
					
					exit;
				}
				else if (file_exists($file))
				{
					readfile($file, 'rb');
					
					exit;
				} else {
					exit('Error: Could not find file ' . $file . '!');
				}
			} else {
				exit('Error: Headers already sent out!');
			}
		} else {
			$this->redirect($this->url->link('account/download', '', 'SSL'));
		}
	}
}
?>

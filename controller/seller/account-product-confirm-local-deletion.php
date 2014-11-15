<?php
class ControllerSellerAccountProductConfirmLocalDeletion extends ControllerSellerAccount {
	public function index() {
		$this->load->language('account/account');
		$this->data['link_back'] = $this->url->link('seller/account-product-confirm-local-deletion', '', 'SSL');
		
		$this->document->setTitle($this->language->get('ms_account_orders_heading'));
		
		$this->data['breadcrumbs'] = $this->MsLoader->MsHelper->setBreadcrumbs(array(
                        //Change sponiza, first breadcrumb can be removed
			//array(
				//'text' => $this->language->get('text_account'),
				//'href' => $this->url->link('account/account', '', 'SSL'),
			//),
			array(
				'text' => $this->language->get('ms_account_dashboard_breadcrumbs'),
				'href' => $this->url->link('seller/account-dashboard', '', 'SSL'),
			),			
			array(
				'text' => $this->language->get('ms_account_orders_breadcrumbs'),
				'href' => $this->url->link('seller/account-product-confirm-local-deletion', '', 'SSL'),
			)
		));

		$seller = $this->MsLoader->MsSeller->getSeller($this->customer->getId());

		if (!($this->customer->isLogged() && isset($this->request->get['productid']) && !empty($this->request->get['productid']) && $this->MsLoader->MsProduct->productOwnedBySeller($this->request->get['productid'], $this->customer->getId()))) {
			$this->redirect($this->url->link('seller/account-product', '', 'SSL'));
		}

		$downloads = $this->MsLoader->MsProduct->getProductDownloads($this->request->get['productid']);
		$downloads_to_confirm = array();

		foreach ($downloads as $download) {
			$downloads_to_confirm[] = $download['mask'];
		}

		$this->data['downloads_to_confirm'] = $downloads_to_confirm;
		$this->data['product_form_id'] = $this->request->get['productid'];
		$this->data['action_submit'] = $this->url->link('seller/account-product-confirm-local-deletion/confirmDeletion', '', 'SSL');

		if (isset($this->session->data['confirm_deletion_error'])) {
			$this->data['confirm_deletion_error'] = $this->session->data['confirm_deletion_error'];
			unset($this->session->data['confirm_deletion_error']);
		}
		
		list($this->template, $this->children) = $this->MsLoader->MsHelper->loadTemplate('account-product-confirm-local-deletion');

		$this->response->setOutput($this->render());
	}

	public function confirmDeletion() {
		$this->load->model('module/confirmdelete');

		if (!($this->customer->isLogged() && isset($this->request->post['product_id']) && !empty($this->request->post['product_id']) && $this->MsLoader->MsProduct->productOwnedBySeller($this->request->post['product_id'], $this->customer->getId()))) {
			$this->redirect($this->url->link('seller/account-product', '', 'SSL'));
		}

		if (isset($this->request->post['confirmed']) && $this->request->post['confirmed'] == "Yes") {
			$this->model_module_confirmdelete->confirmDeletion((int) $this->request->post['product_id']);
			$this->MsLoader->MsProduct->changeStatus((int) $this->request->post['product_id'], MsProduct::STATUS_ACTIVE);
			$this->redirect($this->url->link('seller/account-product', '', 'SSL'));
		} else {
			$this->session->data['confirm_deletion_error'] = 'noconfirm';
			$this->redirect($this->url->link('seller/account-product-confirm-local-deletion', 'productid=' . $this->request->post['product_id'], 'SSL'));
		}
	}
}
?>

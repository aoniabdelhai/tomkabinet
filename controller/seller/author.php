<?php
class ControllerSellerAuthor extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('catalog/author');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author');

        $this->getList();
    }

    public function insert() {
        $this->language->load('catalog/author');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_author->addAuthor($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('catalog/author', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('catalog/author');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_author->editAuthor($this->request->get['author_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('catalog/author', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('catalog/author');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $author_id) {
                $this->model_catalog_author->deleteAuthor($author_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('catalog/author', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->getList();
    }

    private function getList() {
        $this->language->load('catalog/author');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/author', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('catalog/author/insert', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['delete'] = $this->url->link('catalog/author/delete', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['authors'] = array();

        $results = $this->model_catalog_author->getAuthors();

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('catalog/author/update', 'token=' . $this->session->data['token'] . '&author_id=' . $result['author_id'], 'SSL')
            );

            $this->data['authors'][] = array(
                'author_id'   => $result['author_id'],
                'name'        => $result['name'],
                'sort_order'  => $result['sort_order'],
                'selected'    => isset($this->request->post['selected']) && in_array($result['author_id'], $this->request->post['selected']),
                'action'      => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_sort_order'] = $this->language->get('column_sort_order');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_insert'] = $this->language->get('button_insert');
        $this->data['button_delete'] = $this->language->get('button_delete');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->template = 'catalog/author_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );

        $this->response->setOutput($this->render());
    }

    private function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');

        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
        $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_store'] = $this->language->get('entry_store');
        $this->data['entry_keyword'] = $this->language->get('entry_keyword');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_top'] = $this->language->get('entry_top');
        $this->data['entry_column'] = $this->language->get('entry_column');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_layout'] = $this->language->get('entry_layout');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');
        $this->data['tab_design'] = $this->language->get('tab_design');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = array();
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/author', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['author_id'])) {
            $this->data['action'] = $this->url->link('catalog/author/insert', 'token=' . $this->session->data['token'], 'SSL');
        } else {
            $this->data['action'] = $this->url->link('catalog/author/update', 'token=' . $this->session->data['token'] . '&author_id=' . $this->request->get['author_id'], 'SSL');
        }

        $this->data['cancel'] = $this->url->link('catalog/author', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->request->get['author_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $author_info = $this->model_catalog_author->getAuthor($this->request->get['author_id']);
        }

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['author_description'])) {
            $this->data['author_description'] = $this->request->post['author_description'];
        } elseif (isset($author_info)) {
            $this->data['author_description'] = $this->model_catalog_author->getAuthorDescriptions($this->request->get['author_id']);
        } else {
            $this->data['author_description'] = array();
        }

        $authors = $this->model_catalog_author->getAuthors();

        // Remove own id from list
        if (isset($author_info)) {
            foreach ($authors as $key => $author) {
                if ($author['author_id'] == $author_info['author_id']) {
                    unset($authors[$key]);
                }
            }
        }

        $this->data['authors'] = $authors;

        $this->load->model('setting/store');

        $this->data['stores'] = $this->model_setting_store->getStores();

        if (isset($this->request->post['author_store'])) {
            $this->data['author_store'] = $this->request->post['author_store'];
        } elseif (isset($author_info)) {
            $this->data['author_store'] = $this->model_catalog_author->getAuthorStores($this->request->get['author_id']);
        } else {
            $this->data['author_store'] = array(0);
        }

        if (isset($this->request->post['keyword'])) {
            $this->data['keyword'] = $this->request->post['keyword'];
        } elseif (isset($author_info)) {
            $this->data['keyword'] = $author_info['keyword'];
        } else {
            $this->data['keyword'] = '';
        }

        if (isset($this->request->post['image'])) {
            $this->data['image'] = $this->request->post['image'];
        } elseif (isset($author_info)) {
            $this->data['image'] = $author_info['image'];
        } else {
            $this->data['image'] = '';
        }

       $this->load->model('tool/image');

		if (!empty($author_info) && $author_info['image'] && file_exists(DIR_IMAGE . $author_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($author_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);


        if (isset($this->request->post['sort_order'])) {
            $this->data['sort_order'] = $this->request->post['sort_order'];
        } elseif (isset($author_info)) {
            $this->data['sort_order'] = $author_info['sort_order'];
        } else {
            $this->data['sort_order'] = 0;
        }

        if (isset($this->request->post['status'])) {
            $this->data['status'] = $this->request->post['status'];
        } elseif (isset($author_info)) {
            $this->data['status'] = $author_info['status'];
        } else {
            $this->data['status'] = 1;
        }

        if (isset($this->request->post['author_layout'])) {
            $this->data['author_layout'] = $this->request->post['author_layout'];
        } elseif (isset($author_info)) {
            $this->data['author_layout'] = $this->model_catalog_author->getAuthorLayouts($this->request->get['author_id']);
        } else {
            $this->data['author_layout'] = array();
        }

        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();

        $this->template = 'catalog/author_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );

        $this->response->setOutput($this->render());
    }

    private function validateForm() {
        if (!$this->user->hasPermission('modify', 'catalog/author')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['author_description'] as $language_id => $value) {
            if ((strlen(utf8_decode($value['name'])) < 2) || (strlen(utf8_decode($value['name'])) > 255)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    private function validateDelete() {
        if (!$this->user->hasPermission('modify', 'catalog/author')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->post['filter_name'])) {
            $this->load->model('catalog/author');

            $data = array(
                'filter_name' => $this->request->post['filter_name'],
                'start'       => 0,
                'limit'       => 20
            );

            $results = $this->model_catalog_author->getAuthors($data);

            foreach ($results as $result) {
                $json[] = array(
                    'author_id'     => $result['author_id'],
                    'author_name'   => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')
                );
            }

        }

        $this->response->setOutput(json_encode($json));
    }
}
?>

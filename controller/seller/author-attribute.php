<?php
class ControllerSellerAuthorAttribute extends Controller {
    private $error = array();

    public function index() {
        $this->language->load('catalog/author_attribute');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author_attribute');

        $this->getList();
    }

    public function insert() {
        $this->language->load('catalog/author_attribute');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author_attribute');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_author_attribute->addAuthorAttribute($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/author_attribute', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function update() {
        $this->language->load('catalog/author_attribute');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author_attribute');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_author_attribute->editAuthorAttribute($this->request->get['author_attribute_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/author_attribute', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->language->load('catalog/author_attribute');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/author_attribute');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $author_attribute_id) {
                $this->model_catalog_author_attribute->deleteAuthorAttribute($author_attribute_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/author_attribute', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    private function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'name';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/author_attribute', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('catalog/author_attribute/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('catalog/author_attribute/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['author_attributes'] = array();

        $data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $author_attribute_total = $this->model_catalog_author_attribute->getTotalAuthorAttributes();

        $results = $this->model_catalog_author_attribute->getAuthorsAttribute($data);

        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('catalog/author_attribute/update', 'token=' . $this->session->data['token'] . '&author_attribute_id=' . $result['author_attribute_id'] . $url, 'SSL')
            );

            $this->data['author_attributes'][] = array(
                'author_attribute_id' => $result['author_attribute_id'],
                'name'                => $result['name'],
                'selected'            => isset($this->request->post['selected']) && in_array($result['author_attribute_id'], $this->request->post['selected']),
                'action'              => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_name'] = $this->language->get('column_name');
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

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['sort_name'] = $this->url->link('catalog/author_attribute', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $author_attribute_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('catalog/author_attribute', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'catalog/author_attribute_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );

        $this->response->setOutput($this->render());
    }

    private function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');

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

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('catalog/author_attribute', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['author_attribute_id'])) {
            $this->data['action'] = $this->url->link('catalog/author_attribute/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('catalog/author_attribute/update', 'token=' . $this->session->data['token'] . '&author_attribute_id=' . $this->request->get['author_attribute_id'] . $url, 'SSL');
        }

        $this->data['cancel'] = $this->url->link('catalog/author_attribute', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['author_attribute'])) {
            $this->data['author_attribute'] = $this->request->post['author_attribute'];
        } elseif (isset($this->request->get['author_attribute_id'])) {
            $this->data['author_attribute'] = $this->model_catalog_author_attribute->getAuthorAttributeDescriptions($this->request->get['author_attribute_id']);
        } else {
            $this->data['author_attribute'] = array();
        }

        $this->template = 'catalog/author_attribute_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );

        $this->response->setOutput($this->render());
    }

    private function validateForm() {
        if (!$this->user->hasPermission('modify', 'catalog/author_attribute')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['author_attribute'] as $language_id => $value) {
            if ((strlen(utf8_decode($value['name'])) < 3) || (strlen(utf8_decode($value['name'])) > 32)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    private function validateDelete() {
        if (!$this->user->hasPermission('modify', 'catalog/author_attribute')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('catalog/product');

        foreach ($this->request->post['selected'] as $author_attribute_id) {

            $product_total = $this->model_catalog_product->getTotalProductsByAuthorAttributeId($author_attribute_id);

            if ($product_total) {
                $this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
            }
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
            $this->load->model('catalog/author_attribute');

            $data = array(
                'filter_name' => $this->request->post['filter_name'],
                'start'       => 0,
                'limit'       => 20
            );

            $results = $this->model_catalog_author_attribute->getAuthorsAttribute($data);

            foreach ($results as $result) {
                $json[] = array(
                    'author_attribute_id'     => $result['author_attribute_id'],
                    'author_attribute_name'   => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')
                );
            }

        }

       $this->response->setOutput(json_encode($json));
    }
}
?>

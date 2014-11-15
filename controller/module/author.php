<?php
class ControllerModuleAuthor extends Controller {
    protected function index() {
        $this->language->load('module/author');

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['text_select'] = $this->language->get('text_select');

        if (isset($this->request->get['author_id'])) {
            $this->data['author_id'] = $this->request->get['author_id'];
        } else {
            $this->data['author_id'] = 0;
        }

        $this->load->model('catalog/author');

        $this->data['authors'] = array();

        $authors = $this->model_catalog_author->getAuthors();

        foreach ($authors as $author) {

            $this->data['authors'][] = array(
                'author_id'   => $author['author_id'],
                'name'        => $author['name'],
                'href'        => $this->url->link('product/author', 'author_id=' . $author['author_id'])
            );
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/author.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/author.tpl';
        } else {
            $this->template = 'default/template/module/author.tpl';
        }

        $this->render();
    }
}
?>
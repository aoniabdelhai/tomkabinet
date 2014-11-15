<?php
class ControllerProductAuthor extends Controller {
    public function index() {
        $this->language->load('product/author');

        $this->load->model('catalog/author');

        $this->load->model('catalog/product');

        $this->load->model('tool/image');

        if (isset($this->request->get['author_id'])) {
            $author_id = $this->request->get['author_id'];
        } else {
            $author_id = 0;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.sort_order';
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

        if (isset($this->request->get['limit'])) {
            $limit = $this->request->get['limit'];
        } else {
            $limit = $this->config->get('config_catalog_limit');
        }

		$this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
        );

		$author_info = $this->model_catalog_author->getAuthor($author_id);

        if ($author_info) {
            $this->document->setTitle($author_info['name']);
            $this->document->setDescription($author_info['meta_description']);
            $this->document->setKeywords($author_info['meta_keyword']);
			$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');

            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_title'),
                'href'      => $this->url->link('product/author'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['breadcrumbs'][] = array(
                'text'      => $author_info['name'],
                'href'      => $this->url->link('product/author', 'author_id=' .  $author_info['author_id']),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['heading_title'] = $author_info['name'];

            $this->data['text_empty'] = $this->language->get('text_empty');
            $this->data['text_tax'] = $this->language->get('text_tax');
            $this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
            $this->data['text_display'] = $this->language->get('text_display');
            $this->data['text_list'] = $this->language->get('text_list');
            $this->data['text_grid'] = $this->language->get('text_grid');
            $this->data['text_sort'] = $this->language->get('text_sort');
            $this->data['text_limit'] = $this->language->get('text_limit');

            $this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['button_wishlist'] = $this->language->get('button_wishlist');
            $this->data['button_compare'] = $this->language->get('button_compare');
            $this->data['button_continue'] = $this->language->get('button_continue');

            if ($author_info['image']) {
                $this->data['thumb'] = $this->model_tool_image->resize($author_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
            } else {
                $this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
            }

            $this->data['description'] = html_entity_decode($author_info['description'], ENT_QUOTES, 'UTF-8');
            $this->data['compare'] = $this->url->link('product/compare');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['products'] = array();

            $data = array(
                'filter_author_id'   => $author_id,
                'sort'               => $sort,
                'order'              => $order,
                'start'              => ($page - 1) * $limit,
                'limit'              => $limit
            );

            $product_total = $this->model_catalog_product->getTotalProducts($data);

            $results = $this->model_catalog_product->getProducts($data);

            foreach ($results as $result) {
                if (EPUB_USE_AMAZON_S3 && $result['image'])
                {
                    $image = S3_COVER_URL . 'resized/' . image_resize_name(basename($result['image']), $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                }
                else if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                } else {
                    $image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
                } else {
                    $tax = false;
                }

                if ($this->config->get('config_review_status')) {
                    $rating = (int)$result['rating'];
                } else {
                    $rating = false;
                }

                $this->data['products'][] = array(
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'name'        => $result['name'],
                    'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
                    'price'       => $price,
                    'special'     => $special,
                    'tax'         => $tax,
                    'rating'      => $result['rating'],
                    'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                    'href'        => $this->url->link('product/product', 'author_id=' . $this->request->get['author_id'] . '&product_id=' . $result['product_id'])
                );
            }

            $url = '';

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $this->data['sorts'] = array();

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_default'),
                'value' => 'p.sort_order-ASC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=p.sort_order&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_name_asc'),
                'value' => 'pd.name-ASC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=pd.name&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_name_desc'),
                'value' => 'pd.name-DESC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=pd.name&order=DESC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_price_asc'),
                'value' => 'p.price-ASC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=p.price&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_price_desc'),
                'value' => 'p.price-DESC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=p.price&order=DESC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_rating_desc'),
                'value' => 'rating-DESC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=rating&order=DESC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_rating_asc'),
                'value' => 'rating-ASC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=rating&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_model_asc'),
                'value' => 'p.model-ASC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=p.model&order=ASC' . $url)
            );

            $this->data['sorts'][] = array(
                'text'  => $this->language->get('text_model_desc'),
                'value' => 'p.model-DESC',
                'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . '&sort=p.model&order=DESC' . $url)
            );

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            $this->data['limits'] = array();
	
			$limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));
			
			sort($limits);
	
			foreach($limits as $limits){
				$this->data['limits'][] = array(
					'text'  => $limits,
					'value' => $limits,
					'href'  => $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . $url . '&limit=' . $limits)
				);
			}
			
            $url = '';
			
			if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $pagination = new Pagination();
            $pagination->total = $product_total;
            $pagination->page = $page;
            $pagination->limit = $limit;
            $pagination->text = $this->language->get('text_pagination');
            $pagination->url = $this->url->link('product/author', 'author_id=' . $this->request->get['author_id'] . $url . '&page={page}');

            $this->data['pagination'] = $pagination->render();

            $this->data['sort'] = $sort;
            $this->data['order'] = $order;
            $this->data['limit'] = $limit;

            $this->data['continue'] = $this->url->link('common/home');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/author.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/product/author.tpl';
            } else {
                $this->template = 'default/template/product/author.tpl';
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
        } elseif (!isset($this->request->get['author_id'])) {

            $this->document->setTitle($this->language->get('heading_title'));

            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_title'),
                'href'      => $this->url->link('product/author'),
                'separator' => $this->language->get('text_separator')
            );

            $this->data['heading_title'] = $this->language->get('heading_title');

            $this->data['text_empty'] = $this->language->get('text_empty');
            $this->data['text_index'] = $this->language->get('text_index');

            $this->data['categories'] = array();

            $results = $this->model_catalog_author->getAuthors();

            foreach ($results as $result) {
                if (is_int(substr($result['name'], 0, 1))) {
                    $key = '0 - 9';
                } else {
                    $key = utf8_substr(utf8_strtoupper($result['name']), 0, 1);
                }

                if (!isset($this->data['authors'][$key])) {
                    $this->data['categories'][$key]['name'] = $key;
                }

                $this->data['categories'][$key]['author'][] = array(
                    'name' => $result['name'],
                    'href' => $this->url->link('product/author', 'author_id=' . $result['author_id'])
                );
            }

            $this->data['continue'] = $this->url->link('common/home');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/author_list.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/product/author_list.tpl';
            } else {
                $this->template = 'default/template/product/author_list.tpl';
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
            $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_error'),
                'href'      => $this->url->link('product/author', 'author_id=' . $author_id),
                'separator' => $this->language->get('text_separator')
            );

            $this->document->setTitle($this->language->get('text_error'));

            $this->data['heading_title'] = $this->language->get('text_error');

            $this->data['text_error'] = $this->language->get('text_error');

            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->data['continue'] = $this->url->link('common/home');

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
}
?>
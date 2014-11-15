<?php

class ControllerProductAdsattributes extends Controller
{

    public function index()
    {
        $this->language->load('product/adsattributes');

        $this->load->model('catalog/adsattributes');
        //Change sponiza, vqmod
        //Also changed ... for each filter_name the reading of the search parameter in the form
        $this->load->model('catalog/author');
        $this->load->model('tool/image');

        $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');

        if (isset($this->request->post['keyword']))
        {
            $this->document->setTitle($this->language->get('heading_title') . ' - ' . $this->request->get['keyword']);
        } else
        {
            $this->document->setTitle($this->language->get('heading_title'));
        }


        $quicksearch = false;

        if (isset($_REQUEST['search']))
        {
            $filter_name = $_REQUEST['search'];
            $filter_title = $filter_name;
            $filter_author = $filter_name;

            $this->request->post['filter_title'] = $filter_name;

            $quicksearch = true;
        } else
        {
            $filter_name = '';
        }


        if (isset($this->request->post['filter_name']))
        {
            $filter_name = $this->request->post['filter_name'];
        }

        if (isset($this->request->post['filter_description']))
        {
            $filter_description = $this->request->post['filter_description'];
        } else
        {
            $filter_description = '';
        }


        if ($quicksearch == false)
        {

            if (isset($this->request->post['filter_title']))
            {
                $filter_title = $this->request->post['filter_title'];
            } else
            {
                $filter_title = '';
            }

            if (isset($this->request->post['filter_author']))
            {
                $filter_author = $this->request->post['filter_author'];
            } else
            {
                $filter_author = '';
            }
        }


        if (isset($this->request->post['filter_isbn']))
        {
            $filter_isbn = $this->request->post['filter_isbn'];
        } else
        {
            $filter_isbn = '';
        }

        if (isset($this->request->post['filter_tag']))
        {
            $filter_tag = $this->request->post['filter_tag'];
        } else
        {
            $filter_tag = '';
        }

        if (isset($this->request->post['filter_manufacturer_id']))
        {
            $filter_manufacturer_id = $this->request->post['filter_manufacturer_id'];
        } else
        {
            $filter_manufacturer_id = '';
        }

        if (isset($this->request->post['filter_language']))
        {
            $filter_language = $this->request->post['filter_language'];
        } else
        {
            $filter_language = '';
        }

        if (isset($this->request->post['filter_category_id']))
        {
            $filter_category_id = $this->request->post['filter_category_id'];
        } else
        {
            $filter_category_id = 0;
        }

        if (isset($this->request->post['filter_sub_category']))
        {
            $filter_sub_category = $this->request->post['filter_sub_category'];
        } else
        {
            $filter_sub_category = '';
        }

        if (isset($this->request->post['filter_pricemin']))
        {
            $filter_pricemin = $this->request->post['filter_pricemin'];
        } else
        {
            $filter_pricemin = '';
        }

        if (isset($this->request->post['filter_pricemax']))
        {
            $filter_pricemax = $this->request->post['filter_pricemax'];
        } else
        {
            $filter_pricemax = '';
        }

        if (isset($this->request->post['filter_groups']))
        {
            $filter_groups = $this->request->post['filter_groups'];
        } else
        {
            $filter_groups = '';
        }

        if (isset($this->request->post['filter_attribute']))
        {
            $filter_attribute = $this->request->post['filter_attribute'];
        } else
        {
            $filter_attribute = '';
        }


        if (isset($this->request->post['sort']))
        {
            $sort = $this->request->post['sort'];
        } else
        {
            $sort = 'p.sort_order';
        }

        if (isset($this->request->post['order']))
        {
            $order = $this->request->post['order'];
        } else
        {
            $order = 'ASC';
        }

        if (isset($this->request->post['page']))
        {
            $page = $this->request->post['page'];
        } else
        {
            $page = 1;
        }

        if (isset($this->request->post['limit']))
        {
            $limit = $this->request->post['limit'];
        } else
        {
            //$limit = $this->config->get('config_catalog_limit');
            $limit = 180;
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home'),
            'separator' => false
        );

        $url = '';

        if (isset($this->request->post['search']))
        {
            $url .= '&filter_name=' . $this->request->post['search'];
        }

        if (isset($this->request->post['filter_name']))
        {
            $url .= '&filter_name=' . $this->request->post['filter_name'];
        }

        if (isset($this->request->post['filter_title']))
        {
            $url .= '&filter_title=' . $this->request->post['filter_title'];
        }

        if (isset($this->request->post['filter_author']))
        {
            $url .= '&filter_author=' . $this->request->post['filter_author'];
        }

        if (isset($this->request->post['filter_isbn']))
        {
            $url .= '&filter_isbn=' . $this->request->post['filter_isbn'];
        }

        if (isset($this->request->post['filter_tag']))
        {
            $url .= '&filter_tag=' . $this->request->post['filter_tag'];
        }

        if (isset($this->request->post['filter_description']))
        {
            $url .= '&filter_description=' . $this->request->post['filter_description'];
        }

        if (isset($this->request->post['filter_language']))
        {
            $url .= '&filter_language=' . $this->request->post['filter_language'];
        }

        if (isset($this->request->post['filter_category_id']))
        {
            $url .= '&filter_category_id=' . $this->request->post['filter_category_id'];
        }

        if (isset($this->request->post['filter_sub_category']))
        {
            $url .= '&filter_sub_category=' . $this->request->post['filter_sub_category'];
        }

        if (isset($this->request->post['filter_pricemin']))
        {
            $url .= '&filter_pricemin=' . $this->request->post['filter_pricemin'];
        }

        if (isset($this->request->post['filter_pricemax']))
        {
            $url .= '&filter_pricemax=' . $this->request->post['filter_pricemax'];
        }

        if (isset($this->request->post['filter_groups']))
        {
            $url .= '&filter_groups=' . $this->request->post['filter_groups'];
        }

        if (isset($this->request->post['filter_attribute']))
        {
            $url .= '&filter_attribute=' . $this->request->post['filter_attribute'];
        }

        if (isset($this->request->post['sort']))
        {
            $url .= '&sort=' . $this->request->post['sort'];
        }

        if (isset($this->request->post['order']))
        {
            $url .= '&order=' . $this->request->post['order'];
        }

        if (isset($this->request->post['page']))
        {
            $url .= '&page=' . $this->request->post['page'];
        }

        if (isset($this->request->post['limit']))
        {
            $url .= '&limit=' . $this->request->post['limit'];
        }

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('product/adsattributes', $url),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_empty'] = $this->language->get('text_empty');
        $this->data['text_critea'] = $this->language->get('text_critea');
        $this->data['text_search'] = $this->language->get('text_search');
        $this->data['text_keyword'] = $this->language->get('text_keyword');
        $this->data['text_category'] = $this->language->get('text_category');
        $this->data['text_sub_category'] = $this->language->get('text_sub_category');
        $this->data['text_quantity'] = $this->language->get('text_quantity');
        $this->data['text_title'] = $this->language->get('text_title');
        $this->data['text_author'] = $this->language->get('text_author');
        $this->data['text_isbn'] = $this->language->get('text_isbn');
        $this->data['text_price'] = $this->language->get('text_price');
        $this->data['text_tax'] = $this->language->get('text_tax');
        $this->data['text_points'] = $this->language->get('text_points');
        $this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
        $this->data['text_display'] = $this->language->get('text_display');
        $this->data['text_list'] = $this->language->get('text_list');
        $this->data['text_grid'] = $this->language->get('text_grid');
        $this->data['text_sort'] = $this->language->get('text_sort');
        $this->data['text_limit'] = $this->language->get('text_limit');

        $this->data['entry_search'] = $this->language->get('entry_search');
        $this->data['entry_description'] = $this->language->get('entry_description');

        $this->data['button_search'] = $this->language->get('button_search');
        $this->data['button_cart'] = $this->language->get('button_cart');
        $this->data['button_wishlist'] = $this->language->get('button_wishlist');
        $this->data['button_compare'] = $this->language->get('button_compare');

        $this->data['action'] = $this->url->link('product/adsattributes', '', 'SSL');
        $this->data['compare'] = $this->url->link('product/compare');


        $this->data['products'] = array();

        if (
                isset($this->request->post['filter_name']) ||
                isset($this->request->post['search']) ||
                isset($this->request->post['filter_title']) ||
                isset($this->request->post['filter_author']) ||
                isset($this->request->post['filter_isbn']) ||
                isset($this->request->post['filter_language']) ||
                isset($this->request->post['filter_category_id']) ||
                isset($this->request->post['filter_manufacturer_id']) ||
                isset($this->request->post['filter_sub_category']) ||
                isset($this->request->post['filter_pricemin']) ||
                isset($this->request->post['filter_pricemax']) ||
                isset($this->request->post['filter_description']) ||
                isset($this->request->post['filter_groups']) ||
                isset($this->request->post['filter_attribute']))
        {

            $this->data['heading_title'] = $this->language->get('text_search');

            $data = array(
                'filter_name' => $filter_name,
                'filter_title' => $filter_title,
                'filter_author' => $filter_author,
                'filter_isbn' => $filter_isbn,
                'filter_tag' => $filter_tag,
                'filter_manufacturer_id' => $filter_manufacturer_id,
                'filter_language' => $filter_language,
                'filter_category_id' => $filter_category_id,
                'filter_sub_category' => $filter_sub_category,
                'filter_pricemin' => ($filter_pricemin ? (float) $this->currency->convert($filter_pricemin, $this->session->data['currency'], $this->config->get('config_currency')) : ''),
                'filter_pricemax' => ($filter_pricemax ? (float) $this->currency->convert($filter_pricemax, $this->session->data['currency'], $this->config->get('config_currency')) : ''),
                'filter_description' => $filter_description,
                'filter_groups' => $filter_groups,
                'filter_attribute' => $filter_attribute,
                'sort' => $sort,
                'order' => $order,
                'start' => ($page - 1) * $limit,
                'limit' => $limit,
                'quicksearch' => $quicksearch
            );

            $product_total = $this->model_catalog_adsattributes->getTotalProducts($data);

            //echo $product_total .'######';
            # if no products are found let give them random products
            if ($product_total < 1)
            {

                //echo '#######';

                $this->data['heading_title'] = $this->language->get('text_noresults');

                $data = array(
                    'quantity' => 12,
                    'sort' => 'RAND()'
                );

                $product_total = $this->model_catalog_adsattributes->getTotalProducts($data);
            }


            # if no searchaction has been made, lets give them random products
        } else
        {

            $this->data['heading_title'] = $this->language->get('text_cleanentry');

            $data = array(
                'quantity' => 12,
                'sort' => 'RAND()'
            );

            $product_total = $this->model_catalog_adsattributes->getTotalProducts($data);
        }


        $results = $this->model_catalog_adsattributes->getProducts($data);

        foreach ($results as $result) {
            if (EPUB_USE_AMAZON_S3 && $result['image'])
            {
                $image = S3_COVER_URL . 'resized/' . image_resize_name(basename($result['image']), $this->config->get('config_image_product_width'));
            } else if ($result['image'] && file_exists(DIR_IMAGE . $result['image']))
            {
                //$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));

                $image = $this->model_tool_image->onesize($result['image'], $this->config->get('config_image_product_width'));
            } else
            {
                $image = $this->model_tool_image->resize("data/noimage.jpg", $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price'))
            {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else
            {
                $price = false;
            }

            if ((float) $result['special'])
            {
                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else
            {
                $special = false;
            }

            if ($this->config->get('config_tax'))
            {
                $tax = $this->currency->format((float) $result['special'] ? $result['special'] : $result['price']);
            } else
            {
                $tax = false;
            }

            if ($this->config->get('config_review'))
            {
                $rating = (int) $result['rating'];
            } else
            {
                $rating = false;
            }

            //Change sponiza, to vqmod, line with the authorstring
            $authorstring = '';
            if ($result['product_id'])
            {
                $authors = $this->model_catalog_author->getAuthorsFromProduct($result['product_id']);
                $authorstring = $authors['authorstring'];
            }

            $this->data['products'][] = array(
                'product_id' => $result['product_id'],
                'thumb' => $image,
                'name' => $result['name'],
                'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
                'price' => $price,
                'special' => $special,
                'tax' => $tax,
                'authorstring' => $authorstring,
                'rating' => $result['rating'],
                'reviews' => sprintf($this->language->get('text_reviews'), (int) $result['reviews']),
                'href' => $this->url->link('product/product', $url . '&product_id=' . $result['product_id'])
            );
        }

        $url = '';

        if (isset($this->request->post['search']))
        {
            $url .= '&filter_name=' . $this->request->post['search'];
        }

        if (isset($this->request->post['filter_name']))
        {
            $url .= '&filter_name=' . $this->request->post['filter_name'];
        }

        if (isset($this->request->post['filter_title']))
        {
            $url .= '&filter_title=' . $this->request->post['filter_title'];
        }

        if (isset($this->request->post['filter_author']))
        {
            $url .= '&filter_author=' . $this->request->post['filter_author'];
        }

        if (isset($this->request->post['filter_isbn']))
        {
            $url .= '&filter_isbn=' . $this->request->post['filter_isbn'];
        }

        if (isset($this->request->post['filter_tag']))
        {
            $url .= '&filter_tag=' . $this->request->post['filter_tag'];
        }

        if (isset($this->request->post['filter_language']))
        {
            $url .= '&filter_language=' . $this->request->post['filter_language'];
        }

        if (isset($this->request->post['filter_category_id']))
        {
            $url .= '&filter_category_id=' . $this->request->post['filter_category_id'];
        }

        if (isset($this->request->post['filter_sub_category']))
        {
            $url .= '&filter_sub_category=' . $this->request->post['filter_sub_category'];
        }

        if (isset($this->request->post['filter_manufacturer_id']))
        {
            $url .= '&filter_manufacturer_id=' . $this->request->post['filter_manufacturer_id'];
        }

        if (isset($this->request->post['filter_pricemin']))
        {
            $url .= '&filter_pricemin=' . $this->request->post['filter_pricemin'];
        }

        if (isset($this->request->post['filter_pricemax']))
        {
            $url .= '&filter_pricemax=' . $this->request->post['filter_pricemax'];
        }

        if (isset($this->request->post['filter_description']))
        {
            $url .= '&filter_description=' . $this->request->post['filter_description'];
        }

        if (isset($this->request->post['filter_groups']))
        {
            $url .= '&filter_groups=' . $this->request->post['filter_groups'];
        }

        if (isset($this->request->post['filter_attribute']))
        {
            $url .= '&filter_attribute=' . $this->request->post['filter_attribute'];
        }

        if (isset($this->request->post['limit']))
        {
            $url .= '&limit=' . $this->request->post['limit'];
        }

        $this->data['sorts'] = array();

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_default'),
            'value' => 'p.sort_order-ASC',
            'href' => $this->url->link('product/adsattributes', 'sort=p.sort_order&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_name_asc'),
            'value' => 'pd.name-ASC',
            'href' => $this->url->link('product/adsattributes', 'sort=pd.name&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_name_desc'),
            'value' => 'pd.name-DESC',
            'href' => $this->url->link('product/adsattributes', 'sort=pd.name&order=DESC' . $url)
        );

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_price_asc'),
            'value' => 'p.price-ASC',
            'href' => $this->url->link('product/adsattributes', 'sort=p.price&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_price_desc'),
            'value' => 'p.price-DESC',
            'href' => $this->url->link('product/adsattributes', 'sort=p.price&order=DESC' . $url)
        );

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_rating_desc'),
            'value' => 'rating-DESC',
            'href' => $this->url->link('product/adsattributes', 'sort=rating&order=DESC' . $url)
        );

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_rating_asc'),
            'value' => 'rating-ASC',
            'href' => $this->url->link('product/adsattributes', 'sort=rating&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_model_asc'),
            'value' => 'p.model-ASC',
            'href' => $this->url->link('product/adsattributes', 'sort=p.model&order=ASC' . $url)
        );

        $this->data['sorts'][] = array(
            'text' => $this->language->get('text_model_desc'),
            'value' => 'p.model-DESC',
            'href' => $this->url->link('product/adsattributes', 'sort=p.model&order=DESC' . $url)
        );

        $url = '';

        if (isset($this->request->post['search']))
        {
            $url .= '&filter_name=' . $this->request->post['search'];
        }

        if (isset($this->request->post['filter_name']))
        {
            $url .= '&filter_name=' . $this->request->post['filter_name'];
        }

        if (isset($this->request->post['filter_title']))
        {
            $url .= '&filter_title=' . $this->request->post['filter_title'];
        }

        if (isset($this->request->post['filter_author']))
        {
            $url .= '&filter_author=' . $this->request->post['filter_author'];
        }

        if (isset($this->request->post['filter_isbn']))
        {
            $url .= '&filter_isbn=' . $this->request->post['filter_isbn'];
        }

        if (isset($this->request->post['filter_tag']))
        {
            $url .= '&filter_tag=' . $this->request->post['filter_tag'];
        }

        if (isset($this->request->post['filter_language']))
        {
            $url .= '&filter_language=' . $this->request->post['filter_language'];
        }


        if (isset($this->request->post['filter_category_id']))
        {
            $url .= '&filter_category_id=' . $this->request->post['filter_category_id'];
        }

        if (isset($this->request->post['filter_sub_category']))
        {
            $url .= '&filter_sub_category=' . $this->request->post['filter_sub_category'];
        }

        if (isset($this->request->post['filter_manufacturer_id']))
        {
            $url .= '&filter_manufacturer_id=' . $this->request->post['filter_manufacturer_id'];
        }

        if (isset($this->request->post['filter_pricemin']))
        {
            $url .= '&filter_pricemin=' . $this->request->post['filter_pricemin'];
        }

        if (isset($this->request->post['filter_pricemax']))
        {
            $url .= '&filter_pricemax=' . $this->request->post['filter_pricemax'];
        }

        if (isset($this->request->post['filter_description']))
        {
            $url .= '&filter_description=' . $this->request->post['filter_description'];
        }

        if (isset($this->request->post['filter_groups']))
        {
            $url .= '&filter_groups=' . $this->request->post['filter_groups'];
        }

        if (isset($this->request->post['filter_attribute']))
        {
            $url .= '&filter_attribute=' . $this->request->post['filter_attribute'];
        }

        if (isset($this->request->post['sort']))
        {
            $url .= '&sort=' . $this->request->post['sort'];
        }

        if (isset($this->request->post['order']))
        {
            $url .= '&order=' . $this->request->post['order'];
        }

        $this->data['limits'] = array();

        $this->data['limits'][] = array(
            'text' => $this->config->get('config_catalog_limit'),
            'value' => $this->config->get('config_catalog_limit'),
            'href' => $this->url->link('product/adsattributes', $url . '&limit=' . $this->config->get('config_catalog_limit'))
        );

        $this->data['limits'][] = array(
            'text' => 25,
            'value' => 25,
            'href' => $this->url->link('product/adsattributes', $url . '&limit=25')
        );

        $this->data['limits'][] = array(
            'text' => 50,
            'value' => 50,
            'href' => $this->url->link('product/adsattributes', $url . '&limit=50')
        );

        $this->data['limits'][] = array(
            'text' => 75,
            'value' => 75,
            'href' => $this->url->link('product/adsattributes', $url . '&limit=75')
        );

        $this->data['limits'][] = array(
            'text' => 100,
            'value' => 100,
            'href' => $this->url->link('product/adsattributes', $url . '&limit=100')
        );

        $url = '';

        if (isset($this->request->post['search']))
        {
            $url .= '&filter_name=' . $this->request->post['search'];
        }

        if (isset($this->request->post['filter_name']))
        {
            $url .= '&filter_name=' . $this->request->post['filter_name'];
        }

        if (isset($this->request->post['filter_title']))
        {
            $url .= '&filter_title=' . $this->request->post['filter_title'];
        }

        if (isset($this->request->post['filter_author']))
        {
            $url .= '&filter_author=' . $this->request->post['filter_author'];
        }

        if (isset($this->request->post['filter_isbn']))
        {
            $url .= '&filter_isbn=' . $this->request->post['filter_isbn'];
        }

        if (isset($this->request->post['filter_tag']))
        {
            $url .= '&filter_tag=' . $this->request->post['filter_tag'];
        }

        if (isset($this->request->post['filter_description']))
        {
            $url .= '&filter_description=' . $this->request->post['filter_description'];
        }

        if (isset($this->request->post['filter_language']))
        {
            $url .= '&filter_language=' . $this->request->post['filter_language'];
        }


        if (isset($this->request->post['filter_category_id']))
        {
            $url .= '&filter_category_id=' . $this->request->post['filter_category_id'];
        }

        if (isset($this->request->post['filter_sub_category']))
        {
            $url .= '&filter_sub_category=' . $this->request->post['filter_sub_category'];
        }

        if (isset($this->request->post['filter_manufacturer_id']))
        {
            $url .= '&filter_manufacturer_id=' . $this->request->post['filter_manufacturer_id'];
        }

        if (isset($this->request->post['filter_pricemin']))
        {
            $url .= '&filter_pricemin=' . $this->request->post['filter_pricemin'];
        }

        if (isset($this->request->post['filter_pricemax']))
        {
            $url .= '&filter_pricemax=' . $this->request->post['filter_pricemax'];
        }

        if (isset($this->request->post['filter_description']))
        {
            $url .= '&filter_description=' . $this->request->post['filter_description'];
        }

        if (isset($this->request->post['filter_groups']))
        {
            $url .= '&filter_groups=' . $this->request->post['filter_groups'];
        }

        if (isset($this->request->post['filter_attribute']))
        {
            $url .= '&filter_attribute=' . $this->request->post['filter_attribute'];
        }


        if (isset($this->request->post['sort']))
        {
            $url .= '&sort=' . $this->request->post['sort'];
        }

        if (isset($this->request->post['order']))
        {
            $url .= '&order=' . $this->request->post['order'];
        }

        if (isset($this->request->post['limit']))
        {
            $url .= '&limit=' . $this->request->post['limit'];
        }

        $pagination = new PaginationAdsAttributes();
        $pagination->total = $product_total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $url; //$this->url->link('product/adsattributes', $url . '&page={page}');

        $this->data['pagination'] = $pagination->render();




        $this->data['filter_name'] = $filter_name;
        $this->data['filter_title'] = $filter_title;
        $this->data['filter_author'] = $filter_author;
        $this->data['filter_isbn'] = $filter_isbn;
        $this->data['filter_language'] = $filter_language;
        $this->data['filter_category_id'] = $filter_category_id;
        $this->data['filter_sub_category'] = $filter_sub_category;
        $this->data['filter_manufacturer_id'] = $filter_manufacturer_id;
        $this->data['filter_pricemin'] = $filter_pricemin;
        $this->data['filter_pricemax'] = $filter_pricemax;
        $this->data['filter_description'] = $filter_description;
        $this->data['filter_groups'] = $filter_groups;
        $this->data['filter_attribute'] = $filter_attribute;

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;
        $this->data['limit'] = $limit;

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/adsattributes.tpl'))
        {
            $this->template = $this->config->get('config_template') . '/template/product/adsattributes.tpl';
        } else
        {
            $this->template = 'default/template/product/adsattributes.tpl';
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

?>

<?php echo $header; ?>
<div id="topcategory">
    <div id="slogan">
        <span class="title">Uitgebreid zoeken</span>
    </div>
    <?php echo $content_top; ?>
</div>
<?php echo $column_left; ?><?php echo $column_right; ?>

<div id="contentcategory_wrapper">
    <div id="contentcategory">  
        <!-- Sponiza change -->
        <div class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb): ?>
            <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
            <?php endforeach; ?>
        </div>

        <h1><?php echo $heading_title; ?></h1>
        <?php if (isset($thumb) || isset($description)) { ?>
        <div class="category-info">
            <?php if ($thumb) { ?>
            <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
            <?php } ?>
            <?php if ($description) { ?>
            <?php echo $description; ?>
            <?php } ?>
        </div>
        <?php } ?>
        <?php if($this->config->get('perfectum_layout_refsearch')) { ?>
        <?php if ($categories) { ?>
        <h2><?php echo $text_refine; ?></h2>
        <div class="category-list">
            <?php if (count($categories) <= 5) { ?>
            <ul>
                <?php foreach ($categories as $category) { ?>
                <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                <?php } ?>
            </ul>
            <?php } else { ?>
            <?php for ($i = 0; $i < count($categories);) { ?>
            <ul>
                <?php $j = $i + ceil(count($categories) / 4); ?>
                <?php for (; $i < $j; $i++) { ?>
                <?php if (isset($categories[$i])) { ?>
                <li><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
                <?php } ?>
                <?php } ?>
            </ul>
            <?php } ?>
            <?php } ?>
        </div>
        <?php } ?>
        <?php } ?>

        <?php if ($products) { ?>
        <div class="product-filter" style="display: none;">
            <div class="display"><b><?php echo $text_display; ?></b> <a title="<?php echo $text_list; ?>" class="active"><?php echo $text_list; ?></a><a title="<?php echo $text_grid; ?>" onclick="display('grid');"><?php echo $text_grid; ?></a><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></div>

            <div class="limit"><b><?php echo $text_limit; ?></b>
                <select onchange="location = this.value;">
                    <?php foreach ($limits as $limits) { ?>
                    <?php if ($limits['value'] == $limit) { ?>
                    <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="sort"><b><?php echo $text_sort; ?></b>
                <select onchange="location = this.value;">
                    <?php foreach ($sorts as $sorts) { ?>
                    <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                    <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="product-grid box-product">
            <?php foreach ($products as $product) { ?>
            <!-- box -->
            <div class="box-product-item">

                <div class="box-line-remove"></div>
                <div class="view-first">

                    <div class="view-content">
                        <?php if ($product['thumb']) { ?>
                        <?php 
                        $butid='stfbut-' . $product['product_id'];
                        $imgid='stfimg-' . $product['product_id'];
                        ?>
                        <div class="image" onmouseover="displayButton('<?php echo $butid ?>', '<?php echo $imgid ?>');" onmouseout="hideButton('<?php echo $butid ?>', '<?php echo $imgid ?>');">

                            <?php if(($product['special'])&&($this->config->get('perfectum_status') == '1')&&($this->config->get('layout_product_showsalebadge'))) { ?>
                            <div class="sale-badge"><?php echo $this->config->get('layout_product_showsalebadge_title');?></div>
                            <?php } ?>
                            <?php if ($product['rating']) { ?>
                            <div class="box-product-rating"><img src="catalog/view/theme/perfectum/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                            <?php } ?>
                            <a href="<?php echo $product['href']; ?>">
                            </a>

                            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" id="<?php echo $imgid ?>" class="stf-img">

                            <div onclick="addToCart('<?php echo $product['product_id']; ?>');" id="<?php echo $butid ?>" class="stf-button-cart"><i class="fa fa-plus"></i></div>
                        </div>
                        <?php } ?>

                        <div class="name name1">
                            <a title="<?php echo $product['name']; ?>" href="<?php echo $product['href']; ?>">
                                <?php

                                if (!($this->config->get('perfectum_layout_shortenby'))) {
                                $shortenby = 34;
                                } else {
                                $shortenby = $this->config->get('perfectum_layout_shortenby');
                                }
                                mb_internal_encoding("UTF-8");
                                if(strlen($product['name']) > $shortenby) { $product['name'] = mb_substr($product['name'],0,$shortenby).'...'; } echo $product['name'];
                                ?>
                            </a>
                        </div>
                        <div class="authorname">
                            <?php
                            $authorstring = "";
                            if ($product['authorstring'] != "") {
                            $authorstring = $product['authorstring'];
                            }
                            ?>
                            <?php echo $authorstring ?>
                        </div>
                        <!-- For list view-->
                        <div class="name name2"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                        <div class="price2">
                            <?php if (!$product['special']) { ?>
                            <?php echo $product['price']; ?>
                            <?php } else { ?>
                            <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                            <?php } ?>

                        </div>

                        <div class="description"><?php echo $product['description']; ?><?php if ($product['rating']) { ?>
                            <div class="box-product-rating2"><img src="catalog/view/theme/perfectum/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                            <?php } ?></div>

                        <div class="product-list-buttons">

                            <a class="button btn-cart pbuttons" onclick="addToCart('<?php echo $product['product_id']; ?>');">
                                <?php echo $button_cart; ?>
                            </a>
                        </div>
                        <!-- / -->


                        <?php if ($product['price']) { ?>
                        <div class="price">
                            <?php if (!$product['special']) { ?>
                            <?php if($product['min_price']!=$product['max_price'] && $product['book_count']>1){?>
                            <?php echo  'Available from: '.$product['min_price']; ?>
                            <?php }else{?>
                            <?php echo $product['price'];}?>
                            <?php } else { ?>
                            <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span> 
                            <?php } ?>
                            <span>(<?php echo $product['book_count'];?>)</span>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div id="box_searchat"><input name="filter_name" type="hidden"></div>
            <!--/ box-->
            <?php } ?>
        </div>
        <!-- <div class="pagination"><?php echo $pagination; ?></div> -->
        <?php } ?>
        <?php echo $content_bottom; ?>
    </div>
</div>
<script type="text/javascript"><!--
  function display(view) {
            //Change sponiza, only listview
            if (view == 'list' && false) {
            $('.product-grid').attr('class', 'product-list box-product');
                    $('.display').html('<b><?php echo $text_display; ?></b> <a title="<?php echo $text_list; ?>" class="active"><?php echo $text_list; ?></a><a title="<?php echo $text_grid; ?>" onclick="display(\'grid\');"><?php echo $text_grid; ?></a><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a>');
                    $.cookie('display', 'list');
            } else {
            $('.product-list').attr('class', 'product-grid box-product');
                    $('.display').html('<b><?php echo $text_display; ?></b> <a title="<?php echo $text_list; ?>" onclick="display(\'list\');"><?php echo $text_list; ?></a><a class="active" title="<?php echo $text_grid; ?>" ><?php echo $text_grid; ?></a><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a>');
                    $.cookie('display', 'grid');
            }
            }

    view = $.cookie('display');
            < ?php

            if (($this - > config - > get('perfectum_status') == '1') && (($this - > config - > get('perfectum_layout_pdisplay'))) < > '')
    {
    $perfectum_layout_pdisplay = $this - > config - > get('perfectum_layout_pdisplay');
    }
    else
    {
    $perfectum_layout_pdisplay = 'list';
    }
    ? >
            if (view) {
    display(view);
    } else {
    display('<?php echo $perfectum_layout_pdisplay; ?>');
    }
    //--></script> 
<?php echo $footer; ?>

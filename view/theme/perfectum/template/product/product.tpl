<?php echo $header; ?>

<div id="topproduct">

    <div id="contentproduct">

        <div class="product-info">
            <?php if ($thumb || $images) { ?>
            <div class="left">
                <?php if ($thumb) { ?>
                <div class="image">
                    <a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox" rel="prettyPhoto">
                        <img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" />
                    </a>
                </div><!-- end div image -->

                <?php } ?>
            </div><!-- end div left -->
            <?php } ?>
            <div class="right">
                <h1><?php echo $heading_title; ?></h1>
                <div class="bookdescription">
                    <?php echo str_replace("\n", "<br/>", strip_tags($description)); ?>
                </div>
                <div class="description">
                    <span>Auteur(s): 
                        <?php 
                        $i = 0; 
                        foreach ($authors as $author) {
                        if ($i > 0) {
                        echo ', ';
                        $i++;
                        }
                        ?>
                        <a href="<?php echo $author['href']; ?>"><?php echo $author['author_name']; ?></a>
                        <?php } ?>
                    </span> <span><img src="image/data/vinkje.png" id="vinkje">Tweedehands beschikbaar</span>
                </div><!-- end description -->
                <div class="bookdetails">
                    <div class="bookdetailssale">
                        <?php echo $seller['nickname'] ?> verkoopt dit boek voor
                        <br><div id="pricedetail">
                            <div id="pricesale"><?php echo $price ?></div>
                        </div>
                    </div>
                    <div class="bookdetailsdets">
                        <span><?php echo $text_format; ?></span> <?php echo $format; ?><br />
                        <span><?php echo $text_book_language; ?></span> <?php echo $book_language; ?><br />
                        <span><?php echo $text_page; ?></span> <?php echo $page; ?><br />
                        <span><?php echo $text_date_published; ?></span> <?php echo $date_published; ?><br />
                    </div>

                    <div class="product-buttons clearfix button-product-sponiza">
                        <div id="button-cart" class="product-buttons-row clearfix product-buttons-row-cart">
                            <div class="text">Plaats op mijn boekenplank</div>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="input-qty"><?php echo $text_qty; ?> 
                        <input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" />
                        <input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
                        <input type="hidden" name="productpage" size="1" value="1" />
                    </div>
                    <div class="clear"></div>

                </div><!-- end bookdetails -->
                <!-- combodeals -->
                <?php
                foreach ($combodeals as $deal) {
                $oldprice = 0;
                ?>
                <div class="combodeal">
                    <table width="100%">
                        <tr>
                            <td width="85%">
                                <?php foreach ($deal['items'] as $other_item) {
                                $product_info = $this->model_catalog_product->getProduct($other_item);
                                if ($product_info['image'] && $product_info['product_id'] != $product_id_combo) {
                                echo '<a href="' . $this->url->link('product/product', 'product_id=' . $product_info['product_id']) . '"><img src="' . $this->model_tool_image->resize($product_info['image'], 38, 50) . '" style="padding:6px;" /></a>';
                                }
                                $oldprice += $product_info['price'];
                                }
                                ?>
                            </td>
                            <td>
                                <div class="combopricelabel">
                                    <div class="combopricesale"><del>€ <?php echo round($oldprice, 2) ?> </del> € <?php echo round($deal['price'], 2) ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Bestel dit product nu in combinatie met
                                <?php
                                $i = 0;
                                foreach ($deal['items'] as $other_item) {
                                $product_info = $this->model_catalog_product->getProduct($other_item);

                                if ($product_info['product_id'] == $product_id_combo) {
                                continue;
                                }

                                if ($i == count($deal['items']) - 2) {
                                ?>
                                <a href="<?php $this->url->link('product/product', 'product_id=' . $product_info['product_id']) ?>"> <?php echo $product_info['name'] ?> </a>
                                <?php } else if ($i == count($deal['items']) - 3) { ?>
                                <a href="<?php $this->url->link('product/product', 'product_id=' . $product_info['product_id']) ?>"> <?php echo $product_info['name'] ?> </a> en
                                <?php } else { ?>
                                <a href="<?php $this->url->link('product/product', 'product_id=' . $product_info['product_id']) ?>"> <?php echo $product_info['name'] ?></a>,
                                <?php }
                                $i++;
                                } ?>

                                en bespaar <?php echo round($oldprice - $deal['price'], 2) ?> euro!
                            </td>
                            <td>
                                <?php echo '<a href="javascript:addBundle(\'' . implode(',', $deal['items']) . '\')" class="button">Kopen</a>'; ?>
                            </td>
                        </tr>

                    </table>
                </div>
                <?php } ?>

                <!-- endcombodeals -->
            </div><!-- end class right -->
        </div><!-- productinfo -->
    </div><!-- contentproduct -->

    <div id="bar">
        <div id="circle">
            <div class="left"></div>
            <div class="right"></div>
            <div class="arrow"></div>
        </div>
    </div>
</div><!-- topproduct -->


<!-- sponiza, removed options, not used -->


<script type="text/javascript"><!--
 $("a[rel^='prettyPhoto']").prettyPhoto();
            //--></script> 
<script type="text/javascript"><!--
 $('#button-cart').bind('click', function() {
    $.ajax({
    url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
            dataType: 'json',
            success: function(json) {
            $('.success, .warning, .attention, information, .error').remove();
                    if (json['error']) {
            if (json['error']['option']) {
            for (i in json['error']['option']) {
            $('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
            }
            }
            }

            if (json['success']) {

            //$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');

            //$('.success').fadeIn('slow');

            location.href = 'index.php?route=checkout/cart';
                    $('#cart-total').html(json['total']);
                    //$('html, body').animate({ scrollTop: 0 }, 'slow'); 
            }
            }
    });
            });
//--></script>

<script type="text/javascript">
            function addBundle(combodtr) {
            var res = combodtr.split(",");
                    for (index = 0; index < res.length; index++) {
            addToCart(res[index], 1);
            }
            }
</script> 

<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
  if ($.browser.msie && $.browser.version == 6) {
    $('.date, .datetime, .time').bgIframe();
    }

    $('.date').datepicker({dateFormat: 'yy-mm-dd'});
            $('.datetime').datetimepicker({
    dateFormat: 'yy-mm-dd',
            timeFormat: 'h:m'
    });
            $('.time').timepicker({timeFormat: 'h:m'});
            $(document).ready(function(){

    < ?php
            if (($this - > config - > get('perfectum_status') == '1') && ($this - > config - > get('perfectum_effects_productimage') == 'zoom')) {
    ? >
            var options = {
            zoomType: 'standard',
                    lens:true,
                    preloadImages: true,
                    alwaysOn:false,
                    zoomWidth: 250,
                    zoomHeight: 271,
                    xOffset:10,
                    yOffset:00,
                    position:'right',
                    title:false

            };
            $('.imageZoom').jqzoom(options);
            < ?php
    } else {
    ? >
            $('.zoom').hide();
            < ?php } ? >
    });
            //--></script>
</div><!-- end div container -->

<div id="contentcategory_wrapper">
    <div id="contentcategory">
        <!-- Sponiza change -->
        <div class="breadcrumb">
        </div>
        <h1><?php echo $other_products ?></h1>

        <div class="product-grid box-product">

            <?php foreach ($products as $product) { ?>
            <!-- box -->
            <div class="box-product-item">
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
                            <a href="<?php echo $product['href']; ?>"></a>

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
                            <?php echo $product['price']; ?>
                            <?php } else { ?>
                            <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                            <?php } ?>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <?php } ?>
            <!--/ box-->

        </div><!-- end div product-grid -->

    </div><!-- end contentcategory -->
</div><!-- end contentcategorywrapper -->

<?php echo $footer; ?>

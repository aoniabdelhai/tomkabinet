<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title; ?></title>
        <base href="<?php echo $base; ?>" />

        <?php if ($description): ?>
        <meta name="description" content="<?php echo $description; ?>" />
        <?php endif; ?>

        <?php if ($keywords): ?>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <?php endif; ?>

        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <?php if ($icon): ?>
        <link href="<?php echo $icon; ?>" rel="icon" />
        <?php endif; ?>

        <?php foreach ($links as $link): ?>
        <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
        <?php endforeach; ?>

        <?php if(($this->config->get('perfectum_status') != '1')||($this->config->get('perfectum_header_font')=='PT Sans')): ?>
        <link href='//fonts.googleapis.com/css?family=PT Sans:regular,italic,700,700italic&subset=cyrillic' rel='stylesheet' type='text/css'>
        <?php endif; ?>

        <?php if(($this->config->get('perfectum_status') == '1')&&( $this->config->get('perfectum_header_font') != 'Arial')):	?>
        <link href='//fonts.googleapis.com/css?family=<?php echo $this->config->get('perfectum_header_font') ?>:<?php echo $this->config->get('perfectum_header_font_weight'); ?>&subset=<?php echo $this->config->get('perfectum_header_font_subset'); ?>' rel='stylesheet' type='text/css'>
              <?php endif; ?>

              <?php if(($this->config->get('perfectum_status') == '1')&&( $this->config->get('perfectum_buttons_font') != 'Arial')):	?>
              <link href='//fonts.googleapis.com/css?family=<?php echo $this->config->get('perfectum_buttons_font'); ?>:<?php echo $this->config->get('perfectum_buttons_font_weight'); ?>&subset=<?php echo $this->config->get('perfectum_buttons_font_subset'); ?>' rel='stylesheet' type='text/css'>
              <?php endif; ?>

              <!-- Change sponiza, import Font Awesome -->
              <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/flexslider.css" />
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/jquery.jqzoom.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/prettyPhoto.css" />

        <?php if($direction == 'rtl-notavailable'): ?>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/rtl.css" />
        <?php endif; ?>

        <?php if(($this->config->get('perfectum_status') == '1')&&( $this->config->get('perfectum_layout_responsive') == 1)): ?>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/responsive.css" />
        <?php if($direction == 'rtl-notavailable'): ?>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/responsive-rtl.css" />
        <?php endif; ?>
        <?php endif; ?>

        <?php foreach ($styles as $style): ?>
        <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
        <?php endforeach; ?>
        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
        <script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
        <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
        <script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/jquery.flexslider-min.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/jquery.ba-throttle-debounce.min.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/jquery.touchSwipe.min.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/jquery.carouFredSel-6.1.0-packed.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/jquery.jqzoom-core-pack.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/twitter/jquery.tweet.js"></script>
        <script type="text/javascript">var switchTo5x = true;</script>
        <script type="text/javascript" src="//w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "fdf72e22-4d1c-4270-9aea-a784ad6c30c2"});</script>

        <?php foreach ($scripts as $script): ?>
        <script type="text/javascript" src="<?php echo $script; ?>"></script>
        <?php endforeach; ?>
        <!-- REVOLUTION -->
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/rs-plugin/revolution-css/fullwidth.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/rs-plugin/css/settings.css" media="screen" />
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/revolution/jquery.themepunch.plugins.min.js"></script>
        <script type="text/javascript" src="catalog/view/theme/perfectum/js/revolution/jquery.themepunch.revolution.js"></script>
        <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/ie7.css" />
        <![endif]-->
        <!--[if lt IE 7]>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/ie6.css" />
        <script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
        <script type="text/javascript">
        DD_belatedPNG.fix('#logo img');
        </script>
        <![endif]-->
     <?php if(($this->config->get('perfectum_status') == '1') && ($this->config->get('perfectum_slider_enable') == '1')): ?>
        <script type="text/javascript">
                    <!--
          $(document).ready(function() {
            if ($.fn.cssOriginal != undefined)
                    $.fn.css = $.fn.cssOriginal;
                    $('.fullwidthbanner').revolution(
            {
            delay: < ?php echo $this - > config - > get('perfectum_slider_autoplay_delay'); ? > ,
                    startwidth:980,
                    startheight:500,
                    onHoverStop:"on", // Stop Banner Timet at Hover on Slide on/off
                    thumbWidth:100, // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                    thumbHeight:50,
                    thumbAmount:3,
                    hideThumbs:0,
                    navigationType:"bullet", // bullet, thumb, none
                    navigationArrows:"solo", // nexttobullets, solo (old name verticalcentered), none
                    navigationStyle:"round", // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
                    navigationHAlign:"center", // Vertical Align top,center,bottom
                    navigationVAlign:"bottom", // Horizontal Align left,center,right
                    navigationHOffset:0,
                    navigationVOffset:20,
                    soloArrowLeftHalign:"left",
                    soloArrowLeftValign:"center",
                    soloArrowLeftHOffset:20,
                    soloArrowLeftVOffset:0,
                    soloArrowRightHalign:"right",
                    soloArrowRightValign:"center",
                    soloArrowRightHOffset:20,
                    soloArrowRightVOffset:0,
                    touchenabled:"on", // Enable Swipe Function : on/off
                    stopAtSlide: < ?php echo ($this - > config - > get('perfectum_slider_autoplay') == 1) ? '-1' : '1'; ? > , // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                    stopAfterLoops:0, // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
                    hideCaptionAtLimit:0, // It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                    hideAllCaptionAtLilmit:0, // Hide all The Captions if Width of Browser is less then this value
                    hideSliderAtLimit:0, // Hide the whole slider, and stop also functions if Width of Browser is less than this value
                    fullWidth:"on",
                    shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)
            });
            });
                    //-->
        </script>
        <?php endif; ?>
        <script type="text/javascript">
                    <!--
          $(document).ready(function() {
            <?php
                    if (($this->config-> get('perfectum_status') == '1')){
            echo html_entity_decode($this->config-> get('perfectum_custom_js'));
            }
            ?>
                    // Image animation
                    $(".fade-image, .box-category .menuopen, .box-category .menuclose").live({
            mouseenter:
                    function(){
                    $(this).stop().fadeTo(300, 0.6);
                    },
                    mouseleave:
                    function(){
                    $(this).stop().fadeTo(300, 1);
                    }
            });
                    $(".box-category div.menuopen").live('click', function(event) {
            event.preventDefault();
                    $('.box-category a + ul').slideUp();
                    $('+ a + ul', this).slideDown();
                    $('.box-category ul li div.menuclose').removeClass("menuclose").addClass("menuopen");
                    $(this).removeClass("menuopen").addClass("menuclose");
                    $('.box-category ul li a.active').removeClass("active");
                    $('+ a', this).addClass("active");
            });
                    var mobilemenuOpened = false;
                    $(".mobile-menu-toggle").live('click', function(event) {
            if (mobilemenuOpened == false){
            $(".mobile-menu").slideDown();
                    mobilemenuOpened = true;
            } else{
            $(".mobile-menu").slideUp();
                    mobilemenuOpened = false;
            }
            });
                    $('.shop-about .about-slider .slider').flexslider({
            animation: "slide",
                    controlNav: false,
                    directionNav: false,
                    slideshowSpeed: 3000
            });
                    // Using default configuration
                    $(".shop-news .shop-news-slider .slider").carouFredSel({
            infinite: false,
                    auto 	: false,
                    width : "100%",
                    prev	: {
                    button	: ".shop-news .prev",
                            key		: "left"
                    },
                    next	: {
                    button	: ".shop-news .next",
                            key		: "right"
                    },
                    swipe: {
                    onTouch: true,
                            onMouse     : false
                    }
            });
                    $('.holder_category').live('click', function(event) {
            var parent_id = $(this).data('id');
                    $('.child_' + parent_id).show();
            });
            });
                    //-->
        </script>
        <style type="text/css">
            <?php
            if(($this->config->get('perfectum_status') == '1')){
                echo html_entity_decode($this->config->get('perfectum_custom_css'));
            }
            ?>
            <?php if($this->config->get('perfectum_layout_boxed')): ?>
            /* backgrounds */
            body {
                background-color: #<?php echo $this->config->get('perfectum_color_body_bg'); ?>;
            }
            <?php if($this->config->get('dx_bg_image') == '1'): ?>
            body{
                background-image:url("<?php echo 'image/' . $this->config->get('dx_image'); ?>");
            } 	
            <?php elseif ($this->config->get('perfectum_body_bg_pattern')!= "no_pattern"): ?>
            body {
                background-image:url("catalog/view/theme/perfectum/image/bg/<?php echo $this->config->get('perfectum_body_bg_pattern');?>.png");
            }
            <?php endif; ?>	
            <?php if ($this->config->get('dx_full_bg_image') == '1'): ?>
            body {
                background:url("<?php echo 'image/' . $this->config->get('dx_full_image'); ?>") repeat fixed center top transparent;
            } 	
            <?php endif; ?>

            <?php if ($this->config->get('perfectum_transparent_content') == '1'): ?>
            #container, .box .box-content, .mini-sliders {
                background:none;
            }
            #box-shadow, #header #cart .content, .htabs a.selected {
                background:url("catalog/view/theme/perfectum/image/transparent_bg.png") transparent repeat;
            }
            <?php endif;  ?>
            <?php endif; ?>

            /* font size */
            body, td, th, input, textarea, select, #twitter_update_list {
                font-size:<?php echo $this->config->get('perfectum_buttons_fontsize'); ?>px;
            }

            /* font family */
            body {
                font-family:<?php echo $this->config->get('perfectum_buttons_font'); ?>;
            }

            h1, .welcome, h2,.box .box-heading,#footer h3,.footer-about .social h1 {
                font-family:"<?php echo $this->config->get('perfectum_header_font'); ?>";

                <?php $header_font_weight = str_replace("italic","",$this->config->get('perfectum_header_font_weight')); ?>
                <?php if(strlen($header_font_weight) < strlen($this->config->get('perfectum_header_font_weight'))): ?>
                    font-style: italic;
                <?php endif; ?>

                text-transform: <?php echo $this->config->get('perfectum_fonts_transform'); ?>;
            }
            /* bg */
            #header #cart .icon, #currency .active, #currency a:hover, .buttons-cart, .box-product-item .box-line, a.button, input.button, .custom-footer .custom-footer-column .custom-footer-contact .contact-icon, .product-info .zoom a, .product-buttons .product-buttons-row.product-buttons-row-cart, #twitter_update_list li .tweet-icon, .custom-footer .custom-footer-column .line, .pagination .links b {
                background-color:#<?php echo$this->config->get('perfectum_button_bg'); ?>;
            }
            #header #cart .icon:hover, .buttons-cart:hover, a.button:hover, input.button:hover, .product-info .zoom a:hover, .product-buttons .product-buttons-row.product-buttons-row-cart:hover,.pagination .links a:hover {
                background-color:#<?php echo$this->config->get('perfectum_button_hoverbg'); ?>;
            }
            #menu{
                background-color:#<?php echo$this->config->get('perfectum_topmenu_bg'); ?>;
            }
            /* colors */
            a, .product-info .price, .box-product-item .price, #header #welcome a, #powered a, .breadcrumb a, .category-list a, .product-filter .display a, .box-category > ul > li > a:hover, .box-category > ul > li ul > li > a:hover, .product-buttons .product-buttons-row, .shop-news .news-block .news-block-more a, .product-filter .display a:hover, .product-filter .display .active, .product-info .description a, #header #cart .content a {
                color: #<?php echo$this->config->get('perfectum_button_bg'); ?>;
            }
            a:hover {
                color: #<?php echo$this->config->get('perfectum_button_hoverbg'); ?>;
            }
            /* borders */
            #menu> ul > li:hover, #header #search .search-btn:hover, .product-filter .display .active, .product-filter .display a:hover {
                border-color: #<?php echo$this->config->get('perfectum_button_bg'); ?>;
            }
            #menu> ul > li {
                border-color: #<?php echo$this->config->get('perfectum_topmenu_bg'); ?>;
            }
            /* Custom block */
            #menu.custom-topmenu-block {
                width:<?php echo$this->config->get('perfectum_layout_custommenu_block_width'); ?>px;
            }
            .sale-badge {
                background:#<?php echo$this->config->get('layout_product_showsalebadge_color'); ?>;
            }
            <?php
            $perfectum_effects_carousel = $this->config->get('perfectum_effects_carousel');
            if($perfectum_effects_carousel !== 'enable'):
            ?>
            .navigate  {
                display:none;
            }
            .caruofredsel {
                height:auto;
            }
            .caruofredsel .box-product-item {
                margin-bottom:10px;
            }
            <?php endif; ?>
            <?php if($this->config->get('perfectum_layout_boxed')): ?>
            #menu, .custom-footer-wrapper, .footer-container, .footer-wrapper, #header-menu-bg, .fullwidthbanner-container {
                width:980px;
                margin-left: auto;
                margin-right: auto;
            }
            .wrapper {
                width:1000px;
                margin:0 auto;
                background:#fff; 
            }
            #header-menu-bg, .footer-wrapper, .nav-container, .custom-footer-wrapper, .fullwidthbanner-container  {
                width:1000px;
            }
            <?php if($this->config->get('perfectum_layout_boxed_shadow')): ?>
            .wrapper {
                box-shadow: 0 12px 15px rgba(0, 0, 0, 0.2);
                -webkit-box-shadow: 0 12px 15px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 0 12px 15px rgba(0, 0, 0, 0.2);
            }
            <?php endif; ?>
            <?php endif; ?>  
        </style> 

        <!-- EXTRA CSS TO FIX THINGS -->
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/perfectum/stylesheet/editsponiza.css" media="screen" />

</head>
<?php
$route = empty($this->request->get['route']) ? 'common/home' : $this->request->get['route'];
$rt = explode('/', $route);

if($rt[0]!='account'){
$rt[0] = '';
}

$css_wrapper = $rt[0] .' '. str_replace('/', '_', $route);
?>
<body class="<?php echo $css_wrapper; ?>">


    <div class="wrapper"> 
        <div id="header-menu-bg">
            <div id="header_menu">
                <div id="menucontent">
                    <ul class="ulmenu" id="ulmenuid">
                        <li><a href="/"><img src="image/data/logotomkabinet.png"></a><i id="burger" class="fa fa-align-justify fa-2x"></i></li>
                        <?php if ($categories): ?>
                        <?php foreach ($categories as $category): ?>
                        <li class="hideonmobile"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                            <?php if ($category['children']): ?>
                            <?php for($i = 0; $i < count($category['children']); ): ?>
                            <ul class="submenuul">
                                <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                                <?php for (; $i < $j; $i++): ?>
                                <?php $child = $category['children'][$i]; ?>
                                <?php if ($child['childcount']): ?>
                                <li <?php if ($child['depth']) echo 'class="sub"'; ?>>
                                    <?php echo str_repeat('&nbsp;&nbsp;&nbsp;', $child['depth']); ?>
                                    <span class="holder_category" data-id="<?php echo $child['id']; ?>">
                                        <?php echo $child['name']; ?>
                                    </span>
                                </li>
                                <li class="sub child_<?php echo $child['id']; ?>">
                                    <?php echo str_repeat('&nbsp;&nbsp;&nbsp;', $child['depth'] + 1); ?>
                                    <a href="<?php echo $child['href']; ?>">
                                        <?php
                                        echo $child['name'] . ' Algemeen';
                                        if (false !== $child['productcount']) echo ' (' . $child['productcount'] . ')';
                                        ?>
                                    </a>
                                </li>
                                <?php else: ?>
                                <li <?php if ($child['depth']) echo 'class="sub child_' . $child['parent_id'] . '"'; ?>>
                                    <?php echo str_repeat('&nbsp;&nbsp;&nbsp;', $child['depth']); ?>
                                    <a href="<?php echo $child['href']; ?>">
                                        <?php
                                        echo $child['name'];
                                        if (false !== $child['productcount']) echo ' (' . $child['productcount'] . ')';
                                        ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php endfor; ?>
                            </ul>
                            <?php endfor; ?>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                        <?php endif;//end if categories ?>
                        <li class="hideonmobile"><a href="index.php?route=account/register-seller">Verkopen</a></li>
                        <li class="hideonmobile"><a href="<?php echo $help; ?>">Help</a></li>
                    </ul>

                    <div id="infodetails" class="hideonmobile">
                        <div id="search">
                            <button class="search_menu" id="open_search"></button>
                            <div class="search_menu" id="form" style="display: block; opacity: 0;">
                                <?php $action = $this->url->link('product/adsattributes', '', 'SSL'); ?>
                                <form id="myform" action="<?php echo $action; ?>" method="post">
                                    <input type="text" name="search" value="Zoek uw boek" onclick="this.value = ''" onblur="if (this.value == '') { this.value = 'Zoek uw boek'}" ;="">
                                    <button type="submit" title="Go" class="search-btn button-search"></button>
                                </form>
                                <div id="advanced_search"><a href="index.php?route=product/adsattributes">Geavanceerd&nbsp;zoeken</a></div>
                            </div>
                        </div>
                        <div id="welcome" class="det_button">
                            <?php if(!$logged): ?>
                            <a href="index.php?route=account/login">Login</a>
                            <?php else: ?>
                            <?php echo $text_logged; ?>
                            <?php endif; ?>
                        </div><!-- end welcome -->
                        <div id="det_cart" class="det_button_dark"><?php echo $cart; ?></div>
                    </div><!-- end infodetails -->
                </div><!-- div menucontent -->
            </div><!-- end header_menu -->
        </div><!-- div end header bg -->

        <?php if ($error): ?>
        <div class="inotify">
            <div class="warning"><?php echo $error; ?><a href="#" class="de_closenote"></a></div>
        </div>
        <?php endif; ?>

        <div class="container">
            <?php if ($categories): ?>
            <div class="mobile-menu-toggle" style="display: none;">Menu <img src="catalog/view/theme/perfectum/image/toggle.png"></div>
            <div class="box mobile-menu" style="display: none;">
                <div class="box-content">
                    <div class="box-category">
                        <ul>
                            <?php foreach ($categories as $category): ?>
                            <li>
                                <?php if($category['children']): ?>
                                <div class="menuopen"></div>
                                <?php endif; ?>
                                <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                                <?php if($category['children']): ?>
                                <ul>
                                    <?php foreach ($category['children'] as $child): ?>
                                    <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="inotify">
                <div id="notification"></div>
            </div>	

        </div>

        <div class="container clearfix">
            <!-- END header.tpl -->

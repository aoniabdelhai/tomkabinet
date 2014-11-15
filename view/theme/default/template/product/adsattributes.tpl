<?php echo $header; ?>
<div id="accountstart">
   <img src="image/data/background/manglaswijn.jpg" style="max-width: 100%;">
   <div id="slogan">
        <span class="title">Plugins om te delen</span>
        <span class="description">Online delen plugins, themes en handleidingen</span>
   </div>
   <div id="bar">
       <div id="circle">
           <div class="left"></div>
           <div class="right"></div>
           <div class="arrow"></div>
       </div>
   </div>
</div>

<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="contentaccount"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>


  <h2><?php echo $text_search; ?></h2>
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

<div class="product-list box-product">
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
   <div class="image" onmouseover="displayButton('<?php echo $butid ?>','<?php echo $imgid ?>');" onmouseout="hideButton('<?php echo $butid ?>','<?php echo $imgid ?>');">

   <? if(($product['special'])&&($this->config->get('perfectum_status') == '1')&&($this->config->get('layout_product_showsalebadge'))) { ?>
      <div class="sale-badge"><?=$this->config->get('layout_product_showsalebadge_title');?></div>
   <? } ?>
      <?php if ($product['rating']) { ?>
         <div class="box-product-rating"><img src="catalog/view/theme/perfectum/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
         <a href="<?php echo $product['href']; ?>">
         </a>

            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" id="<?php echo $imgid ?>" class="stf-img">

         <div onclick="addToCart('<?php echo $product['product_id']; ?>');" id="<?php echo $butid ?>" class="stf-button-cart"><i class="fa fa-plus"></i></div>
   </div>
   <? } ?>

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
   <? echo $authorstring ?>
   </a>
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

<?php echo $footer; ?>

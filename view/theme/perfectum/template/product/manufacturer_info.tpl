<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php if ($products) { ?>
  <div class="product-filter">
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
<div class="box-product-buttons">
    <div onclick="addToCompare('<?php echo $product['product_id']; ?>');" class="buttons-compare"></div>
    <div onclick="addToWishList('<?php echo $product['product_id']; ?>');" class="buttons-wish"></div>
</div>

<div class="box-line"></div>
<div class="view-first">

<div class="view-content">
<?php if ($product['thumb']) { ?>
<div class="image">
<? if(($product['special'])&&($this->config->get('perfectum_status') == '1')&&($this->config->get('layout_product_showsalebadge'))) { ?>
<div class="sale-badge"><?=$this->config->get('layout_product_showsalebadge_title');?></div>
<? } ?>
<?php if ($product['rating']) { ?>
<div class="box-product-rating"><img src="catalog/view/theme/perfectum/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
<?php } ?>
<a href="<?php echo $product['href']; ?>">
<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>">
</a>
</div>
<? } ?>
<div class="name name1">
<a title="<?php echo $product['name']; ?>" href="<?php echo $product['href']; ?>">
<?php

if (!($this->config->get('perfectum_layout_shortenby'))) {
  $shortenby = 34;
}
else
{
  $shortenby = $this->config->get('perfectum_layout_shortenby');
}
mb_internal_encoding("UTF-8");
if(strlen($product['name']) > $shortenby) { $product['name'] = mb_substr($product['name'],0,$shortenby).'...'; } echo $product['name'];
?>
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
	    <div class="pbuttons buttons-wish" onclick="addToWishList('<?php echo $product['product_id']; ?>');" alt="<?php echo $button_wishlist; ?>"></div><div class="pbuttons buttons-compare" onclick="addToCompare('<?php echo $product['product_id']; ?>');" alt="<?php echo $button_compare; ?>"></div>
	  </div>
<!-- / -->

<div onclick="addToCart('<?php echo $product['product_id']; ?>');" class="buttons-cart"></div>

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
      <!--/ box-->
   
    <?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>
  <?php if (!$products) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
function display(view) {
	if (view == 'list') {
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

<?

  if(($this->config->get('perfectum_status') == '1')&&(($this->config->get('perfectum_layout_pdisplay')))<>'')
  {
    $perfectum_layout_pdisplay = $this->config->get('perfectum_layout_pdisplay');
  }
  else
  {
    $perfectum_layout_pdisplay = 'list';
  }
?>
if (view) {
	display(view);
} else {
	display('<?=$perfectum_layout_pdisplay?>');
}
//--></script> 
<?php echo $footer; ?>
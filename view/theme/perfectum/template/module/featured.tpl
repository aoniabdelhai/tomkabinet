<div class="box module">
  <div class="box-heading module"><?php echo $heading_title; ?><div class="navigate navigate-featured"><div class="prev"></div><div class="next"></div></div></div>
  <div class="clear"></div>
  <div class="box-content">
    <div class="box-product caruofredsel caruofredsel-featured">
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
<div class="name">
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
  </div>
</div>
<div class="clear"></div>
<?
if($this->config->get('perfectum_status') == '1') {$perfectum_effects_carousel = $this->config->get('perfectum_effects_carousel');} else {$perfectum_effects_carousel = 'enable';}

if($perfectum_effects_carousel == 'enable')
{
?>
<script type="text/javascript"><!--
$(document).ready(function() {
      
	// Using default configuration
	$(".caruofredsel-featured").carouFredSel({
      
                  infinite: false,
                  auto 	: false,
		  width : "100%",
                  prev	: {	
                          button	: ".navigate-featured .prev",
                          key		: "left"
                  },
                  next	: { 
                          button	: ".navigate-featured .next",
                          key		: "right"
                  }
                  ,swipe           : {
                      onTouch     : true,
                      onMouse     : false
                  }
		  ,onCreate : function(data) { $(this).css("height","auto");  }
        
        })

});

--></script>
<? } else { ?>
<style type="text/css">
.navigate-featured {
  display:none;
}
</style>
<? } ?>
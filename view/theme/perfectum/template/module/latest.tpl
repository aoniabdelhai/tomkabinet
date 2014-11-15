<div class="box module">
  <div class="box-heading module"><?php echo $heading_title; ?></div>
  <div class="clear"></div>
  <div class="box-content">

  <div class="product-list box-product">
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
                  <div class="image" onmouseover="displayButton('<?php echo $butid ?>','<?php echo $imgid ?>');" onmouseout="hideButton('<?php echo $butid ?>','<?php echo $imgid ?>');">

                  <?php if(($product['special'])&&($this->config->get('perfectum_status') == '1')&&($this->config->get('layout_product_showsalebadge'))) { ?>
                      <div class="sale-badge"><?php echo $this->config->get('layout_product_showsalebadge_title');?></div>
                  <?php } ?>
                  <?php if ($product['rating']) { ?>
                      <div class="box-product-rating"><img src="catalog/view/theme/perfectum/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                  <?php } ?>
                  <a href="<?php echo $product['href']; ?>"></a>

                  <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" id="<?php echo $imgid ?>" class="stf-img">

                  <div onclick="addToCart('<?php echo $product['product_id']; ?>');" id="<?php echo $butid ?>" class="stf-button-cart"><i class="fa fa-plus"></i></div>
                  </div><!-- end image -->
           <?php }//end product thumb ?>

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


           <?php if ($product['price']) { ?>
                <div class="price">
                  <?php if (!$product['special']) { ?>
                  <?php echo $product['price']; ?>
                  <?php } else { ?>
                  <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                  <?php } ?>
                </div>
           <?php } ?>
     </div> <!-- view-content -->
     </div> <!-- view-first -->
     </div> <!-- box-product-item -->
     <?php }//end for each ?>
     </div> <!-- product-list -->

  </div><!-- end div -->

</div><!-- div contentsearch -->

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

<?php

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
        display('<?php echo $perfectum_layout_pdisplay; ?>');
}
//--></script>





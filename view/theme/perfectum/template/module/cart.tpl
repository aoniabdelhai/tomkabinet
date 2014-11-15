<div id="cart">
  <!-- icons are removed -->
  <div class="heading">
    <a><span id="cart-total"><?php echo $text_items; ?></span></a></div>
  <div class="content">
    <?php if ($products || $vouchers) { ?>
    <div class="mini-cart-info">
        <div id="topcart">
          <img src="image/data/background/bookshelf-small.jpg">
        </div>

      <div class="contentcartmodule">

      <table>
        <?php foreach ($products as $product) { ?>
        <tr>
          <td class="image">
            <?php if ($product['thumb']) { ?>
               <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
            <?php } ?>
          </td>
          <td class="name"><?php echo $product['name']; ?>
            <div class="moreinfo">
              <div id="writer"><?php echo $product['authorstring'] ?></div>
              <div id="more_info">
                  <span><strong><?php echo $product['sellerstring'] ?></strong><span class="spacer">|</span> <span id="isbn_title">ISBN</span> <span id="isbn"><?php echo $product['ean'] ?></span> <span class="spacer">|</span> <span id="type"><?php echo $product['genre'] ?></span>
              </div></td>
            </div>
          </td>
          <td class="total">
          <td class="remove">
            <div class="price"><?php echo $product['total']; ?>
            <img src="catalog/view/theme/default/image/remove.png" alt="<?php echo $button_remove; ?>" 
              title="<?php echo $button_remove; ?>" class="removeproduct" 
              rel="<?php echo $product['key']; ?>" />
            </div>
          </td>

        </tr>
        <?php } ?>
      </table>
    </div>
    <div class="mini-cart-total" id="mini-cart-total">
      <table>
        <?php foreach ($totals as $total) {
               if ($total['code'] == 'total') { ?>
        <tr>
          <td width="300px"><b><?php echo $total['title']; ?>:</b></td>
          <td width="300px"><?php echo $total['text']; ?></td>
        </tr>
        <?php } } ?>
      </table>
    </div>
    <div class="checkout">
    	<a class="closecart" id="closecart"></a>
    	<a href="<?php echo $cart; ?>"><?php echo $text_cart; ?></a> | <a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a>
    </div>
    </div><!-- end contentcartmodule -->
    <?php } else { ?>
    <div class="empty"><?php echo $text_empty; ?></div>
    <?php } ?>
  </div>
</div>

<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="accountstart">
   <img src="image/data/background/manzonnebril.jpg" style="max-width: 100%;">
</div>

<div id="contentseller" class="ms-account-product-form">
	<?php echo $content_top; ?>

	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>

	<h1><?php echo $heading; ?></h1>

	<p class="warning main"></p>
	<div class="content">

	<div class="ms-product-left">

	    <form id="ms-new-product" method="post" enctype="multipart/form-data">

               <div id="tab-combos">
                     <table class="list">
                     <thead>
                         <tr>
                            <td><?php echo $ms_account_product_priority; ?></td>
                            <td><?php echo $ms_account_product_price; ?></td>
                            <td><?php echo $ms_account_product_other_items; ?></td>
                            <td><?php echo $ms_account_product_date_start; ?></td>
                            <td><?php echo $ms_account_product_date_end; ?></td>
                            <td></td>
                         </tr>
                     </thead>
                     <tbody>

                         <!-- sample row -->
                         <tr class="ffSample">
                            <td><input type="text" name="product_combos[0][priority]" value="" size="2" /></td>
                            <td><input type="text" name="product_combos[0][price]" value="" /></td>
                            <td><select multiple name="product_combos[0][combo_products][]">
                            <?php foreach($owned_products as $prod) {
                                    echo intval($prod['product_id']) != intval($product['product_id']) ? '<option value="' . $prod['product_id'] . '">' . $prod['pd.name'] . '</option>' : '';
                            }?>
                            </select>
                            </td>
                            <td><input type="text" name="product_combos[0][date_start]" value="" class="date" /></td>
                            <td><input type="text" name="product_combos[0][date_end]" value="" class="date" /></td>
                            <td><a class="ms-button-delete" title="<?php echo $ms_delete; ?>"></a></td>
                         </tr>

                         <?php if (isset($product['combos'])) { ?>
                         <?php $combo_rows = 1; ?>
                         <?php foreach ($product['combos'] as $product_combos) { ?>
                         <tr>
                            <td><input type="text" name="product_combos[<?php echo $combo_rows; ?>][priority]" value="<?php echo $product_combos['priority']; ?>" size="2" /></td>
                            <td><input type="text" name="product_combos[<?php echo $combo_rows; ?>][price]" value="<?php echo $product_combos['price']; ?>" /></td>
                            <td><select multiple name="product_combos[<?php echo $combo_rows; ?>][combo_products][]">
                            <?php foreach($owned_products as $prod) {
                                    echo intval($prod['product_id']) != intval($product['product_id']) ? ((in_array(intval($prod['product_id']), $product_combos['combo_product_id'])) ? '<option selected value="' . $prod['product_id'] . '">' . $prod['pd.name'] . '</option>' : '<option value="' . $prod['product_id'] . '">' . $prod['pd.name'] . '</option>') : '';
                            }?>
                            </select>
                            </td>
                            <td><input type="text" name="product_combos[<?php echo $combo_rows; ?>][date_start]" value="<?php echo $product_combos['date_start']; ?>" class="date" /></td>
                            <td><input type="text" name="product_combos[<?php echo $combo_rows; ?>][date_end]" value="<?php echo $product_combos['date_end']; ?>" class="date" /></td>
                            <td><a class="ms-button-delete" title="<?php echo $ms_delete; ?>"></a></td>
                         </tr>
                         <?php $combo_rows++; ?>
                         <?php } ?>
                         <?php } ?>
                         </tbody>

                         <tfoot>
                         <tr>
                         <td colspan="5"><a class="button ffClone"><?php echo $ms_button_add_combo; ?></a></td>
                         </tr>
                         </tfoot>
                     </table>

		     <div class="buttons">
			<div class="left">
		           <a href="<?php echo $back; ?>" class="button">
				<span><?php echo $ms_button_cancel; ?></span>
			   </a>
				</div>
				<div class="right">
					<a class="button" id="ms-submit-button">
						<span><?php echo $ms_button_submit; ?></span>
					</a>
				</div>
			</div>
		</div>
	</div> <!-- ms-product-left -->

	</form>

	   <div class="ms-product-right">
	   </div> <!-- ms-product-right -->
	</div>

	<?php echo $content_bottom; ?>
</div>

<?php $timestamp = time(); ?>
<script>
	var msGlobals = {
		timestamp: '<?php echo $timestamp; ?>',
		token : '<?php echo md5($salt . $timestamp); ?>',
		session_id: '<?php echo session_id(); ?>',
		product_id: '<?php echo $product['product_id']; ?>',
		button_generate: '<?php echo htmlspecialchars($ms_button_generate, ENT_QUOTES, "UTF-8"); ?>',
		text_delete: '<?php echo htmlspecialchars($ms_delete, ENT_QUOTES, "UTF-8"); ?>',
		uploadError: '<?php echo htmlspecialchars($ms_error_file_upload_error, ENT_QUOTES, "UTF-8"); ?>',
		formError: '<?php echo htmlspecialchars($ms_error_form_submit_error, ENT_QUOTES, "UTF-8"); ?>',
		formNotice: '<?php echo htmlspecialchars($ms_error_form_notice, ENT_QUOTES, "UTF-8"); ?>',
		config_enable_rte: '<?php echo $this->config->get('msconf_enable_rte'); ?>'
	};
</script>

<div style="clear:both; content:''"></div>
<?php echo $footer; ?>

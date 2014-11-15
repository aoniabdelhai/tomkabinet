<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="accountstart">
   
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

		<!-- general tab -->
		<div id="tab-general">
			<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>" />
			<input type="hidden" name="keyword" value="" />
			<input type="hidden" name="action" id="ms_action" />
			<table class="ms-product-required">
				<tr>
					<td colspan="2"><h3><?php echo $ms_account_product_input; ?></h3></td>
				</tr>
                                <tr>
					<td>
                                           <?php echo $ms_account_product_download; ?>
                                        </td>
				<td>
                                   <?php if (!isset($product['product_id']) || empty($product['product_id'])) { ?>
			                <input type="hidden" name="details" id="details" />
					<!--<input type="file" name="ms-file-addfiles" id="ms-file-addfiles" />-->
					<a name="ms-file-addfiles" id="ms-file-addfiles" class="button"><span><?php echo $ms_button_select_files; ?></span></a><span class="faq fa-question tooltip" titlett="<?php echo $ms_account_product_download_note ?>"></span>
						<div class="error" id="error_product_download"></div>
						<div class="download progress"></div>
						<div class="product_download_files">
						<?php if (isset($product['downloads'])) { ?>
							<?php $i = 0; ?>
							<?php foreach ($product['downloads'] as $download) { ?>
								<div class="ms-download">
								<input type="hidden" name="product_downloads[<?php echo $i; ?>][download_id]" value="<?php echo $download['id']; ?>" />
								<input type="hidden" name="product_downloads[<?php echo $i; ?>][filename]" value="" />
								<div class="ms-download-name"><?php echo $download['name']; ?></div>
								<div class="ms-buttons">
									<a class="ms-button-delete" title="<?php echo $ms_delete; ?>"></a>
								</div>
								</div>
							<?php $i++; ?>
							<?php } ?>
						<?php } ?>
						</div>

                                   <?php } else { ?>
                                        <?php if (isset($product['downloads'])) { ?>
                                                 <?php foreach ($product['downloads'] as $download) { ?>
                                                      <a href="<?php echo $download['href']; ?>" class="ms-button-download" title="<?php echo $ms_download; ?>"><div class="ms-download"><?php echo $download['name']; ?></div></a>
                                                 <?php } ?>
                                         <?php } ?>
                                   <?php } ?>
				   </td>
				</tr>                                

                                <?php if (!isset($product['product_id']) || empty($product['product_id'])) { ?>
				<tr>
					<td><?php echo $entry_legal; ?></td>
					<td><input type="checkbox" name="product_legal" /><p class="error" id="error_product_legal"></p></td>
				</tr>
				<tr>
					<td><?php echo $ms_account_confirm_deletion_post_checkbox; ?></td>
					<td><input type="checkbox" name="product_confirmdelete" /></td>
				</tr>
                                <?php } ?>

				<tr>
					<td><?php echo $ms_account_product_price; ?></td>
					<td><input type="text" name="product_price" value="<?php echo $product['price']; ?>">
                                           <p class="error" id="error_product_price"></p>
                                        </td>
				</tr>
                                
				<tr>
					<td><?php echo $ms_account_product_category; ?></td>
					<td><?php if (!$msconf_allow_multiple_categories) { ?><select name="product_category">
						<?php foreach ($categories as $category) { ?>
                                                   <?php if ($category['parent_id'] > 0) { ?>
						<option value="<?php echo $category['category_id']; ?>" <?php if (in_array($category['category_id'], explode(',',$product['category_id'])) && !$category['disabled']) { ?>selected="selected"<?php } ?><?php echo ($category['disabled'] ? 'disabled' : ''); ?>>
							<?php echo str_repeat('&nbsp;', $category['depth'] - 1); ?>
							<?php //if ($category['depth'] > 1) echo 'a'; ?>
							<?php echo trim($category['name']); ?>
						</option>
						   <?php }//display all cats except for the root ?>
						<?php } ?>
					</select>
					<?php } else { ?>
					<div class="scrollbox">
						<?php $class = 'odd'; ?>
							<?php foreach ($categories as $category) { ?>
							<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
							<div class="<?php echo $class; ?> <?php echo ($category['disabled'] ? 'disabled' : ''); ?>">
								<input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>" <?php if (in_array($category['category_id'], explode(',',$product['category_id'])) && !$category['disabled']) { ?>checked="checked"<?php } ?> <?php if ($category['disabled']) { ?>disabled="disabled"<?php } ?>/>
								<?php echo $category['name']; ?>
							</div>
						<?php }//end for each ?>
					</div>

					   <?php } ?>

					<p class="error" id="error_product_category"></p>
					</td>
				</tr>
                                <?php if (isset($product['product_id']) && !empty($product['product_id']) && 1==2) { ?>
                                <tr>
					<td colspan="2"><?php echo $ms_account_product_add_combo; ?><span class="faq fa-question tooltip" titlett="<?php echo $ms_account_product_bundle_note ?>"></span></td>
				</tr> 
                                <tr>
					<td><?php echo $ms_account_product_combo_price; ?></td>
					<td><?php echo $ms_account_product_other_items; ?></td>
				</tr>  
                                <?php if (isset($product['combos']) && !empty($product['combos'])) { 
                                          $currencies = $this->model_localisation_currency->getCurrencies();
                                          $decimal_place = $currencies[$this->config->get('config_currency')]['decimal_place'];
                                          $decimal_point = $this->language->get('decimal_point');
                                          $thousand_point = $this->language->get('thousand_point');
                                ?>
                                <tr>
					<td><input type="text" name="product_combos[0][price]" value="<?php echo number_format(round($product['combos']['price'], (int)$decimal_place), (int)$decimal_place, $decimal_point, ''); ?>" /></td>
					<td>
                                            <select multiple name="product_combos[0][combo_products][]">
                                            <?php foreach($eligible_products as $prod) {
                                                 echo intval($prod['product_id']) != intval($product['product_id']) ? 
                                                 ((in_array(intval($prod['product_id']), $product['combos']['combo_product_id'])) ? 
                                                      '<option selected value="' . $prod['product_id'] . '">' . $prod['pd.name'] . '</option>' : 
                                                      '<option value="' . $prod['product_id'] . '">' . $prod['pd.name'] . '</option>') : '';
                                            }?>
                                            </select>
                                            <a class="ms-button-delete" title="<?php echo $ms_delete; ?>"></a>
                                        </td>
				</tr>   
                                <?php } else { ?>
                                <tr>
					<td><input type="text" name="product_combos[0][price]" value="" /></td>
					<td>
                                            <select multiple name="product_combos[0][combo_products][]">
                                            <?php foreach($eligible_products as $prod) {
                                                 echo intval($prod['product_id']) != intval($product['product_id']) ? '<option value="' . $prod['product_id'] . '">' . $prod['pd.name'] . '</option>' : '';
                                            }?>
                                            </select>
                                        </td>
				</tr>
                                <?php } ?>
                                <?php } //if existing product ?>
                        </table>
			</div>
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

	        <div id="ms-product-right">
		<table class="ms-product-retrieved">
		    <tr>
			<td><b><?php echo $ms_account_product_name . ':'; ?></b></td>
			<td id="product_name"><?php echo $product['languages'][$this->config->get('config_language_id')]['name'];?></td>
		    </tr>
					<tr>
						<td><b><?php echo $entry_ean; ?></b></td>
			                        <td id="product_ean"><?php echo $product['ean'] ?></td>
					</tr>
                                        
                                        <tr>
						<td><b><?php echo $entry_author; ?></b></td>
			                        <td id="product_author"><?php echo $product['authorstring'] ?></td>
					</tr>
		   
					<tr>
						<td><b><?php echo $entry_book_language; ?></b></td>
						<td id="product_language"><?php echo $product['book_language'] ?></td>
					</tr>
					<tr>
						 <td><b><?php echo $entry_date_published; ?></b></td>
						 <td id="product_datepublished"><?php echo $product['date_published'] ?></td>
					</tr>
		    <tr>
			<td colspan="2"><b><?php echo $ms_account_product_description; ?>:</b></td>
		    </tr>
		    <tr>
			<td colspan="2">
				<div id="product_description">
                        <?php 
                           $string = strip_tags($product['languages'][$this->config->get('config_language_id')]['description']);

                           if (strlen($string) > 500) {

                               // truncate string
                               $stringCut = substr($string, 0, 500);
                           
                               // make sure it ends in a word so assassinate doesn't become ass...
                               $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                           }
                           echo str_replace("\n", "<br/>", $string);
                        ?>
                 </div>
            </td>
		    <tr>
		    <?php if($product['product_cover_images']) { ?>
		        <?php foreach($product['product_cover_images'] as $img){ ?>
                <td>
                    <img src="<?php echo $img['image']; ?>" class="productimage" />
                </td>
                <?php } ?>
		    <?php } else { ?>
			<td>
                        <img id="productimage1" class="productimage" />
                        </td>
		    <?php } ?>
		    </tr>

		</table>
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
		config_enable_rte: '<?php echo $this->config->get('msconf_enable_rte'); ?>',
		validation_error: '<?php echo htmlspecialchars($ms_validation_error, ENT_QUOTES, "UTF-8"); ?>'
	};
</script>

<div style="clear:both; content:''"></div>
<?php echo $footer; ?>

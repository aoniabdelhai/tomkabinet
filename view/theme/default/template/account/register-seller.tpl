<?php echo $header; ?>

<?php if ($error_warning) { ?>
<div class="inotify">
	<div class="warning"><?php echo $error_warning; ?><a href="#" class="de_closenote"></a></div>
</div>
<?php } ?>


<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="contentaccountseller"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
  <!-- Buyer account part -->
  
  <div class="left-accountregister">
  <h1><?php //echo $ms_account_register_seller; ?></h1>
  <p><strong>Welkom! Als je e-books wilt verkopen, heeft Tom een paar gegevens van je nodig.</strong></p>

  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="ms-accountinfo">
    <input type="hidden" name="telephone" value="nietverplicht" />
    <input type="hidden" name="address_1" value="nietverplicht" />
    <input type="hidden" name="city" value="nietverplicht" />
    <input type="hidden" name="postcode" value="nietverplicht" />
    <input type="hidden" name="country_id" value="nietverplicht" />
    <input type="hidden" name="zone_id" value="nietverplicht" />
    <input type="hidden" name="seller_company" value="" />
    <input type="hidden" name="seller_description" value="" />
    <div class="content">
      <table class="form" id="table_registration">
        <tr>
          <td><?php echo $entry_firstname; ?></td>
          <td><input type="text" name="firstname" value="<?php echo $firstname; ?>" />
            <?php if ($error_firstname) { ?>
            <span class="error"><?php echo $error_firstname; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_lastname; ?></td>
          <td><input type="text" name="lastname" value="<?php echo $lastname; ?>" /><span class="faq fa-question tooltip" titlett="Je naam en emailadres zullen niet getoond worden op de website."></span>
            <?php if ($error_lastname) { ?>
            <span class="error"><?php echo $error_lastname; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_email; ?></td>
          <td><input type="text" name="email" value="<?php echo $email; ?>" />
            <?php if ($error_email) { ?>
            <span class="error"><?php echo $error_email; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_password; ?></td>
          <td><input type="password" name="password" value="<?php echo $password; ?>" /><span class="faq fa-question tooltip" titlett="Een wachtwoord moet minimaal lengte 8 hebben en een kleine letter, hoofdletter en cijfer bevatten."></span>
            <?php if ($error_password) { ?>
            <span class="error"><?php echo $error_password; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_confirm; ?></td>
          <td><input type="password" name="confirm" value="<?php echo $confirm; ?>" />
            <?php if ($error_confirm) { ?>
            <span class="error"><?php echo $error_confirm; ?></span>
            <?php } ?></td>
        </tr>
	<tr>
	    <td><?php echo $ms_account_sellerinfo_nickname; ?></td>
	    <td>
		<input type="text" name="seller_nickname" value="<?php echo $seller_nickname; ?>" /><span class="faq fa-question tooltip" titlett="<?php echo $ms_account_sellerinfo_nickname_note; ?>"></span>
		<?php if ($error_seller_nickname) { ?>
		<span class="error"><?php echo $error_seller_nickname; ?></span>
		<?php } ?>
            </td>
	</tr>
			
	<tr>
		<td><?php echo $ms_account_sellerinfo_paypal; ?></td>
		<td>
                        <input type="text" name="seller_paypal" value="<?php echo $seller_paypal; ?>" /><span class="faq fa-question tooltip" titlett="<?php echo $ms_account_sellerinfo_paypal_note; ?>"></span>
			<?php if ($error_seller_paypal) { ?>
				<span class="error"><?php echo $error_seller_paypal; ?></span>
			<?php } ?>
		</td>
	</tr>
			<?php if ($ms_account_sellerinfo_terms_note) { ?>
			<tr>
				<td><?php echo $ms_account_sellerinfo_terms; ?></td>
				<td>
				   <input type="checkbox" name="seller_terms" value="1" /><?php echo $ms_account_sellerinfo_terms_note; ?><span class="faq fa-question tooltip" titlett='<?php echo $ms_account_sellerinfo_terms_text; ?>'></span>
				<?php if ($error_seller_terms) { ?>
					<span class="error"><?php echo $error_seller_terms; ?></span>
				<?php } ?></td>
			</tr>
			<?php } ?>
			
			<tr>
                            <td><?php echo $entry_newsletter; ?></td>
                            <td><?php if ($newsletter) { ?>
                                <input type="radio" name="newsletter" value="1" checked="checked" />
                                <?php echo $text_yes; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="newsletter" value="0" />
                                <?php echo $text_no; ?>
                                <?php } else { ?>
                                <input type="radio" name="newsletter" value="1" />
                                <?php echo $text_yes; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="newsletter" value="0" checked="checked" />
                                <?php echo $text_no; ?>
                                <?php } ?>
                            </td>
                        </tr>
		</table>
	</div>
		
	<?php if (isset($group_commissions) && $group_commissions[MsCommission::RATE_SIGNUP]['flat'] > 0) { ?>
		<p class="attention ms-commission">
			<?php echo sprintf($this->language->get('ms_account_sellerinfo_fee_flat'),$this->currency->format($group_commissions[MsCommission::RATE_SIGNUP]['flat'], $this->config->get('config_currency')), $this->config->get('config_name')); ?>
			<?php echo $ms_commission_payment_type; ?>
		</p>
	<?php } ?>
	
	<!-- Common part -->
	
    <div class="content">
      <table class="form">
        
      </table>
    </div>

	
	<?php if ($text_agree) { ?>
	<div class="buttons">
	  <div class="right">
	  	<span class="agree">
	      	<?php echo $text_agree; ?>
	        <?php if ($agree) { ?>
	        <input type="checkbox" name="agree" value="1" checked="checked" />
	        <?php } else { ?>
	        <input type="checkbox" name="agree" value="1" />
	        <?php } ?>
	    </span>
	    <input type="submit" value="<?php echo $ms_button_create; ?>" class="button" />
	  </div>
	</div>
	<?php } else { ?>
	<div class="buttons">
	  <div class="right">
	    <input type="submit" value="<?php echo $ms_button_create; ?>" class="button" />
	  </div>
	</div>
	<?php } ?>
	

  </form>
  </div>
     <div class="right-accountregister">
        <p>Heb je al een account? <a href="index.php?route=account/login">Log dan snel in</a>.</p>
     </div>
  </div>
 
  <?php echo $content_bottom; ?></div>

<!-- Seller account part -->
<?php $timestamp = time(); ?>
<script type="text/javascript">
	var msGlobals = {
		timestamp: '<?php echo $timestamp; ?>',
		token : '<?php echo md5($timestamp); ?>',
		session_id: '<?php echo session_id(); ?>',
		uploadError: '<?php echo htmlspecialchars($ms_error_file_upload_error, ENT_QUOTES, "UTF-8"); ?>',
		config_enable_rte: '<?php echo $this->config->get('msconf_enable_rte'); ?>'
	};
</script>

<!-- Buyer account part -->
<script type="text/javascript"><!--
$('input[name=\'customer_group_id\']:checked').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_required'] = '<?php echo $customer_group['company_id_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_required'] = '<?php echo $customer_group['tax_id_required']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('#company-id-display').show();
		} else {
			$('#company-id-display').hide();
		}
		
		if (customer_group[this.value]['company_id_required'] == '1') {
			$('#company-id-required').show();
		} else {
			$('#company-id-required').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('#tax-id-display').show();
		} else {
			$('#tax-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_required'] == '1') {
			$('#tax-id-required').show();
		} else {
			$('#tax-id-required').hide();
		}	
	}
});

$('input[name=\'customer_group_id\']:checked').trigger('change');
//--></script> 
<script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=account/register-seller/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'seller_country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=account/register-seller/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'seller_country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},
		success: function(json) {
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'seller_zone\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
$('select[name=\'seller_country_id\']').trigger('change');
//--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.colorbox').colorbox({
		width: 640,
		height: 480
	});
});
//--></script>
<?php if ($this->config->get('msconf_avatars_for_sellers') == 1 || $this->config->get('msconf_avatars_for_sellers') == 2) { ?>
	<script type="text/javascript">
		$('#ms-predefined-avatars').colorbox({
			width:'600px', height:'70%', inline:true, href:'#ms-predefined-avatars-container'
		});

		$('.avatars-list img').click(function() {
			if ($('.ms-image img').length == 0) {
				$('#sellerinfo_avatar_files').html('<div class="ms-image">' +
					'<input type="hidden" value="'+$(this).data('value')+'" name="seller_avatar_name" />' +
					'<img src="'+$(this).attr('src')+'" />' +
					'<span class="ms-remove"></span>' +
					'</div>');
			} else {
				$('.ms-image input[name="seller_avatar_name"]').val($(this).data('value'));
				$('.ms-image img').attr('src', $(this).attr('src'));
			}
			$(window).colorbox.close();
		});
	</script>
<?php } ?>
<?php echo $footer; ?>

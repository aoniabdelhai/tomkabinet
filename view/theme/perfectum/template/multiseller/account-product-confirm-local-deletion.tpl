<?php echo $header; ?>

<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="accountstart">


<div id="contentaccountoverlay" class="ms-account-product">
	<?php echo $content_top; ?>
	
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>

	<?php if (isset($error_warning) && ($error_warning)) { ?>
		<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>

	<?php if (isset($confirm_deletion_error)) { ?>
		<div class="warning"><?php echo $ms_account_confirm_deletion_no_confirm; ?></div>
	<?php } ?>

	<h1><?php echo $ms_account_confirm_deletion_heading; ?></h1>

	<div><?php echo $ms_account_confirm_deletion_body; ?></div>

	<?php
	if (!empty($downloads_to_confirm)) {
		echo "<div>" . $ms_account_confirm_deletion_list_header . "</div>";
		echo "<ul>";
		foreach($downloads_to_confirm as $download) {
			echo "<li>" . $download . "</li>";
		}
		echo "</ul>";
	}
	?>

	<div>
        <form name="confirm_deletion" action="<?php echo $action_submit; ?>" method="post">
        <input type="hidden" value="<?php echo $product_form_id; ?>" name="product_id" />
        <input type="checkbox" name="confirmed" value="Yes"><?php echo $ms_account_confirm_deletion_post_checkbox; ?>
        <input type="submit" value="Bevestig" class="search_button_small floatright">
        </form>
        </div>


	<?php echo $content_bottom; ?>
</div>
</div>
<?php echo $footer; ?>

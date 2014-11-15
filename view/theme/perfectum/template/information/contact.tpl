<?php echo $header; ?>

<div id="topinformation">
	<div id="slogan">
		<span class="title">Boeken om te delen</span>
		<span class="description">Tweedehands e-books worden steeds goedkoper maar slijten nooit.</span>
	</div>
	<div id="bar">
		<div id="circle">
			<div class="left"></div>
			<div class="right"></div>
			<div class="arrow"></div>
		</div>
	</div>
</div>

<div id="contentinformation_wrapper" class="clearfix">
	<div id="contentinformation">
		<?php echo $column_left; ?>
		<?php echo $column_right; ?>
		<?php echo $content_top; ?>
		<div class="breadcrumb">
  		<?php foreach ($breadcrumbs as $breadcrumb): ?>
    		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  		<?php endforeach; ?>
		</div>
		
		<div class="text">
			<h1><?php echo $heading_title; ?></h1>
			
			<?php if($sendok) { ?>
			<h3><?php echo $sendok; ?></h3>
			<?php } ?>
			
			<div class="contact-info">
				<div class="content"><?php echo $description; ?></div>
			</div>
			
			<?php if(($this->config->get('perfectum_status') == '1')&&($this->config->get('layout_product_customcontactblock'))) { 
			  echo '<div class="contact-info">
			     <div class="content">'.html_entity_decode($this->config->get('layout_product_customcontactblock_content')).'</div>
			    </div>';
			} ?>
			
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="std"> 
			  
			  <h2><?php echo $text_contact; ?></h2>	
				  
			  <p><label><?php echo $entry_name; ?></label>
			  	<input type="text" class="txt" name="name" value="<?php echo $name; ?>" />
			  	<?php if ($error_name) { ?><span class="error"><?php echo $error_name; ?></span><?php } ?>
			  </p>
			  
			  <p><label><?php echo $entry_email; ?></label>
			  	<input type="text" class="txt" name="email" value="<?php echo $email; ?>" />
			  	<?php if ($error_email) { ?><span class="error"><?php echo $error_email; ?></span><?php } ?>
			  </p>
			  
			  <p><label><?php echo $entry_enquiry; ?></label>
			  	<textarea name="enquiry"><?php echo $enquiry; ?></textarea>
			  	<?php if ($error_enquiry) { ?><span class="error"><?php echo $error_enquiry; ?></span><?php } ?>
			  </p>
			  
			  <p class="captcha"><label><?php echo $entry_captcha; ?></label>
			  	<input type="text" class="txt" name="captcha" value="<?php echo $captcha; ?>" />
			  	<img src="index.php?route=information/contact/captcha" alt="" />
			  	<?php if ($error_captcha) { ?><span class="error"><?php echo $error_captcha; ?></span><?php } ?>
			  </p>
			  
			  <div class="buttons">
			    <div class="right"><input type="submit" value="<?php echo $button_continue; ?>" class="button" /></div>
			  </div>
			</form>
			<?php echo $content_bottom; ?>
		</div>
	</div>
</div>

<?php echo $footer; ?>

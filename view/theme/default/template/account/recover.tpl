<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
	<div class="breadcrumb">
	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
	<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	<?php } ?>
	</div>
	<h1><?php echo $heading_title; ?></h1>
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	<p><?php echo $text_email; ?></p>
	<h2><?php echo $text_your_email; ?></h2>
	<div class="content">
	  <table class="form">
		<tr>
		  <td><?php echo $entry_email; ?></td>
		  <td><input type="text" name="email" value="<?php if(isset($this->request->get['email'])) { echo $this->request->get['email'];} ?>" /></td>
		</tr>
	  </table>
	</div>
	<h2><?php echo $text_your_codes; ?></h2>
	<div class="content">
	  <table class="form">
		<tr>
		  <td><?php echo $entry_c1; ?></td>
		  <td><input type="text" name="c1" value="" /></td>
		</tr>
		<tr>
		  <td><?php echo $entry_c2; ?></td>
		  <td><input type="text" name="c2" value="" /></td>
		</tr>
	  </table>
	</div>
	<h2><?php echo $text_your_password; ?></h2>
	<div class="content">
	  <table class="form">
		<tr>
		  <td><?php echo $entry_new_password; ?></td>
		  <td><input type="password" name="pass" value="" /></td>
		</tr>
		<tr>
		  <td><?php echo $entry_new_password_repeat; ?></td>
		  <td><input type="password" name="pass_rep" value="" /></td>
		</tr>
	  </table>
	</div>
	<div class="buttons">
	  <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
	  <div class="right">
		<input type="submit" value="<?php echo $button_continue; ?>" class="button" />
	  </div>
	</div>
	</form>
	<?php echo $content_bottom; ?></div>
<?php echo $footer; ?>
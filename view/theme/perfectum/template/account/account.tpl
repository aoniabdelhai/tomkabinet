<?php echo $header; ?>

<?php if ($success) { ?>
<div class="inotify">
	<div class="success"><?php echo $success; ?><a href="#" class="de_closenote"></a></div>
</div>
<?php } ?>

<?php echo $column_left; ?><?php echo $column_right; ?>

<div id="contentaccountoverlay">
	<?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php //echo $heading_title; ?></h1>
  <div class="divonethird">
      <h2><?php echo $text_my_account; ?></h2>
      <div class="content">
        <ul>
          <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
          <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
          <li><a href="index.php?route=account/logout">Uitloggen</a></li>
        </ul>
      </div>
  </div>
  <div class="divonethird">
    <h2><?php echo $text_my_orders; ?></h2>
    <div class="content">
      <ul>
        <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
        <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
      </ul>
    </div>
  </div>
  <div class="divonethird">
     <!-- sponiza change input seller account -->
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?> 

<?php echo $header; ?>

<?php if ($success) { ?>
<div class="inotify">
	<div class="success"><?php echo $success; ?><a href="#" class="de_closenote"></a></div>
</div>
<?php } ?>

<?php if ($error_warning) { ?>
<div class="inotify">
	<div class="warning"><?php echo $error_warning; ?><a href="#" class="de_closenote"></a></div>
</div>
<?php } ?>

<div id="accountstart">

<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="contentaccount"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php //echo $heading_title; ?></h1>
  <div class="login-content">
    <div class="left">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="content">
          <b><?php echo $entry_email; ?></b><br />
          <input type="text" name="email" value="<?php echo $email; ?>" />
          <br />
          <br />
          <b><?php echo $entry_password; ?></b><br />
          <input type="password" name="password" value="<?php echo $password; ?>" />
          <br />
          <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a><br />
          <br />
          <input type="submit" value="<?php echo $button_login; ?>" class="button" />
          <?php if ($redirect && 1==2) { ?>
          <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
          <?php } ?>
        </div>
      </form>
    </div>
    <div class="right">
      <div class="content">
        <p><b><?php //echo $text_register; ?></b></p>
        <p>Heb je nog geen account? Kom verder!</p>
        <div class="buttons">
	      <div class="floatleft">
			<a href="<?php echo $register; ?>">&rsaquo; E-books kopen</a><br />
		 	<a href="index.php?route=account/register-seller">&rsaquo; E-books verkopen</a>
	      </div>
		</div>
      </div>
    </div>
  </div>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('#login input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#login').submit();
	}
});
//--></script> 
</div>
<?php echo $footer; ?>

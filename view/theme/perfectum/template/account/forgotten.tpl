<?php echo $header; ?>

<?php if(1==2){ ?>
<div id="accountstart">
   <img src="image/data/background/manzonnebril.jpg" style="max-width: 100%;">
   <div id="slogan">
        <span class="title">Plugins om te delen</span>
        <span class="description">Online delen plugins, themes en handleidingen</span>
   </div>
   <div id="bar">
       <div id="circle">
           <div class="left"></div>
           <div class="right"></div>
           <div class="arrow"></div>
       </div>
   </div>
</div>
<?php } ?>


<?php if ($error_warning) { ?>
<div class="inotify">
	<div class="warning"><?php echo $error_warning; ?><a href="#" class="de_closenote"></a></div>
</div>
<?php } ?>



<?php echo $column_left; ?>
<?php echo $column_right; ?>

<div id="contentaccountoverlay">
	
	<?php echo $content_top; ?>
 
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
		      <td><input type="text" name="email" value="" /></td>
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
	
	<?php echo $content_bottom; ?>
  
</div>

<?php echo $footer; ?>

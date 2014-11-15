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
			<?php echo $description; ?>
			<?php echo $content_bottom; ?>
		</div>
	</div>
</div>

<?php echo $footer; ?>
<?php if ($authors) { ?>
<div class="box">
	<div class="box-heading"><?php echo $heading_title; ?></div>
	<div class="box-content">
		<div class="box-product">
			<?php foreach ($authors as $author) { ?>
			<div>
				<?php if ($author['thumb']) { ?>
				<div class="image"><a href="<?php echo $author['href']; ?>"><img src="<?php echo $author['thumb']; ?>" alt="<?php echo $author['name']; ?>" /></a></div>
				<?php } ?>
				<div class="name"><a href="<?php echo $author['href']; ?>"><?php echo $author['name']; ?></a></div>
				<div class="price"><?php echo $text_total; ?>&nbsp;<?php echo $author['sales']; ?></div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>
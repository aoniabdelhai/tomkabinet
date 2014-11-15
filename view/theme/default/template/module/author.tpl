<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <?php if ($authors) { ?>
    <select onchange="location=this.options[this.selectedIndex].value;">
      <option value=""><?php echo $text_select; ?></option>
      <?php foreach ($authors as $author) { ?>
      <option value="<?php echo $author['href']; ?>"><?php echo $author['name']; ?></option>
      <?php } ?>
    </select>
    <?php } ?>
  </div>
</div>
<?php echo $header; ?>
​
<script src="catalog/view/javascript/jwplayer/jwplayer.js" ></script>
<script>jwplayer.key="8YayzwhM9L18JAhRJjMKrbmCZ2SDiJt3bCqkzQ==";</script>

<?php if(1==2){ ?>
<div id="accountstart">
   <img src="image/data/background/manzonnebril.jpg" style="max-width: 100%;">
</div>
<?php } ?>

<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="contentaccountoverlay"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php //echo $heading_title; ?></h1>
  <h2>Download uitleg</h2>
  <p>
    Hieronder staan de downloads van je bestelling(en). Het getal bij "Aantal downloads" geeft aan hoeveel pogingen je nog hebt om het boek te downloaden.
    <br /><br />
    Het downloaden werkt in verschillende browsers vaak op verschillende manieren. Als je na het klikken op "Download je e-book" het idee hebt dat het niet goed is gegaan, let dan op de volgende punten:
    <ul>
      <li>
        <b>Vaak 'zie' je de download niet, maar slaat je browser het ebook automatisch op in je map 'Downloads'.</b>
        <br />
        Zoek eerst in deze map of het e-book daar niet in staat.
      </li>
      <li>
        <b>Wil je ebooks downloaden op een ipad, en lukt het niet of weet je niet waar het ebook opgeslagen wordt?</b>
        <br />
        Klik dan <a href="#" onclick="document.getElementById('ipad_wrapper').style.display = 'block'; return false;">hier</a> voor een uitlegfilmpje.
        <br />
        <div id="ipad_wrapper" style="display: none;">
          <div id="ipad">Loading the player...</div>
        </div>
        <script type="text/javascript">
            jwplayer("ipad").setup({
                file: "image/TK on iPad.mp4",
                //image: "http://example.com/uploads/myPoster.jpg",
                width: 640,
                height: 360
            });
        </script>
      </li>
      <li>
        <b>Wil je ebooks downloaden op je iphone?</b>
        <br />
        Klik dan <a href="#" onclick="document.getElementById('iphone_wrapper').style.display = 'block'; return false;">hier</a> voor een uitlegfilmpje.
        <br />
        <div id="iphone_wrapper" style="display: none;">
          <div id="iphone">Loading the player...</div>
        </div>
        <script type="text/javascript">
            jwplayer("iphone").setup({
                file: "image/TK on iPhone.mp4",
                //image: "http://example.com/uploads/myPoster.jpg",
                width: 640,
                height: 360
            });
        </script>
      </li>
    </ul>
  </p>
  <?php foreach ($downloads as $download) { ?>
  <div class="download-list">
    <div class="download-id"><b><?php echo $text_order; ?></b> <?php echo $download['order_id']; ?></div>
    <div class="download-content">
      <div class="info">
      	<b><?php echo $text_product; ?></b> : <?php echo $download['product']; ?><br />
      	<b><?php echo $text_name; ?></b> : <?php echo $download['name']; ?>
      </div>
      <div>
      	<b><?php echo $text_remaining; ?></b> : <?php echo $download['remaining']; ?>
      </div>
      <div class="download-info">
        <?php if ($download['remaining'] > 0) { ?>
        <a href="<?php echo $download['href']; ?>" class="det_button">Download je e-book</a>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
  <div class="pagination"><?php echo $pagination; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>

<div id="register" class="left">
  <h2><?php echo $text_new_customer; ?></h2>
  <p><?php echo $text_checkout; ?></p>
  <!-- adapting the checkout process, request the userid immediately -->
    <input type="hidden" name="telephone" value="nietverplicht" />
    <input type="hidden" name="address_1" value="nietverplicht" />
    <input type="hidden" name="city" value="nietverplicht" />
    <input type="hidden" name="postcode" value="nietverplicht" />
    <input type="hidden" name="country_id" value="NL" />
    <input type="hidden" name="zone_id" value="ZH" />
        </span>Voornaam:
        <br>
        <input class="large-field" type="text" value="" name="firstname">
        <br>
        <br>
        Achternaam:
        <br>
        <input class="large-field" type="text" value="" name="lastname"><span class="faq fa-question tooltip" titlett="Je naam en emailadres zullen niet getoond worden op de website."></span>
        <br>
        <br>
        E-mail adres:
        <br>
        <input class="large-field" type="text" value="" name="email">
        <br>
        <br>
        <h2>Uw wachtwoord</h2>
        Uw wachtwoord:
        <br>
        <input class="large-field" type="password" value="" name="password"><span class="faq fa-question tooltip" titlett="Een wachtwoord moet minimaal lengte 8 hebben en een kleine letter, hoofdletter en cijfer bevatten."></span>
        <br>
        <br>
        Bevestig uw wachtwoord:
        <br>
        <input class="large-field" type="password" value="" name="confirm">
        <br>
        <br>
        <br>
    <div style="clear: both; padding-top: 15px; border-top: 1px solid #EEEEEE;">
	    <div class="buttons">
	    	<span class="agree">Ik heb de <a class="colorbox" alt="Algemene Voorwaarden" href="index.php?route=information/information/info&information_id=5">Algemene Voorwaarden</a>
	     gelezen en ga hiermee akkoord <input type="checkbox" value="1" name="agree"></span>
	    	<input id="button-register" class="button" type="button" value="Verder">
	    </div>
	</div>
<!-- end adapting the checkout process, request the userid immediately -->
  
</div><!-- end class left -->
<div id="login" class="right">
  <h2><?php echo $text_returning_customer; ?></h2>
  <p><?php echo $text_i_am_returning_customer; ?></p>
  <b><?php echo $entry_email; ?></b><br />
  <input type="text" name="email" value="" />
  <br />
  <br />
  <b><?php echo $entry_password; ?></b><br />
  <input type="password" name="password" value="" />
  <br />
  <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a><br />
  <br />
  <input type="button" value="<?php echo $button_login; ?>" id="button-login" class="button" /><br />
  <br />
</div>

<script type="text/javascript"><!--
$('.colorbox').colorbox({
	width: 640,
	height: 480
});
//--></script> 

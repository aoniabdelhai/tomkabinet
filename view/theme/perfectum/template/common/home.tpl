<?php
$cover_pos = array("left","center","right");
?>

<?php echo $header; ?>
<div id="contenthome">
    <div class="headercontent">
        <div id="slogan">
            <h1 class="title" style="color:#FFF;">E-books kopen, lezen en verkopen</h1>
            <p class="description">Verkoop je tweedehands e-books. Veilig en legaal.</p>
        </div>
    </div>
    <div id="search_wrap">
        <form id="myformhome" method="get" action="index.php">
        <input type="text" name="search" value='' placeholder="Zoek e-books"/>
        <input type="hidden" name="route" value="product/adsattributes" />
        <input type='submit' value='Zoek' />
        
        </form>
        
    </div>
    <div id="advanced_search"><a href="index.php?route=product/adsattributes">Geavanceerd&nbsp;zoeken&nbsp;&raquo;</a></div>



</div>

<div id="calloutswrapper">
    <h2>Hoe gaat <span>Tom</span> te werk?</h2>
    <div id="callouts" class="clearfix">
        <div class="col">
            <div class="icon"><img src="image/data/logo.png" /></div>
            <div class="text">
                <h3>1. Upload je e-book</h3>
                <p>
                    Een e-book uploaden is gratis en kost je een paar minuten. Wordt het niet verkocht, dan download je het weer. 
                    Het e-book blijft van jou tot het verkocht is.
                </p>
            </div>
        </div>
        <div class="col">
            <div class="icon"><img src="image/data/logo.png" /></div>
            <div class="text">
                <h3>2. Verkoop je e-book</h3>
                <p>
                    Gelukt! De koper betaalt en jij ontvangt dit bedrag minus een kleine bijdrage voor beveiliging van het 
                    e-book en een veilige betaalomgeving. 
                </p>
            </div>
        </div>
        <div class="col">
            <div class="icon"><img src="image/data/logo.png" /></div>
            <div class="text">
                <h3>3. Waarborg legaliteit</h3>
                <p>
                    Om de auteursrechten te waarborgen, mag er maar 1 kopie in omloop zijn. Jij wist de kopie die je op je PC, tablet, ereader of telefoon hebt staan. 
                </p>
            </div>
        </div>
    </div>
</div>

<div id="endbanner">
    <div class="endbanner-content">
        <div class="title">Help Tom om e-books betaalbaar te maken</div>
        <div class="description"><p>Hallo, ik ben Tom, en persoonlijk vind ik de prijzen van e-books te hoog.
                Toch wil ik best &euro;&nbsp;14,- betalen als ik er &euro;&nbsp;8,- voor terug krijg.
                Zo kan een e-book vele keren worden doorverkocht tegen steeds lagere prijzen! Gemakkelijk, legaal en veilig.
                Zet jij je e-books ook op de site?</p></div>
        <div class="info-endbanner-button"><a class="info-button" href="index.php?route=information/information&information_id=8">Wat kan Tom voor jou doen?</a></div>
    </div>
</div>

<?php echo $footer; ?>

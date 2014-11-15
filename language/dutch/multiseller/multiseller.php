<?php

// **********
// * Global *
// **********
$_['ms_viewinstore'] = 'Bekijk in de winkel';
$_['ms_view'] = 'Bekijk';
$_['ms_publish'] = 'Publiceer';
$_['ms_unpublish'] = 'Publiceren ongedaan maken';
$_['ms_edit'] = 'Wijzig';
$_['ms_clone'] = 'Kloon';
$_['ms_relist'] = 'Opnieuw opsommen';
$_['ms_rate'] = 'Beoordeling';
$_['ms_download'] = 'Download';
$_['ms_create_product'] = 'Upload een nieuw e-book';
$_['ms_delete'] = 'Verwijder';
$_['ms_update'] = 'Update';
$_['ms_type'] = 'Type';
$_['ms_amount'] = 'Aantal';
$_['ms_status'] = 'Status';
$_['ms_date_paid'] = 'Datum betaald';
$_['ms_last_message'] = 'Laatste bericht:';
$_['ms_description'] = 'Omschrijving';
$_['ms_id'] = '#';
$_['ms_by'] = 'door';
$_['ms_action'] = 'Actie';
$_['ms_sender'] = 'Afzender';
$_['ms_message'] = 'Bericht';


$_['ms_date_created'] = 'Datum aangemaakt';
$_['ms_date'] = 'Datum';

$_['ms_button_submit'] = 'Verstuur';
$_['ms_button_add_special'] = 'Maak een nieuwe speciale prijs';
$_['ms_button_add_discount'] = 'Maak een nieuwe korting bij hoeveelheid';
$_['ms_button_generate'] = 'Genereer afbeeldingen vanuit PDF';
$_['ms_button_submit_request'] = 'Dien aanvraag in';
$_['ms_button_save'] = 'Opslaan';
$_['ms_button_create'] = 'Account aanmaken';

$_['ms_button_cancel'] = 'Annuleer';
$_['ms_button_select_predefined_avatar'] = 'Selecteer standaard avatar';

$_['ms_button_select_image'] = 'Selecteer afbeelding';
$_['ms_button_select_images'] = 'Selecteer afbeeldingen';
$_['ms_button_select_files'] = 'Browse';

$_['ms_transaction_order'] = 'Verkoop: Bestelling ID #%s';
$_['ms_transaction_sale'] = 'Verkoop: %s (-%s commissie)';
$_['ms_transaction_refund'] = 'Terugbetaling: %s';
$_['ms_transaction_listing'] = 'Weergavekosteng: %s (%s)';
$_['ms_transaction_signup'] = 'Aanmeldkosten vant %s';
$_['ms_request_submitted'] = 'Je verzoek is verzonden';

$_['ms_totals_line'] = 'Momenteel zijn er %s verkopers met %s e-books te koop!';

$_['ms_text_welcome'] = '<a href="%s">Login</a>';
$_['ms_button_register_seller'] = 'Registreer als een verkoper';
$_['ms_register_seller_account'] = 'Registreer een verkopersaccount';

// Mails

// Seller
$_['ms_mail_greeting'] = "Beste %s,\n\n";
$_['ms_mail_greeting_no_name'] = "Beste meneer/mevrouw,\n\n";
$_['ms_mail_ending'] = "\n\nMet vriendelijke groet,\n%s";
$_['ms_mail_message'] = "\n\nBericht:\n%s";

$_['ms_mail_subject_seller_account_created'] = 'Verkopersaccount aangemaakt';
$_['ms_mail_seller_account_created'] = <<<EOT
Je verkopersaccount bij %s is aangemaakt!

Je kunt nu beginnen met het invoeren van je e-books.
EOT;

$_['ms_mail_subject_seller_account_awaiting_moderation'] = 'Verkopersaccount in afwachting van goedkeuring';
$_['ms_mail_seller_account_awaiting_moderation'] = <<<EOT
Je verkopersaccount op %s is aangemaakt en is nu in afwachting van goedkeuring

Je zal een mail ontvangen zodra we het verzoek hebben verwerkt.
EOT;

$_['ms_mail_subject_product_awaiting_moderation'] = 'Product in afwachting van goedkeuring';
$_['ms_mail_product_awaiting_moderation'] = <<<EOT
Je product %s in %s is in afwachting van goedkeuring.

Je zal een mail ontvangen zodra we het verzoek hebben verwerkt.
EOT;

$_['ms_mail_subject_product_purchased'] = 'Nieuwe bestelling';
$_['ms_mail_product_purchased'] = <<<EOT
Je e-book(s) zijn verkocht vanuit %s.

Klant: %s

E-books:
%s
Totaal door jou te ontvangen: %s

Na 14 dagen op de eerstvolgende 1e of 15e van de maand ontvang jij je winst.
EOT;

$_['ms_mail_product_purchased_no_email'] = <<<EOT
Je e-book(s) zijn gekocht vanuit %s.

Klant: %s

E-books:
%s
Totaal door jou te ontvangen: %s

Na 14 dagen op de eerstvolgende 1e of 15e van de maand ontvang jij je winst.
EOT;

$_['ms_mail_subject_seller_contact'] = 'Nieuw bericht van een klant';
$_['ms_mail_seller_contact'] = <<<EOT
Je hebt een nieuw bericht van een klant ontvangen!

Naam: %s

E-mail: %s

E-book: %s

Bericht:
%s
EOT;

$_['ms_mail_seller_contact_no_mail'] = <<<EOT
Je hebt een nieuw bericht van een klant ontvangen!

Naam: %s

E-book: %s

Bericht:
%s
EOT;

$_['ms_mail_product_purchased_info'] = <<<EOT
\n
Afleveradres:

%s %s
%s
%s
%s
%s %s
%s
%s
EOT;

$_['ms_mail_product_purchased_comment'] = 'Opmerking: %s';

$_['ms_mail_subject_withdraw_request_submitted'] = 'Uitbetalingsverzoek verzonden';
$_['ms_mail_withdraw_request_submitted'] = <<<EOT
We hebben je uitbetalingsverzoek ontvangen. Je zal de winst ontvangen zodra we het verzoek hebben verwerkt.
EOT;

$_['ms_mail_subject_withdraw_request_completed'] = 'Uitbetalingsverzoek ingewilligd';
$_['ms_mail_withdraw_request_completed'] = <<<EOT
Je uitbetalingsverzoek is ingewilligd. Je zou nu de winst moeten ontvangen.
EOT;

$_['ms_mail_subject_withdraw_request_declined'] = 'Uitbetalingsverzoek geweigerd';
$_['ms_mail_withdraw_request_declined'] = <<<EOT
Je uitbetalingsverzoek is geweigerd. Je geld is teruggestort op de balans op %s.
EOT;

$_['ms_mail_subject_transaction_performed'] = 'Nieuwe transactie';
$_['ms_mail_transaction_performed'] = <<<EOT
Er is een nieuwe transactie toegevoegd aan je account op %s.
EOT;

// *********
// * Admin *
// *********
$_['ms_mail_admin_subject_seller_account_created'] = 'Nieuw verkopersaccount aangemaakt';
$_['ms_mail_admin_seller_account_created'] = <<<EOT
Er is een nieuw verkopersaccount vanaf %s aangemaakt!
Verkopersnaam: %s (%s)
E-mail: %s
EOT;

$_['ms_mail_admin_subject_seller_account_awaiting_moderation'] = 'Nieuw verkopersaccount in afwachting van goedkeuring';
$_['ms_mail_admin_seller_account_awaiting_moderation'] = <<<EOT
Er is een nieuw verkopersaccount vanaf %s aangemaakt en dit account wacht nu op goedkeuring.
Verkopersnaam: %s (%s)
E-mail: %s

U kunt dit verwerken in de Multiseller - Sellers sectie in het adminpanel.
EOT;

$_['ms_mail_admin_subject_product_created'] = 'Nieuw e-book toegevoegd';
$_['ms_mail_admin_product_created'] = <<<EOT
Er is een nieuw e-book %s toegevoegd aan %s.

Je kunt dit e-book bekijken of bewerken in het adminpanel.
EOT;

$_['ms_mail_admin_subject_new_product_awaiting_moderation'] = 'Nieuw e-book in afwachting van goedkeuring';
$_['ms_mail_admin_new_product_awaiting_moderation'] = <<<EOT
Een nieuw e-book %s is toegevoegd aan %s en is in afwachting van goedkeuring.

Je kunt dit verwerken in de Multiseller - Sellers sectie in het adminpanel.
EOT;

$_['ms_mail_admin_subject_edit_product_awaiting_moderation'] = 'E-book bewerkt en in afwachting van goedkeuring';
$_['ms_mail_admin_edit_product_awaiting_moderation'] = <<<EOT
E-book %s in %s is bewerkt en in afwachting van goedkeuring.

Je kunt dit verwerken in de Multiseller - Sellers sectie in het adminpanel.
EOT;

$_['ms_mail_admin_subject_withdraw_request_submitted'] = 'Uitbetalingsverzoek in afwachting van goedkeuring';
$_['ms_mail_admin_withdraw_request_submitted'] = <<<EOT
Er is een nieuw uitbetalingsverzoek verstuurd.

Je kunt dit verwerken in de Multiseller - Sellers sectie in het adminpanel.
EOT;

// Success
$_['ms_success_product_published'] = 'E-book toegevoegd.';
$_['ms_success_product_unpublished'] = 'E-book verwijderd';
$_['ms_success_product_created'] = 'E-book gecreeërd';
$_['ms_success_product_updated'] = 'E-book gewijzigd';
$_['ms_success_product_deleted'] = 'E-book verwijderd';

// Errors
$_['ms_error_sellerinfo_nickname_empty'] = 'Je nickname mag niet leeg zijn';
$_['ms_error_sellerinfo_nickname_alphanumeric'] = 'Je nickname kan enkel alfanumerieke tekens bevatten.';
$_['ms_error_sellerinfo_nickname_utf8'] = 'Je nickname kan enkel printbare UTF-8 symbolen bevatten.';
$_['ms_error_sellerinfo_nickname_latin'] = 'Je nickname kan enkel alfanumerieke en diacritieke tekens bevatten.';
$_['ms_error_sellerinfo_nickname_length'] = 'Je nickname moet tussen de 4 and 50 tekens lang zijn';
$_['ms_error_sellerinfo_nickname_taken'] = 'Deze nickname is al in gebruik';
$_['ms_error_sellerinfo_company_length'] = 'Jouw bedrijfsnaam mag niet langer dan 50 tekens zijn.';
$_['ms_error_sellerinfo_description_length'] = 'De omschrijving kan niet langer dan 1000 tekens zijn';
$_['ms_error_sellerinfo_paypal'] = 'Geen geldig IBAN rekeningnummer ingevuld';
$_['ms_error_sellerinfo_legal'] = 'Waarschuwing: Je moet verklaren dat je je aan de auteurswet zult houden.';
$_['ms_error_sellerinfo_terms'] = 'Waarschuwing: Je moet de %s accepteren!';
$_['ms_error_file_extension'] = 'Ongeldige extensie';
$_['ms_error_file_type'] = 'Ongeldig bestandstype';
$_['ms_error_file_size'] = 'Bestand te groot';
$_['ms_error_image_too_small'] = 'De afbeeldingsdimensies zijn te klein. De minimaal toegestane grote is %s x %s (Breedte x Hoogte)';
$_['ms_error_image_too_big'] = 'De afbeeldingsdimensies zijn te groot. De maximaal toegestane grote %s x %s (Breedte x Hoogte)';
$_['ms_error_file_upload_error'] = 'Het bestand kon niet worden geüpload';
$_['ms_error_form_submit_error'] = 'Er is iets mis gegaan bij het versturen van het formulier. Contacteer de eigenaar van deze site voor meer informatie.';
$_['ms_error_form_notice'] = 'Check alle tabbladen op fouten.';
$_['ms_error_product_name_empty'] = 'De productnaam kan niet leeg zijn';
$_['ms_error_product_name_length'] = 'De productnaam moet tussen de %s en %s tekens bevatten';
$_['ms_error_product_description_empty'] = 'De productomschrijving kan niet leeg zijn';
$_['ms_error_product_description_length'] = 'De productomschrijving moet tussen de %s en %s tekens bevatten';
$_['ms_error_product_tags_length'] = 'Te lang!';
$_['ms_error_product_price_empty'] = 'Geef alsjeblieft een prijs op voor je e-book';
$_['ms_error_product_price_invalid'] = 'Ongeldige prijs';
$_['ms_error_product_price_low'] = 'Prijs te laag';
$_['ms_error_product_price_high'] = 'Prijs te hoog';
$_['ms_error_product_category_empty'] = 'Selecteer een categorie';
$_['ms_error_product_model_empty'] = 'Het productmodel kan niet leeg zijn';
$_['ms_error_product_model_length'] = 'Het productmodel moet tussen de %s en %s tekens bevatten';
$_['ms_error_product_image_count'] = 'Upload minstens %s afbeelding(en) voor het e-book';
$_['ms_error_product_download_count'] = 'Voeg digitaal bestand toe aan het e-book';
$_['ms_error_product_image_maximum'] = 'Niet meer dan %s afbeelding(en) toegestaan';
$_['ms_error_product_download_maximum'] = 'Niet meer dan %s bestand toegestaan';
$_['ms_error_product_message_length'] = 'Een bericht kan niet langer dan 1000 tekens zijn';
$_['ms_error_product_invalid_pdf_range'] = 'Specificeer pagina\'s of reeksen pagina\'s (-) gescheiden door komma\'s (,)';
$_['ms_error_product_attribute_required'] = 'Deze waarde is verplicht';
$_['ms_error_product_attribute_long'] = 'Deze waarde kan niet meer dan %s symbolen bevatten';
$_['ms_error_withdraw_amount'] = 'Ongeldig aantal';
$_['ms_error_withdraw_balance'] = 'Niet genoeg kapitaal op de balans';
$_['ms_error_withdraw_minimum'] = 'Cannot withdraw less than minimum limit';
$_['ms_error_contact_email'] = 'Geef alstublieft een geldig e-mailadres op';
$_['ms_error_contact_captcha'] = 'Ongeldige captcha code';
$_['ms_error_contact_text'] = 'Een bericht kan niet langer dan 2000 tekens zijn';
$_['ms_error_contact_allfields'] = 'Vul alsjeblieft alle velden in';

// Account - General 
$_['ms_account_register_seller'] = 'Registreer Verkopersaccount';
$_['ms_account_register_seller_success_heading'] = 'Je verkopersaccount is aangemaakt!';
$_['ms_account_register_seller_success_message']  = '<p>Welkom bij %s!</p> <p>Gefeliciteerd! Je nieuwe verkopersaccount is met succes aangemaakt!</p> <p>Je kunt nu profiteren van verkopersprivileges en e-books via Tom aanbieden.</p> <p><a href="%s">Neem contact op met Tom</a> als je ergens tegen aanloopt.</p>';
$_['ms_account_register_seller_success_approval'] = '<p>Welkom bij %s!</p> <p>Je verkopersaccount is geregistreerd en wacht nu op goedkeuring. Je zal op de hoogte worden gesteld per e-mail als je account is geactiveerd door de eigenaar van de website.</p><p><a href="%s">Contacteer ons</a> als je ergens tegen aanloopt.</p>';

$_['ms_seller'] = 'Verkoper';
$_['ms_account_dashboard'] = 'Dashboard';
$_['ms_account_seller_account'] = 'Verkopersaccount';
$_['ms_account_sellerinfo'] = 'Verkopersprofiel';
$_['ms_account_sellerinfo_new'] = 'Nieuw verkopersaccount';
$_['ms_account_newproduct'] = 'Nieuw e-book';
$_['ms_account_products'] = 'E-books';
$_['ms_account_transactions'] = 'Transacties';
$_['ms_account_orders'] = 'Bestellingen';
$_['ms_account_withdraw'] = 'Aanvraag uitbetaling';
$_['ms_account_badges'] = 'Badges';
$_['ms_account_badges_nobadges'] = 'Nog geen badges';

// Account - New product
$_['ms_account_newproduct_heading'] = 'Nieuw e-book';
$_['ms_account_newproduct_breadcrumbs'] = 'Nieuw e-book';
//General Tab
$_['ms_account_product_tab_general'] = 'Algemeen';
$_['ms_account_product_tab_specials'] = 'Speciale prijzen';
$_['ms_account_product_tab_discounts'] = 'Kortingen bij hoeveelheid';
$_['ms_account_product_name_description'] = 'Naam & Omschrijving';
$_['ms_account_product_name'] = 'Naam';
$_['ms_account_product_name_note'] = 'Geef een naam op voor het e-book';
$_['ms_account_product_description'] = 'Omschrijving';
$_['ms_account_product_description_note'] = 'Omschrijf het e-book';
$_['ms_account_product_meta_description'] = 'Meta Tag Description';
$_['ms_account_product_meta_description_note'] = 'Specificeer de Meta Tag Description voor het e-book';
$_['ms_account_product_meta_keyword'] = 'Meta Tag Keywords';
$_['ms_account_product_meta_keyword_note'] = 'Specificeer Meta Tag Keywords voor het e-book';
$_['ms_account_product_tags'] = 'Labels';
$_['ms_account_product_tags_note'] = 'Specifeer labels voor het e-book';
$_['ms_account_product_price_attributes'] = 'Price & Attributes';
$_['ms_account_product_price'] = 'Prijs';
$_['ms_account_product_price_note'] = 'Kies een prijs voor het e-book';
$_['ms_account_product_listing_flat'] = 'De weergavekosten voor dit e-book zijn <span>%s</span>';
$_['ms_account_product_listing_percent'] = 'De weergavekosten voor dit e-book zijn gebaseerd op de productprijs. Momenteel zijn de kosten: <span>%s</span>.';
$_['ms_account_product_listing_balance'] = 'Dit bedrag zal van je verkopersbalans worden afgetrokken.';
$_['ms_account_product_listing_paypal'] = 'Je zal worden doorgestuurd naar de betalingspagina na het toevoegen van het e-book.';
$_['ms_account_product_listing_itemname'] = 'Product listing fee at %s';
$_['ms_account_product_listing_until'] = 'Dit e-book zal worden weergeven tot %s';
$_['ms_account_product_category'] = 'Genre';
$_['ms_account_product_category_note'] = 'Selecteer een genre voor het e-book';
$_['ms_account_product_enable_shipping'] = 'Inschakelen verzending';
$_['ms_account_product_enable_shipping_note'] = 'Geef aan of het e-book fysiek verzonden moet worden';
$_['ms_account_product_quantity'] = 'Hoeveelheid';
$_['ms_account_product_quantity_note']    = 'Specificeer de hoeveelheid beschikbare e-books';
$_['ms_account_product_files'] = 'Upload je e-book';
$_['ms_account_product_download'] = 'Upload je e-book';
$_['ms_account_product_download_note'] = 'Upload je e-book. Toegestane extensies: %s';
$_['ms_account_product_push'] = 'Geef updates aan oude klanten';
$_['ms_account_product_push_note'] = 'Nieuwe and geüpdate downloads zullen beschikbaar worden gemaakt voor oude klanten';
$_['ms_account_product_image'] = 'Afbeeldingen';
$_['ms_account_product_image_note'] = 'Selecteer afbeeldingen voor je e-book. De eerste afbeelding zal als thumbnail worden gebruikt. Je kunt de volgorde van de afbeeldingen aanpassen door ze te verslepen. Toegestane extensies: %s';
$_['ms_account_product_message_reviewer'] = 'Bericht aan de beoordelaar';
$_['ms_account_product_message'] = 'Bericht';
$_['ms_account_product_message_note'] = 'Jouw bericht aan de beoordelaar';

$_['ms_error_product_infected'] = 'Dit e-book bevat mogelijk een virus. Daarom kan dit e-book niet via deze site worden aangeboden';
$_['ms_error_product_invalid'] = 'Dit is geen valide e-book';
$_['ms_error_product_drm'] = 'Dit e-book bevat een DRM beveiliging. Daarom kan dit e-book niet via deze site worden aangeboden';
$_['ms_error_product_no_watermark'] = 'Dit e-book bevat geen geldig watermerk. Daarom kan dit e-book niet via deze site worden aangeboden';
$_['ms_error_product_no_metadata'] = 'Dit e-book bevat geen metadata. Daarom kan dit e-book niet via deze site worden aangeboden';
$_['ms_error_product_uploaded_before'] = 'Dit e-book heb je al geupload, je mag een e-book niet 2 x verkopen!';
$_['ms_error_product_legal_owner'] = 'U dient te bevestigen dat u de rechtmatige eigenaar van dit e-book bent.';
$_['ms_title_not_found_error'] = 'Dit boek kon niet geidentificeerd als legaal e-book. Daarom kan dit e-book niet via deze site worden aangeboden. Als je toch denkt dat dit een legaal boek is, stuur het dan even samen met een kopie van aanschaf naar Tom Kabinet ter beoordeling.';
$_['ms_not_nl_error'] = 'Excuus, omdat ik de gegevens uit niet-Nederlandse titels niet altijd goed herken, is het tijdelijk niet mogelijk om deze ebooks te verkopen via mijn site.';
$_['ms_account_product_bundle_note'] = 'Verkoop uw boeken in een bundel. Selecteer een boek met uw muis terwijl u de Control-toets ingedrukt houdt.';
$_['ms_warning_product_not_current_owner'] = 'Waarschuwing: We herkennen dit boek en je hebt dit mogelijk niet uit legale bron verkregen. Als dit het geval is, ben je mogelijk strafbaar bij de verkoop van dit boek.';
$_['ms_warning_bought_here_banned'] = 'Waarschuwing: Dit boek is geidentificeerd als niet-legaal aangeboden op Tom Kabinet. Ik moet dit boek na het upload eerst even controleren. Sorry voor het ongemak.';
$_['ms_warning_multiple_authors'] = 'Waarschuwing: Ik moet dit boek na het upload eerst even controleren. Sorry voor het ongemak.';
$_['ms_validation_error'] = 'Dit boek kon niet gevalideerd worden.';
$_['ms_banned_error'] = 'Dit boek is geidentificeerd als niet-legaal. Daarom kan dit e-book niet via deze site worden aangeboden.';
$_['ms_watermark_error'] = 'Sorry! Tom kan je e-book niet voorzien van een watermerk. Daarom kan dit e-book niet via deze site worden aangeboden.';

//Data Tab
$_['ms_account_product_tab_data'] = 'Data';
$_['ms_account_product_model'] = 'Model';
$_['ms_account_product_sku'] = 'SKU';
$_['ms_account_product_sku_note'] = 'Stock Keeping Unit';
$_['ms_account_product_upc']  = 'UPC';
$_['ms_account_product_upc_note'] = 'Universal Product Code';
$_['ms_account_product_ean'] = 'EAN';
$_['ms_account_product_ean_note'] = 'European Article Number';
$_['ms_account_product_jan'] = 'JAN';
$_['ms_account_product_jan_note'] = 'Japanese Article Number';
$_['ms_account_product_isbn'] = 'ISBN';
$_['ms_account_product_isbn_note'] = 'International Standard Book Number';
$_['ms_account_product_mpn'] = 'MPN';
$_['ms_account_product_mpn_note'] = 'Manufacturer Part Number';
$_['ms_account_product_manufacturer'] = 'Fabrikant';
$_['ms_account_product_manufacturer_note'] = '(Autocomplete)';
$_['ms_account_product_tax_class'] = 'BTW-tarief';
$_['ms_account_product_date_available'] = 'Datum Beschikbaar';
$_['ms_account_product_stock_status'] = '"Niet op voorraad"-status';
$_['ms_account_product_stock_status_note'] = 'Status weergeven als een e-book niet op voorraad is';
$_['ms_account_product_subtract'] = 'Verlaag Voorraad';


$_['ms_account_product_priority'] = 'Prioriteit';
$_['ms_account_product_date_start'] = 'Startdatum';
$_['ms_account_product_date_end'] = 'Einddatum';
$_['ms_account_product_sandbox'] = 'Waarschuwing: The payment gateway is in \'Sandbox Mode\'. Your account will not be charged.';

// Account - Edit product
$_['ms_account_editproduct_heading'] = 'Bewerk e-book';
$_['ms_account_editproduct_breadcrumbs'] = 'Bewerk e-book';

// Account - Clone product
$_['ms_account_cloneproduct_heading'] = 'Kloon e-book';
$_['ms_account_cloneproduct_breadcrumbs'] = 'Kloon e-book';

// Account - Relist product
$_['ms_account_relist_product_heading'] = 'Herplaats e-book';
$_['ms_account_relist_product_breadcrumbs'] = 'Herplaats e-book';

// Account - Seller
$_['ms_account_sellerinfo_heading'] = 'Verkopersprofiel';
$_['ms_account_sellerinfo_breadcrumbs'] = 'Verkopersprofiel';
$_['ms_account_sellerinfo_nickname'] = 'Nickname';
$_['ms_account_sellerinfo_nickname_note'] = 'Kies een verkopers-bijnaam.';
$_['ms_account_sellerinfo_description'] = 'Omschrijving';
$_['ms_account_sellerinfo_description_note'] = 'Omschrijf jezelf';
$_['ms_account_sellerinfo_company'] = 'Bedrijf';
$_['ms_account_sellerinfo_company_note'] = 'Je bedrijf (optioneel)';
$_['ms_account_sellerinfo_country'] = 'Land';
$_['ms_account_sellerinfo_country_dont_display'] = 'Verberg mijn land';
$_['ms_account_sellerinfo_country_note'] = 'Selecteer land.';
$_['ms_account_sellerinfo_zone'] = 'Provincie';
$_['ms_account_sellerinfo_zone_select'] = 'Selecteer provincie';
$_['ms_account_sellerinfo_zone_not_selected'] = 'Er is geen provincie geselecteerd';
$_['ms_account_sellerinfo_zone_note'] = 'Selecteer provincie uit deze lijst.';
$_['ms_account_sellerinfo_avatar'] = 'Avatar';
$_['ms_account_sellerinfo_avatar_note'] = 'Selecteer een avatar';
$_['ms_account_sellerinfo_paypal'] = 'IBAN code / rekeningnr';
$_['ms_account_sellerinfo_paypal_note'] = 'Geef het rekeningnummer op waarop je de betalingen wilt ontvangen. Het rekeningnummer zal niet met derden worden gedeeld.';
$_['ms_account_sellerinfo_reviewer_message'] = 'Bericht aan de beoordelaar';
$_['ms_account_sellerinfo_reviewer_message_note'] = 'Uw bericht aan de beroordelaar';
$_['ms_account_sellerinfo_legal'] = 'Ik verklaar hierbij dat ik het Tomkabinet platform niet gebruik voor illegale praktijken.';
$_['ms_account_sellerinfo_legal_note'] = 'Met het aanvragen van een gebruikersnaam verplicht ik mij de auteursrechten te waarborgen.';
$_['ms_account_sellerinfo_terms'] = 'Accepteer voorwaarden';
$_['ms_account_sellerinfo_terms_text'] = 'Lees de voorwaarden en hou je aan de regels van dit platform';
$_['ms_account_sellerinfo_terms_note'] = '<a class="colorbox" href="%s" alt="%s"><b>%s</b></a>';
$_['ms_account_sellerinfo_fee_flat'] = 'Er zijn aanmeldkosten van <span>%s</span> om bij %s een verkoper te worden.';
$_['ms_account_sellerinfo_fee_balance'] = 'Dit bedrag zal van de beginbalans worden afgetrokken.';
$_['ms_account_sellerinfo_fee_paypal'] = 'Je wordt doorverwezen naar de betaalpagina na het opsturen van dit formulier.';
$_['ms_account_sellerinfo_signup_itemname'] = 'Verkopersaccountregistratie bij %s';
$_['ms_account_sellerinfo_saved'] = 'De data voor dit verkopersaccount zijn opgeslagen.';

$_['ms_account_status'] = 'De status van je verkopersaccount is: ';
$_['ms_account_status_tobeapproved'] = '<br />Je kunt dit account gebruiken zodra de eigenaar het account heeft goedgekeurd.';
$_['ms_account_status_please_fill_in'] = 'Vul het volgende formulier in om een verkopersaccount aan te maken.';

$_['ms_seller_status_' . MsSeller::STATUS_ACTIVE] = 'Actief';
$_['ms_seller_status_' . MsSeller::STATUS_INACTIVE] = 'Inactief';
$_['ms_seller_status_' . MsSeller::STATUS_DISABLED] = 'Geblokkeerd';
$_['ms_seller_status_' . MsSeller::STATUS_DELETED] = 'Verwijderd';
$_['ms_seller_status_' . MsSeller::STATUS_UNPAID] = 'Onbetaald aanmeldbedrag';

// Account - Products
$_['ms_account_products_heading'] = 'Jouw e-books';
$_['ms_account_products_breadcrumbs'] = 'Jouw e-books';
$_['ms_account_products_product'] = 'E-book';
$_['ms_account_products_sales'] = 'Verkoop';
$_['ms_account_products_earnings'] = 'Winst';
$_['ms_account_products_status'] = 'Status';
$_['ms_account_products_date'] = 'Datum toegevoegd';
$_['ms_account_products_listing_until'] = 'Lijst tot';
$_['ms_account_products_action'] = 'Actie';
$_['ms_account_products_noproducts'] = 'Je hebt nog geen e-books!';
$_['ms_account_products_confirmdelete'] = 'Weet je zeker dat je dit e-book wil verwijderen?';

$_['ms_not_defined'] = 'Not defined';

$_['ms_product_status_' . MsProduct::STATUS_ACTIVE] = 'Actief';
$_['ms_product_status_' . MsProduct::STATUS_INACTIVE] = 'Inactief';
$_['ms_product_status_' . MsProduct::STATUS_DISABLED] = 'Geblokkeerd';
$_['ms_product_status_' . MsProduct::STATUS_DELETED] = 'Verwijderd';
$_['ms_product_status_' . MsProduct::STATUS_UNPAID] = 'Onbetaald toevoegbedrag';

// Account - ratings
$_['ms_seller_ratings'] = 'Waarderingen: ';
$_['ms_seller_rate_title'] = 'Waardeer Verkopers';

$_['ms_seller_rating_communication'] = 'Communicatie: ';
$_['ms_seller_rating_honesty'] = 'Eerlijkheid: ';
$_['ms_seller_rating_overall'] = 'Algemeen: ';
$_['ms_seller_rate_comment_text'] = 'Commentaar';

$_['entry_bad'] = 'Slecht';
$_['entry_good'] = 'Goed';

$_['ms_seller_rate_success'] = 'Je waardering is opgeslagen!';
$_['ms_error_rate_comment_length'] = 'Het commentaar is te lang, er zijn maximaal %s tekens toegestaan.';
$_['ms_error_rate_no_comment'] = 'Voeg commentaar toe.';
$_['ms_error_rate_no_rating'] = 'Alle waarderingen moeten worden ingevuld.';

// Account - Conversations and Messages
$_['ms_account_conversations'] = 'Gesprekken';
$_['ms_account_messages'] = 'Berichten';

$_['ms_account_conversations_heading'] = 'Jouw gesprekken';
$_['ms_account_conversations_breadcrumbs'] = 'Jouw gesprekken';

$_['ms_account_conversations_status'] = 'Status';
$_['ms_account_conversations_date_created'] = 'Datum aangemaakt';
$_['ms_account_conversations_with'] = 'Gesprek met';
$_['ms_account_conversations_title'] = 'Titel';

$_['ms_conversation_title_product'] = 'Vraag over e-book: %s';
$_['ms_conversation_title'] = 'Vraag van %s';

$_['ms_account_conversations_read'] = 'Gelezen';
$_['ms_account_conversations_unread'] = 'Ongelezen';

$_['ms_account_messages_heading'] = 'Berichten';
$_['ms_account_messages_breadcrumbs'] = 'Berichten';

$_['ms_message_text'] = 'Jouw bericht';
$_['ms_post_message'] = 'Verzend bericht';

$_['ms_customer_does_not_exist'] = 'Klantenaccount verwijderd';
$_['ms_error_empty_message'] = 'Er kan geen leeg bericht worden verstuurd';

$_['ms_mail_subject_private_message'] = 'Nieuw privébericht ontvangen';
$_['ms_mail_private_message'] = <<<EOT
Je hebt een nieuw privébericht ontvangen van %s!

%s

%s

Je kunt reageren op dit bericht in het berichtencentrum in je account.
EOT;


$_['ms_mail_subject_seller_vote'] = 'Stem op de verkoper';
$_['ms_mail_seller_vote_message'] = 'Stem op de verkoper';

// Account - Transactions
$_['ms_account_transactions_heading'] = 'Jouw Financiën';
$_['ms_account_transactions_breadcrumbs'] = 'Jouw Financiën';
$_['ms_account_transactions_balance'] = 'Je actuele balans:';
$_['ms_account_transactions_earnings'] = 'Je winst tot nu toe:';
$_['ms_account_transactions_records'] = 'Balansadministratie';
$_['ms_account_transactions_description'] = 'Omschrijving';
$_['ms_account_transactions_amount'] = 'Hoeveelheid';
$_['ms_account_transactions_notransactions'] = 'Je hebt nog geen transacties!';

// Payments
$_['ms_payment_payments'] = 'Betalingen';
$_['ms_payment_order'] = 'bestelling #%s';
$_['ms_payment_type_' . MsPayment::TYPE_SIGNUP] = 'Aanmeldkosten';
$_['ms_payment_type_' . MsPayment::TYPE_LISTING] = 'Weergeefkosten';
$_['ms_payment_type_' . MsPayment::TYPE_PAYOUT] = 'Handmatige uitbetaling';
$_['ms_payment_type_' . MsPayment::TYPE_PAYOUT_REQUEST] = 'Uitbetalingsaanvraag';
$_['ms_payment_type_' . MsPayment::TYPE_RECURRING] = 'Herhaalbetaling';
$_['ms_payment_type_' . MsPayment::TYPE_SALE] = 'Uitverkoop';

$_['ms_payment_status_' . MsPayment::STATUS_UNPAID] = 'Onbetaald';
$_['ms_payment_status_' . MsPayment::STATUS_PAID] = 'Betaald';

// Account - Orders
$_['ms_account_orders_heading'] = 'Jouw verkopen';
$_['ms_account_orders_breadcrumbs'] = 'Jouw verkopen';
$_['ms_account_orders_id'] = 'Bestelling #';
$_['ms_account_orders_customer'] = 'Klant';
$_['ms_account_orders_products'] = 'E-books';
$_['ms_account_orders_total'] = 'Totaalbedrag';
$_['ms_account_orders_noorders'] = 'Je hebt nog geen e-books verkocht!';

// Account - Dashboard
$_['ms_account_dashboard_heading'] = 'Verkoper Dashboard';
$_['ms_account_dashboard_breadcrumbs'] = 'Verkoper Dashboard';
$_['ms_account_dashboard_orders'] = 'Verkoopresultaten';
$_['ms_account_dashboard_comments'] = 'Recente opmerkingen';
$_['ms_account_dashboard_overview'] = 'Overzicht';
$_['ms_account_dashboard_seller_group'] = 'Verkopersgroep';
$_['ms_account_dashboard_listing'] = 'Weergavekosten';
$_['ms_account_dashboard_sale'] = 'Verkoopkosten';
$_['ms_account_dashboard_stats'] = 'Statistieken';
$_['ms_account_dashboard_balance'] = 'Actuele balans';
$_['ms_account_dashboard_total_sales'] = 'Totale verkoop';
$_['ms_account_dashboard_total_earnings'] = 'Totale winst';
$_['ms_account_dashboard_sales_month'] = 'Verkoop deze maand';
$_['ms_account_dashboard_earnings_month'] = 'Winst deze maand';
$_['ms_account_dashboard_nav'] = 'Snelle navigatie';
$_['ms_account_dashboard_nav_user_dashboard'] = 'Naar gebruikers dashboard';
$_['ms_account_dashboard_nav_profile'] = 'Pas je verkopersprofiel aan';
$_['ms_account_dashboard_nav_product'] = 'Voeg een nieuw e-book toe';
$_['ms_account_dashboard_nav_products'] = 'Beheer je e-books';
$_['ms_account_dashboard_nav_orders'] = 'Bekijk je verkoopresultaten';
$_['ms_account_dashboard_nav_balance'] = 'Bekijk je financiële administratie';
$_['ms_account_dashboard_nav_payout'] = 'Vraag een uitbetaling aan';

// Account - Comments
$_['ms_account_comments_name'] = 'Naam';
$_['ms_account_comments_product'] = 'E-book';
$_['ms_account_comments_comment'] = 'Recensie';
$_['ms_account_comments_nocomments'] = 'Je heeft nog geen recensies!';

// Account - Request withdrawal
$_['ms_account_withdraw_heading'] = 'Aanvraag Uitbetaling';
$_['ms_account_withdraw_breadcrumbs'] = 'Aanvraag Uitbetaling';
$_['ms_account_withdraw_balance'] = 'Je actuele balans:';
$_['ms_account_withdraw_balance_available'] = 'Beschikbaar voor opname:';
$_['ms_account_withdraw_minimum'] = 'Miniminaal uit te betalen hoeveelheid:';
$_['ms_account_balance_reserved_formatted'] = '-%s te komen uitbetalingen';
$_['ms_account_balance_waiting_formatted'] = '-%s wachttijd';
$_['ms_account_withdraw_description'] = 'Betalingsverzoek via %s (%s) op %s';
$_['ms_account_withdraw_amount'] = 'Hoeveelheid:';
$_['ms_account_withdraw_amount_note'] = 'Geef het uit te betalen bedrag op';
$_['ms_account_withdraw_method'] = 'Betaalmethode:';
$_['ms_account_withdraw_method_note'] = 'Selecteer de uitbetalingsmethode';
$_['ms_account_withdraw_method_paypal'] = 'Bank';
$_['ms_account_withdraw_all'] = 'Alle winst momenteel beschikbaar';
$_['ms_account_withdraw_minimum_not_reached'] = 'Je totale balans ligt lager dan de minimaal uit te betalen hoeveelheid!';
$_['ms_account_withdraw_no_funds'] = 'Geen kapitaal om uit te betalen.';
$_['ms_account_withdraw_no_paypal'] = '<a href="index.php?route=seller/account-profile">Geef een IBANcode / rekeningnummer</a> eerst op!';

// Product page - Seller information
$_['ms_catalog_product_sellerinfo'] = 'Verkopersinformatie';
$_['ms_catalog_product_contact'] = 'Contacteer deze verkoper';

// Product page - Comments
$_['ms_comments_post_comment'] = 'Plaats Recensie';
$_['ms_comments_name'] = 'Naam';
$_['ms_comments_note'] = '<span style="color: #FF0000;">Opmerking:</span> HTML wordt niet geïnterpreteerd!';
$_['ms_comments_email'] = 'E-mail';
$_['ms_comments_comment'] = 'Recensie';
$_['ms_comments_wait'] = 'Wacht even alsjeblieft!';
$_['ms_comments_login_register'] = '<a href="%s">Login</a> of <a href="%s">registreer</a> om een recensie te plaatsen.';
$_['ms_comments_error_name'] = 'Geef alsjeblieft een naam op met minimaal %s en maximaal %s tekens';
$_['ms_comments_error_email'] = 'Geef alsjeblieft een geldig e-mailadres op';
$_['ms_comments_error_comment_short'] = 'De recensie moet minstens %s tekens lang zijn';
$_['ms_comments_error_comment_long'] = 'De recensie kan niet langer dan %s tekens zijn';
$_['ms_comments_error_captcha'] = 'De ingevoerde code komt niet overeen met de captcha';
$_['ms_comments_success'] = 'Bedankt voor je recensie.';
$_['ms_comments_captcha'] = 'Voer de code in het veld hieronder in:';
$_['ms_comments_no_comments_yet'] = 'Nog geen recensies geplaatst';
$_['ms_comments_tab_comments'] = 'Recensies (%s)';
$_['ms_footer'] = '<br>MultiMerch Marketplace door <a href="http://multimerch.com/">multimerch.com</a>';

// Catalog - Sellers list
$_['ms_catalog_sellers_heading'] = 'Verkopers';
$_['ms_catalog_sellers_country'] = 'Land:';
$_['ms_catalog_sellers_website'] = 'Website:';
$_['ms_catalog_sellers_company'] = 'Bedrijf:';
$_['ms_catalog_sellers_totalsales'] = 'Verkopen:';
$_['ms_catalog_sellers_totalproducts'] = 'E-book:';
$_['ms_sort_country_desc'] = 'Land (Z - A)';
$_['ms_sort_country_asc'] = 'Land (A - Z)';
$_['ms_sort_nickname_desc'] = 'Naam (Z - A)';
$_['ms_sort_nickname_asc'] = 'Naam (A - Z)';

// Catalog - Seller profile page
$_['ms_catalog_sellers'] = 'Verkopers';
$_['ms_catalog_sellers_empty'] = 'Er zijn nog geen verkopers.';
$_['ms_catalog_seller_profile_heading'] = 'Profiel van %s';
$_['ms_catalog_seller_profile_breadcrumbs'] = 'Profiel van %s';
$_['ms_catalog_seller_profile_about_seller'] = 'Over de verkopers';
$_['ms_catalog_seller_profile_products'] = 'Enkele e-books van de verkoper';
$_['ms_catalog_seller_profile_tab_products'] = 'E-books';
$_['ms_catalog_seller_profile_tab_comments'] = 'Recensies';
$_['ms_catalog_seller_profile_country'] = 'Land:';
$_['ms_catalog_seller_profile_zone'] = 'Provincie:';
$_['ms_catalog_seller_profile_website'] = 'Website:';
$_['ms_catalog_seller_profile_company'] = 'Bedrijf:';
$_['ms_catalog_seller_profile_totalsales'] = 'Totale verkopen:';
$_['ms_catalog_seller_profile_totalproducts'] = 'Totaal aantal e-books:';
$_['ms_catalog_seller_profile_view'] = 'Bekijk alle e-books van %s';

// Ratings
$_['ms_catalog_seller_profile_rating'] = 'Waardering:';
$_['ms_catalog_seller_profile_ratings_singular'] = 'waardering';
$_['ms_catalog_seller_profile_ratings_plural'] = 'waarderingen';
$_['ms_catalog_seller_profile_rating_overall'] = 'Algemene waardering:';
$_['ms_catalog_seller_profile_rating_communication'] = 'Communicatiewaardering:';
$_['ms_catalog_seller_profile_rating_honesty'] = 'Eerlijkheidswaardering:';
$_['ms_catalog_seller_profile_rating_not_defined'] = 'Nog niet beoordeeld';
$_['ms_catalog_seller_ratings_breadcrumbs'] = 'Waarderingen';
$_['ms_catalog_seller_ratings'] = 'Waarderingen';

// Catalog - Seller's products list
$_['ms_catalog_seller_products_heading'] = 'E-books van %s';
$_['ms_catalog_seller_products_breadcrumbs'] = 'E-books van %s';
$_['ms_catalog_seller_products_empty'] = 'Deze verkoper heeft nog geen e-books!';

// Catalog - Carousel
$_['ms_carousel_sellers'] = 'Onze verkopers';
$_['ms_carousel_view'] = 'Bekijk alle verkopers';

// Catalog - Top sellers
$_['ms_topsellers_sellers'] = 'Topverkopers';
$_['ms_topsellers_view'] = 'Bekijk alle verkopers';

// Catalog - New sellers
$_['ms_newsellers_sellers'] = 'Nieuwe verkopers';
$_['ms_newsellers_view'] = 'Bekijk alle verkopers';

// Catalog - Seller dropdown
$_['ms_sellerdropdown_sellers'] = 'Onze verkopers';
$_['ms_sellerdropdown_select'] = '-- Selecteer een verkoper --';

// Catalog - Seller contact dialog
$_['ms_sellercontact_title'] = 'Contacteer verkoper';
$_['ms_sellercontact_name'] = 'Je naam';
$_['ms_sellercontact_email'] = 'Je e-mail';
$_['ms_sellercontact_text'] = 'Je bericht';
$_['ms_sellercontact_captcha'] = 'Captcha';
$_['ms_sellercontact_sendmessage'] = 'Verzend een bericht aan %s';
$_['ms_sellercontact_success'] = 'Je bericht is met succes verzonden';

// Account - PDF generator dialog
$_['ms_pdfgen_title'] = 'Genereer afbeeldingen vanuit PDF';
$_['ms_pdfgen_pages'] = 'Pagina\'s';
$_['ms_pdfgen_note'] = 'Selecteer pagina\'s om afbeeldingen van te maken. Nieuwe afbeeldingen zullen worden toegevoegd aan de lijst afbeeldingen op de productpagina.';
$_['ms_pdfgen_file'] = 'Bestand';

$_['ms_account_product_add_combo'] = 'Verkoop meerdere e-books tegelijk in 1 pakket';
$_['ms_button_add_combos'] = 'Klik hier';
$_['ms_button_go_back_to_form'] = 'Terug';
?>

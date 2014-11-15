<?php
class ModelCatalogOnix extends Model {
    //Set up request to the ONIX database. Retrieve the info, authors should be added as array
    public function getFields($product_ean) {
        /* setup db connection */
        $product_ean = $this->db->escape($product_ean);
        $querystring = "SELECT Ean, Uitgever, Titel, Ondertitel, Taalvermelding, Verschijningsdatum, Samenvatting, Aantalblz FROM Boeken WHERE Ean ='" . $product_ean . "'";

        #$querystring = "SELECT * from Boeken";
        if($this->book->query($querystring)->num_rows == 0){
            return array();
        }

        $book_fields = $this->book->query($querystring)->row;
        $row = array(
            "product_model"=> $book_fields['Titel'],
            "product_ean" => $book_fields['Ean'],
            "subtitle" => $book_fields['Ondertitel'],
            "pages" => $book_fields['Aantalblz'],
            "language" => $book_fields['Taalvermelding'],
            "date_published" => $book_fields['Verschijningsdatum'],
            "description" => $book_fields['Samenvatting'],
            "publisher" => $book_fields['Uitgever'],
        );

        $queryauthor = "SELECT *
                        FROM BoekAuteurs
                        WHERE Ean = '" . $product_ean .
                      "' ORDER BY Auteurpositie";

        $authorrows = $this->book->query($queryauthor)->rows;
        $authors = array();
        $authorstring = "";

        foreach($authorrows as $res){
            $tmp_author = array(
               'fullname' => $res['AuteurVolledigenaam']
            );
            array_push($authors, $tmp_author);
            $authorstring .= "," . $res['AuteurVolledigenaam'];
        }

        $row['authors'] = $authors;
        $row['authorstring'] = "";
        if (strlen($authorstring) > 2) {
           $row['authorstring'] = substr($authorstring, 1);
        }

        $thumb = "data/ONIX/" . $product_ean . "_VRK.jpg";
        if (file_exists(DIR_IMAGE . $thumb)) {
           //$thumbnail = $this->MsLoader->MsFile->resizeImage($thumb, $this->config->get('msconf_preview_product_image_width'), $this->config->get('msconf_preview_product_image_height'));
           //$newimg = $product_ean . "_thumbnail.jpg";
           //copy($thumbnail, DIR_IMAGE . "data/ONIX/" . $newimg);
           //$row['product_thumbnail'] = "data/ONIX/" . $newimg;
           $row['product_thumbnail'] = $thumb;
        } 

        $front_img = "data/ONIX/" . $product_ean . "_VRK.jpg";
        $back_img = "data/ONIX/" . $product_ean . "_ATK.jpg";

        $productimages = array();
	if (file_exists(DIR_IMAGE . $front_img)) {
            $productimages[] = $front_img;
        } if (file_exists(DIR_IMAGE . $back_img)) {
            $productimages[] = $back_img;
        }
        $row['product_images']  = $productimages;

        return $row;
    }
}
?>

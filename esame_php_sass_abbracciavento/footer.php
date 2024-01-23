<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$filefooter = "data/footer_indirizzi.json";
$objfooter = json_decode(UT::leggiTesto($filefooter));
?>

<footer>
    <div class="box footerone">
        
            <?php
                $imgL = $objfooter->logo;
                printf('<a href="%s" title="%s"><img src="%s" alt="%s" draggable="false" loading="lazy" class="mainImage"></a>', $imgL->url,$imgL->title, $imgL->icona, $imgL->alt);
            ?>
    </div>
    <div class="box footertwo">
        <p class="recapiti">Recapiti</p>
        <ul>
            <?php foreach ($objfooter->contatti as $link) { ?>
                <li><?php echo $link; ?></li>
            <?php } ?>
        </ul>
        <?php
        $lkd = $objfooter->linkedin;
        printf('<a href="%s" title="%s" target="_blank" class="link"><img src="%s" alt="%s" class="icona" draggable="false" loading="lazy"></a>',
        $lkd->url, $lkd->title, $lkd->icona, $lkd->alt);
        ?>
    </div>
    <div class="box footerthree">
        <hr>
        <p class="button"><?php echo $objfooter->firma; ?></p>
    </div>
</footer>
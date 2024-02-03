<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$filefooter = "data/footer_indirizzi.json";
$objfooter = json_decode(UT::leggiTesto($filefooter));
?>

<footer>
    <div class="footerOne">
        <?php
        $imgL = $objfooter->logo;
        printf('<a href="%s" title="%s"><img src="%s" alt="%s" draggable="false" loading="lazy" class="mainImage"></a>', $imgL->url, $imgL->title, $imgL->icona, $imgL->alt);
        ?>
    </div>
    <div class="footerTwo">
        <p><?php echo $objfooter->titolo ?></p>
        <ul>
            <?php foreach ($objfooter->contatti as $link) { ?>
                <li><?php echo $link; ?></li>
            <?php } ?>
        </ul>
        <?php
        $lkd = $objfooter->linkedin;
        printf(
            '<a href="%s" title="%s" target="_blank" class="link"><img src="%s" alt="%s" class="iconaLnkd" draggable="false" loading="lazy"></a>',
            $lkd->url,
            $lkd->title,
            $lkd->icona,
            $lkd->alt
        );
        ?>
    </div>
    <div class="footerThree">
        <hr>
        <p class="button"><?php echo $objfooter->firma; ?></p>
    </div>
</footer>
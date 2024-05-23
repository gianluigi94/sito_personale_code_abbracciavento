<?php
// in questa pagina organizzo il codice per la gestione del footer 
// il footer è diviso in tre div e i dati sono richiamati tramite file json 
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$filefooter = "data/footer_indirizzi.json";
$objfooter = json_decode(UT::leggiTesto($filefooter));
?>

<footer>
    <!-- il primo div gestisce il logo  -->
    <div class="footerOne">
        <div id="iubenda"><a href="https://www.iubenda.com/privacy-policy/42055894" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a>
<script type="text/javascript">
    (function(w, d) {
        var loader = function() {
            var s = d.createElement("script"),
                tag = d.getElementsByTagName("script")[0];
            s.src = "https://cdn.iubenda.com/iubenda.js";
            tag.parentNode.insertBefore(s, tag);
        };
        if (w.addEventListener) {
            w.addEventListener("load", loader, false);
        } else if (w.attachEvent) {
            w.attachEvent("onload", loader);
        } else {
            w.onload = loader;
        }
    })(window, document);
</script>

<a href="https://www.iubenda.com/privacy-policy/42055894/cookie-policy" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Cookie Policy ">Cookie Policy</a>
<script type="text/javascript">
    (function(w, d) {
        var loader = function() {
            var s = d.createElement("script"),
                tag = d.getElementsByTagName("script")[0];
            s.src = "https://cdn.iubenda.com/iubenda.js";
            tag.parentNode.insertBefore(s, tag);
        };
        if (w.addEventListener) {
            w.addEventListener("load", loader, false);
        } else if (w.attachEvent) {
            w.attachEvent("onload", loader);
        } else {
            w.onload = loader;
        }
    })(window, document);
</script>

<a href="https://www.iubenda.com/termini-e-condizioni/42055894" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Termini e Condizioni ">Termini e Condizioni</a>
<script type="text/javascript">
    (function(w, d) {
        var loader = function() {
            var s = d.createElement("script"),
                tag = d.getElementsByTagName("script")[0];
            s.src = "https://cdn.iubenda.com/iubenda.js";
            tag.parentNode.insertBefore(s, tag);
        };
        if (w.addEventListener) {
            w.addEventListener("load", loader, false);
        } else if (w.attachEvent) {
            w.attachEvent("onload", loader);
        } else {
            w.onload = loader;
        }
    })(window, document);
</script></div>
        <?php
        $imgL = $objfooter->logo;
        printf('<a href="%s" title="%s"><img src="%s" alt="%s" draggable="false" loading="lazy" class="mainImage"></a>', $imgL->url, $imgL->title, $imgL->icona, $imgL->alt);
        ?>
    </div>
    <div class="footerTwo">
        <!-- il secondo div gestisce i miei contatti  -->
        <p><?php echo $objfooter->titolo ?></p>
        <ul>
            <!-- uso un ciclo per stampare i dati del ul dei miei contatti presi da un json -->
            <?php foreach ($objfooter->contatti as $link) { ?>
                <li><?php echo $link; ?></li>
            <?php } ?>
        </ul>
        <?php
        $lkd = $objfooter->linkedin;
        printf('<a href="%s" title="%s" target="_blank" class="link"><img src="%s" alt="%s" class="iconaLnkd" draggable="false" loading="lazy"></a>', $lkd->url, $lkd->title, $lkd->icona, $lkd->alt);
        ?>
    </div>
    <div class="footerThree">
        <hr>
        <!-- il terzo div gestisce la mia firma  -->
        <p class="button"><?php echo $objfooter->firma; ?></p>
    </div>
</footer>
<?php

// in questa pagina gestisco il portfolio grafico 
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$currentPage = basename($_SERVER['PHP_SELF']);
$fileaside = "data/aside.json";
$aside = json_decode(UT::leggiTesto($fileaside));

$filePortfolio = "data/portfolio.json";
$disegni = json_decode(UT::leggiTesto($filePortfolio));

//  inserisco il doctype, imposto la lingua e inserisco la head con la description
require_once "head.php";
?>

<body>

    <?php
    // inserisco il menu, il titolo principale e l'immagine di sfondo 
    require_once "menu.php";
    require_once "add.php";
    ?>
    <section class="pgraf">

    <?php
    // ciclo in una volta sola tutte le card con tutte le varie proprietà che si trovano salvate su un file json, tuttavia ci sono delle card particolari dove ho inserito più di una classe. Per assegnare eventualmente più classi dinamicamente, ho lasciato volutamente uno spazio nel nome della classe, se non dovesse servire, lo eliminerò in seguito con trim 
        foreach ($disegni->progetti as $progGra) {
            $classPro = "imgcard ";
            if ($progGra->h3 == "Carosello Vivace") {
                $classPro .= "carosello";
            }
            if ($progGra->h3 == "Toto Maker") {
                $classPro .= "toto";
            }
            printf('<div class="imgCon"><a href="%s" class="card" target="_blank" title="%s"><h3 class="titoletto">%s</h3><p class="descrizioneimg">%s</p><img src="%s" alt="%s" class="%s" draggable="false"></a></div>', $progGra->url, $progGra->title, $progGra->h3, $progGra->paragrafo, $progGra->url, $progGra->alt, trim($classPro));
        }
        ?>
    </section>

    

    <?php
    // richiamo l'aside, il footer e il codice js che ho usato per le animazioni del menu 
    require_once "aside.php";
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
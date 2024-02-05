<?php

// in questa pagina gestisco la pagina dove vengono visualizzati tutti i progetti, i dati sono inseriti in file json
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$fileProgetti = "data/progetti.json";
$progect = json_decode(UT::leggiTesto($fileProgetti));

// richiamo la head impostando dinamicamente lingua, il title, e la description
require_once "head.php";
?>

<body>

    <?php
    // richiamo il menu, e dinamicamente anche il titolo principale e l'immagine di sfondo 
    require_once "menu.php";
    require_once "add.php";
    ?>

    <div class="ttprogect">

        <?php
        // con un ciclo stampo a schermo tutti i dati dei progetti  presi da un json
        foreach ($progect->progetti as $prg) {
            $specialClass = "";
            if ($prg->h3 == "Portfolio Grafico") {
                $specialClass = "portfolio";
            }
            printf('<div><a href="%s" title="%s"><div><h3 class="%s">%s</h3><img src="%s" alt="%s" draggable="false"></div><p>%s</p></a></div>', $prg->url, $prg->title, $specialClass, $prg->h3, $prg->immagine, $prg->alt, $prg->paragrafo);
        }

        ?>

    </div>
    <?php
    // richiamo il footer e il codice js usato per le animazioni del menu 
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
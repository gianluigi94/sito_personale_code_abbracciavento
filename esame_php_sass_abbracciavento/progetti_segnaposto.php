<?php
// questa è la pagina dove gestisco i progetti segnaposto scritti in lorem ipsum 
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$currentPage = basename($_SERVER['PHP_SELF']);
$fileaside = "data/aside.json";
$aside = json_decode(UT::leggiTesto($fileaside));

$fileLorem = "data/lorem.json";
$lorem = json_decode(UT::leggiTesto($fileLorem));


// richiamo la head impostando dinamicamente lingua, il title, e la description

require_once "head.php";
?>

<body>
    
    <?php
            // richiamo il menu, e dinamicamente anche il titolo principale e l'immagine di sfondo 
    require_once "menu.php";
    require_once "add.php";
    ?>
    <div class="container">
        <div class="uno">
            <?php
            // creo 4 paragrafi con un ciclo 
            for ($i = 0; $i < 4; $i++) {
            ?>
                <p class="text">
                    <?php echo $lorem->pagina->testo; ?>
                </p>
            <?php
            }
            ?>
        </div>
        <figure class="due">
            <?php

            // con un ciclo passo a rassegna un file json finché non trova l'immagine che mi occorre per questa pagina, salta i dati che non c'entrano con le immagini ed esce una volta trovato ciò che cercava
            foreach ($lorem as $link => $value) {

                if ($link == "pagina") {
                    continue;
                }


                if ($value->pagina == $currentPage) {
                    printf('<img src="%s" alt="%s" title="%s" draggable="false">', $value->urlImg, $value->alt, $value->title);
                    break;
                }
            }
            ?>
        </figure>
    </div>


    <?php
    // richiamo  l'aside, il footer e il js usato per le animazioni del menu 
    require_once "aside.php";
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
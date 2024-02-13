<?php

// in questa file gestisco la pagina dove vengono visualizzati tutti i progetti, i dati sono inseriti in file json
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$arrLorem = ["space_chess_dolor", "socialorem", "lorem_cripto_dolor", "ipsum-commerce"];

$currentPageQuery = basename($_SERVER['PHP_SELF']) . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
$fileaside = "data/aside.json";
$aside = json_decode(UT::leggiTesto($fileaside));

$fileProgetti = "data/pagina_progetti.json";
$progetti = json_decode(UT::leggiTesto($fileProgetti));
$lorem = $progetti->progettiSegnaposto;
$disegni = $progetti->portfolio;
$principale = $progetti->principale;
// richiamo la head impostando dinamicamente lingua, il title, e la description
require_once "head.php";
?>

<body>

    <?php
    // richiamo il menu, e dinamicamente anche il titolo principale e l'immagine di sfondo 
    require_once "menu.php";
    require_once "add.php";

    // se la richiesta get è uguale a tutti i progetti, entro in questo blocco di codice e visualizzerò la pagina di anteprima di tutti i progetti 
    if ($_GET['progetto'] == "tutti_i_progetti") {
    ?>
        <div class="ttprogect">

            <?php
            // con un ciclo stampo a schermo tutti i dati dei progetti  presi da un json
            foreach ($principale->progetti as $prg) {
                $specialClass = "";
                if ($prg->h3 == "Portfolio Grafico") {
                    $specialClass = "portfolio";
                }
                printf('<div><a href="%s" title="%s"><div><h3 class="%s">%s</h3><img src="%s" alt="%s" draggable="false"></div><p>%s</p></a></div>', $prg->url, $prg->title, $specialClass, $prg->h3, $prg->immagine, $prg->alt, $prg->paragrafo);
            }

            ?>

        </div>

    <?php
    }
    ?>

<!--  se la richiesta get è uguale ad uno dei progetti segnaposto, entro in questo blocco di codice e visualizzerò il progetto specifico a seconda del parametro passato dalla query  -->
    <?php
    if (in_array($_GET['progetto'], $arrLorem)) {
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


                    if ($value->pagina == $currentPageQuery) {
                        printf('<img src="%s" alt="%s" title="%s" draggable="false">', $value->urlImg, $value->alt, $value->title);
                        break;
                    }
                }
                ?>
            </figure>
        </div>


        <?php
        // richiamo  l'aside 
        require_once "aside.php";
        ?>
    <?php
    }
    ?>
<!--  se la richiesta get è uguale a portfolio grafico, entro in questo blocco di codice e visualizzerò il progetto più complesso dei 5  -->
    <?php
    if ($_GET['progetto'] == "portfolio_grafico") {
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
?>
    <?php
    }
    ?>
    <?php
    // richiamo il footer e il codice js usato per le animazioni del menu 
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
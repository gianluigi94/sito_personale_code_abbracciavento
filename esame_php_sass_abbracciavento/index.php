<?php
// in questa pagina gestisco la home page, le informazioni sono prese da dei dati json 
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$fileHome = "data/home.json";
$paragrafi = json_decode(UT::leggiTesto($fileHome));

// richiamo la head impostando dinamicamente lingua il title, e il content
require_once "head.php";
?>

<body>
    <?php
    // richiamo il menu 
    require_once "menu.php";
    ?>
    <!-- imposto la header  -->
    <header>
        <?php
        $videoh = $paragrafi->video;
        printf('<video src="%s" %s>%s</video>', $videoh->url, $videoh->attributi, $videoh->alt);
        ?>
        <div class="headerContent">
            <!-- imposto i titoli  -->
                <h1><?php echo $paragrafi->H1 ?></h1>
                <h2><?php echo $paragrafi->H2 ?></h2>
                <div class="ahome">
                    <!-- imposto i bottoni per le cta  -->
                    <?php
                    $bUno = $paragrafi->bottoneUno;
                    $bDue = $paragrafi->bottoneDue;
                    printf('<div class="%s"> <a href="%s" title="%s" class="%s">%s</a></div>', $bUno->class, $bUno->url, $bUno->title, $bUno->classDue, $bUno->testo);
                    printf('<div class="%s"> <a href="%s" title="%s" class="%s">%s</a></div>', $bDue->class, $bDue->url, $bDue->title, $bDue->classDue, $bDue->testo)
                    ?>
                    
                </div>
            </div>
    </header>

     <div class="homeElement">
        <!-- imposto lo sfondo  -->

        <span class="sfondoimgnove"></span>

        <!-- imposto la descrizione  -->
        <div class="description">
            <h1 class= "hiddenTitle"><?php // questo titolo non è visibile serviva solo per inserire un h1 nel main della mia home page
                echo $paragrafi->H1 . ", " . $paragrafi->H2;
            ?></h1>
            <p><?php
                echo $paragrafi->p_uno;
                ?></p>
            <p><?php
                echo $paragrafi->p_due;
                ?></p>
            <p><?php
                echo $paragrafi->p_tre;
                ?></p>
        </div>

        <!-- imposto il video di youtube e il pulsante per accedere al mio vecchio progetto adobe xD  -->
        <div class="secondCol">
            <?php
                $iframe= $paragrafi->youtube;
                printf('<iframe %s src="%s" title="%s" allow="%s" %s></iframe>',$iframe->dimension, $iframe->url, $iframe->title, $iframe->allow, $iframe->attributi );
                $bTre = $paragrafi->bottoneTre;
                printf(' <a href="%s" class="%s" title="%s" target="_blank">%s</a>', $bTre->url, $bTre->class, $bTre->title, $bTre->testo)
            ?>
           
        </div>

    </div>
    <?php
    // richiamo il footer e il js usato per le animazioni del menu
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
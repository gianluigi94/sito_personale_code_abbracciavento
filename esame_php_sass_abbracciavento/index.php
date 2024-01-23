<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$fileHome = "data/home.json";
$paragrafi = json_decode(UT::leggiTesto($fileHome));

  //  inserisco il doctype, imposto la lingua e inserisco la head
  require_once "head.php";
?>

<body>

   <?php
  //  inserisco il menu 
  require_once "menu.php"; 
  // inserisco lo span e il logo che apparirà nella pagina al ridursi dello schermo e l'immagine di sfondo dell'intera pagina se è presente 
  require_once "add.php";
  ?>


<!-- HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER HEADER   -->

    <header>
        <div class="videoContainer">
            <?php
                $videoh = $paragrafi->video;
                printf('<video src="%s" id="%s" %s>%s</video>',$videoh->url, $videoh->id, $videoh->attributi, $videoh->alt );
            ?>
            

            <div class="headerContent">
                <h1><?php echo $paragrafi->H1 ?></h1>
                <h2><?php echo $paragrafi->H2 ?></h2>
                <div class="ahome">
                    <?php
                    $bUno = $paragrafi->bottoneUno;
                    $bDue = $paragrafi->bottoneDue;
                    printf('<div class="%s"> <a href="%s" title="%s" class="%s">%s</a></div>', $bUno->class, $bUno->url, $bUno->title, $bUno->classDue, $bUno->testo);
                    printf('<div class="%s"> <a href="%s" title="%s" class="%s">%s</a></div>', $bDue->class, $bDue->url, $bDue->title, $bDue->classDue, $bDue->testo)
                    ?>
                    
                </div>
            </div>
        </div>
    </header>

    <div class="homeElement">
        <span class="sfondoimgnove"></span>
        <div class="description">
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

        <div class="secondCol">
            <?php
                $iframe= $paragrafi->youtube;
                printf('<iframe %s src="%s" title="%s" allow="%s" %s></iframe>',$iframe->dimension, $iframe->url, $iframe->title, $iframe->allow, $iframe->attributi );
                $bTre = $paragrafi->bottoneTre;
                printf(' <a href="%s" class="%s" title="%s" target="_blank">%s</a>', $bTre->url, $bTre->class, $bTre->title, $bTre->testo)
            ?>
           
        </div>

    </div>


    <!-- inserisco il footer  -->

    <?php
    require_once "footer.php";
    ?>

    
    <!-- codice js per il funzionamento del menu hamburger -->

    <script src="script/script.js"></script>


</body>

</html>
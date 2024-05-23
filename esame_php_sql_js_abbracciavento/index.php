<?php
// in questa pagina gestisco la home page, le informazioni sono prese da dei dati json 
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$fileHome = "data/home.json";
$paragrafi = json_decode(UT::leggiTesto($fileHome));

// richiamo la head impostando dinamicamente lingua il title, e il content
require_once "head.php";
require_once 'cookies.php';


?>

<body class="noscroll">
    <?php
    // richiamo il menu 
    require_once "menu.php";
    ?>
    <!-- imposto la header  -->
    <header>
        <canvas id="canvas"> </canvas>
        <?php
        $videoh = $paragrafi->video;
        printf('<video src="%s" %s>%s</video>', $videoh->url, $videoh->attributi, $videoh->alt);
        ?>
        <div class="headerContent">
            <!-- imposto i titoli  -->
            <h1 class="hUno <?php echo $cookieColor; ?>"><?php echo $paragrafi->H1 ?></h1>
            <h2 class="<?php echo $cookieColorTwo ?>"><?php echo $paragrafi->H2 ?></h2>
            <div class="ahome">
                <!-- imposto i bottoni per le cta  -->
                <?php
                $bUno = $paragrafi->bottoneUno;
                $bDue = $paragrafi->bottoneDue;
                printf('<div class="%s"> <a href="%s" title="%s" class="%s %s">%s <span class="click %s"></span></a></div>', $bUno->class, $bUno->url, $bUno->title, $bUno->classDue, $cookieColor, $bUno->testo, $cookieClick);
                printf('<div class="%s"> <a href="%s" title="%s" class="%s %s">%s <span class="click %s"></span></a></div>', $bDue->class, $bDue->url, $bDue->title, $bDue->classDue, $cookieColor, $bDue->testo, $cookieClick)
                ?>
            </div>

        </div>
    </header>
    <?php
    require_once 'horse.php'
    ?>

    <div class="homeElement">
        <!-- imposto lo sfondo  -->

        <svg id="Livello_1" data-name="Livello 1" viewBox="0 0 269 487.35">
  
        <polyline class="cls-1" points="303.5 .5 165.5 .5 165.5 73.37 119.5 73.37 119.5 138.78 268.5 138.78 268.5 288.26 .5 288.26 .5 373.28 224.5 373.28 224.5 443.35 211.5 455.5"/>
</svg>
        <svg id="Livello_2" data-name="Livello 2" viewBox="0 0 269 487.35">
  
        <polyline class="cls-2" points="303.5 .5 165.5 .5 165.5 73.37 119.5 73.37 119.5 138.78 268.5 138.78 268.5 288.26 .5 288.26 .5 373.28 224.5 373.28 224.5 443.35 211.5 455.5"/>
</svg>
        <svg id="Livello_3" data-name="Livello 3" viewBox="0 0 269 487.35">
  
        <polyline class="cls-3" points="303.5 .5 165.5 .5 165.5 73.37 119.5 73.37 119.5 138.78 268.5 138.78 268.5 288.26 .5 288.26 .5 373.28 224.5 373.28 224.5 443.35 211.5 455.5"/>
</svg>
        


        <!-- imposto la descrizione  -->
        <div class="description <?php echo $cookieColor; ?>">

            <h1 class="hiddenTitle"><?php // questo titolo non è visibile, serve solo per inserire un h1 nel main della mia home page
                                    echo $paragrafi->H1 . ", " . $paragrafi->H2;
                                    ?></h1>
            <p class="pTransitionOne"><?php
                                        echo $paragrafi->p_uno;
                                        ?></p>
            <p class="pTransitionOne"><?php
                                        echo $paragrafi->p_due;
                                        ?></p>
            <p class="pTransitionOne"><?php
                                        echo $paragrafi->p_tre;
                                        ?></p>
        </div>

        <!-- imposto il video di youtube e il pulsante per accedere al mio vecchio progetto adobe xD  -->
        <div class="secondCol">
            <?php
            $iframe = $paragrafi->youtube;
            $iframe_url_no_autoplay = str_replace("autoplay=1&", "", $iframe->url); // Rimuovo autoplay
            printf('<iframe %s id="youtubeVideo" src="%s" title="%s" allow="%s" %s></iframe>', $iframe->dimension, $iframe_url_no_autoplay, $iframe->title, $iframe->allow, $iframe->attributi);
            ?>

        </div>
        <!-- definisco lo stile del pendolo e delle competenze  -->
        <h3 class="newtonh3">Le competenze che sto acquisendo: </h3>
        <div class="newton">
            
     <!-- tag apertura  -->
            <div class="apertura"><span class="tag">&lt;</span><span class="tagTwo">ul</span><span 
                    class="tag">&gt;</span></div>
            <ul class="competenze">
                <!-- lista di competenze 'tra tag' nascosti e animati con css -->
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Architettura web HTML e CSS<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Editing in Photoshop<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Stilizzazione via SASS<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Back-end con PHP<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Interattività in JS<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Editing con Illustrator<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>UI/UX design<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Sviluppo con WordPress<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Branch su Git<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
                <li class="<?php echo $cookieColor ?>"><span class="tag">&lt;</span><span class="tagTwo">li</span><span
                    class="tag">&gt;</span>Database con SQL<span class="tag">&lt;/</span><span
                    class="tagTwo">li</span><span class="tag">&gt;</span></li>
            </ul>
            <div class="flexNew"> 
                <!-- grafica delle sfere e delle aste del pendolo animate con css -->
            <div class="cradle <?php echo $bordoNewton ?>">
                <span class="<?php echo $spanBefore ?>"></span>
                <span class="<?php echo $spanBefore ?>"></span>
                <span class="<?php echo $spanBefore ?>"></span>
                <span class="<?php echo $spanBefore ?>"></span>
                <span class="<?php echo $spanBefore ?>"></span>
            </div>
            </div>
            <!-- tag chiusura -->
            <div class="chiusura"><span class="tag">&lt;/</span><span
                    class="tagTwo">ul</span><span class="tag">&gt;</span></div>
        </div>
        <div class="figma">
    <?php
    // bottone progetti
         $bTre = $paragrafi->bottoneTre;
         printf(' <div class= "centerC"><a href="%s" class="%s %s" title="%s" target="_blank">%s <span class="click %s"></span></a></div>', $bTre->url, $bTre->class, $cookieColor, $bTre->title, $bTre->testo, $cookieClick)
    ?>
    </div>
    </div>
    <?php
    // richiamo il footer
    require_once "footer.php";
    ?>
</body>

</html>

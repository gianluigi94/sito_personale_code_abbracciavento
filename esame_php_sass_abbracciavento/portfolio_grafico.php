<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$currentPage = basename($_SERVER['PHP_SELF']);
$fileaside = "data/aside.json";
$aside = json_decode(UT::leggiTesto($fileaside));

$filePortfolio = "data/portfolio.json";
$disegni = json_decode(UT::leggiTesto($filePortfolio));

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


    <?php
    $proGraf = $disegni->pagina;
    printf('<h1 class="%s" id="%s" >%s</h1>', $proGraf->class, $proGraf->id, $proGraf->h1);
    ?>

    <section class="pgraf">

        <?php
        foreach ($disegni->progetti as $progGra) {
            $classPro = "imgcard ";
            if ($progGra->h3 == "Carosello Vivace") {
                $classPro .= "carosello";
            }
            if ($progGra->h3 == "Toto Maker") {
                $classPro .= "toto";
            }
            printf('<div class="imgCon"><a href="%s" class="card" title="%s"><h3 class="titoletto">%s</h3><p class="descrizioneimg">%s</p><img src="%s" alt="%s" class="%s" draggable="false"></a></div>', $progGra->url, $progGra->title, $progGra->h3, $progGra->paragrafo, $progGra->url, $progGra->alt, trim($classPro));
        }
        ?>

    </section>





    <div class="container">

        <!-- inserisco l'aside per navigare tra gli altri progetti il più comodamente possibile -->

        <?php
            require_once "aside.php";
        ?>
    </div>


    <!-- inserisco il footer  -->

    <?php
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
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
    require_once "menu.php";
    require_once "add.php";
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
            printf('<div class="imgCon"><a href="%s" class="card" target="_blank" title="%s"><h3 class="titoletto">%s</h3><p class="descrizioneimg">%s</p><img src="%s" alt="%s" class="%s" draggable="false"></a></div>', $progGra->url, $progGra->title, $progGra->h3, $progGra->paragrafo, $progGra->url, $progGra->alt, trim($classPro));
        }
        ?>
    </section>

    

    <?php
    require_once "aside.php";
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$fileProgetti = "data/progetti.json";
$progect = json_decode(UT::leggiTesto($fileProgetti));

require_once "head.php";
?>

<body>

    <?php
    require_once "menu.php";
    require_once "add.php";
    ?>

    <div class="ttprogect">

        <?php
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
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
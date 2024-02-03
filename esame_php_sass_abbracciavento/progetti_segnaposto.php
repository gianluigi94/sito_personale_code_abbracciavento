<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$currentPage = basename($_SERVER['PHP_SELF']);
$fileaside = "data/aside.json";
$aside = json_decode(UT::leggiTesto($fileaside));

$fileLorem = "data/lorem.json";
$lorem = json_decode(UT::leggiTesto($fileLorem));



require_once "head.php";
?>

<body>
    <?php
    require_once "menu.php";
    require_once "add.php";
    ?>
    <div class="container">
        <div class="uno">
            <?php
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
    require_once "aside.php"
    ?>

    <?php
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
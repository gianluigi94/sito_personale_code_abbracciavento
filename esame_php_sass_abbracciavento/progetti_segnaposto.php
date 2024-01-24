<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$currentPage = basename($_SERVER['PHP_SELF']);
$fileaside = "data/aside.json";
$aside = json_decode(UT::leggiTesto($fileaside));

$fileLorem = "data/lorem.json";
$lorem = json_decode(UT::leggiTesto($fileLorem));

$titleProgect = UT::titleHTTP();

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



  <div class="container">
    <main class="box uno">
      <h1 class="title"><?php echo $titleProgect ?></h1>
      <?php
      for ($i = 0; $i < 4; $i++) {
      ?>
        <p class="text">
          <?php echo $lorem->pagina->testo; ?>
        </p>
      <?php
      }
      ?>

    </main>
    <figure class="box due">
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
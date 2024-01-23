<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$fileProgetti = "data/progetti.json";
$progect = json_decode(UT::leggiTesto($fileProgetti));

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
  
  <h1 class="titler"><?php echo $progect->pagina->h1 ?></h1>
  
  <section class="sectionPro">
    
    <?php
      foreach($progect->progetti as $prg){
        
        printf('<div class="progect"><a href="%s" title="%s"><h3>%s</h3><img src="%s" alt="%s" draggable="false"><p class="imgdes">%s</p></a></div>', $prg->url, $prg->title, $prg->h3, $prg->immagine, $prg->alt, $prg->paragrafo);
      }
      
    ?>

  </section>
  

 <!-- inserisco il footer  -->

 <?php
  require_once "footer.php";
  ?>
  
    <!-- codice js per il funzionamento del menu hamburger -->

  <script src="script/script.js"></script>  
  

</body>

</html>
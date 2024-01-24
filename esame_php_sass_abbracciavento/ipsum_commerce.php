<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$currentPage = basename($_SERVER['PHP_SELF']);
$fileaside = "data/aside.json";
$aside = json_decode(UT::leggiTesto($fileaside));
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
      <h1 class="title" >Ipsum-commerce</h1>
      <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem adipisci totam aliquam
        ab
        velit illum provident itaque nostrum modi, labore quia asperiores sed. Dolorum reiciendis sequi culpa
        inventore adipisci aliquam dignissimos at odio hic cumque nam, neque minima aliquid error labore. Porro
        exercitationem earum nulla officiis inventore, asperiores suscipit repellat fugit, vero ad reiciendis
        rerum. <br>
        Facere ipsa cupiditate. Possimus commodi odit cumque voluptatum nemo debitis rerum neque vitae, eveniet
        reprehenderit dolor numquam enim consequatur repellat aut, obcaecati libero, magnam minima natus
        voluptas
        cum corrupti nihil? Ipsam harum incidunt laborum quia voluptatem, laboriosam praesentium sapiente illo
        officia maxime sed unde illum recusandae ducimus dignissimos iure sit error autem earum eum molestias
        assumenda labore. <br> Officiis tempore corporis vitae soluta eligendi recusandae, assumenda a
        consectetur
        maxime, ea expedita blanditiis. Nemo impedit voluptate mollitia aut dolores laborum quaerat iure maiores
        soluta! Nesciunt minima, culpa maiores deleniti molestiae magni placeat nulla velit quasi fugiat sit ut
        reiciendis nisi facere id ducimus rerum explicabo magnam alias, nobis voluptate. Voluptatem saepe
        doloremque. <br>
        Fuga ducimus in cum sit ab debitis voluptates eaque, molestiae vitae aliquid dolore doloribus itaque,
        sint
        maiores, temporibus odio nesciunt mollitia reprehenderit. Exercitationem non quas ipsa quo sequi sunt
        voluptatem, debitis quidem velit vero? Esse!
      </p>
    </main>
    <figure class="box due">
      <img src="assets/negozionline.png" alt="Negozio online immagine" title="Immagine negozio online"
        draggable="false">
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
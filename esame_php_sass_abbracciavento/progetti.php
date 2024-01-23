<?php
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
  
  <h1 class="titler">Progetti</h1>
  
  <section class="ppro">
    
    
    <div class="progect">
      <a href="lorem_cripto_dolor.php" title="Progetto tema finanziario">
        <h3>Lorem Cripto Dolor</h3>      
        <img src="assets/grafico.png" alt="Immagine grafico" draggable="false">
        <p class="imgdes">Progetto ipotetico a tema finanziario

        </p>
     </a>
    </div>

    <div class="progect">
      <a href="socialorem.php" title="Progetto tema social network">
        <h3>SociaLorem</h3>      
        <img src="assets/telefono.png" alt="immagine telefono" draggable="false">
        <p class="imgdes">Progetto ipotetico a tema social network
        </p>
     </a>
    </div>

    <div class="progect">
      <a href="ipsum_commerce.php" title="Progetto tema negozio online">
        <h3>Ipsum-Commerce</h3>      
        <img src="assets/negozionline.png" alt="Immagine negozionline" draggable="false">
        <p class="imgdes">Progetto ipotetico a tema negozio onlini
        </p>
     </a>
    </div>

    <div class="progect">
      <a href="space_chess_dolor.php" title="Progetto scacchistico">
        <h3>Space Chess Dolor</h3>      
        <img src="assets/scacchispaziali.png" alt="mano che muove pezzo di scacchi" draggable="false">
        <p class="imgdes">Progetto ipotetico a tema scacchistico
        </p>
     </a>
    </div>

    <div class="progect">
      <a href="portfolio_grafico.php" title="Porfolio grafico">
        <h3>Porfolio Grafico</h3>      
        <img src="assets/penna.png" alt="immagine pena grafica" draggable="false">
        <p class="imgdes">Raccolta dei miei lavori con Photoshop e Illustrator</p>
     </a>
    </div>


  </section>
  

 <!-- inserisco il footer  -->

 <?php
  require_once "footer.php";
  ?>
  
    <!-- codice js per il funzionamento del menu hamburger -->

  <script src="script/script.js"></script>  
  

</body>

</html>
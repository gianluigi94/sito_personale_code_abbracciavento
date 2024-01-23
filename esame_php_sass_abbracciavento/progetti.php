<!DOCTYPE html>
<html lang="it">

  <!-- inserisco la head -->

  <?php
  require_once "head.php";
?>

<body>
  <span class="bordoMenu"></span>
  <span class="sfondoimgsei"></span>
  <a href="index.html" title="Home">
  <img class="nascosto mainImage" loading="eager" src="assets/logobianco.png" alt="Logo regina" draggable="false" >
  </a>

  <!-- inserisco il menu  -->

  <?php
  require_once "menu.php";
  ?>


  <!-- MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN  -->



  
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
  
  <script src="script/script.js"></script>  
  

</body>

</html>
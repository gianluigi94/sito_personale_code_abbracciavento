<!DOCTYPE html>
<html lang="it">

   <!-- inserisco la head -->

   <?php
  require_once "head.php";
?>

<body>
  <span class="bordoMenu"></span>
  <a href="index.html" title="Home">
  <img class="nascosto mainImage" loading="eager" src="assets/logobianco.png" alt="Logo regina" draggable="false" >

  </a>

  <!-- inserisco il menu  -->

  <?php
  require_once "menu.php";
  ?>

    

  <!-- MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN  -->

<header>
    <div class="videoContainer">
        <video src="assets/sesantaquattro.webm" id="videobig" autoplay loop muted></video>
        
        <div class="headerContent">
            <h1>Gianluigi Abbracciavento</h1>
            <h2>Aspirante web developer e web desiner</h2>
            <div class="ahome">
           <div class="ooo"> <a href="contatti.php" title="Pagina contatti" class="contatti">Contattami</a></div>
           <div class="ppp"> <a href="progetti.php" title="pagina progetti" class="progetti">Guarda i miei progetti</a></div>
        </div>
        </div>
    </div>
</header>

<div class="homeElement">
    <span class="sfondoimgnove"></span>
<div class="description">
    <p>
        Benvenuto sul mio secondo sito
        sviluppato in PHP E SASS.
    </p>
    <p>
        Se non lo hai ancora fatto puoi dare
        un'occhiata al mio <a href="https://www.gianluigiabbracciavento.it/" class="link" title="sito WordPress"
            target="_blank">sito in WordPress</a>,
        che ho realizzato come esercitazione
        per l'accademia Glam.
        <br>
        Mi chiamo Gianluigi e sono un
        appassionato di informatica e grafica
        e attualmente sto studiando
        programmazione presso l'accademia
        code, quindi tenete d'occhio i miei siti
        e la mia pagina <a href="http://www.linkedin.com/in/gianluigi-abbracciavento-b661a8284" class="link"
            title="pagina social" target="_blank">Linkedin</a> per scoprire
        le mie ultime novità.
    </p>
    <p>
  
        Sono entusiasta di potervi mostrare i
        miei progetti e sarei felice di ricevere
        i vostri pareri per migliorare come
        professionista.
    </p>
  </div>  
  
  <div class="secondCol">
    <iframe width="500" height="315" src="https://www.youtube.com/embed/kqLYcNH2l60?si=Z_U9FeksVDfmV0Jh"
    title="YouTube video player"
    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    allowfullscreen>
    </iframe>

<a href="https://xd.adobe.com/view/da29ab1c-e6f2-47dc-b964-e8fc9c3a5b83-8f7a/" class="prototipo" title="adobe XD"
    target="_blank">Guarda il prototipo del sito</a>

  </div>
  
</div>

  
      <!-- inserisco il footer  -->

  <?php
  require_once "footer.php";
  ?>
  
  <script src="script/script.js"></script>  
  

</body>

</html>
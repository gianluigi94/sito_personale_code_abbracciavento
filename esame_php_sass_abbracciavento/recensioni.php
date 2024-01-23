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


  <!-- MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN  -->



  <header class="recc">
    
      <h1 class="titler">Cosa dicono di me</h1>

    
      <p class="spiegazione">Per il momento non ho molte recensioni visto il numero modesto di progetti che ho sviluppato,
        ma allo stesso
        tempo non mi tiro indietro se qualcuno mi commissiona un lavoro.
      </p>
    

  </header>


  <section class="recensione">
    <h2 class="tittledue">Toto Pixel</h2>
    <div class="conteinerdue">
      <img src="assets/toto_foto.png" alt="Foto Toto Pixel" draggable="false" title="Toto Pixel">
      <p>Estremamente soddisfatto del risultato finale, logo trasformato in vettoriale in maniera eccelsa con
        addirittura più versioni e colorazioni, in modo da essere già tutto pronto per essere utilizzato in ogni
        possibile soluzione.
        Anche la versione creata da zero è molto bella e sia adatta al mio stile e lavoro.
        Super consigliato.</p>
      <a href="https://www.youtube.com/@TotoPixel" title="Social Toto" target="_blank">Youtube</a>
      <br>
      <a href="https://www.instagram.com/warriors_tfc/" title="Social Toto" target="_blank">Instagram</a>
    </div>
  </section>

  <!-- COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI COMMENTI -->


  <form action="recensioni.php" class="formTwo">
    <h2 class="tittledue">Lascia anche tu un commento:</h2>
    <textarea name="commento" id="commento" placeholder="commento..."></textarea>
    <label for="foto">Invia foto <span class="opzionale">(opzionale, png o jpeg, max size 5MB)</span></label>
    <input type="file" id="foto" name="foto">
    <label for="accettazione" class="customChecbox">
        <input type="checkbox" class="hidenCheckbox" id="accettazione" name="accettazione" required>
        <span class="checkmark"></span>
        Dichiaro di aver letto le informative riguardanti l'utilizzo dei dati personali
      </label>
      <button type="submit">Invia messaggio <svg class="airp w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
      </svg>
      </button>
  </form>




  <!-- inserisco il footer  -->

  <?php
  require_once "footer.php";
  ?>
  
  <script src="script/script.js"></script>


</body>

</html>
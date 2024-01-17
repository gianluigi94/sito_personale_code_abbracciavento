<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Pagina contatti">
  <title>Contatti</title>
  
  <link rel="icon" type="image/png" href="assets/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="css/style.min.css">
  
</head>

<body>
  <span class="bordoMenu"></span>
  <!-- <span class="animate"></span> -->
  <span class="sfondoimgotto"></span>
  <a href="index.html" title="Home">
  <img class="nascosto mainImage" loading="eager" src="assets/bianco.png" alt="Logo regina" draggable="false" >
  </a>

  <!-- MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU MENU   -->

 

  <nav id="top">
    <div class="navbig" >
        <div class="firstmenu">
            <ul class="firstlist">
                <li><a href="index.php" title="Home" id="uru">Home</a></li>
                <li class="special"><a href="progetti.php" title="progetti">Progetti  <i class="fas fa-caret-down"></i></a>
                <ul class="subMenu">
                    <li><a href="progetti.php" title="progetti" >Tutti i Progetti</a></li>
                    <li><a href="portfolio_grafico.php" title="portfoglio grafico">Porfolio Grafico</a></li>
                    <li><a href="ipsum_commerce.php" title="progetto Ipsum-Commerce">Ipsum-Commerce</a></li>
                    <li><a href="socialorem.php" title="progetto sociaLorem">SociaLorem</a></li>
                    <li><a href="lorem_cripto_dolor.php" title="progetto Lorem Cripto Dolor">Lorem Cripto Dolor</a></li>
                    <li class="lastChild"><a href="space_chess_dolor.php" title="progetto space Chess Dolor">Space Chess Dolor</a></li>
                </ul>
                </li>
            </ul>
        </div>
        <div class="secondmenu">
          <a href="index.php" id="logo" title="Home" >
        <img src="assets/bianco.png" alt="Logo regina" loading="eager" draggable="false" class="mainImage">
      </a>
    </div>
        <div class="thirdmenu">
            <ul class="secondlist">
                <li><a href="recensioni.php" title="Pagina recensioni">Recensioni</a></li>
                <li><a href="contatti.php" title="pagina contatti">Contatti</a></li>
            </ul>
        </div>
    </div>

    <!-- MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURG -->

    <div class="containersup">
      <div class="navbar">
        <div class="hamburgermenu">
          <span class="linee lineeone"></span>
          <span class="linee linetwo"></span>
          <span class="linee linetree"></span>
        </div>
        <ul class="navList">
          <li class="navItem">
            <a href="index.php" class="nav-link" id="ur">Home</a>
          </li>
          <li class="navItem navprogect">
            Progetti <i class="fas fa-caret-down"></i>
            <ul class="sottomini">
              <li><a href="progetti.php" title="Pagina progetti">Tutti i Progetti</a></li>
              <li><a href="portfolio_grafico.php" title="portfolio grafico">Porfolio Grafico</a></li>
              <li><a href="ipsum_commerce.php" title="Progetto Ipsum-Commerce">Ipsum-Commerce</a></li>
              <li><a href="socialorem.php" title="Progetto SociaLorem">SociaLorem</a></li>
              <li><a href="lorem_cripto_dolor.php" title="Progetto lorem Cripto Dolor">Lorem Cripto Dolor</a></li>
              <li><a href="space_chess_dolor.php" title="Progetto Space Chess Dolor">Space Chess Dolor</a></li>
  
            </ul>
          </li>
          <li class="navItem">
            <a href="recensioni.php" title="pagina recensioni" class="nav-link">Recensioni</a>
          </li>
          <li class="navItem">
            <a href="contatti.php" class="nav-link" title="pagina contatti">Contatti</a>
          </li>
  
        </ul>
  
      </div>
    </div>
</nav>


  <!-- MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN MAIN  --> FIXME:

  
  <h1 class="titles">Contatti</h1>
  <div class="twopage">
    <form action="invioEmail" method="post">
      <fieldset>
      <legend>Inviami una email</legend>
      <label for="nome">Nome<span class="opzionale">*</span></label>
      <input type="text" id="nome" name="nome" required autocomplete="off">
      <label for="cognome">Cognome<span class="opzionale">*</span> </label>
      <input type="text" id="cognome" name="cognome" required autocomplete="off">
      <label for="email">Email<span class="opzionale">*</span> </label>
      <input type="email" id="email" name="email" required autocomplete="off">
      <label for="tel">Numero di telefono <span class="opzionale">(opzionale)</span></label>
      <input type="tel" id="tel" name="tel" autocomplete="off">
      <label for="messaggio">Inserisci il tuo messaggio<span class="opzionale">*</span> </label>
      <textarea name="messaggio" id="messaggio" cols="30" rows="10" required autocomplete="off"></textarea>
      <label for="accettazione" class="customChecbox">
        <input type="checkbox" class="hidenCheckbox" id="accettazione" name="accettazione" required>
        <span class="checkmark"></span>
        Dichiaro di aver letto le informative riguardanti l'utilizzo dei dati personali
      </label>
      <button type="submit">Ivia messaggio <svg class="airp w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
      </svg>
      </button>
    </fieldset>
    </form>
    
      <iframe class="sectiontwo"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d90708.72157601382!2d7.334092992309494!3d44.72680422133416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12cd339e28a911ef%3A0x405e67d473ca330!2s12032%20Barge%20CN!5e0!3m2!1sit!2sit!4v1698120340020!5m2!1sit!2sit"
            title="mappa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    
  </div>
  
  
  <!-- FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER -->


  <footer>
    <div class="box footerone"> 
      <a href="#top">
      <img src="assets/bianco.png" alt="Logo regina" draggable="false" loading="lazy" title="Torna su" class="mainImage">
      </a>
    </div>
    <div class="box footertwo">
      <p class="recapiti">Recapiti</p>
      <ul>
        <li>Via Castello 2, Barge (CN)</li>
        <li>+39 3405281353</li>
        <li>gianluigiabbracciavento@yahoo.com</li>
      </ul>
      <a aria-label="Linkedin" href="http://www.linkedin.com/in/gianluigi-abbracciavento-b661a8284" title="social"
        target="_blank" class="link">
        <img
          src="assets/linkedin.png"
          alt="Icona social" class="icona"  draggable="false" loading="lazy"></a>
    </div>
    <div class="box footerthree">
      <hr>

      <p class="button">Sviluppato da © Gianluigi Abbracciavento</p>
    </div>
  </footer>
  <script src="script/script.js"></script>  
  

</body>

</html>
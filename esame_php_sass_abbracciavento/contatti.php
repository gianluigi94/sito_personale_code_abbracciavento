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
   <!-- inserisco il menu  -->

   <?php
  require_once "menu.php";
  ?>

  <span class="bordoMenu"></span>
  <span class="sfondoimgotto"></span>
  <a href="index.html" title="Home">
  <img class="nascosto mainImage" loading="eager" src="assets/logobianco.png" alt="Logo regina" draggable="false" >
  </a>
  
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
      <label for="argomento">Scegli il tipo di argomento<span class="opzionale">*</span></label>
      <select name="argomento" id="argomento">
        <option value="" selected>Seleziona un argomento</option>
        <option value="informazioni">Informazioni</option>
        <option value="assistenza">Assistenza</option>
      </select>
      <label for="messaggio">Inserisci il tuo messaggio<span class="opzionale">*</span> </label>
      <textarea name="messaggio" id="messaggio" cols="30" rows="10" required autocomplete="off"></textarea>
      <label for="accettazione" class="customChecbox">
        <input type="checkbox" class="hidenCheckbox" id="accettazione" name="accettazione" required>
        <span class="checkmark"></span>
        Dichiaro di aver letto le informative riguardanti l'utilizzo dei dati personali
      </label>
      <button type="submit">Invia messaggio <svg class="airp w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
  
  
  <!-- inserisco il footer  -->

  <?php
  require_once "footer.php";
  ?>
  
  <script src="script/script.js"></script>
  

</body>

</html>
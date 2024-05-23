<?php
// in questa pagina gestisco l'interfaccia grafica delle tabelle che gestiscono le info ai miei progetti

require_once 'funzioni.php';

// inizializzo le variabili per la creazione di un form
$formUpRec = "";
$formUpMes = "";
$formUpDr = "";
$formUpPr = "";
$formUpUt = "";
$formInRec = "";
$formInUp = "";
$formInMes = "";
$formInDr = "";
$formInPr = "";
require_once "head.php";
session_start(); // inizio la sessione per far accedere a questa pagina solo i responsabili

// se clicco sul tasto per uscire dalla sessione
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['azione']) && $_POST['azione'] === 'logout') { 
    session_unset(); // Rimuove tutte le variabili di sessione
    session_destroy(); // Distrugge la sessione
    header('Location: login.php'); // Reindirizza alla pagina di login
    exit();
}


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); //vengo rimandato al login se non c'è una sessione
    exit;
}
?>

<body class="dbBody">

    <!-- menu che farà comparire la tabella specifica -->
    <nav id="menuDb">
        <ul>
            <li><a href="?db=conferma" id="confermaLink">Conferma recensioni</a></li>
            <li><a href="?db=recensioni" id="recensioniLink">Tutte le recensioni</a></li>
            <li><a href="?db=portfolio" id="portfolioLink">Portfolio grafico</a></li>
            <li><a href="?db=progetti" id="progettiLink">Tutti i progetti</a></li>
            <li><a href="?db=utenti" id="utentiLink">Utenti</a></li>
        </ul>
    </nav>

    <button type="button" id="exit">Disconnettiti</button>

    <!-- i 4 titoli che compariranno nella pagina corrispondente  -->
    <h3 class="dbTitolo">Conferma le ultime recensioni ricevute:</h3>
    <h3 class="dbTitolo">Modifica i dati della pagina Recensioni:</h3>
    <h3 class="dbTitolo">Modifica i dati del progetto Portfolio grafico:</h3>
    <h3 class="dbTitolo">Modifica la gestione dei tuoi progetti:</h3>
    <h3 class="dbTitolo">Gestisci utenti:</h3>

    <!-- span dell'immagine di sfondo -->
    <span id="sfondoRegina"><img src="assets/logobianco.png" alt="logo regina"></span>


    <!-- span dove si agganceranno le 4 tabelle create in js  -->
    <span id="tabellaContainer"></span>
    <span id="tabellaContainerMes"></span>
    <span id="tabellaContainerRec"></span>
    <span id="tabellaContainerProg"></span>
    <span id="tabellaContainerUt"></span>



    <!-- I 5 popup nascosti per la conferma della cancellazione dei dati, uno per tabella con id diverso  -->
    <div class="cancelMes" id="cancUno">
        <p>Sei sicuro di voler cancellare definitivamente il dato?</p>
        <div>
            <button type="button" id="annullaCancB">Annulla</button>
            <button type="button" id="cancDefUno">Cancella</button>
        </div>
    </div>

    <div class="cancelMes" id="cancDue">
        <p>Sei sicuro di voler cancellare definitivamente il dato?</p>
        <div>
            <button type="button" id="annullaCancBDue">Annulla</button>
            <button type="button" id="cancDefDue">Cancella</button>
        </div>
    </div>

    <div class="cancelMes" id="cancTre">
        <p>Sei sicuro di voler cancellare definitivamente il dato?</p>
        <div>
            <button type="button" id="annullaCancBTre">Annulla</button>
            <button type="button" id="cancDefTre">Cancella</button>
        </div>
    </div>

    <div class="cancelMes" id="cancQuattro">
        <p>Sei sicuro di voler cancellare definitivamente il dato?</p>
        <div>
            <button type="button" id="annullaCancBQuattro">Annulla</button>
            <button type="button" id="cancDefQuattro">Cancella</button>
        </div>
    </div>
    <div class="cancelMes" id="cancCinque">
        <p>Sei sicuro di voler cancellare definitivamente il dato?</p>
        <div>
            <button type="button" id="annullaCancBCinque">Annulla</button>
            <button type="button" id="cancDefCinque">Cancella</button>
        </div>
    </div>


    <!-- form nascosto per l'inserimento di un nuovo progetto grafico  -->

    <form action="admin.php" method="post" id="formInsertf">

    <?php
        $formInDr .= sprintf('<div><p>NUOVA IMMAGINE:</p>');
        $formInDr .= sprintf('<input type="hidden" id="id"  name="id">');
        $formInDr .= sprintf('<label for="url">URL</label>');
        $formInDr .= sprintf('<input type="text" required id="url" name="url">');
        $formInDr .= sprintf('<label for="titolo">TITOLO</label>');
        $formInDr .= sprintf('<input type="text" required id="titolo" name="titolo">');
        $formInDr .= sprintf('<label for="sottotitolo">SOTTOTITOLO</label>');
        $formInDr .= sprintf('<input type="text" required id="sottotitolo" name="sottotitolo">');
        $formInDr .= sprintf('<label for="alt">ALT</label>');
        $formInDr .= sprintf('<input type="text" required id="alt" name="alt"></div>');
        $formInDr .= sprintf('<div><label for="descrizione">DESCRIZIONE</label>');
        $formInDr .= sprintf('<textarea required name="descrizione" id="descrizione"></textarea>');
        $formInDr .= sprintf('<button type="button" class="annullaInsertf">Annulla</button>');
        $formInDr .= sprintf('<button type="button" id="nuoletigaf">Inserisci</button></div>');
        $formInDr .= sprintf('');
        echo $formInDr;
    ?>
       </form>
            
    <!-- form nascosto per la modifica di un progetto grafico  -->  

    <form action="admin.php" method="post" id="formUpdate">

        <?php
            $formUpDr .= sprintf('<div><p>MODIFICA IMMAGINE:</p>');
            $formUpDr .= sprintf('<input type="hidden" id="idUpdate" name="idUpdate">');
            $formUpDr .= sprintf('<label for="urlUpdate">URL</label>');
            $formUpDr .= sprintf('<input type="text" id="urlUpdate" name="urlUpdate">');
            $formUpDr .= sprintf('<label for="titoloUpdate">TITOLO</label>');
            $formUpDr .= sprintf('<input type="text" id="titoloUpdate" name="titoloUpdate">');
            $formUpDr .= sprintf('<label for="sottotitoloUpdate">SOTTOTITOLO</label>');
            $formUpDr .= sprintf('<input type="text" id="sottotitoloUpdate" name="sottotitoloUpdate">');
            $formUpDr .= sprintf('<label for="altUpdate">ALT</label>');
            $formUpDr .= sprintf('<input type="text" id="altUpdate" name="altUpdate"></div>');
            $formUpDr .= sprintf('<div><label for="descrizioneUpdate">DESCRIZIONE</label>');
            $formUpDr .= sprintf('<textarea name="descrizioneUpdate" id="descrizioneUpdate"></textarea>');
            $formUpDr .= sprintf('<button type="button" class="annullaUpdatef">Annulla</button>');
            $formUpDr .= sprintf('<button type="button" id="cambiaRigaf">Modifica</button></div>');
            $formUpDr .= sprintf('');
            echo $formUpDr;
        ?>
        
    
        

    </form>


<!-- form nascosto per la modifica di una recensione da accettare -->  


    <form action="admin.php" method="post" id="formUpdateMes">

        <?php
            $formInMes .= sprintf('<div><p>MODIFICA RECENSIONE:</p>');
            $formInMes .= sprintf('<input type="hidden" id="idUpdateMes" name="idUpdateMes">');
            $formInMes .= sprintf('<label for="nomeUpdateMes">NOME</label>');
            $formInMes .= sprintf('<input type="text" id="nomeUpdateMes" name="nomeUpdateMes">');
            $formInMes .= sprintf('<label for="urlUpdateProfiloMes">URL FOTO</label>');
            $formInMes .= sprintf('<input type="text" id="urlUpdateProfiloMes" name="urlUpdateProfiloMes">');
            $formInMes .= sprintf('<label for="socialUpdateNameMes">NOME SOCIAL</label>');
            $formInMes .= sprintf('<input type="text" id="socialUpdateNameMes" name="socialUpdateNameMes">');
            $formInMes .= sprintf('<label for="socialUpdateUrlMes">SOCIAL LINK</label>');
            $formInMes .= sprintf('<input type="text" id="socialUpdateUrlMes" name="socialUpdateUrlMes"></div>');
            $formInMes .= sprintf('<div><label for="testoUpdateMes">TESTO</label>');
            $formInMes .= sprintf('<textarea name="testoUpdateMes" id="testoUpdateMes"></textarea>');
            $formInMes .= sprintf('<button type="button" class="annullaUpdate">Annulla</button>');
            $formInMes .= sprintf('<button type="button" id="modificaRigaMes">Modifica</button></div>');
            echo $formInMes;
        ?>
    </form>




    <!-- form nascosto per l'inserimento di una recensione  -->  

    <form action="admin.php" method="post" id="formInsertRec">

    <?php
        $formInRec .= sprintf('<div><p>NUOVA RECENSIONE:</p>');
        $formInRec .= sprintf('<input type="hidden" id="idRec" name="idRec">');
        $formInRec .= sprintf('<label for="nomeRec">NOME</label>');
        $formInRec .= sprintf('<input type="text" id="nomeRec" name="nomeRec">');
        $formInRec .= sprintf('<label for="urlProfilo">URL FOTO</label>');
        $formInRec .= sprintf('<input type="text" id="urlProfilo" name="urlProfilo">');
        $formInRec .= sprintf('<label for="socialName">NOME SOCIAL</label>');
        $formInRec .= sprintf('<input type="text" id="socialName" name="socialName">');
        $formInRec .= sprintf('<label for="socialUrl">SOCIAL LINK</label>');
        $formInRec .= sprintf('<input type="text" id="socialUrl" name="socialUrl"></div>');
        $formInRec .= sprintf('<div><label for="testoRec">TESTO</label>');
        $formInRec .= sprintf('<textarea name="testoRec" id="testoRec"></textarea>');
        $formInRec .= sprintf('<button type="button" class="annullaInsertz">Annulla</button>');
        $formInRec .= sprintf('<button type="button" id="nuoletigaRecz">Inserisci</button></div>');
        echo $formInRec;
    ?>        
    </form>





    <!-- form nascosto per la modifica di una recensione  -->  

    <form action="admin.php" method="post" id="formUpdateRec">

    <?php
        $formUpRec .= sprintf('<div><p>MODIFICA RECENSIONE:</p>');
        $formUpRec .= sprintf('<input type="hidden" id="idUpdateRec" name="idUpdateRec">');
        $formUpRec .= sprintf('<label for="nomeUpdateRec">NOME</label>');
        $formUpRec .= sprintf('<input type="text" id="nomeUpdateRec" name="nomeUpdateRec">');
        $formUpRec .= sprintf('<label for="urlUpdateProfilo">URL FOTO</label>');
        $formUpRec .= sprintf('<input type="text" id="urlUpdateProfilo" name="urlUpdateProfilo">');
        $formUpRec .= sprintf('<label for="socialUpdateName">NOME SOCIAL</label>');
        $formUpRec .= sprintf('<input type="text" id="socialUpdateName" name="socialUpdateName">');
        $formUpRec .= sprintf('<label for="socialUpdateUrl">SOCIAL LINK</label>');
        $formUpRec .= sprintf('<input type="text" id="socialUpdateUrl" name="socialUpdateUrl"></div>');
        $formUpRec .= sprintf('<div><label for="testoUpdateRec">TESTO</label>');
        $formUpRec .= sprintf('<textarea name="testoUpdateRec" id="testoUpdateRec"></textarea>');
        $formUpRec .= sprintf('<button type="button" class="annullaUpdatez">Annulla</button>');
        $formUpRec .= sprintf('<button type="button" id="modificaRigaRecz">Modifica</button></div>');
        echo $formUpRec;
    ?>
    </form>



    

    <!-- form nascosto per l'inserimento di un progetto  -->
    <form action="admin.php" method="post" id="formInsertProg">

    <?php
        $formInPr .= sprintf('<div><p>NUOVO PROGETTO:</p>');
        $formInPr .= sprintf('<input type="hidden" id="idProg" name="idProg">');
        $formInPr .= sprintf('<label for="titoloProg">TITOLO</label>');
        $formInPr .= sprintf('<input type="text" id="titoloProg" name="titoloProg">');
        $formInPr .= sprintf('<label for="descrizioneProg">DESCRIZIONE</label>');
        $formInPr .= sprintf('<input type="text" id="descrizioneProg" name="descrizioneProg">');
        $formInPr .= sprintf('<label for="urlProg">URL IMMAGINE</label>');
        $formInPr .= sprintf('<input type="text" id="urlProg" name="urlProg">');
        $formInPr .= sprintf('<label for="sottotitoloImgProg">SOTTOTITOLO IMMAGINE</label>');
        $formInPr .= sprintf('<input type="text" id="sottotitoloImgProg" name="sottotitoloImgProg"></div>');
        $formInPr .= sprintf('<div><label for="testoProg">TESTO</label>');
        $formInPr .= sprintf('<textarea name="testoProg" id="testoProg"></textarea>');
        $formInPr .= sprintf('<label for="numeroProg">RIPETIZIONI TESTO</label>');
        $formInPr .= sprintf('<input type="number" id="numeroProg" name="numeroProg">');
        $formInPr .= sprintf('<button type="button" class="annullaInserty">Annulla</button>');
        $formInPr .= sprintf('<button type="button" id="nuoletigaProg">Inserisci</button></div>');
        echo $formInPr;
    ?>

    </form>





    <!-- form nascosto per la modifica di un progetto  --> 

    <form action="admin.php" method="post" id="formUpdateProg">

    <?php
        $formUpPr .= sprintf('<div><p>MODIFICA PROGETTO:</p>');
        $formUpPr .= sprintf('<input type="hidden" id="idUpdateProg" name="idUpdateProg">');
        $formUpPr .= sprintf('<label for="titoloUpdateProg">TITOLO</label>');
        $formUpPr .= sprintf('<input type="text" id="titoloUpdateProg" name="titoloUpdateProg">');
        $formUpPr .= sprintf('<label for="descrizioneUpdateProg">DESCRIZIONE</label>');
        $formUpPr .= sprintf('<input type="text" id="descrizioneUpdateProg" name="descrizioneUpdateProg">');
        $formUpPr .= sprintf('<label for="urlUpdateProg">URL IMMAGINE</label>');
        $formUpPr .= sprintf('<input type="text" id="urlUpdateProg" name="urlUpdateProg">');
        $formUpPr .= sprintf('<label for="sottotitoloUpdateImgProg">SOTTOTITOLO IMMAGINE</label>');
        $formUpPr .= sprintf('<input type="text" id="sottotitoloUpdateImgProg" name="sottotitoloUpdateImgProg"></div>');
        $formUpPr .= sprintf('<div><label for="testoUpdateProg">TESTO</label>');
        $formUpPr .= sprintf('<textarea name="testoUpdateProg" id="testoUpdateProg"></textarea>');
        $formUpPr .= sprintf('<label for="numeroUpdateProg">RIPETIZIONI TESTO</label>');
        $formUpPr .= sprintf('<input type="number" id="numeroUpdateProg" name="numeroUpdateProg">');
        $formUpPr .= sprintf('<button type="button" class="annullaUpdatey">Annulla</button>');
        $formUpPr .= sprintf('<button type="button" id="cambiaRigaProg">Modifica</button></div>');
        echo $formUpPr;
    ?>

    </form>
    <!-- form nascosto per l'inserimento di un utente  --> 

    <form action="admin.php" method="post" id="formInsertUt">

    <?php
        $formUpUt .= sprintf('<div><p>INSERISCI UTENTE:</p>');
        $formUpUt .= sprintf('<input type="hidden" id="idInserUt" name="idInserUt">');
        $formUpUt .= sprintf('<label for="nomeInsertUt">NOME</label>');
        $formUpUt .= sprintf('<input type="text" id="nomeInsertUt" name="nomeInsertUt">');
        $formUpUt .= sprintf('<label for="passwordInsertUt">PASSWORD</label>');
        $formUpUt .= sprintf('<input type="text" id="passwordInsertUt" name="passwordInsertUt">');
        $formUpUt .= sprintf('<button type="button" class="annullaInsertUt">Annulla</button>');
        $formUpUt .= sprintf('<button type="button" id="nuoletigaUt">Inserisci</button></div>');
        echo $formUpUt;
    ?>

    </form>

    <!-- form nascosto per la modifica di un utente  --> 

    <form action="admin.php" method="post" id="formUpdateUt">

    <?php
        $formInUp .= sprintf('<div><p>MODIFICA UTENTE:</p>');
        $formInUp .= sprintf('<input type="hidden" id="idUpdateUt" name="idUpdateUt">');
        $formInUp .= sprintf('<label for="nomeUpdateUt">NOME</label>');
        $formInUp .= sprintf('<input type="text" id="nomeUpdateUt" name="nomeUpdateUt">');
        $formInUp .= sprintf('<label for="passwordUpdateUt">PASSWORD</label>');
        $formInUp .= sprintf('<input type="text" id="passwordUpdateUt" name="passwordUpdateUt">');
        $formInUp .= sprintf('<button type="button" class="annullaUpdateUt">Annulla</button>');
        $formInUp .= sprintf('<button type="button" id="modificaRigaUt">Modifica</button></div>');
        echo $formInUp;
    ?>

    </form>

    
</body>

</html>
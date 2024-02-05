<?php

// in questa pagina definisco la pagina delle recensioni, con l'aggiunta di un nuovo form per simulare l'invio di una vera e propria recensione 
require_once "funzioni.php";

use sito_personale\functions\Utility as UT;

// definisco i valori dei campi presi dal metodo post 
$inviato = UT::richiestaHTTP('inviato');
$nome = trim(UT::richiestaHTTP("nome"));
$testo = trim(UT::richiestaHTTP("commento"));
$check = UT::richiestaHTTP("accettazione");

// definisco alcune variabili che mi serviranno su questa pagina 
$fileDaScrivere = "data/recensioni.txt";
$fileRec = "data/recensioni.json";
$dataOra = date("d-m-Y H:i");

// creo delle scorciatoie per leggere i file json 
$recensione = json_decode(UT::leggiTesto($fileRec));
$recUno = $recensione->recensione;
$inptxt = $recensione->form->textarea;
$inpInp = $recensione->form->input;
$inpck = $recensione->form->check;
$inpbtn = $recensione->form->button;
$nomeF = $recensione->form->nome;
$hdn = $recensione->form->hidden;
$out = $recensione->output;

// definisco la classe dei messaggi di errore, di default hanno dispay none 
$classHiddenUno = "formErHid";
$classHiddenDue = "formErHid";
$classHiddenTre = "formErHid";
$classHiddenQuattro = "formErHid";
$classHiddenCinque = "formErHid";
$classHiddenSei = "formErHid";
$classHiddenSette = "formErHid";
$classHiddenOtto = "formErHid";
$classHiddenNove = "formErHid";
$classHiddenTen = "formErHid";

// definisco la classe di defaul dei vari elementi input 
$clNomeImp = "inpOne";
$clTxtImp = "txtOne";
$clCkImp = "checkmark";
$clCkLab = "labRec";
$clFlImo = "inpOne";
$clFlLab = "labRec";

// definisco delle variabili vuote che mi serviranno più avanti 
$stringaRec = "";
$fileName = "";
$form = "";

// se non è stato inviato nessu dato valido sara false 
$inviato = ($inviato == null || $inviato != 1) ? false : true;

if ($inviato) {
    // imposto due contatori per gli errori, uno per gli input obligatori e uno per l'invio dell'immagine facoltativa
    $valido = 0;
    $erroreImg = 0;

    // con questo metodo controllo la validità del campo nome e in caso di errore aumento il conteggio degli errori, e cambio le classi
    UT::formControl($nome, 2, 20, $clNomeImp, "inpOneEr", $classHiddenUno, $classHiddenDue,  $valido);

    // con questo metodo controllo la validità del campo testo e in caso di errore aumento il conteggio degli errori, e cambio le classi
    UT::formControl($testo, 2, 600, $clTxtImp, "txtOneEr", $classHiddenTre, $classHiddenQuattro,  $valido);

    // con questo metodo controllo la spunta nella checkboxe  e in caso di errore aumento il conteggio degli errori, e cambio le classi
    UT::checkControl($valido, $clCkLab, "labRecEr", $clCkImp, "checkmarkEr", $classHiddenTen);

    // inizio il controllo dell'immagine, ricordiamo non essere un campo obligatorio, ma se l'utente prova ad inviare file non accettati viene segnalato 
    if (isset($_FILES) && count($_FILES) > 0) {
        // definisco le estensioni permesse, la grandezza massima e la cartella dove verrà salvato il file 
        $estensioniPermesse = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
        $dimensione_massima = 4 * 1024 * 1024;
        $uploadDir = __DIR__ . '/upload';

        // creo un ciclo per passare le proprità del file inviato, se trova l'errore di elemento vuoto, lo faccio saltare, perche lascio la possibilità di non inserire la foto per la recensione. La funzione assegna le classi di errore e aumenta di uno il conteggio degli errori per il file
        foreach ($_FILES as $file) {
            if ($file['error'] === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            $fileName = basename($file['name']);
            $dimensione_file = $file["size"];
            $estensione = pathinfo($fileName, PATHINFO_EXTENSION);
            if ($file['error'] !== UPLOAD_ERR_OK) {
                UT::fotoControl($erroreImg, $classHiddenCinque, $clFlImo, $clFlLab);
            } elseif (!array_key_exists($estensione, $estensioniPermesse)) {
                UT::fotoControl($erroreImg, $classHiddenSei, $clFlImo, $clFlLab);
            } elseif ($dimensione_file > $dimensione_massima) {
                UT::fotoControl($erroreImg, $classHiddenSette, $clFlImo, $clFlLab);
            } elseif (file_exists($uploadDir . DIRECTORY_SEPARATOR . $fileName)) {
                UT::fotoControl($erroreImg, $classHiddenOtto, $clFlImo, $clFlLab);
            }
            // se non ci sono errori nell'invio del file, ma ci sono errori nel resto del form, mando a schermo un errore apposita per indicare la giusta via all'utente
            if ((($erroreImg != 0) || ($erroreImg == 0)) && (($valido != 0) && ($_FILES['foto']['error'] != UPLOAD_ERR_NO_FILE))) {
                $clFlImo = "inpOneEr";
                $clFlLab = "labRecEr";
                $classHiddenNove = "formEr";
            }
        }
    }
    // se non ci sono errori ne nei campi obligatori e ne in quello facoltativo $inviato diventa true 
    $inviato = ($valido == 0 && $erroreImg == 0) ? true : false;
}
// richiamo la head impostando dinamicamente lingua il title, e il content
require_once "head.php";
?>

<body>
    <?php
    // richiamo il menu, e dinamicamente anche il titolo principale e l'immagine di sfondo 
    require_once "menu.php";
    require_once "add.php";
    ?>
    <!-- gestisco la section dove tengo la mia recesione, tutti i dati sono salvati su un file json  -->
    <section>
        <p class="spieg"><?php echo $recensione->p ?></p>

        <div class="conteinerdue">
            <h3><?php echo $recUno->h2 ?></h3>
            <?php
            $recImg = $recUno->foto;
            printf('<img src="%s" alt="%s" draggable="false" title="%s">', $recImg->url, $recImg->alt, $recImg->title);
            ?>
            <p><?php echo $recUno->testo ?></p>
            <?php
            $recSuno = $recUno->socialUno;
            printf('<a href="%s" title="%s" target="_blank">%s</a><br>', $recSuno->url, $recSuno->title, $recSuno->txt);
            $recSdue = $recUno->socialDue;
            printf('<a href="%s" title="%s" target="_blank">%s</a>', $recSdue->url, $recSdue->title, $recSdue->txt);
            ?>
        </div>
    </section>

    <!-- se $inviato è false verrà ancora mostrato il form  -->
    <?php if (!$inviato) {
        // per prima cosa controllo se fosse stata selezionata la checkboxe e se fosse vero la riseleziono 
        $isChecked = isset($_POST['accettazione']) && $_POST['accettazione'] == 'on' ? 'checked' : '';
    ?>
    <!-- gestisco il form i dati per la costruzione dei campi sono presi da un file json, i messaggi di errore sono stati inseriti e nascosti vicini al campo interessato  -->

    

        <form action="recensioni.php#ancora" class="formTwo" method="post" enctype="multipart/form-data" novalidate>
            <fieldset class="fieltwo">
                <legend class="tittledue"><?php echo $recensione->titolo->h2 ?></legend>
                <?php
                $form .= sprintf("<input class='%s' type='%s' id='%s'  name='%s' placeholder=%s value='%s' required minlength='2' maxlength='20' autocomplete='off'>",$clNomeImp, $nomeF->type, $nomeF->id, $nomeF->name, $nomeF->placeholder, $nome);
                $form .= sprintf($out->nomeV, $classHiddenUno);
                $form .= sprintf($out->nomeIn, $classHiddenDue);
                $form .= sprintf("<textarea class='%s' name='%s' id='%s' placeholder='%s' minlength='2' maxlength='600' required >%s</textarea>",$clTxtImp, $inptxt->name, $inptxt->id, $inptxt->placeholder, $testo);
                $form .= sprintf($out->txtV, $classHiddenTre);
                $form .= sprintf($out->txtIn, $classHiddenQuattro);
                $form .= sprintf("<label class='%s' for='%s'>%s <span class='%s'>%s</span></label>",$clFlLab, $inpInp->for, $inpInp->text, $inpInp->spanClass, $inpInp->spanTxt);
                $form .= sprintf("<input class='%s' type='%s' id='%s' accept='image/jpeg, image/png' name='%s'>",$clFlImo, $inpInp->type, $inpInp->id, $inpInp->name);
                $form .= sprintf($out->generale, $classHiddenCinque);
                $form .= sprintf($out->estensioni, $classHiddenSei);
                $form .= sprintf($out->grandezza, $classHiddenSette);
                $form .= sprintf($out->presenza, $classHiddenOtto, $fileName);
                $form .= sprintf($out->noPerfect, $classHiddenNove);
                $form .= sprintf("<label for='%s' class='customChecbox %s'>", $inpck->for, $clCkLab);
                $form .= sprintf("<input type='%s' class='hidenCheckbox' %s required id='%s' name='%s'>", $inpck->type, $isChecked, $inpck->id, $inpck->name);
                $form .= sprintf("<span class='%s'></span>%s</label>",$clCkImp, $inpck->text);
                $form .= sprintf($out->checkF, $classHiddenTen);
                $form .= sprintf('<input type="%s" name="%s" value="%s">', $hdn->type, $hdn->name, $hdn->value);
                $form .= sprintf('<button class="buttOne"  type="%s">%s %s</button>', $inpbtn->type, $inpbtn->txt, $inpbtn->svg);
                echo $form;
                
                ?>
            </fieldset>
        </form>

<!-- se $inviato è vero si entra in questo blocco di codice e il form sparisce per visualizzare il resoconto dei dati inviati  -->
    <?php } else {
        // creo una stringa con i dati dell'utente, la salvo su un file txt e mando a schermo un resoconto.
        $stringaRec = "Nome utente:" . chr(10) . $nome . chr(10) . "Recensione:" . chr(10) . $testo . chr(10) . $dataOra . chr(10) . chr(10);
        UT::scriviTesto($fileDaScrivere, $stringaRec);
        printf($out->successoTxt, $nome, $testo, $dataOra);
        
        // se tutto è andato a buon fine mando un secondo messaggio sia nel caso ha mandato anche un immagine, o se non lo ha fatto e vorrebbe farlo 
        if (($erroreImg == 0) && ($_FILES['foto']['error'] != UPLOAD_ERR_NO_FILE)) {
            move_uploaded_file($_FILES['foto']['tmp_name'], $uploadDir . DIRECTORY_SEPARATOR . $_FILES['foto']['name']);
            printf($out->successoImg, $_FILES['foto']['name']);
        }elseif((($_FILES['foto']['error'] == UPLOAD_ERR_NO_FILE)) && (UT::scriviTesto($fileDaScrivere, $stringaRec))) {
            printf($out->successoNoImg);
        }
    ?>
    <!-- faccio comparire anche un bottone per un eventuale rinvio della recensione o di una foto  -->
        <button class="buttTre" onclick="window.location.href='recensioni.php'"><?php echo $inpbtn->txtDue  ?></button>
    <?php

    }
    ?>
<!-- creo un ancoraggio con uno span per reindirizzare l'utente nel posto giusto al ricaricamento della pagina, sia se il form è valido e sia se non lo è -->
<span id="ancora"></span>
    <?php
    // richiamo il footer e il codice js usato per le animazioni del menu 
    require_once "footer.php";
    ?>
    <script src="script/script.js"></script>
</body>

</html>
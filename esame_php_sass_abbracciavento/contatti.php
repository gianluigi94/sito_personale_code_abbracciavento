<?php
// in questa pagina organizzo il codice per il form della pagina contatti 

require_once "funzioni.php";
use sito_personale\functions\Utility as UT;

// lista del valore dei campi presi tramite metodo Post 
$inviato = UT::richiestaHTTP('inviato');
$nome = trim(UT::richiestaHTTP('nome'));
$cognome = trim(UT::richiestaHTTP('cognome'));
$email = trim(UT::richiestaHTTP('email'));
$tel = trim(UT::richiestaHTTP('tel'));
$argomento = UT::richiestaHTTP('argomento');
$testo = trim(UT::richiestaHTTP('messaggio'));
$check = UT::richiestaHTTP("accettazione");

// variabili che mi serviranno in questa pagina 
$copiaEmail = "data/email_copia.txt";
$fileContatti = "data/contatti.json";
$dataOra = date("d-m-Y H:i");

// scorciatoie per muoversi più velocemente nei file json 
$contatti = json_decode(UT::leggiTesto($fileContatti));
$nomeJs = $contatti->form->nome;
$cognomeJs = $contatti->form->cognome;
$emailJs = $contatti->form->email;
$telJs = $contatti->form->tel;
$argomentoJs = $contatti->form->argomento;
$txtJs = $contatti->form->textarea;
$checkJs = $contatti->form->check;
$button = $contatti->form->button;
$hdn = $contatti->form->hidden;
$out = $contatti->form->output;
$if = $contatti->iframe;

// classi degli input di default 
$classeNomeLab = "labelTwo";
$classeNomeImp = "inpTwo";
$classeCognomeLab = "labelTwo";
$classeCognomeImp = "inpTwo";
$classeEmailLab = "labelTwo";
$classeEmailImp = "inpTwo";
$classeTelefonoLab = "labelTwo";
$classeTelefonoImp = "inpTwo";
$classeArgomentoLab = "labelTwo";
$classeArgomentoImp = "select";
$classeTestoLab = "labelTwo";
$classeTestoImp = "txtDue";
$classeCheckLab = "labelTwo";
$clsasseCheck = "checkmarkTwo";

// classi dei messaggi di errore, di default sono su display none 
$classeHiddenUno = "formErHid";
$classeHiddenDue = "formErHid";
$classeHiddenTre = "formErHid";
$classeHiddenQuattro = "formErHid";
$classeHiddenCinque = "formErHid";
$classeHiddenSei = "formErHid";
$classeHiddenSette = "formErHid";
$classeHiddenOtto = "formErHid";
$classeHiddenNove = "formErHid";
$classeHiddenTen = "formErHid";
$classeHiddenUndic = "formErHid";
$classeHiddenDodici = "formErHid";
$classeHiddenTredici = "formErHid";
$classeHiddenQuattordici = "formErHid";

// inizializzo delle variabili vuote che mi serviranno in questa pagina 
$form = "";
$stringaEmail = "";
$fileNameEm = "";

// se l'utente non ha inviato dei dati validi è falso, altrimenti è vero 
$inviato = ($inviato == null || $inviato != 1) ? false : true;

// se inviato è vero esegue questi controlli 
if ($inviato) {
    // contatore di errori 
    $valido = 0;

    // metodo per il controllo del nome, nel caso ci siano errori, cambia classi css, aumenta il conteggio degli errori e resetta il valore
    UT::formControlDue($nome, 2, 20, $classeNomeImp, "inpTwoEr", $classeHiddenUno, $classeHiddenDue, $classeNomeLab, "labelTwoEr",  $valido);

    // metodo per il controllo del cognome, nel caso ci siano errori, cambia classi css, aumenta il conteggio degli errori e resetta il valore
    UT::formControlDue($cognome, 2, 20, $classeCognomeImp, "inpTwoEr", $classeHiddenTre, $classeHiddenQuattro, $classeCognomeLab, "labelTwoEr",  $valido);

    // metodo per il controllo della email, nel caso ci siano errori, cambia classi css, aumenta il conteggio degli errori e resetta il valore 
    UT::formControlEmail($email, 8, 55, $classeEmailImp, $classeHiddenCinque,  $classeHiddenSette, $classeHiddenSei, $classeEmailLab, $valido);

    // metodo per il controllo del testo, nel caso ci siano errori, cambia classi css, aumenta il conteggio degli errori e resetta il valore
    UT::formControlDue($testo, 2, 600, $classeTestoImp, "txtDueEr", $classeHiddenUndic, $classeHiddenDodici, $classeTestoLab, "labelTwoEr",  $valido);

    // metodo per il controllo della spunta della checkbox, nel caso ci siano errori, cambia classi css e aumenta il conteggio degli errori 
    UT::checkControl($valido, $classeCheckLab, "labelTwoEr", $clsasseCheck, "checkmarkTwoEr", $classeHiddenTredici);

    // il controllo del numero di telefono non è uguale agli altri controlli, visto che il campo telefono è opzionale e non controllo che sia vuoto. Tuttavia se viene inserito un valore e quel valore è sbagliato, questo viene segnalato all'utente
    // Viene controllato che non siano stati inseriti caratteri non ammessi, che sia della giusta lunghezza e in caso di errore cambia gli stili css facendo apparire anche messaggi di errore  
    if (!preg_match('/^[+]?[0-9\s\-\(\)]+$/', $tel) && !empty($tel)) {
        $classeHiddenQuattordici = "formErr";
    } elseif ((!UT::controllaRangeStringa($tel, 7, 17)) && !empty($tel)) {
        $classeHiddenNove = "formErr";
    }
    if ((!preg_match('/^[+]?[0-9\s\-\(\)]+$/', $tel) && !empty($tel)) || (!UT::controllaRangeStringa($tel, 7, 17)) && !empty($tel)) {
        $tel = "";
        $valido++;
        $classeTelefonoLab = "labelTwoEr";
        $classeTelefonoImp = "inpTwoEr";
    }

    // Qui controllo velocemente se è stata selezionata la select ed è stato scelto un argomento 
    if (empty($argomento)) {
        $argomento = "";
        $valido++;
        $classeHiddenTen = "formErr";
        $classeArgomentoLab = "labelTwoEr";
        $classeArgomentoImp = "selectEr";
    }

    // Viene nuovamente controllato $valido, se il campo degli errori è ancora sullo 0 inviato è vero 
    $inviato = ($valido == 0) ? true : false;
}


// richiamo il doctype e la head, definendo dinamicamente la lingua, il title, e la description. 
require_once "head.php";
?>

<body>
    <?php
    // richiamo il menu, e dinamicamente anche il titolo principale e l'immagine di sfondo 
    require_once "menu.php";
    require_once "add.php";

    ?>
    <!-- se $inviato è ancora falso si entra in questo blocco di codice e viene mostrato nuovamente il form  -->
      <?php if (!$inviato) {
        // controllo se in precedenza è stata selezionata la checkbox dall'utente e se sì la riseleziono 
                    $isChecked = isset($_POST['accettazione']) && $_POST['accettazione'] == 'on' ? 'checked' : '';
                ?>
    <div class="twopage">

    <!-- compare il form solo se $inviato è false, il form ha novalidate per apprezzare i controlli lato server. I dati per la costruzione del form sono presi dal file json e tra gli elementi del form sono stati aggiunti i messaggi di errore vicino ai campi interessati, ma tenuti nascosti-->
        <form action="contatti.php" method="post" novalidate>
            <fieldset class="fieltwo">
              
                    <legend><?php echo $contatti->form->legend ?></legend>
                    <?php
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span></label>', $classeNomeLab, $nomeJs->for, $nomeJs->txt, $nomeJs->spanclass, $nomeJs->spanText);
                    $form .= sprintf('<input class="%s" type="%s" id="%s" name="%s" value="%s" required minlength="2" maxlength="20" autocomplete="off">', $classeNomeImp, $nomeJs->type, $nomeJs->id, $nomeJs->name, $nome);
                    $form .= sprintf($out->nomeV, $classeHiddenUno);
                    $form .= sprintf($out->nomeIn, $classeHiddenDue);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span> </label>', $classeCognomeLab, $cognomeJs->for, $cognomeJs->txt, $cognomeJs->spanclass, $cognomeJs->spanText);
                    $form .= sprintf('<input class="%s" type="%s" id="%s" name="%s" value="%s" minlength="2" maxlength="20" required autocomplete="off">', $classeCognomeImp, $cognomeJs->type, $cognomeJs->id, $cognomeJs->name, $cognome);
                    $form .= sprintf($out->cognomeV, $classeHiddenTre);
                    $form .= sprintf($out->cognomeIn, $classeHiddenQuattro);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span> </label>', $classeEmailLab, $emailJs->for, $emailJs->txt, $emailJs->spanclass, $emailJs->spanText);
                    $form .= sprintf('<input class="%s" type="%s" id="%s" name="%s" value="%s" minlength="10" maxlength="55" required autocomplete="off">', $classeEmailImp, $emailJs->type, $emailJs->id, $emailJs->name, $email);
                    $form .= sprintf($out->emailV, $classeHiddenCinque);
                    $form .= sprintf($out->emailIn, $classeHiddenSei);
                    $form .= sprintf($out->emailErr, $classeHiddenSette);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span></label>', $classeTelefonoLab, $telJs->for, $telJs->txt, $telJs->spanclass, $telJs->spanText);
                    $form .= sprintf('<input class="%s" type="%s" id="%s" name="%s" value="%s" minlength="7" maxlength="17" autocomplete="off">', $classeTelefonoImp, $telJs->type, $telJs->id, $telJs->name, $tel);
                    $form .= sprintf($out->telV, $classeHiddenOtto);
                    $form .= sprintf($out->telIn, $classeHiddenNove);
                    $form .= sprintf($out->telCaratteri, $classeHiddenQuattordici);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span></label>', $classeArgomentoLab, $argomentoJs->for, $argomentoJs->txt, $argomentoJs->spanclass, $argomentoJs->spanText);
                    $form .= sprintf('<select class="%s" name="%s" id="%s">', $classeArgomentoImp, $argomentoJs->name, $argomentoJs->id);

                    // con un array definisco le opzioni della select e le ciclo per trovare quella selezionata dall'utente
                    $options = [
                        $argomentoJs->v1 => $argomentoJs->v1txt,
                        $argomentoJs->v2 => $argomentoJs->v2txt,
                        $argomentoJs->v3 => $argomentoJs->v3txt
                    ];

                    foreach ($options as $value => $text) {
                        $selected = ($argomento == $value) ? ' selected' : '';
                        $form .= sprintf('<option value="%s"%s>%s</option>', $value, $selected, $text);
                    }
                    $form .= sprintf('</select>');
                    $form .= sprintf($out->argV, $classeHiddenTen);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span> </label>', $classeTestoLab, $txtJs->for, $txtJs->txt, $txtJs->spanclass, $txtJs->spanText);
                    $form .= sprintf('<textarea class="%s" name="%s" id="%s" %s required minlength="2" maxlength="600" autocomplete="off">%s</textarea>', $classeTestoImp, $txtJs->name, $txtJs->id, $txtJs->dimension, $testo);
                    $form .= sprintf($out->txtV, $classeHiddenUndic);
                    $form .= sprintf($out->txtIn, $classeHiddenDodici);
                    $form .= sprintf('<label for="%s" class="%s %s">', $checkJs->for, $checkJs->class, $classeCheckLab);
                    $form .= sprintf('<input type="%s" class="%s" id="%s" name="%s" %s required>', $checkJs->type, $checkJs->inpClass, $checkJs->id, $checkJs->name, $isChecked);
                    $form .= sprintf('<span class="%s"></span>', $clsasseCheck);
                    $form .= sprintf('%s', $checkJs->text);
                    $form .= sprintf('</label>');
                    $form .= sprintf($out->checkF, $classeHiddenTredici);
                    $form .= sprintf('<input type="%s" name="%s" value="%s">', $hdn->type, $hdn->name, $hdn->value);
                    $form .= sprintf('<button type="%s" class="%s">%s %s</button>', $button->type, $button->class, $button->txt, $button->svg);
                    echo $form;
                    ?>
                
            </fieldset>
        </form>
        
        <!-- stampo a schermo la mappa  -->
        <?php
        printf('<iframe class="sectiontwo" src="%s" title="%s" %s></iframe>', $if->url, $if->title, $if->attributi);
        ?>

    </div>
    <!-- se $inviato è vero entro in questo blocco di codice e il form sparisce, rimpiazzato dall'elenco dei suoi dati  -->
    <?php } else {
        // in base alla scelta fatta dall'utente definisco l'oggetto della richiesta 
                    $argomento = ($argomento == 1) ? "Informazioni" : "Assistenza";

                    // se il numero di telefono è assente lo specifico 
                    $tel = ($tel == "") ? "-ASSENTE-" : $tel;

                    // compongo la stringa con i dati dell'utente e la data/ora dell'invio
                    $stringaEmail = "<strong>Nome:</strong>" . "<br>" . $nome . "<br>" . "<strong>Cognome:</strong>" . "<br>" . $cognome . "<br>" . "<strong>Email:</strong>" . "<br>" . $email . "<br>" . "<strong>Telefono:</strong>" . "<br>" . $tel . "<br>" . "<strong>Argomento/Oggetto:</strong>" . "<br>" . $argomento . "<br>" . "<strong>Testo:</strong>" . "<br>" . $testo . "<br>" . "<strong>$dataOra</strong>" . "<br>" . "<br>";

                    printf($out->successoTxt, $stringaEmail);
                    // dopo aver stampato a schermo i dati converto i caratteri html in caratteri ASCII e salvo il contenuto in un file txt
                    $stringaEmail = str_replace( ["<br>", "<strong>", "</strong>"], [chr(10), "", ""], $stringaEmail );
                    UT::scriviTesto($copiaEmail, $stringaEmail);
                    ?>
                    <!-- compare un pulsante per ricaricare la pagina se si vuole inviare un nuovo messaggio  -->
                    <button class="buttTre" onclick="window.location.href='contatti.php'"><?php echo $button->txtDue?></button>
                <?php
                } ?>

<!-- richiamo il footer e il js usato per le animazioni del menu -->
    <?php
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
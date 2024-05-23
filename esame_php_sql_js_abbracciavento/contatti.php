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


require_once 'cookies.php';


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

    $inviato = ($valido == 0) ? true : false;
    // Codice per inviare email in LOCALE COMMENTERO' PER EVITARE ERRORI
    // if ($inviato) {
    //     $to = 'gianluigiabbracciavento@yahoo.com'; 
    //     $subject = 'Nuovo messaggio dal form contatti';
    //     $message = "<strong>Nome:</strong> $nome<br><strong>Cognome:</strong> $cognome<br><strong>Email:</strong> $email<br><strong>Telefono:</strong> $tel<br><strong>Argomento/Oggetto:</strong> $argomento<br><strong>Testo:</strong> $testo<br><strong>Data e Ora:</strong> $dataOra<br>";
    //     $headers = "MIME-Version: 1.0" . "\r\n";
    //     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    //     $headers .= "From: <$email>" . "\r\n";
    
    //     if (!mail($to, $subject, $message, $headers)) {
    //         $inviato = false; 
    //     }
    // }
    
}


// richiamo il doctype e la head, definendo dinamicamente la lingua, il title, e la description. 
require_once "head.php";
?>

<body class="noscroll">
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

                    <legend class="
                    <?php
                    echo $cookieColor;
                    ?>"><?php echo $contatti->form->legend ?><span class="pCookiesQuattro <?php
                                                                                            echo $cookieSpecial
                                                                                            ?>"></span></legend>
                    <?php
                    $form .= sprintf('<label class="%s %s" for="%s">%s<span class="%s">%s</span></label>', $classeNomeLab, $cookieColorTwo, $nomeJs->for, $nomeJs->txt, $nomeJs->spanclass, $nomeJs->spanText);
                    $form .= sprintf('<input class="%s %s" type="%s" id="%s" name="%s" value="%s" required minlength="2" maxlength="20" autocomplete="off">', $classeNomeImp, $cookieInput, $nomeJs->type, $nomeJs->id, $nomeJs->name, $nome);
                    $form .= sprintf($out->nomeV, $classeHiddenUno, $cookieSpecial);
                    $form .= sprintf($out->nomeIn, $classeHiddenDue, $cookieSpecial);
                    $form .= sprintf('<label class="%s %s" for="%s">%s<span class="%s">%s</span> </label>', $classeCognomeLab, $cookieColorTwo, $cognomeJs->for, $cognomeJs->txt, $cognomeJs->spanclass, $cognomeJs->spanText);
                    $form .= sprintf('<input class="%s %s" type="%s" id="%s" name="%s" value="%s" minlength="2" maxlength="20" required autocomplete="off">', $classeCognomeImp, $cookieInput, $cognomeJs->type, $cognomeJs->id, $cognomeJs->name, $cognome);
                    $form .= sprintf($out->cognomeV, $classeHiddenTre, $cookieSpecial);
                    $form .= sprintf($out->cognomeIn, $classeHiddenQuattro, $cookieSpecial);
                    $form .= sprintf('<label class="%s %s" for="%s">%s<span class="%s">%s</span> </label>', $classeEmailLab, $cookieColorTwo, $emailJs->for, $emailJs->txt, $emailJs->spanclass, $emailJs->spanText);
                    $form .= sprintf('<input class="%s %s" type="%s" id="%s" name="%s" value="%s" minlength="10" maxlength="55" required autocomplete="off">', $classeEmailImp, $cookieInput, $emailJs->type, $emailJs->id, $emailJs->name, $email);
                    $form .= sprintf($out->emailV, $classeHiddenCinque, $cookieSpecial);
                    $form .= sprintf($out->emailIn, $classeHiddenSei, $cookieSpecial);
                    $form .= sprintf($out->emailErr, $classeHiddenSette, $cookieSpecial);
                    $form .= sprintf('<label class="%s %s" for="%s">%s<span class="%s">%s</span></label>', $classeTelefonoLab, $cookieColorTwo, $telJs->for, $telJs->txt, $telJs->spanclass, $telJs->spanText);
                    $form .= sprintf('<input class="%s %s" type="%s" id="%s" name="%s" value="%s" minlength="7" maxlength="17" autocomplete="off">', $classeTelefonoImp, $cookieInput, $telJs->type, $telJs->id, $telJs->name, $tel);
                    $form .= sprintf($out->telV, $classeHiddenOtto, $cookieSpecial);
                    $form .= sprintf($out->telIn, $classeHiddenNove, $cookieSpecial);
                    $form .= sprintf($out->telCaratteri, $classeHiddenQuattordici, $cookieSpecial);
                    $form .= sprintf('<label class="%s %s" for="%s">%s<span class="%s">%s</span></label>', $classeArgomentoLab, $cookieColorTwo, $argomentoJs->for, $argomentoJs->txt, $argomentoJs->spanclass, $argomentoJs->spanText);
                    $form .= sprintf('<select class="%s %s" name="%s" id="%s">', $classeArgomentoImp, $cookieInput, $argomentoJs->name, $argomentoJs->id);

                    // con un array definisco le opzioni della select e le ciclo per trovare quella selezionata dall'utente
                    $options = [
                        $argomentoJs->v1 => $argomentoJs->v1txt,
                        $argomentoJs->v2 => $argomentoJs->v2txt,
                        $argomentoJs->v3 => $argomentoJs->v3txt
                    ];

                    foreach ($options as $value => $text) {
                        $selected = ($argomento == $value) ? ' selected' : '';
                        $form .= sprintf('<option class="%s" value="%s"%s>%s</option>', $cookieOption, $value, $selected, $text);
                    }
                    $form .= sprintf('</select>');
                    $form .= sprintf($out->argV, $classeHiddenTen, $cookieSpecial);
                    $form .= sprintf('<label class="%s %s" for="%s">%s<span class="%s">%s</span> </label>', $classeTestoLab, $cookieColorTwo, $txtJs->for, $txtJs->txt, $txtJs->spanclass, $txtJs->spanText);
                    $form .= sprintf('<textarea class="%s %s" name="%s" id="%s" %s required minlength="2" maxlength="600" autocomplete="off">%s</textarea>', $classeTestoImp, $cookieInput, $txtJs->name, $txtJs->id, $txtJs->dimension, $testo);
                    $form .= sprintf($out->txtV, $classeHiddenUndic, $cookieSpecial);
                    $form .= sprintf($out->txtIn, $classeHiddenDodici, $cookieSpecial);
                    $form .= sprintf('<label for="%s" class="%s %s %s">', $checkJs->for, $checkJs->class, $classeCheckLab, $cookieColorTwo);
                    $form .= sprintf('<input type="%s" class="%s" id="%s" name="%s" %s required>', $checkJs->type, $checkJs->inpClass, $checkJs->id, $checkJs->name, $isChecked);
                    $form .= sprintf('<span class="%s %s"></span>', $clsasseCheck, $cookieInput);
                    $form .= sprintf('%s', $checkJs->text);
                    $form .= sprintf('</label>');
                    $form .= sprintf($out->checkF, $classeHiddenTredici, $cookieSpecial);
                    $form .= sprintf('<input type="%s" name="%s" value="%s">', $hdn->type, $hdn->name, $hdn->value);
                    $form .= sprintf('<button type="%s" id="invioEmail" class="%s %s">%s %s</button>', $button->type, $button->class, $cookieInputIn, $button->txt, $button->svg);
                    echo $form;
                    ?>

                </fieldset>
            </form>
            <div class="mappa">
                <!-- stampo a schermo la mappa  -->
                <?php
                printf('<iframe class="sectiontwo" src="%s" title="%s" %s></iframe>', $if->url, $if->title, $if->attributi);
                ?>
                <span class="ombraSpan"></span>
            </div>

        </div>
        <!-- se $inviato è vero entro in questo blocco di codice e il form sparisce, rimpiazzato dall'elenco dei suoi dati  -->
    <?php } else {
        // in base alla scelta fatta dall'utente definisco l'oggetto della richiesta 
        $argomento = ($argomento == 1) ? "Informazioni" : "Assistenza";

        // se il numero di telefono è assente lo specifico 
        $tel = ($tel == "") ? "-ASSENTE-" : $tel;

        // compongo la stringa con i dati dell'utente e la data/ora dell'invio
        $stringaEmail = "<strong>Nome:</strong>" . "<br>" . $nome . "<br>" . "<strong>Cognome:</strong>" . "<br>" . $cognome . "<br>" . "<strong>Email:</strong>" . "<br>" . $email . "<br>" . "<strong>Telefono:</strong>" . "<br>" . $tel . "<br>" . "<strong>Argomento/Oggetto:</strong>" . "<br>" . $argomento . "<br>" . "<strong>Testo:</strong>" . "<br>" . $testo . "<br>" . "<strong>$dataOra</strong>" . "<br>" . "<br>";

        printf($out->successoTxt, $cookieSpecial, $stringaEmail);
        // dopo aver stampato a schermo i dati converto i caratteri html in caratteri ASCII e salvo il contenuto in un file txt
        $stringaEmail = str_replace(["<br>", "<strong>", "</strong>"], [chr(10), "", ""], $stringaEmail);
        UT::scriviTesto($copiaEmail, $stringaEmail);
    ?>
        <!-- compare un pulsante per ricaricare la pagina se si vuole inviare un nuovo messaggio  -->
        <button class="buttTre <?php echo $cookieInputIn; ?>" onclick="window.location.href='contatti.php'"><?php echo $button->txtDue ?></button>
    <?php
    } ?>

    <!-- richiamo il footer-->
    <?php
    require_once "footer.php";
    ?>

    



</body>

</html>
<?php

// in questa pagina definisco la pagina delle recensioni, con l'aggiunta di un nuovo form per simulare l'invio di una vera e propria recensione 
require_once "funzioni.php";
require 'db/config.php';

use sito_personale\functions\Utility as UT;

// definisco i valori dei campi presi dal metodo post 
$inviato = UT::richiestaHTTP('inviato');
$nome = trim(UT::richiestaHTTP("nomeRe"));
$socialSel = trim(UT::richiestaHTTP("social"));
$socialLink = trim(UT::richiestaHTTP("socialImp"));
$testo = trim(UT::richiestaHTTP("commentoRe"));
$check = UT::richiestaHTTP("accettazione");

// definisco alcune variabili che mi serviranno su questa pagina 
$fileDaScrivere = "data/recensioni.txt";
$fileRec = "data/recensioni.json";
$dataOra = date("d-m-Y H:i");

// creo delle scorciatoie per leggere i file json 
$recensione = json_decode(UT::leggiTesto($fileRec));
$recensioniDiv = $recensione->recensioni;
$inptxt = $recensione->form->textarea;
$inpInp = $recensione->form->input;
$inpck = $recensione->form->check;
$inpbtn = $recensione->form->button;
$nomeF = $recensione->form->nome;
$hdn = $recensione->form->hidden;
$out = $recensione->output;

// definisco la classe dei messaggi di errore, di default hanno display none 
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
$classHiddenUndici = "formErHid";
$classHiddenDodici = "formErHid";
$classHiddenTredici = "formErHid";

// definisco la classe di default dei vari elementi input 
$clNomeImp = "inpOne";
$clTxtImp = "txtOne";
$clCkImp = "checkmark";
$clCkLab = "labRec";
$clFlImo = "inpOne";
$clFlLab = "labRec";
$clScUno = "labRec";
$clScDue = "select";
$clScTre = "inpOne";

// definisco delle variabili vuote che mi serviranno più avanti 
$stringaRec = "";
$fileName = "";
$form = "";

require_once 'cookies.php';


// se non è stato inviato nessun dato valido sarà false 
$inviato = ($inviato == null || $inviato != 1) ? false : true;

if ($inviato) {
    // imposto due contatori per gli errori, uno per gli input obbligatori e uno per l'invio dell'immagine facoltativa
    $valido = 0;
    $erroreImg = 0;

    // con questo metodo controllo la validità del campo nome e in caso di errore aumento il conteggio degli errori, e cambio le classi
    UT::formControl($nome, 2, 20, $clNomeImp, "inpOneEr", $classHiddenUno, $classHiddenDue,  $valido);

    // con questo metodo controllo la validità del campo testo e in caso di errore aumento il conteggio degli errori, e cambio le classi
    UT::formControl($testo, 2, 600, $clTxtImp, "txtOneEr", $classHiddenTre, $classHiddenQuattro,  $valido);

    // con questo metodo controllo la spunta nella checkbox  e in caso di errore aumento il conteggio degli errori, e cambio le classi
    UT::checkControl($valido, $clCkLab, "labRecEr", $clCkImp, "checkmarkEr", $classHiddenTen);

    // inizio il controllo dell'immagine, che ricordiamo non essere un campo obbligatorio, ma se l'utente prova ad inviare file non accettati viene segnalato 
    if (isset($_FILES) && count($_FILES) > 0) {
        $estensioniPermesse = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
        $dimensione_massima = 4 * 1024 * 1024;
        $uploadDir = 'upload';  // Percorso relativo rispetto alla directory root del web server

        // Assicurati che la directory di upload esista
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

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
            }
        }
    }


    if ($socialSel != "0" && strlen($socialLink) == 0) {
        $classHiddenTredici = "formEr";
        $clScUno = "labRecEr";
        $clScTre = "inpOneEr";
        $valido++;
    } elseif ($socialSel == "0" && strlen($socialLink) > 0) {
        $classHiddenUndici = "formEr";
        $clScUno = "labRecEr";
        $clScDue = "selectEr";
        $valido++;
    } elseif ($socialSel != "0" && strlen($socialLink) > 0 && strlen($socialLink) < 7) {
        $classHiddenDodici = "formEr";
        $clScUno = "labRecEr";
        $clScTre = "inpOneEr";
        $valido++;
    }




    // se non ci sono errori né nei campi obbligatori e né in quello facoltativo $inviato diventa true 
    $inviato = ($valido == 0 && $erroreImg == 0) ? true : false;
}
// richiamo la head impostando dinamicamente lingua, il title, e il content
require_once "head.php";
?>

<body class="noscroll">
    <?php
    // richiamo il menu, e dinamicamente anche il titolo principale e l'immagine di sfondo 
    require_once "menu.php";
    require_once "add.php";
    ?>
    <!-- gestisco la section dove tengo la mia recensione, tutti i dati sono salvati su un file json  -->
    <section>
        <p class="spieg <?php echo $cookieColor; ?>">
            <?php echo $recensione->p; ?>
            <span class="pCookiesDue <?php echo $cookieSpecialNone; ?>"></span>
        </p>

        <?php
        $sql = "SELECT nome, url_immagine, testo, link, social FROM recensioni WHERE cancellato = 0";
        $result = $connessione->query($sql);

        // Visualizzazione dei dati
        if ($result->num_rows > 0) {
            while ($recensioneCiclo = $result->fetch_object()) {
        ?>
                <div class="conteinerdue">
                    <span class="spanBord <?php echo $cookieBorder; ?>"></span>
                    <h3 class="<?php echo $cookieColor; ?>"><?php echo htmlspecialchars($recensioneCiclo->nome); ?></h3>
                    <div class="imgWrapper">
                        <span class="imgCo <?php echo $cookieSpecial; ?>"></span>
                        <img src="<?php echo htmlspecialchars($recensioneCiclo->url_immagine ? $recensioneCiclo->url_immagine : 'assets/profilo.png'); ?>" alt="immagine persona">

                    </div>
                    <p class="<?php echo $cookieColorTwo; ?>">
                        <span class="pCookiesDue <?php echo $cookieSpecialNone; ?>"></span>
                        <?php echo htmlspecialchars($recensioneCiclo->testo); ?>
                    </p>
                    <?php if (!empty($recensioneCiclo->social)) { ?>
                        <ul>
                            <li>
                                <a href="<?php echo htmlspecialchars($recensioneCiclo->link); ?>" title="link social" target="_blank">
                                    <?php echo htmlspecialchars($recensioneCiclo->social); ?>
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
        <?php
            }
        }
        ?>
    </section>


    <!-- se $inviato è false verrà ancora mostrato il form  -->
    <?php if (!$inviato) {
        // per prima cosa controllo se fosse stata selezionata la checkbox e se fosse vero la riseleziono 
        $isChecked = isset($_POST['accettazione']) && $_POST['accettazione'] == 'on' ? 'checked' : '';
    ?>
        <!-- gestisco il form i dati per la costruzione dei campi sono presi da un file json, i messaggi di errore sono stati inseriti e nascosti vicini al campo interessato  -->


        <!-- creazione form -->
        <form action="recensioni.php#ancora" class="formTwo" method="post" enctype="multipart/form-data" novalidate>
            <fieldset class="fieltwo">
                <legend class="tittledue <?php
                                            echo $cookieColors;
                                            ?>"><?php echo $recensione->titolo->h2 ?>
                    <span class="pCookiesTre <?php
                                                echo $cookieSpecial;
                                                ?>"></span>
                </legend>
                <?php
                $form .= sprintf("<input class='%s  %s' type='%s'  id='%s'  name='%s' placeholder=%s value='%s' required minlength='2' maxlength='20' autocomplete='off'>", $clNomeImp, $cookieInput, $nomeF->type, $nomeF->id, $nomeF->name, $nomeF->placeholder, $nome);
                $form .= sprintf($out->nomeV, $classHiddenUno, $cookieSpecial);
                $form .= sprintf($out->nomeIn, $classHiddenDue, $cookieSpecial);
                $form .= sprintf("<textarea class='%s  %s' name='%s' id='%s' placeholder='%s' minlength='2' maxlength='600' required >%s</textarea>", $clTxtImp, $cookieInput, $inptxt->name, $inptxt->id, $inptxt->placeholder, $testo);
                $form .= sprintf($out->txtV, $classHiddenTre, $cookieSpecial);
                $form .= sprintf($out->txtIn, $classHiddenQuattro, $cookieSpecial);
                $form .= sprintf("<label class='%s %s' for='%s'>%s <span class='%s'>%s</span></label>", $clFlLab, $cookieColorTwo, $inpInp->for, $inpInp->text, $inpInp->spanClass, $inpInp->spanTxt);
                $form .= sprintf("<input class='%s %s' type='%s' id='%s' accept='image/jpeg, image/png' name='%s'>", $clFlImo, $cookieInput, $inpInp->type, $inpInp->id, $inpInp->name);
                $form .= sprintf($out->generale, $classHiddenCinque, $cookieSpecial);
                $form .= sprintf($out->estensioni, $classHiddenSei, $cookieSpecial);
                $form .= sprintf($out->grandezza, $classHiddenSette, $cookieSpecial);
                $form .= sprintf($out->presenza, $classHiddenOtto, $cookieSpecial, $fileName);
                $form .= sprintf($out->noPerfect, $classHiddenNove, $cookieSpecial);
                $form .= sprintf("<div class='recensioniDiv'>
                <div>
                    <label for='social' class='%s %s' id='labelS'>Social <span class='opzionale'>(opzionale)</span></label>
                    <select name='social' id='social' class='%s  %s ?>'>
                        <option class=' %s ?>' value='0'>Nessun...</option>
                        <option class=' %s ?>' value='Linkedin'>Linkedin</option>
                        <option class=' %s ?>' value='GitHub'>GitHub</option>
                        <option class=' %s ?>' value='Instagram'>Instagram</option>
                        <option class=' %s ?>' value='Facebook'>Facebook</option>
                        <option class=' %s ?>' value='YouTube'>YouTube</option>
                    </select>
                </div>
        
                <div>
                    <input type='text' name='socialImp' id='socialImp' placeholder='Url...' class='%s %s'>
                </div>
        
            </div>", $clScUno, $cookieColorTwo, $clScDue, $cookieInputIn, $cookieOption, $cookieOption, $cookieOption, $cookieOption, $cookieOption, $cookieOption, $clScTre, $cookieInputIn);
                $form .= sprintf($out->socialV, $classHiddenUndici, $cookieSpecial);
                $form .= sprintf($out->socialEr, $classHiddenDodici, $cookieSpecial);
                $form .= sprintf($out->socialErTwo, $classHiddenTredici, $cookieSpecial);
                $form .= sprintf("<label for='%s' class='customChecbox %s %s'>", $inpck->for, $clCkLab, $cookieColorTwo);
                $form .= sprintf("<input type='%s' class='hidenCheckbox' %s required id='%s' name='%s'>", $inpck->type, $isChecked, $inpck->id, $inpck->name);
                $form .= sprintf("<span class='%s %s'></span>%s</label>", $clCkImp, $cookieInput, $inpck->text);
                $form .= sprintf($out->checkF, $classHiddenTen, $cookieSpecial);
                $form .= sprintf('<input type="%s" name="%s" value="%s">', $hdn->type, $hdn->name, $hdn->value);
                $form .= sprintf('<button class="buttOne %s"  type="%s">%s %s</button>', $cookieInputIn, $inpbtn->type, $inpbtn->txt, $inpbtn->svg);
                echo $form;

                ?>
            </fieldset>
        </form>

        <!-- se $inviato è vero si entra in questo blocco di codice e il form sparisce per visualizzare il resoconto dei dati inviati  -->
    <?php } else {

        printf($out->successoTxt, $cookieSpecial); //messaggio di successo

        if (($erroreImg == 0) && ($_FILES['foto']['error'] != UPLOAD_ERR_NO_FILE)) {
            $uploadedFilePath = $uploadDir . '/' . $_FILES['foto']['name'];
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadedFilePath)) {
               
            } 
        }

    ?>
        <div class="conteinerdue">
            <span class="spanBord <?php echo $cookieBorder ?>"></span>
            <h3 class="<?php
                        echo $cookieColor;
                        ?>"><?php echo ($nome); ?></h3>
            <div class="imgWrapper">
                <span class="imgCo <?php echo $cookieSpecial ?>"></span>
                <!-- inserisco un immagine di default se non è stata inserita nessuna -->
                <img src="<?php echo (!empty($uploadedFilePath) ? $uploadedFilePath : 'assets/profilo.png'); ?>" alt="immagine persona"> 
            </div>

            <p class="<?php
                        echo $cookieColorTwo;
                        ?>"><span class="pCookiesDue <?php
                                                        echo $cookieSpecialNone;
                                                        ?>"></span><?php echo ($testo); ?></p>
                <ul>
                    <li>
                        <a class="<?php echo ($socialSel == '0' ? 'hidElement' : ''); ?>" href="<?php echo ($socialLink); ?>" title="Link social">
                            <?php echo ($socialSel); ?>
                        </a>
                    </li>

                </ul>
        </div>
        <!-- faccio comparire anche un bottone per un eventuale rinvio della recensione o di una foto  -->
        <button class="buttTre <?php
                                echo $cookieInputIn;
                                ?>" onclick="window.location.href='recensioni.php'"><?php echo $inpbtn->txtDue  ?></button>
    <?php
    $sql = "INSERT INTO nuovi_commenti (nome, social, link, url_immagine, testo) VALUES (?, ?, ?, ?, ?)";

    // Preparo sql per inviare dati al database
    $stmt = $connessione->prepare($sql);

    if ($stmt) {
        // lego i parametri
        $stmt->bind_param("sssss",$nome, $socialSel, $socialLink, $uploadedFilePath, $testo);
        
        $stmt->execute();
           
        

        // Chiudo prima connessione
        $stmt->close();
    } else {
        echo "Errore nella preparazione della query: " . $conn->error;
    }

    // Chiudo seconda connessione
    $connessione->close();
    }
    ?>

    <!-- creo un ancoraggio con uno span per reindirizzare l'utente nel posto giusto al ricaricamento della pagina, sia se il form è valido e sia se non lo è -->
    <span id="ancora"></span>
    <?php
    // richiamo il footer
    require_once "footer.php";
    ?>


</body>

</html>
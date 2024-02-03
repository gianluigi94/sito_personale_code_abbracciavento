<?php
require_once "funzioni.php";

use sito_personale\functions\Utility as UT;

$inviato = UT::richiestaHTTP('inviato');
$nome = UT::richiestaHTTP('nome');
$cognome = UT::richiestaHTTP('cognome');
$email = UT::richiestaHTTP('email');
$tel = UT::richiestaHTTP('tel');
$argomento = UT::richiestaHTTP('argomento');
$testo = UT::richiestaHTTP('messaggio');
$check = UT::richiestaHTTP("accettazione");

$copiaEmail = "data/email_copia.txt";
$fileContatti = "data/contatti.json";
$dataOra = date("d-m-Y H:i");

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

$form = "";
$stringaEmail = "";
$fileNameEm = "";

$inviato = ($inviato == null || $inviato != 1) ? false : true;

if ($inviato) {
    $valido = 0;

    UT::formControlDue($nome, 2, 20, $classeNomeImp, "inpTwoEr", $classeHiddenUno, $classeHiddenDue, $classeNomeLab, "labelTwoEr",  $valido);
    UT::formControlDue($cognome, 2, 20, $classeCognomeImp, "inpTwoEr", $classeHiddenTre, $classeHiddenQuattro, $classeCognomeLab, "labelTwoEr",  $valido);
    UT::formControlEmail($email, 10, 55, $classeEmailImp, $classeHiddenCinque,  $classeHiddenSette, $classeHiddenSei, $classeEmailLab, $valido);
    UT::formControlDue($testo, 2, 600, $classeTestoImp, "txtDueEr", $classeHiddenUndic, $classeHiddenDodici, $classeTestoLab, "labelTwoEr",  $valido);
    UT::checkControl($valido, $classeCheckLab, "labelTwoEr", $clsasseCheck, "checkmarkTwoEr", $classeHiddenTredici);


    if (!preg_match('/^[+]?[0-9\s\-\(\)]+$/', $tel) && !empty($tel)) {
        $classeHiddenQuattordici = "formErr";
    } elseif ((!UT::controllaRangeStringa($tel, 8, 14)) && !empty($tel)) {
        $classeHiddenNove = "formErr";
    }
    if ((!preg_match('/^[+]?[0-9\s\-\(\)]+$/', $tel) && !empty($tel)) || (!UT::controllaRangeStringa($tel, 8, 14)) && !empty($tel)) {
        $tel = "";
        $valido++;
        $classeTelefonoLab = "labelTwoEr";
        $classeTelefonoImp = "inpTwoEr";
    }

    if (empty($argomento)) {
        $argomento = "";
        $valido++;
        $classeHiddenTen = "formErr";
        $classeArgomentoLab = "labelTwoEr";
        $classeArgomentoImp = "selectEr";
    }

    $inviato = ($valido == 0) ? true : false;
}



require_once "head.php";
?>

<body>
    <?php
    require_once "menu.php";
    require_once "add.php";

    ?>
      <?php if (!$inviato) {
                    $isChecked = isset($_POST['accettazione']) && $_POST['accettazione'] == 'on' ? 'checked' : '';
                ?>
    <section class="twopage">

        <form action="contatti.php" method="post" novalidate>
            <fieldset class="fieltwo">
              
                    <legend><?php echo $contatti->form->legend ?></legend>
                    <?php
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span></label>', $classeNomeLab, $nomeJs->for, $nomeJs->txt, $nomeJs->spanclass, $nomeJs->spanText);
                    $form .= sprintf('<input class="%s" type="%s" id="%s" name="%s" value="%s" required autocomplete="off">', $classeNomeImp, $nomeJs->type, $nomeJs->id, $nomeJs->name, $nome);
                    $form .= sprintf($out->nomeV, $classeHiddenUno);
                    $form .= sprintf($out->nomeIn, $classeHiddenDue);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span> </label>', $classeCognomeLab, $cognomeJs->for, $cognomeJs->txt, $cognomeJs->spanclass, $cognomeJs->spanText);
                    $form .= sprintf('<input class="%s" type="%s" id="%s" name="%s" value="%s"; required autocomplete="off">', $classeCognomeImp, $cognomeJs->type, $cognomeJs->id, $cognomeJs->name, $cognome);
                    $form .= sprintf($out->cognomeV, $classeHiddenTre);
                    $form .= sprintf($out->cognomeIn, $classeHiddenQuattro);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span> </label>', $classeEmailLab, $emailJs->for, $emailJs->txt, $emailJs->spanclass, $emailJs->spanText);
                    $form .= sprintf('<input class="%s" type="%s" id="%s" name="%s" value="%s" required autocomplete="off">', $classeEmailImp, $emailJs->type, $emailJs->id, $emailJs->name, $email);
                    $form .= sprintf($out->emailV, $classeHiddenCinque);
                    $form .= sprintf($out->emailIn, $classeHiddenSei);
                    $form .= sprintf($out->emailErr, $classeHiddenSette);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span></label>', $classeTelefonoLab, $telJs->for, $telJs->txt, $telJs->spanclass, $telJs->spanText);
                    $form .= sprintf('<input class="%s" type="%s" id="%s" name="%s" value="%s" autocomplete="off">', $classeTelefonoImp, $telJs->type, $telJs->id, $telJs->name, $tel);
                    $form .= sprintf($out->telV, $classeHiddenOtto);
                    $form .= sprintf($out->telIn, $classeHiddenNove);
                    $form .= sprintf($out->telCaratteri, $classeHiddenQuattordici);
                    $form .= sprintf('<label class="%s" for="%s">%s<span class="%s">%s</span></label>', $classeArgomentoLab, $argomentoJs->for, $argomentoJs->txt, $argomentoJs->spanclass, $argomentoJs->spanText);
                    $form .= sprintf('<select class="%s" name="%s" id="%s">', $classeArgomentoImp, $argomentoJs->name, $argomentoJs->id);
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
                    $form .= sprintf('<textarea class="%s" name="%s" id="%s" %s required autocomplete="off">%s</textarea>', $classeTestoImp, $txtJs->name, $txtJs->id, $txtJs->dimension, $testo);
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

        <?php
        printf('<iframe class="sectiontwo" src="%s" title="%s" %s"></iframe>', $if->url, $if->title, $if->attributi);
        ?>

    </section>
    <?php } else {
                    $argomento = ($argomento == 1) ? "Informazioni" : "Assistenza";
                    $tel = ($tel == "") ? "-ASSENTE-" : $tel;
                    $stringaEmail = "<strong>Nome:</strong>" . "<br>" . $nome . "<br>" . "<strong>Cognome:</strong>" . "<br>" . $cognome . "<br>" . "<strong>Email:</strong>" . "<br>" . $email . "<br>" . "<strong>Telefono:</strong>" . "<br>" . $tel . "<br>" . "<strong>Argomento/Oggetto:</strong>" . "<br>" . $argomento . "<br>" . "<strong>Testo:</strong>" . "<br>" . $testo . "<br>" . "<strong>$dataOra</strong>" . "<br>" . "<br>";

                    printf($out->successoTxt, $stringaEmail);
                    $stringaEmail = str_replace( ["<br>", "<strong>", "</strong>"], [chr(10), "", ""], $stringaEmail );
                    UT::scriviTesto($copiaEmail, $stringaEmail);
                    ?>
                    <button class="buttTre" onclick="window.location.href='contatti.php'"><?php echo $button->txtDue?></button>
                <?php
                } ?>

    <?php
    require_once "footer.php";
    ?>

    <script src="script/script.js"></script>


</body>

</html>
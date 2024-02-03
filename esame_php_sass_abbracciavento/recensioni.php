<?php
require_once "funzioni.php";

use sito_personale\functions\Utility as UT;

$nome = UT::richiestaHTTP("nome");
$testo = UT::richiestaHTTP("commento");
$check = UT::richiestaHTTP("accettazione");
$inviato = UT::richiestaHTTP('inviato');

$fileDaScrivere = "data/recensioni.txt";
$fileRec = "data/recensioni.json";
$dataOra = date("d-m-Y H:i");


$recensione = json_decode(UT::leggiTesto($fileRec));
$recUno = $recensione->recensione;
$inptxt = $recensione->form->textarea;
$inpInp = $recensione->form->input;
$inpck = $recensione->form->check;
$inpbtn = $recensione->form->button;
$nomeF = $recensione->form->nome;
$hdn = $recensione->form->hidden;
$out = $recensione->output;


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

$clNomeImp = "inpOne";
$clTxtImp = "txtOne";
$clCkImp = "checkmark";
$clCkLab = "labRec";
$clFlImo = "inpOne";
$clFlLab = "labRec";

$stringaRec = "";
$fileName = "";
$form = "";

$inviato = ($inviato == null || $inviato != 1) ? false : true;

if ($inviato) {
    $valido = 0;
    $erroreImg = 0;

    UT::formControl($nome, 2, 20, $clNomeImp, "inpOneEr", $classHiddenUno, $classHiddenDue,  $valido);

    UT::formControl($testo, 2, 600, $clTxtImp, "txtOneEr", $classHiddenTre, $classHiddenQuattro,  $valido);

    UT::checkControl($valido, $clCkLab, "labRecEr", $clCkImp, "checkmarkEr", $classHiddenTen);

    if (isset($_FILES) && count($_FILES) > 0) {
        $estensioniPermesse = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
        $dimensione_massima = 4 * 1024 * 1024;
        $uploadDir = __DIR__ . '/upload';


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
            if ((($erroreImg != 0) || ($erroreImg == 0)) && (($valido != 0) && ($_FILES['foto']['error'] != UPLOAD_ERR_NO_FILE))) {
                $clFlImo = "inpOneEr";
                $clFlLab = "labRecEr";
                $classHiddenNove = "formEr";
            }
        }
    }
    $inviato = ($valido == 0 && $erroreImg == 0) ? true : false;
}
require_once "head.php";
?>

<body>
    <?php
    require_once "menu.php";
    require_once "add.php";
    ?>
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
    <?php if (!$inviato) {
        $isChecked = isset($_POST['accettazione']) && $_POST['accettazione'] == 'on' ? 'checked' : '';
    ?>
        <form action="recensioni.php#ancora" class="formTwo" method="post" enctype="multipart/form-data" novalidate id="formLocation">
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

    <?php } else {
        $stringaRec = "Nome utente:" . chr(10) . $nome . chr(10) . "Recensione:" . chr(10) . $testo . chr(10) . $dataOra . chr(10) . chr(10);
        UT::scriviTesto($fileDaScrivere, $stringaRec);
        printf($out->successoTxt, $nome, $testo, $dataOra);
        if (($erroreImg == 0) && ($_FILES['foto']['error'] != UPLOAD_ERR_NO_FILE)) {
            move_uploaded_file($_FILES['foto']['tmp_name'], $uploadDir . DIRECTORY_SEPARATOR . $_FILES['foto']['name']);
            printf($out->successoImg, $_FILES['foto']['name']);
        }
        if ((($_FILES['foto']['error'] == UPLOAD_ERR_NO_FILE)) && (UT::scriviTesto($fileDaScrivere, $stringaRec))) {
            printf($out->successoNoImg);
        }
    ?>
        <button class="buttTwo" onclick="window.location.href='recensioni.php'">Invia un nuovo commento</button>
    <?php

    }
    ?>
    <span id="ancora"></span>

    <?php
    require_once "footer.php";
    ?>
    <script src="script/script.js"></script>
</body>

</html>
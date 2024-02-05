<?php
// in questa pagina gestisco la diversa immagine di sfondo in maniera dinamica prendendo il nome dell'immagine da un file json, che deve corrispondere al nome della pagina. Poi definisco con la funzione titleHttp il titolo del progetto.
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;
$titleProgect = UT::titleHTTP();
$filedue = "data/sfondo.json";
$sfondi = json_decode(UT::leggiTesto($filedue));
$currentPage = basename($_SERVER['PHP_SELF']);

if (isset($sfondi->$currentPage)) {
    $class = $sfondi->$currentPage;
    echo "<span class='$class'></span>";
}
?>

<h1 class="titoloPr"><?php echo $titleProgect ?></h1>

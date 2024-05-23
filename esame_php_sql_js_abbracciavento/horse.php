<?php
// In questa pagina gestisco il pulsante per il cambio di tema 
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$fileLabel = "data/sfondo.json";
$iconHorse = json_decode(UT::leggiTesto($fileLabel));
$icBlack = $iconHorse-> sfondoCavalloNero;
$icWhite = $iconHorse-> sfondoCavalloBianco;
?>

<label for="cHorse" class="horse" title="Cambio tema">
    <input type="checkbox" id="cHorse" class="dLHorse">
    <?php
        printf('<img src="%s" alt="%s" class="%s" draggable="false">',$icBlack->src, $icBlack->alt, $icBlack->class);
        printf('<img src="%s" alt="%s" class="%s" draggable="false">',$icWhite->src, $icWhite->alt, $icWhite->class);
    ?>  
    <span class="toggle notransition"></span>
</label>
<span class="animateBg 
<?php
// specifico la grandezza iniziale a seconda del cookies
if (!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'dark') {
    echo 'min';
} elseif (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') {
    echo 'max';
}
?>">
</span>


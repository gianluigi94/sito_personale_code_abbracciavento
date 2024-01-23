<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$fileUno = "data/footer_indirizzi.json";
$filedue = "data/sfondo.json";
$objlogo = json_decode(UT::leggiTesto($fileUno));
$sfondi = json_decode(UT::leggiTesto($filedue));
$currentPage = basename($_SERVER['PHP_SELF']);

if (isset($sfondi->$currentPage)) {
    $class = $sfondi->$currentPage;
    echo "<span class='$class'></span>";
}

?>


<span class="bordoMenu"></span>
<?php
    $imgLo = $objlogo->logo;
    printf('<a href="%s" title="%s"><img class="nascosto mainImage" loading="eager" src="%s" alt="%s" draggable="false" ></a>', $imgLo->urlsecond,$imgLo->titledue, $imgLo->icona, $imgLo->alt);
?>
  
<?php
// in questa pagina definisco la head, il doctype e dinamicamente imposto la lingua, il title e la description con delle funzioni 
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;
$pageTitle = UT:: titleHTTP();
$lingua = UT::lingua();

$fileContent = "data/content.json";
$content = json_decode(UT::leggiTesto($fileContent));
// definisco sia la pagina corrente con o senza eventuali query
$currentPage = basename($_SERVER['PHP_SELF']);
$currentPageQuery = basename($_SERVER['PHP_SELF']) . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
$contenuto = "";
if (isset($content->$currentPageQuery)) {
    $contenuto = $content->$currentPageQuery;
} elseif (isset($content->$currentPage)){
    $contenuto = $content->$currentPage;
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lingua?>">

<?php
$html = '';

$html .= '<head>';
$html .= '<meta charset="UTF-8">';
$html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
$html .= "<meta name='description' content='$contenuto'>";
$html .= '<title>' . $pageTitle . '</title>';
$html .= '<link rel="icon" type="image/png" href="assets/favicon.png">';
// riferimento all'icona per il menu a tendina scaricata 
$html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"                               integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">';
$html .= '<link rel="stylesheet" href="css/style.min.css">';
$html .= '</head>';

echo $html;
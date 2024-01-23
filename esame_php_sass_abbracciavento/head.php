<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;
$pageTitle = UT:: titleHTTP();
$lingua = UT::lingua();
?>
<!DOCTYPE html>
<html lang="<?php echo $lingua?>">
<?php
$html = '';

$html .= '<head>';
$html .= '<meta charset="UTF-8">';
$html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
$html .= '<meta name="description" content="Pagina contatti">';
$html .= '<title>' . $pageTitle . '</title>';
$html .= '<link rel="icon" type="image/png" href="assets/favicon.png">';
$html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"                               integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">';
$html .= '<link rel="stylesheet" href="css/style.min.css">';
$html .= '</head>';

echo $html;
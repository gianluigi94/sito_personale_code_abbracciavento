<?php
// in questa pagina definisco la head, il doctype e dinamicamente imposto la lingua, il title e la description con delle funzioni.
// a seconda di che pagina ci si trova imposto il file js specifico
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$pageTitle = UT::titleHTTP();
$lingua = UT::lingua();

$fileContent = "data/content.json";
$content = json_decode(UT::leggiTesto($fileContent));
// definisco sia la pagina corrente con o senza eventuali query
$currentPage = basename($_SERVER['PHP_SELF']);
$currentPageQuery = basename($_SERVER['PHP_SELF']) . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
$contenuto = "";
if (isset($content->$currentPageQuery)) {
    $contenuto = $content->$currentPageQuery;
} elseif (isset($content->$currentPage)) {
    $contenuto = $content->$currentPage;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lingua ?>">

<?php
$html = '';

$html .= '<head>';
$html .= '<meta charset="UTF-8">';
$html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
$html .= "<meta name='description' content='$contenuto'>";
$html .= '<title>' . $pageTitle . '</title>';
$html .= '<link rel="icon" type="image/png" href="assets/favicon.png">';
$html .= '<link rel="stylesheet" href="css/style.min.css">';


if ($currentPage !== 'login.php' && $currentPage !== 'admin.php') { // escludo i file js principali dal backend
    // script iubenda
    $html .= '<script type="text/javascript">
    var _iub = _iub || [];
    _iub.csConfiguration = {"askConsentAtCookiePolicyUpdate":true,"enableFadp":true,"enableLgpd":true,"enableUspr":true,"fadpApplies":true,"floatingPreferencesButtonDisplay":"bottom-right","perPurposeConsent":true,"preferenceCookie":{"expireAfter":180},"siteId":3642159,"usprApplies":true,"whitelabel":false,"cookiePolicyId":42055894,"lang":"it", "banner":{ "acceptButtonDisplay":true,"closeButtonDisplay":false,"customizeButtonDisplay":true,"explicitWithdrawal":true,"listPurposes":true,"ownerName":"www.abbracciaventoportfolio.com","position":"float-bottom-left","rejectButtonDisplay":true,"showPurposesToggles":true,"showTitle":false,"showTotalNumberOfProviders":true }};
    </script>
    <script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3642159.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/gpp/stub.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
    ';
    $html .= '<script defer src="script/script.js"></script>';
    $html .= '<script defer src="script/cookies_theme.js"></script>';
}

// richiamo il giusto js per le pagine che ne richiedono uno specifico
if ($currentPage == 'index.php') {
    $html .= '<script defer src="script/canvas.js"></script>';
} elseif ($currentPage == 'admin.php') {
    $html .= '<script defer src="script/db.js"></script>';
} elseif ($currentPage == 'recensioni.php') {
    $html .= '<script defer src="script/recensioni.js"></script>';
} elseif ($currentPage == 'contatti.php') {
    $html .= '<script defer src="script/contatti.js"></script>';
}

$html .= '</head>';



echo $html;

?>


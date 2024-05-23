<!-- In questa pagina gestisco l'animazione del logo che compare durante i caricamenti -->
<?php require_once 'cookies.php'; ?>

<div id="loadingPage" class="<?php echo $cookieBk?>">
    <div class="logo mainImage">
        <img class="logoLoad" src="assets/logobianco.png" alt="logo regina" draggable="false">
        <div class="loading">
            <!-- righe di animazione sotto al logo -->
            <span class="objDe <?php echo $cookieLine?>"></span>
            <span class="objDe <?php echo $cookieLine?>"></span>
            <span class="objDe <?php echo $cookieLine?>"></span>
            <span class="objDe <?php echo $cookieLine?>"></span>
            <span class="objDe <?php echo $cookieLine?>"></span>
            <span class="objDe <?php echo $cookieLine?>"></span>
            <span class="objDe <?php echo $cookieLine?>"></span>
            <span class="objDe <?php echo $cookieLine?>"></span>
        </div>
    </div>
</div>

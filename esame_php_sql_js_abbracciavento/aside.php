<!-- In questa pagina definisco l'aside per la navigazione più facile tra i vari progetti, prendendo le info dal database-->


<?php

       require_once 'cookies.php';
?>
<aside class="tre">

    <h3><?php echo $aside->pagina->h3; ?></h3>
    <ul>
        <?php
        require 'db/config.php';
        
       $sql = "SELECT titolo, descrizione FROM progetti WHERE cancellato = 0";  // preparo sql
       $result = $connessione->query($sql);
       
       // calcolo e ottengo il nome della query corrispondente al progetto
$currentPageQuery = strtolower(str_replace(' ', '_', $_GET['progetto'] ?? ''));

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $normalizedTitle = strtolower(str_replace(' ', '_', $row['titolo']));

        // Salto la voce corrente se corrisponde alla pagina attuale
        if ($normalizedTitle == $currentPageQuery) {
            continue;
        }

        // Stampo il link con il titolo modificato come parte dell'URL e la descrizione come titolo del link
        printf('<li><a class="%s" href="progetti.php?progetto=%s" title="%s">%s</a></li>',
            $cookieColorGreen, $normalizedTitle, $row['descrizione'], $row['titolo']);
    }
} 

        ?>
    </ul>

</aside>
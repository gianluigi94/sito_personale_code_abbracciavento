<?php

// in questa file gestisco la pagina dove vengono visualizzati tutti i progetti, i dati sono inseriti in file json
require_once 'funzioni.php';
require_once 'db/config.php';

use sito_personale\functions\Utility as UT;

// Query al database per ottenere tutti i titoli, escludendo varianti di 'portfolio_grafico'
$sql = "SELECT titolo FROM progetti WHERE LOWER(REPLACE(titolo, ' ', '_')) != 'portfolio_grafico'";
$result = $connessione->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Trasforma il titolo in minuscolo e sostituisce gli spazi con underscore
        $titoloModificato = str_replace(' ', '_', strtolower($row['titolo']));
        $arrLorem[] = $titoloModificato; // Aggiungi il titolo modificato all'array
    }
} else {
    echo "Nessun titolo trovato nel database.";
}




$currentPageQuery = basename($_SERVER['PHP_SELF']) . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
$fileaside = "data/aside.json";
$aside = json_decode(UT::leggiTesto($fileaside));

// richiamo la head impostando dinamicamente lingua, il title, e la description
require_once "head.php";
require_once 'cookies.php';

?>

<body class="noscroll">

    <?php
    // richiamo il menu, e dinamicamente anche il titolo principale e l'immagine di sfondo 
    require_once "menu.php";
    require_once "add.php";

    // se la richiesta get è uguale a tutti i progetti, entro in questo blocco di codice e visualizzerò la pagina di anteprima di tutti i progetti 
    if ($_GET['progetto'] == "tutti_i_progetti") {
    ?>
        <div class="ttprogect">

        <?php
            $sql = "SELECT * FROM progetti WHERE cancellato = 0"; //imposto il codice sql
            $result = $connessione->query($sql); //mi connetto al database

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { // con un ciclo stampo i dati e creo i vari progetti
                    $specialClass = "";
                    if ($row['titolo'] == "Portfolio Grafico") {
                        $specialClass = "portfolio"; //assegno una classe speciale al portfolio grafico
                    }
                    $indirizzoProgetto = "progetti.php?progetto=" . str_replace(' ', '_', strtolower($row['titolo'])); //creo il titolo partendo dall'indirizzo specifico

                    
                    printf('<div><a href="%s" title="%s"><div><h3 class="%s %s">%s</h3><img src="%s" alt="%s" draggable="false"></div><p class="scomparsa %s">%s</p><span class="proBack %s"></span></a></div>',
                        $indirizzoProgetto, 
                        $row['titolo'], 
                        $specialClass, 
                        $cookieColor, 
                        $row['titolo'], 
                        $row['url_immagine'], 
                        $row['sottotitolo_immagine'],
                        $cookieColor,
                        $row['descrizione'], 
                        $cookieSpecialNone);
                }
            }
        
          
            $connessione->close();// chiudo connessione
        ?>

        </div>

    <?php
    }
    ?>

<!--  se la richiesta get è uguale ad uno dei progetti segnaposto, entro in questo blocco di codice e visualizzerò il progetto specifico a seconda del parametro passato dalla query  -->
    <?php
    if (in_array($_GET['progetto'], $arrLorem)) {
    ?>
        <div class="container">
        <div class="uno">
            <?php
            
            $progettoUrl = $_GET['progetto'];// estraggo il progetto dall'url

            // Query al database per trovare il titolo corrispondente e altre informazioni è passare i dati nella pagina specifica
            $sql = "SELECT titolo, testo, ripetizioni_testo FROM progetti WHERE REPLACE(LOWER(titolo), ' ', '_') = ?";
            $stmt = $connessione->prepare($sql); // preparo sql
            $stmt->bind_param("s", $progettoUrl);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                for ($i = 0; $i < $row['ripetizioni_testo']; $i++) { // stampo i paragrafi per il numero specificato nel database
                    ?>
                    <p class="text <?php echo $cookieColor; ?>">
                        <span class="pCookies <?php echo $cookieSpecial; ?>"></span>
                        <?php echo $row['testo']; ?>
                    </p>
                    <?php
                }
            }
            ?>
        </div>
    
        <figure class="due">
        <?php
// Preparazione della query per ottenere le informazioni relative alle immagini
$sqlImg = "SELECT url_immagine, sottotitolo_immagine FROM progetti WHERE REPLACE(LOWER(titolo), ' ', '_') = ?";
$stmtImg = $connessione->prepare($sqlImg);
$stmtImg->bind_param("s", $progettoUrl); 
$stmtImg->execute();
$resultImg = $stmtImg->get_result(); // ottengo i risultati e li ciclo

if ($resultImg->num_rows > 0) {
    $imgRow = $resultImg->fetch_assoc();
    // Visualizzazione dell'immagine
    ?>
    <figure class="due">
        <img src="<?php echo $imgRow['url_immagine']; ?>" alt="<?php echo $imgRow['sottotitolo_immagine']; ?>" title="<?php echo $imgRow['sottotitolo_immagine']; ?>" draggable="false">
    </figure>
    <?php
} 
$stmtImg->close(); // chiudo connessione
?>  
</figure>

        </div>


        <?php
        // richiamo  l'aside 
        require_once "aside.php";
        ?>
    <?php
    }
    ?>
<!--  se la richiesta get è uguale a portfolio grafico, entro in questo blocco di codice e visualizzerò il progetto più complesso dei 5  -->
    <?php
    if ($_GET['progetto'] == "portfolio_grafico") {
    ?>
    <!-- creazione del popup per la navigazione delle immagini -->
    <div class="popup">
        <span class="popupS <?php echo $cookieBacGallery ?>"></span>
        <div class="topBarPop">
            <span class="closeBtn">╳</span>
            <p class="immageNamePop"> Titolo</p>
            <button class="arrowLeft popupButton">←</button>
            <button class="arrowRight popupButton">→</button>
            <img src="assets/portfolio/spacetime.webp" class="largeImg" alt="">
            <!-- testo di placeholder, verrà modificato con js -->
            <p class="descritionPop <?php echo $cookieColor?>">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda eveniet numquam perspiciatis exercitationem libero facere, error veniam at. Obcaecati iste ratione voluptatum sit optio ipsum suscipit consequuntur commodi ex architecto!</p>
        </div>
    </div>
    <section class="pgraf">

<?php
// ciclo in una volta sola tutte le card con tutte le varie proprietà che si trovano salvate sul database, tuttavia ci sono delle card particolari dove ho inserito più di una classe. Per assegnare eventualmente più classi dinamicamente, ho lasciato volutamente uno spazio nel nome della classe, se non dovesse servire, lo eliminerò in seguito con trim 
    
    
    $sql = "SELECT * FROM portfolio_grafico WHERE cancellato = 0"; //preparo sql
    $result = $connessione->query($sql);
    
    $titoli = [];
    $descrizioni = [];
    
    //ciclo i dati presi dal database creando anche un array che raccoglie i titoli e le descrizioni, importanti per il popup   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $titoli[] = $row['titolo'];
            $descrizioni[] = $row['descrizione'];
    
            $classPro = "imgcard ";
            if ($row['titolo'] == "Carosello Vivace") {
                $classPro .= "carosello";
            }
            if ($row['titolo'] == "Toto Maker") {
                $classPro .= "toto";
            }
    
            printf('<div class="imgCon"><div class="card" title="%s"><span class="porBack %s"></span><h3 class="titoletto">%s</h3><p class="descrizioneimg">%s</p><img src="%s" alt="%s" class="%s" draggable="false"></div></div>',
                $row['sottotitolo'], 
                $cookieSpecialNone, 
                $row['titolo'], 
                $row['descrizione'], 
                $row['url'], 
                $row['alt'], 
                trim($classPro));
        }
    } 
    
    $connessione->close(); // chiudo connessione
    
    // Conversione degli array in JSON e stampa
    $jsonData = json_encode(['titoli' => $titoli, 'descrizioni' => $descrizioni]);
    echo "<script>";
    echo "let titoliFromPHP = " . json_encode($titoli) . ";";
    echo "let descrizioniFromPHP = " . json_encode($descrizioni) . ";";
    echo "</script>";
    
?>
    
</section>



<?php
// richiamo l'aside  
require_once "aside.php";
?>
    <?php
    }
    ?>
    <?php
    // richiamo il footer   
    require_once "footer.php";
    ?>

   

  
</body>

</html>
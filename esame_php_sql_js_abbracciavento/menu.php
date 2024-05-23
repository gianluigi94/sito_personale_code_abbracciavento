<?php
require_once 'funzioni.php';
require 'db/config.php';

// in questa pagina gestisco sia il menu normale che il menu hamburger 
use sito_personale\functions\Utility as UT;

$filemenu = "data/menu.json";
$objmenu = json_decode(UT::leggiTesto($filemenu));
$pagina = basename($_SERVER['PHP_SELF']);
$paginaQuery = basename($_SERVER['PHP_SELF']) . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');

$imgL = $objmenu->secondmenu;


require_once 'cookies.php';
require_once "loading.php";

?>
<!-- il menu grande è diviso in tre div per aiutarmi a centrare il logo, nel primo div ci sono le prime due voci del menu, nel secondo div c'è l'immagine logo e nel terzo le ultime due voci del menu. Pertanto dovrò usare due cicli per stampare a schermo i dati del menu grande, i dati del menu sono in un json -->
<nav id="top">
    <div class="navbig">
    <span class="navbigTwo <?php
        echo($cookieBackground . " " . $cookieShadow);
    ?>"></span>
        <div class="firstmenu">
            <ul class="firstlist">
                <?php
// ciclo le prime due voci del menu, creando al suo interno un secondo ciclo per le voci del sottomenu dei progetti
                foreach ($objmenu->firstmenu as $link) {
                    $class = "";
                    $icon = "";
                    $subMenu = "";
                    if ($link->sub != []) {
                        // una voce del menu potrebbe avere più di una classe: la classe che rappresenta il 'li' che contiene il sottomenu, oppure potrebbe avere anche la classe speciale che sottolinea la voce del menu corrispondente alla pagina che si sta visitando. Per concatenare adeguatamente le classi lascio volutamente uno spazio vuoto, spazio che se inutile, lo toglierò in seguito con trim 
                        $class .= "special ";
                        $subMenu = sprintf('<ul class="subMenu %s">',$cookieSubUno);
                       
                        $classOnemenu = ($paginaQuery == "progetti.php?progetto=tutti_i_progetti") ? "underlined " : "";
                        $subMenu .= sprintf('<li class="%s %s"><a class="aStyle  %s" href="progetti.php?progetto=tutti_i_progetti" title="pagina contenente tutti i progetti">Tutti i progetti</a></li>', $classOnemenu, $cookieSubHover, $cookieColorHo );
                        
                        
                             $classub = "";
                            // preparo l sql per stampare le voci del menu con un ciclo
                            $sql = "SELECT titolo, descrizione FROM progetti WHERE cancellato = 0";  
                            $result = $connessione->query($sql);
                            $row_count = $result->num_rows;

                            if ($result->num_rows > 0) {
                                $current_row = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $current_row++;
                                    $formattedTitle = strtolower(str_replace(' ', '_', $row['titolo']));
                                    $url = "progetti.php?progetto=" . $formattedTitle;
                                    $classub = '';
                                    if ($url == $pagina || $url == $paginaQuery) {
                                        $classub .= "underlined ";
                                    }
                                    if ($current_row === $row_count) {
                                        $classub .= "lastChild ";
                                    }

                                    $subMenu .= sprintf(
                                        '<li class="%s %s"><a class="aStyle %s" href="%s" title="%s">%s</a></li>',
                                        trim($classub), $cookieSubHover, $cookieColorHo, $url, $row['descrizione'], $row['titolo']
                                    );
                                }
                            } 
                        $subMenu .= "</ul>";
                    }
                    if ($link->url == $pagina) {
                        $class .= "underlined";
                    }
                    printf('<li class="%s"><a class="%s aStyle" href="%s" title="%s">%s</a>%s</li>', trim($class), $cookieColorHo, $link->url, $link->title, $link->nome, $subMenu);
                }
                ?>
            </ul>
        </div>
        <div class="secondmenu">
            <?php
            // stampo a schermo il logo 
            printf('<a href="%s" id="logo" title="%s"><img class="mainImage" loading="eager" src="%s" alt="%s" draggable="false"></a>', $imgL->url, $imgL->title, $imgL->icona, $imgL->alt);
            ?>
        </div>
        <!-- ciclo le ultime due voci del menu  -->
        <div class="thirdmenu">
            <ul class="secondlist">
                <?php
                foreach ($objmenu->thirdmenu as $link) {
                    $class = "";
                    if ($link->url == $pagina) {
                        $class .= "underlined ";
                    }
                    printf('<li class="%s"><a class="%s aStyle" href="%s" title="%s">%s</a></li>', trim($class), $cookieColorHo, $link->url, $link->title, $link->nome);
                }
                ?>
            </ul>
        </div>
    </div>



    <!-- MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURG -->



    <!-- creo uno span che fungerà da sfondo del menu al rimpicciolirsi dello schermo con un altro logo, ma più piccolo -->
    <span class="bordoMenu <?php
        echo(
        $cookieBackground . " " . $cookieShadow)
    ?>"></span>
        <?php
        printf('<a href="%s" title="%s"><img class="nascosto mainImage" loading="eager" src="%s" alt="%s" draggable="false" ></a>', $imgL->url, $imgL->title, $imgL->icona, $imgL->alt);
        ?>
    <div class="containersup">
        <div class="navbar">
        <span class="navbarDue <?php
            echo $cookieSubUno;
        ?>"></span>
            <div class="hamburgermenu">
                <?php
                // ciclo di nuovo le informazioni contenuti nei json per la creazione delle voci del menu hamburger, ma visto che ora posso creare il menu con un solo ciclo, prima unisco i dati in un solo array e uso lo stesso sistema di prima per le assegnazioni di più classi
                $menuUnito = array_merge($objmenu->firstmenu, $objmenu->thirdmenu);

                // creo anche un piccolo ciclo per creare gli span che daranno vita alle 3 linee verdi che formano l'icona del menu hamburger 
                $classiL = ["lineeone", "linetwo", "linetree"];
                foreach ($classiL as $clsL) {
                    echo '<span class="linee ' . $clsL . '"></span>';
                }
                ?>
            </div>
            <ul class="navList">
                <?php
                foreach ($menuUnito as $linktwo) {
                    $class = "navItem lOne ";
                    $subMenu = "";
                    if ($linktwo->sub != []) {
                        $class .= "navprogect ";
                        echo '<li class="' . $class . " " . $cookieColor . '">' . $linktwo->nome;

                        $subMenu = '<ul class="sottomini">';
                        //prima voce del sotto menu cliccabile
                        $classOnemenu = ($paginaQuery == "progetti.php?progetto=tutti_i_progetti") ? "underlined " : "";
                        $subMenu .= sprintf('<li class="%s"><a class="%s" href="progetti.php?progetto=tutti_i_progetti" title="pagina contenente tutti i progetti">Tutti i progetti</a></li>', $classOnemenu, $cookieColorTwo );
                            $classub = "";
                            
                            $sql = "SELECT titolo, descrizione FROM progetti WHERE cancellato = 0"; //preparo sql e stampo  le voci del sottomenu
                            $result = $connessione->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $current_row++;
                                    $formattedTitle = strtolower(str_replace(' ', '_', $row['titolo']));
                                    $url = "progetti.php?progetto=" . $formattedTitle;  // Creo l'URL per il link per accedere alle vaie voci e pagine
                                    $classub = ''; //aggiungo eventuali classi particolari
                                    if ($url == $pagina || $url == $paginaQuery) {
                                        $classub .= "underlined ";
                                    }
                                    if ($current_row === $row_count) {
                                        $classub .= "lastChild ";
                                    }
                                    $title = $row['descrizione'];  // prendo descrizione e titolo dal database
                                    $name = $row['titolo'];  

                                    // Creo il link definitivo
                                    $subMenu .= sprintf('<li class="%s"><a class="%s" href="%s" title="%s">%s</a></li>',
                                        trim($classub), $cookieColorTwo, $url, $title, $name);
                                }
                            } else {
                                echo "Nessun progetto trovato.";
                            }
                            
                        
                        $subMenu .= "</ul>";
                        echo $subMenu . '</li>';
                    } else {
                        if ($linktwo->url == $pagina) {
                            $class .= "underlined ";
                        }
                        printf('<li class="%s"><a class="lOne %s" href="%s" title="%s">%s</a></li>', $class, $cookieColor, $linktwo->url, $linktwo->title, $linktwo->nome);
                    }
                }

                ?>
            </ul>

        </div>
    </div>
</nav>
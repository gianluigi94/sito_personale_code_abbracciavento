<?php
require_once 'funzioni.php';

// in questa pagina gestisco sia il menu normale che il menu hamburger 
use sito_personale\functions\Utility as UT;

$filemenu = "data/menu.json";
$objmenu = json_decode(UT::leggiTesto($filemenu));
$pagina = basename($_SERVER['PHP_SELF']);
$imgL = $objmenu->secondmenu;

?>
<!-- il menu grande è diviso in tre div per aiutarmi a centrare il logo, nel primo div ci sono le prime due voci del menu, nel secondo div c'è l'immagine logo e nel terzo le unltime due voci del menu. Per tanto dovro usare due cicli per mandare a scermo i dati del menu grande, i dati del menu sono in un json -->
<nav id="top">
    <div class="navbig">
        <div class="firstmenu">
            <ul class="firstlist">
                <?php
// ciclo le prime due voci del menu, creando al suo interno un secondo ciclo per le voci del sottomenu dei progetti
                foreach ($objmenu->firstmenu as $link) {
                    $class = "";
                    $icon = "";
                    $subMenu = "";
                    if ($link->sub != []) {
                        // una voce del menu potrebbe avere più di una classe: la classe che rapresenta il 'li' che contiene il sottomenu, oppure potrebbe avere anche la classe speciale che sotolinea la voce del menu corrispondente alla pagina che si sta visitando. Per concatenare adeguatamente le classi lascio volutamente uno spazio vuoto, spazio che se innutile, lo toglierò in seguito con trim 
                        $class .= "special ";
                        $icon = "$objmenu->icona";
                        $subMenu = '<ul class="subMenu">';
                        foreach ($link->sub as $subLink) {
                            $classub = "";
                            if ($subLink->id == 16) {
                                $classub .= "lastChild ";
                            }
                            // $pagina è la variabile che determina la pagina che si sta visitando e verà aggiunta una classe per la sotolineatura 
                            if ($subLink->url == $pagina) {
                                $classub .= "underlined ";
                            }
                            $subMenu .= sprintf('<li class="%s"><a href="%s" title="%s">%s</a></li>', trim($classub), $subLink->url, $subLink->title, $subLink->nome);
                        }
                        $subMenu .= "</ul>";
                    }
                    if ($link->url == $pagina) {
                        $class .= "underlined";
                    }
                    printf('<li class="%s"><a href="%s" title="%s">%s %s</a>%s</li>', trim($class), $link->url, $link->title, $link->nome, $icon, $subMenu);
                }
                ?>
            </ul>
        </div>
        <div class="secondmenu">
            <?php
            // mando a schermo il logo 
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
                    printf('<li class="%s"><a href="%s" title="%s">%s</a></li>', trim($class), $link->url, $link->title, $link->nome);
                }
                ?>
            </ul>
        </div>
    </div>



    <!-- MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURGER MENU HAMBURG -->



    <!-- creo uno span che fungera da sfondo del menu al rimpiciolirsi dello schermo con un altro logo, ma più piccolo -->
    <span class="bordoMenu"></span>
        <?php
        printf('<a href="%s" title="%s"><img class="nascosto mainImage" loading="eager" src="%s" alt="%s" draggable="false" ></a>', $imgL->url, $imgL->title, $imgL->icona, $imgL->alt);
        ?>
    <div class="containersup">
        <div class="navbar">
            <div class="hamburgermenu">
                <?php
                // ciclo di nuovo le informazioni contenuti nei jeson per la creazione delle voci del menu hamburger, ma visto che ora posso creare il menu con un solo ciclo, prima unisco i dati in un solo array e uso lo stesso sistema di prima per le assegnazioni di più classi
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
                    $class = "navItem ";
                    $icon = "";
                    $subMenu = "";
                    if ($linktwo->sub != []) {
                        $class .= "navprogect ";
                        $icon = "<i class='fas fa-caret-down'></i>";
                        echo '<li class="' . $class . '">' . $linktwo->nome . ' ' . $icon;

                        $subMenu = '<ul class="sottomini">';
                        foreach ($linktwo->sub as $subLinktwo) {
                            $classub = "";
                            if ($subLinktwo->url == $pagina) {
                                $classub .= "underlined ";
                            }
                            $subMenu .= sprintf('<li class="%s"><a href="%s" title="%s">%s</a></li>', trim($classub), $subLinktwo->url, $subLinktwo->title, $subLinktwo->nome);
                        }
                        $subMenu .= "</ul>";
                        echo $subMenu . '</li>';
                    } else {
                        if ($linktwo->url == $pagina) {
                            $class .= "underlined ";
                        }
                        printf('<li class="%s"><a href="%s" title="%s">%s</a></li>', $class, $linktwo->url, $linktwo->title, $linktwo->nome);
                    }
                }

                ?>
            </ul>

        </div>
    </div>
</nav>
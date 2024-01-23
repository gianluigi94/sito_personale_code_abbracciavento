<?php
require_once 'funzioni.php';

use sito_personale\functions\Utility as UT;

$file = "data/menu.json";
$obj = json_decode(UT::leggiTesto($file));
$pagina = basename($_SERVER['PHP_SELF']);

?>

<nav id="top">
    <div class="navbig">
        <div class="firstmenu">
            <ul class="firstlist">
                <?php

                foreach ($obj->firstmenu as $link) {
                    $class = "";
                    $icon = "";
                    $subMenu = "";
                    if ($link->sub != []) {
                        $class .= "special ";
                        $icon = "<i class='fas fa-caret-down'></i>";
                        $subMenu = '<ul class="subMenu">';
                        foreach ($link->sub as $subLink) {
                            $classub = "";
                            if ($subLink->id == 16) {
                                $classub .= "lastChild ";
                            }
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
            $imgL = $obj->secondmenu;
            printf('<a href="%s" id="logo" title="%s"><img class="mainImage" loading="eager" src="%s" alt="%s" draggable="false"></a>', $imgL->url, $imgL->title, $imgL->icona, $imgL->alt);
            ?>


        </div>
        <div class="thirdmenu">
            <ul class="secondlist">
                <?php
                foreach ($obj->thirdmenu as $link) {
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

    <div class="containersup">
        <div class="navbar">
            <div class="hamburgermenu">
                <?php
                $menuUnito = array_merge($obj->firstmenu, $obj->thirdmenu);

                $classiL = ["lineeone", "linetwo", "linetree"];
                foreach ($classiL as $clsL) {
                    echo '<span class="linee ' . $clsL . '"></span>';
                }
                ?>
            </div>
            <ul>
                <?php
               foreach ($menuUnito as $link) {
                $class = "navItem ";
                $icon = "";
                $subMenu = "";
                if ($link->sub != []) {
                    $class .= "navprogect ";
                    $icon = "<i class='fas fa-caret-down'></i>";
                    echo '<li class="' . $class . '">' . $link->nome . ' ' . $icon;
            
                    $subMenu = '<ul class="sottomini">';
                    foreach ($link->sub as $subLink) {
                        $classub = "";
                        if ($subLink->url == $pagina) {
                            $classub .= "underlined ";
                        }
                        $subMenu .= sprintf('<li class="%s"><a href="%s" title="%s">%s</a></li>', trim($classub), $subLink->url, $subLink->title, $subLink->nome);
                    }
                    $subMenu .= "</ul>";
                    echo $subMenu . '</li>';
                } else {
                    if ($link->url == $pagina) {
                        $class .= "underlined ";
                    }
                    printf('<li class="%s"><a href="%s" title="%s">%s</a></li>', $class, $link->url, $link->title, $link->nome);
                }
            }
            
                ?>
            </ul>
        </div>
    </div>

</nav>
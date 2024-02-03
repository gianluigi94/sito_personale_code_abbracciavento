<?php

namespace sito_personale\functions;

class utility
{
    public static function leggiTesto($file, $commenta = false)
    {
        $rit = false;
        if (!$fp = fopen($file, 'r')) {
            if ($commenta) {
                echo "non posso aprire il file $file<br>";
            }
        } else {
            if (is_readable($file) === false) {
                if ($commenta) {
                    echo "Il file $file non è leggibile<br>";
                }
            } else {
                $rit = fread($fp, filesize($file));
                if ($commenta) {
                    echo "Il file $file è stato aperto e letto<br>";
                }
            }
            fclose($fp);
        }
        return $rit;
    }


    public static function richiestaHTTP($str)
    {
        $rit = null;
        if ($str !== null) {
            if (isset($_POST[$str])) {
                $rit = $_POST[$str];
            } elseif (isset($_GET[$str])) {
                $rit = $_GET[$str];
            }
        }
        return $rit;
    }

    public static function titleHTTP()
    {
        $fileName = basename($_SERVER['PHP_SELF'], '.php');
        $pageTitle = ucfirst(str_replace('_', ' ', $fileName));
        if ($pageTitle == "Index") {
            $pageTitle = "Home Page";
        }
        return $pageTitle;
    }
    public static function lingua()
    {
        $lorem = ['ipsum-commerce.php', 'lorem_cripto_dolor.php', 'socialorem.php', 'space_chess_dolor.php'];
        $pagina = basename($_SERVER['SCRIPT_NAME']);
        $lingua = in_array($pagina, $lorem) ? 'zxx' : 'it';
        return $lingua;
    }

    public static function scriviTesto($file, $stringa, $commenta = false)
    {
        $rit = false;

        if (!$fp = fopen($file, 'a')) {
            echo "Non posso aprire il file $file<br>";
        } else {

            if (is_writable($file) === false) {
                echo " $file non è scrivibile <br>";
            } else {
                if (!fwrite($fp, $stringa)) {
                    echo "Non posso scrivere il file $file<br>";
                } else {
                    if ($commenta) {
                        echo "Completo! Ho scritto $stringa in $file";
                    }
                    $rit = true;
                }
            }
        }
        fclose($fp);
        return $rit;
    }

    public static function controllaRangeStringa($stringa, $min = null, $max = null)
    {
        $rit = 0;
        $n = strlen($stringa);
        if ($min != null && $n < $min) {
            $rit++;
        }
        if ($max != null && $n > $max) {
            $rit++;
        }
        return ($rit == 0);
    }

    public static function formControl(&$stringa, $min, $max, &$classeOrigine, $classeDestinazione, &$classeErroreOrUno,  &$classeErroreOrDue, &$valido)
    {
        if (empty($stringa)) {
            $valido++;
            $classeOrigine = $classeDestinazione;
            $stringa = "";
            $classeErroreOrUno = "formEr";
        } elseif (!self::controllaRangeStringa($stringa, $min, $max)) {
            $valido++;
            $classeOrigine = $classeDestinazione;
            $stringa = "";
            $classeErroreOrDue = "formEr";
        }
        return $valido;
    }

    public static function formControlDue(&$stringa, $min, $max, &$classeOrigine, $classeDestinazione, &$classeErroreOrUno,  &$classeErroreOrDue,&$classeLab, $classeLabNuova, &$valido)
    {
        if (empty($stringa)) {
            $valido++;
            $classeOrigine = $classeDestinazione;
            $stringa = "";
            $classeErroreOrUno = "formErr";
            $classeLab = $classeLabNuova;
        } elseif (!self::controllaRangeStringa($stringa, $min, $max)) {
            $valido++;
            $classeOrigine = $classeDestinazione;
            $stringa = "";
            $classeErroreOrDue = "formErr";
            $classeLab = $classeLabNuova;
        }
        return $valido;
    }
    public static function formControlEmail(&$stringa, $min, $max, &$classeOrigine, &$classeErroreOrUno,  &$classeErroreOrDue, &$classeErroreOrTre, &$classeLab, &$valido)
    {
        if (empty($stringa)) {
            $valido++;
            $classeLab = "labelTwoEr";
            $classeOrigine = "inpTwoEr";
            $classeErroreOrUno = "formErr";
            $stringa = "";
        } elseif(!filter_var($stringa, FILTER_VALIDATE_EMAIL)){
            $valido++;
            $classeLab = "labelTwoEr";
            $classeOrigine = "inpTwoEr";
            $classeErroreOrDue = "formErr";
            $stringa = "";
        } elseif (!self::controllaRangeStringa($stringa, $min, $max)){
            $valido++;
            $classeLab = "labelTwoEr";
            $classeOrigine = "inpTwoEr";
            $classeErroreOrTre = "formErr";
            $stringa = "";
        }
        return $valido;
    }
   
    public static function fotoControl(&$erroreImg, &$incognitaClass, &$clFlImo, &$clFlLab)
    {
        $erroreImg++;
        $incognitaClass = "formEr";
        $clFlImo = "inpOneEr";
        $clFlLab = "labRecEr";
    }
    
    public static function checkControl(&$valido, &$classeLab, $classeLabNuova, &$clsasseCheck, $classeCheckNuova, &$classeHidden)
    {
        if (!isset($_POST['accettazione'])) {
            $valido++;
            $classeLab = $classeLabNuova;
            $clsasseCheck = $classeCheckNuova;
            $classeHidden = "formErr";
        }
    }
}

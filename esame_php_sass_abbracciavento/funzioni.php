<?php
    namespace sito_personale\functions;

    class utility{
        public static function leggiTesto($file) {
            $rit = false;
            if (!$fp = fopen($file, 'r')) {
                echo "non posso aprire il file $file<br>";
            } else {
                if (is_readable($file) === false) {
                    echo "Il file $file non è leggibile<br>";
                } else {
                    $rit = fread($fp, filesize($file));
                }
                fclose($fp);
            }
            return $rit;
        }

        public static function richiestaHTTP($str){
            $rit = null;
            if($str !== null) {
                if (isset($_POST[$str])) {
                    $rit = $_POST[$str];
                } elseif (isset($_GET[$str])){
                    $rit = $_GET[$str];
                }
            }
            return $rit;
        }

        public static function titleHTTP() {
            $fileName = basename($_SERVER['PHP_SELF'], '.php');
            $pageTitle = ucfirst(str_replace('_', ' ', $fileName));
            if($pageTitle == "Index"){
                $pageTitle = "Home Page";
            }  
            return $pageTitle;
        }
        
    }
?>
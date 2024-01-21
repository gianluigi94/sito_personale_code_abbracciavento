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
    }
?>
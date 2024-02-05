<?php

namespace sito_personale\functions;

/**
 * Classe che contiene le funzioni usati nel mio sito
 * @author Gianluigi Abbracciavento
 * 
 */
class utility
{
    /**
     * Il Metodo riportato sotto è usato per leggere i file json
     * @param string $file è il percorso/nome del file
     * @param boolean $commenta se vera mostra dei commenti per aiutarmi nello sviluppo, faccio in modo di non mostrarli
     * @return boolean|string dopo che il file è stato aperto,  letto per intero e chiuso, ritorna sia un booleano e sia la stringa con il testo che occorreva
     */
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

    /**
     * Il Metodo riportato sotto è usato per estrarre il valore Post o Get
     * @param string $str valore scritto dall'utente tramite form da ricercare
     * @return string|null Ho è nullo ho ritorna il valore
     */

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
    /**
     * Il metodo riportato sotto serve per ricavare il title della pagina corrente e il titolo principale dei progetti in maniera dinamica: prende con una variabile superglobale il nome dal percorso.
     * dopo rende maiuscola la prima lettera, sostituisce gli eventuali underscore con spazzi bianchi e per finire se il risultato finale è Index lo sostituisce con Home Page.
     * @return string TITLE | h1 della pagina
     */
    public static function titleHTTP()
    {
        $fileName = basename($_SERVER['SCRIPT_NAME'], '.php');
        $pageTitle = ucfirst(str_replace('_', ' ', $fileName));
        if ($pageTitle == "Index") {
            $pageTitle = "Home Page";
        }
        return $pageTitle;
    }

    /**
     * Il metodo riportato sotto serve per assegnare la lingua arbitraria zxx nelle pagine dove ho usato principalmente il lorem ipsum.
     * Quindi ho creato un array con tutte le pagine lorem ipsum e assegno ad esse la lingua zxx, selezionandole dal nome del percorso.
     * Le altre saranno in it. 
     * @return string html lang
     */

    public static function lingua()
    {
        $lorem = ['ipsum-commerce.php', 'lorem_cripto_dolor.php', 'socialorem.php', 'space_chess_dolor.php'];
        $pagina = basename($_SERVER['SCRIPT_NAME']);
        $lingua = in_array($pagina, $lorem) ? 'zxx' : 'it';
        return $lingua;
    }

    /**
     * Il metodo riportato sotto è per scrivere su un file txt una stringa che raccoglie i dati dell'utente
     * @param string $file nome del file che viene aperto, verificato se scrivibile, scritto e chiuso
     * @param string $stringa da scrivere nel file
     * @param boolean $commenta, se vera permette l'invio di messaggi di verifica
     * @return boolean
     */
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

    /**
     * Il metodo riportato sotto è usato per controllare la grandezza minima e massima di un valore inviato dall'utente all'interno di un form. 
     * @param string $stringa valore inserito dall'utente
     * @param int $min valore numerico sotto al cuale il dato non deve scendere
     * @param int $max Valore numerico sopra al cuale il dato non deve salire
     * @return boolean 
     */
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

    /**
 * Il metodo riportato sotto serve a ridurre il numero di righe di codice in maniera sostanziale e controlla la validazione di molti dei campi imput presenti sul mio sito, controlla se il campo non è vuoto, controlla se la lunghezza è delle giuste dimensioni e se non andasse bene qualcosa, cambia le clasi del form facendo quindi comprendere l'errore all'utente e facendo comparire un testo esplicito che indica l'errore. Molte variabili sono passate per riferimento.
 *
 * @param string &$stringa campo da validare.
 * @param int $min Lunghezza minima accettabile della stringa.
 * @param int $max Lunghezza massima accettabile della stringa.
 * @param string &$classeOrigine Riferimento alla classe CSS  da modificare in caso di errore.
 * @param string $classeDestinazione Classe CSS che se in caso di errore prende il posto a classeOrrigine.
 * @param string &$classeErroreOrUno si riferisce alla specifica classe dello specifico messaggio di errore (lo scopo è togliere il display none)
 * @param string &$classeErroreOrDue si riferisce alla specifica classe dello specifico messaggio di errore (lo scopo è togliere il display none)
 * @param int &$valido Riferimento al contatore degli errori; incrementato in caso di errore.
 * @return int Restituisce il numero aggiornato di errori validati.
 */
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

    /**
 * Il metodo riportato sotto serve a ridurre in maniera sostanziale il numero di righe di codice controlla la validazione di molti dei campi imput presenti sul mio sito, controlla se il campo non è vuoto, controlla se la lunghezza è delle giuste dimensioni e se non andasse bene qualcosa, cambia le clasi del form facendo capire l'errore all'utente e facendo comparire un testo che indica l'errore. Molte variabili sono passate per riferimento.
 *
 * @param string &$stringa campo da validare.
 * @param int $min Lunghezza minima accettabile della stringa.
 * @param int $max Lunghezza massima accettabile della stringa.
 * @param string &$classeOrigine Riferimento alla classe CSS  da modificare in caso di errore.
 * @param string $classeDestinazione Classe CSS che se in caso di errore prende il posto a classeOrrigine.
 * @param string &$classeErroreOrUno si riferisce alla specifica classe dello specifico messaggio di errore (lo scopo è togliere il display none)
 * @param string &$classeErroreOrDue si riferisce alla specifica classe dello specifico messaggio di errore (lo scopo è togliere il display none)
 * @param string &classeLab si riferisce alla classe della label da eventualmente modificare.
 * @param string classeLabNuova la nuova classe per la lable
 * @param int &$valido Riferimento al contatore degli errori; incrementato in caso di errore.
 * @return int Restituisce il numero aggiornato di errori validati.
 */
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


      /**
 * Il metodo riportato sotto serve a ridurre in maniera sostanziale il numero di righe di codice e controlla la validazione del campo email presenti sul mio sito. Controlla se il campo non è vuoto, controlla se la lunghezza è delle giuste dimensioni, controlla se è un email valida e se non andasse bene qualcosa, cambia le clasi del form facendo capire l'errore all'utente e facendo comparire un testo che indica l'errore. Molte variabili sono passate per riferimento.
 *
 * @param string &$stringa del campo email.
 * @param int $min Lunghezza minima accettabile della stringa.
 * @param int $max Lunghezza massima accettabile della stringa.
 * @param string &$classeOrigine Riferimento alla classe CSS  da modificare in caso di errore.
 * @param string &$classeErroreOrUno si riferisce alla specifica classe dello specifico messaggio di errore (lo scopo è togliere il display none)
 * @param string &$classeErroreOrDue si riferisce alla specifica classe dello specifico messaggio di errore (lo scopo è togliere il display none)
 * @param string &$classeErroreOrTre si riferisce alla specifica classe dello specifico messaggio di errore (lo scopo è togliere il display none)
 * @param string &classeLab si riferisce alla classe della label da eventualmente modificare.
 * @param int &$valido Riferimento al contatore degli errori; incrementato in caso di errore.
 * @return int Restituisce il numero aggiornato di errori validati.
 */
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
   
    /**
     * Il metodo riportato sotto serve a ridurre il numero di righe di codice visto che questi elementi sono ripetuti in tutti i controlli che servono a validare l'input file per l'invio della foto. Tutte le variabili sono passate per riferimento. Cambiano le classi css e aumentano di un il conteggio degli errori.
     * @param int &$erroreImg cambia il numero attribuiti agli errori della validazione dell'immagine
     * @param string &$incognitaClass la classe css da cambiare per il testo nascosto
     * @param string &$clFlImo cambia la classe dell'input file
     * @param string &$clFlLab cambia la classe della label
     */
    public static function fotoControl(&$erroreImg, &$incognitaClass, &$clFlImo, &$clFlLab)
    {
        $erroreImg++;
        $incognitaClass = "formEr";
        $clFlImo = "inpOneEr";
        $clFlLab = "labRecEr";
    }
    
      /**
     * Il metodo riportato sotto serve a validare la spunta nel form di contatti. Molte variabili sono passate per riferimento. Cambiano le classi css e aumenta eventualmente di uno il conteggio degli errori.
     * @param int &$valido cambia il numero attribuiti agli errori
     * @param string &$classeLab cambia la label
     * @param string $classeLabNuova la nuova classe che sostituisce la classe della label
     * @param string &$clsasseCheck serve a cambiare lo stile della checkboxe
     * @param string &$classeHidden serve per mostrare il messaggio di errore
     */
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

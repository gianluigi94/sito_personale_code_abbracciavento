<?php
//in questa pagina preparo la connessione con mysqli
$host = "localhost";
$user = "root";
$password = "";
$db = "code";

$connessione = new mysqli($host, $user, $password, $db);

if ($connessione->connect_error) {
    die('Errore di connessioneee (' . $connessione->connect_errno . ') '
        . $connessione->connect_error);
} 
?>

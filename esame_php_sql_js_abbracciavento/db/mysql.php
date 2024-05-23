<?php
// in questa pagina gestisco le dinamiche tra il database e la tabella del portfolio grafico
require_once('config.php');

// Ottengo il corpo della richiesta JSON e decodificalo
$input = json_decode(file_get_contents('php://input'), true);
$azione = $input['azione'] ?? null;

if ($azione === 'seleziona') {  // azione per visualizzare i dati del database nella tabella
    $sql = 'SELECT id, url, titolo, descrizione, sottotitolo, alt, cancellato FROM portfolio_grafico';
    $data = [];
    if ($result = $connessione->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $data[] = [ // raccolgo i dati necessari
                    'id' => $row['id'],
                    'url' => addslashes($row['url']),
                    'titolo' => addslashes($row['titolo']),
                    'descrizione' => addslashes($row['descrizione']),
                    'sottotitolo' => addslashes($row['sottotitolo']),
                    'alt' => addslashes($row['alt']),
                    'cancellato' => $row['cancellato']
                ];
            }
        }
        echo json_encode($data); // trasformo file json
    } else {
        echo json_encode(["messaggio" => "Errore nell'esecuzione di $sql. " . $connessione->error]);
    }
}elseif ($azione === 'toggleVisibility') { // azione per la cancellazione logica e nascondere i dati non necessari
    $id = $connessione->real_escape_string($input['id']);
    $nuovoStato = $connessione->real_escape_string($input['nuovoStato']);
    
    $sql = "UPDATE portfolio_grafico SET cancellato = '$nuovoStato' WHERE id = '$id'"; // preparo sql
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "Stato aggiornato con successo", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "Errore nell'aggiornamento dello stato", "response" => 0, "error" => $connessione->error]);
    }
}elseif ($azione === 'inserisci') { //azione per inserire elemento nel database e nel sito 
    //raccolgo i dati degli iput del sito
    $url = $connessione->real_escape_string($input['url']);
    $titolo = $connessione->real_escape_string($input['titolo']);
    $descrizione = $connessione->real_escape_string($input['descrizione']);
    $sottotitolo = $connessione->real_escape_string($input['sottotitolo']);
    $alt = $connessione->real_escape_string($input['alt']);

    //preparo sql
    $sql = "INSERT INTO portfolio_grafico (url, titolo, descrizione, sottotitolo, alt) VALUES ('$url', '$titolo', '$descrizione', '$sottotitolo', '$alt')";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo inserimento", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => $connessione->error, "response" => 0]);
    }
} elseif ($azione === 'elimina') { //azione per eliminare elemento selezionato definitivamente, dal database e dal sito
    $id = $input['id'];
    $sql = "DELETE FROM portfolio_grafico WHERE id = $id"; //preparo sql 
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo eliminato", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "no eliminato", "response" => 0]);
    }
} elseif ($azione === 'aggiorna') { //azione per modificare dato del database e del sito 
    //raccolgo i valori, gli input devono essere precompilati
    $id = $connessione->real_escape_string($input['id']);
    $titolo = $connessione->real_escape_string($input['titolo']);
    $url = $connessione->real_escape_string($input['url']);
    $descrizione = $connessione->real_escape_string($input['descrizione']);
    $sottotitolo = $connessione->real_escape_string($input['sottotitolo']);
    $alt = $connessione->real_escape_string($input['alt']);

     // preparo sql
    $sql = "UPDATE portfolio_grafico SET titolo='$titolo', url='$url', descrizione='$descrizione', sottotitolo='$sottotitolo', alt='$alt' WHERE id=$id";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo modifica", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "errore modifica", "response" => 0]);
    }
} else {
    echo json_encode(["messaggio" => "Azione non definita"]);
}
?>

<?php
// in questa pagina gestisco le dinamiche tra il database e la tabella progetti
require_once('config.php');

// Ottengo il corpo della richiesta JSON e decodificalo
$input = json_decode(file_get_contents('php://input'), true);
$azione = $input['azione'] ?? null;

if ($azione === 'seleziona') { // azione per visualizzare i dati del database nella tabella
    $sql = 'SELECT id, titolo, testo, ripetizioni_testo, descrizione, sottotitolo_immagine, url_immagine, cancellato FROM progetti';
    $data = [];
    if ($result = $connessione->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $data[] = [ // raccolgo i dati necessari
                    'id' => $row['id'],
                    'titolo' => addslashes($row['titolo']),  
                    'testo' => addslashes($row['testo']),    
                    'ripetizioni_testo' => $row['ripetizioni_testo'],
                    'descrizione' => addslashes($row['descrizione']),  
                    'sottotitolo_immagine' => addslashes($row['sottotitolo_immagine']),  
                    'url_immagine' => addslashes($row['url_immagine']),
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
    
    $sql = "UPDATE progetti SET cancellato = '$nuovoStato' WHERE id = '$id'"; // preparo sql
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "Stato aggiornato con successo", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "Errore nell'aggiornamento dello stato", "response" => 0, "error" => $connessione->error]);
    }
}
elseif ($azione === 'inserisci') { //azione per inserire elemento nel database e nel sito 
    //raccolgo i dati degli iput del sito
    $titolo = $connessione->real_escape_string($input['titolo']);
    $testo = $connessione->real_escape_string($input['testo']);
    $ripetizioni_testo = $connessione->real_escape_string($input['ripetizioni_testo']);
    $descrizione = $connessione->real_escape_string($input['descrizione']);
    $sottotitolo_immagine = $connessione->real_escape_string($input['sottotitolo_immagine']);
    $url_immagine = $connessione->real_escape_string($input['url_immagine']);

    //preparo sql
    $sql = "INSERT INTO progetti (titolo, testo, ripetizioni_testo, descrizione, sottotitolo_immagine, url_immagine) VALUES ('$titolo', '$testo', '$ripetizioni_testo', '$descrizione', '$sottotitolo_immagine', '$url_immagine')";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo inserimento", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => $connessione->error, "response" => 0]);
    }
} elseif ($azione === 'elimina') { //azione per eliminare elemento selezionato definitivamente, dal database e dal sito
    $id = $input['id'];
    $sql = "DELETE FROM progetti WHERE id = $id"; //preparo sql 
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo eliminato", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "no eliminato", "response" => 0]);
    }
} elseif ($azione === 'aggiorna') { //azione per modificare dato del database e del sito 
    //raccolgo i valori, gli input devono essere precompilati
    $id = $connessione->real_escape_string($input['id']);
    $titolo = $connessione->real_escape_string($input['titolo']);
    $testo = $connessione->real_escape_string($input['testo']);
    $ripetizioni_testo = $connessione->real_escape_string($input['ripetizioni_testo']);
    $descrizione = $connessione->real_escape_string($input['descrizione']);
    $sottotitolo_immagine = $connessione->real_escape_string($input['sottotitolo_immagine']);
    $url_immagine = $connessione->real_escape_string($input['url_immagine']);
    
    // preparo sql
    $sql = "UPDATE progetti SET titolo='$titolo', descrizione='$descrizione', testo='$testo', ripetizioni_testo='$ripetizioni_testo',sottotitolo_immagine='$sottotitolo_immagine', url_immagine='$url_immagine' WHERE id=$id";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo modifica", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "errore modifica", "response" => 0]);
    }
} else {
    echo json_encode(["messaggio" => "Azione non definita"]);
}
?>

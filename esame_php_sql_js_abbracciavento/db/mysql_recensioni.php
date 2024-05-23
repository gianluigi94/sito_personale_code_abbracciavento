<?php
// in questa pagina gestisco le dinamiche tra il database e la tabella recensioni
require_once('config.php');

// Ottengo il corpo della richiesta JSON e decodificalo
$input = json_decode(file_get_contents('php://input'), true);
$azione = $input['azione'] ?? null;

if ($azione === 'seleziona') { // azione per visualizzare i dati del database nella tabella
    $sql = 'SELECT id, nome, testo, url_immagine, social, link, cancellato FROM recensioni';
    $data = [];
    if ($result = $connessione->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $row = array_map('htmlspecialchars', $row);
                $data[] = [ // raccolgo i dati necessari
                    'id' => $row['id'],
                    'nome' => addslashes($row['nome']),  
                    'testo' => nl2br(addslashes($row['testo'])),    
                    'url_immagine' => $row['url_immagine'],
                    'social' => addslashes($row['social']),  
                    'link' => addslashes($row['link']),  
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
    
    $sql = "UPDATE recensioni SET cancellato = '$nuovoStato' WHERE id = '$id'"; // preparo sql
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "Stato aggiornato con successo", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "Errore nell'aggiornamento dello stato", "response" => 0, "error" => $connessione->error]);
    }
}
elseif ($azione === 'inserisci') {  //azione per inserire elemento nel database e nel sito 
    //raccolgo i dati degli iput del sito
    $nome = $connessione->real_escape_string($input['nome']);
    $testo = $connessione->real_escape_string($input['testo']);
    $url_immagine = $connessione->real_escape_string($input['url_immagine']);
    $social = $connessione->real_escape_string($input['social']);
    $link = $connessione->real_escape_string($input['link']);

    //preparo sql
    $sql = "INSERT INTO recensioni (nome, testo, url_immagine, social, link) VALUES ('$nome', '$testo', '$url_immagine', '$social', '$link')";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo inserimento", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => $connessione->error, "response" => 0]);
    }
} elseif ($azione === 'elimina') { //azione per eliminare elemento selezionato definitivamente, dal database e dal sito
    $id = $input['id'];
    $sql = "DELETE FROM recensioni WHERE id = $id"; //preparo sql 
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo eliminato", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "no eliminato", "response" => 0]);
    }
} elseif ($azione === 'aggiorna') { //azione per modificare dato del database e del sito 
    //raccolgo i valori, gli input devono essere precompilati
    $id = $connessione->real_escape_string($input['id']);
    $nome = $connessione->real_escape_string($input['nome']);
    $testo = $connessione->real_escape_string($input['testo']);
    $url_immagine = $connessione->real_escape_string($input['url_immagine']);
    $social = $connessione->real_escape_string($input['social']);
    $link = $connessione->real_escape_string($input['link']);
    
    // preparo sql
    $sql = "UPDATE recensioni SET nome='$nome', social='$social', testo='$testo', url_immagine='$url_immagine',link='$link' WHERE id=$id";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo modifica", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "errore modifica", "response" => 0]);
    }
} else {
    echo json_encode(["messaggio" => "Azione non definita"]);
}
?>

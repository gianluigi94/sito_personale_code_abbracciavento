<?php
// in questa pagina gestisco le dinamiche tra il database e la tabella messaggi
require_once('config.php');

// Ottengo il corpo della richiesta JSON e la decodifico
$input = json_decode(file_get_contents('php://input'), true);
$azione = $input['azione'] ?? null;

if ($azione === 'seleziona') { // azione per visualizzare i dati del database nella tabella
    $sql = 'SELECT id, nome, testo, url_immagine, social, link  FROM nuovi_commenti'; //preparo la selezione
    $data = [];
    if ($result = $connessione->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $row = array_map('htmlspecialchars', $row);
                $data[] = [ // raccolgo i dati necessari in un array mappato 
                    'id' => $row['id'],
                    'nome' => addslashes($row['nome']),  
                    'testo' => addslashes($row['testo']),    
                    'url_immagine' => $row['url_immagine'],
                    'social' => addslashes($row['social']),  
                    'link' => addslashes($row['link'])  
                ];
            }
        }
        echo json_encode($data); // trasformo file json
    } else {
        echo json_encode(["messaggio" => "Errore nell'esecuzione di $sql. " . $connessione->error]);
    }
}elseif ($azione === 'trasferisci') { // trasferisco i dati da una tabella all'altra se premo sul tasto accept
    $connessione->begin_transaction();  // Inizio una transizione dove invio i dati e poi li cancello
    $sql_insert = "INSERT INTO recensioni (nome, testo, url_immagine, social, link)
                   VALUES (?, ?, ?, ?, ?)";
    $stmt = $connessione->prepare($sql_insert);
    if ($stmt) {
        $stmt->bind_param("sssss", $input['nome'], $input['testo'], $input['url_immagine'], $input['social'], $input['link']);
        if ($stmt->execute()) {
            // Solo se l'inserimento ha successo, procedo con l'eliminazione
            $sql_delete = "DELETE FROM nuovi_commenti WHERE id = ?";
            $stmt_del = $connessione->prepare($sql_delete);
            if ($stmt_del) {
                $stmt_del->bind_param("i", $input['id']);
                if ($stmt_del->execute()) {
                    $connessione->commit();  // Completo la transazione se anche l'eliminazione è riuscita
                    echo json_encode(["messaggio" => "Recensione trasferita e eliminata con successo"]);
                } else {
                    $connessione->rollback();  // Annulla la transazione se l'eliminazione fallisce
                    echo json_encode(["messaggio" => "Errore nell'eliminazione: " . $stmt_del->error]);
                }
                $stmt_del->close();
            } else {
                $connessione->rollback();  // Annulla la transazione se l'eliminazione fallisce
                echo json_encode(["messaggio" => "Errore nella preparazione della query di eliminazione: " . $connessione->error]);
            }
        } else {
            $connessione->rollback();  // Annulla la transazione se l'inserimento fallisce
            echo json_encode(["messaggio" => "Errore nell'inserimento: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["messaggio" => "Errore nella preparazione della query di inserimento: " . $connessione->error]);
    }
}




elseif ($azione === 'elimina') { // azione se non accetto il messaggio 
    $id = $input['id'];
    $sql = "DELETE FROM nuovi_commenti WHERE id = $id";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo eliminato", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "no eliminato", "response" => 0]);
    }

} elseif ($azione === 'aggiorna') { // azione se premo sul tasto upload, i dati del database devono precompilare il form
    $id = $connessione->real_escape_string($input['id']);
    $nome = $connessione->real_escape_string($input['nome']);
    $testo = $connessione->real_escape_string($input['testo']);
    $url_immagine = $connessione->real_escape_string($input['url_immagine']);
    $social = $connessione->real_escape_string($input['social']);
    $link = $connessione->real_escape_string($input['link']);
    
// invio i cambiamenti al database
    $sql = "UPDATE nuovi_commenti SET nome='$nome', social='$social', testo='$testo', url_immagine='$url_immagine',link='$link' WHERE id=$id";
    //mi assicuro che tutto procedi bene
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo modifica", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "errore modifica", "response" => 0]);
    }
} else {
    echo json_encode(["messaggio" => "Azione non definita"]);
}
?>

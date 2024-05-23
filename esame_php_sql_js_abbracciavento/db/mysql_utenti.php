<?php
// in questa pagina gestisco le dinamiche tra il database e la tabella utenti
require_once('config.php');

// Ottengo il corpo della richiesta JSON e decodificalo
$input = json_decode(file_get_contents('php://input'), true);
$azione = $input['azione'] ?? null;

if ($azione === 'seleziona') { // azione per visualizzare i dati del database nella tabella
    $sql = 'SELECT id, nome, password FROM utenti';
    $data = [];
    if ($result = $connessione->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $data[] = [ // raccolgo i dati necessari
                    'id' => $row['id'],
                    'nome' => addslashes($row['nome']),
                    'password' => addslashes($row['password']),
                ];
            }
        }
        echo json_encode($data); // trasformo file json
    } else {
        echo json_encode(["messaggio" => "Errore nell'esecuzione di $sql. " . $connessione->error]);
    }
} elseif ($azione === 'inserisci') { //azione per inserire elemento nel database 
    //raccolgo i dati degli iput del sito
    $nome = $connessione->real_escape_string($input['nome']);
    $password = $connessione->real_escape_string($input['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); //nascondo password

    //preparo sql
    $sql = "INSERT INTO utenti (nome, password) VALUES ('$nome', '$hashed_password')";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo inserimento", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => $connessione->error, "response" => 0]);
    }
} elseif ($azione === 'elimina') { //azione per eliminare elemento selezionato definitivamente, dal database
    $id = $input['id'];
    $sql = "DELETE FROM utenti WHERE id = $id"; //preparo sql 
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo eliminato", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "no eliminato", "response" => 0]);
    }
} elseif ($azione === 'aggiorna') { //azione per modificare dato del database 
    //raccolgo i valori, gli input devono essere precompilati
    $id = $connessione->real_escape_string($input['id']);
    $nome = $connessione->real_escape_string($input['nome']);
    $password = $connessione->real_escape_string($input['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash della password




    // preparo sql
    $sql = "UPDATE utenti SET nome='$nome', password='$hashed_password' WHERE id=$id";
    if ($connessione->query($sql) === true) {
        echo json_encode(["messaggio" => "successo modifica", "response" => 1]);
    } else {
        echo json_encode(["messaggio" => "errore modifica", "response" => 0]);
    }
} else {
    echo json_encode(["messaggio" => "Azione non definita"]);
}

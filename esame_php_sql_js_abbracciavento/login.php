<?php
// in questa pagina definisco il form di login e verifico utente e pasword con i dati nel database
session_start(); // memorizzo le informazioni facendo partire una sessione

require_once 'funzioni.php';
require_once "head.php";
?>

<body class="dbBody">

    <span id="sfondoRegina">
        <img src="assets/logobianco.png" alt="logo regina">
    </span>

    <form action="login.php" method="post" id="formAdmin" novalidate>
        <fieldset>
            <legend>BENTORNATO</legend>

            <label for="nomeUtente">NOME UTENTE</label>
            <input type="text" required id="nomeUtente" name="nomeUtente">

            <label for="password">PASSWORD</label>
            <input type="password" required id="password" name="password">

            <button type="submit" id="entrataAdmin">Entra</button>

        </fieldset>

    </form>
    <?php
    require_once "db/config.php";  // richiamo le configurazioni per il database

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nomeUtente = $connessione->real_escape_string($_POST['nomeUtente']); //recupero il nome utente 
        $password = $_POST['password']; //recupero password inserita

        
        $sql = "SELECT password FROM utenti WHERE nome = ?"; // preparo sql ed eseguo ricerca
        $stmt = $connessione->prepare($sql);
        $stmt->bind_param("s", $nomeUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        $foundUser = $result->num_rows === 1; //verifica nome
        $validPassword = $foundUser && password_verify($password, $result->fetch_assoc()['password']); //verifica password

        // mostro eventuali messaggi di errore
        if (empty($nomeUtente)) {
            echo "<p class ='errorDbU' >Il campo nome utente non può essere vuoto.</p>";
        } elseif (!$foundUser) {
            echo "<p class ='errorDbU' >Nome utente non trovato.</p>";
        }
        if (empty($password)) {
            echo "<p class ='errorDb' >Il campo password non può essere vuoto.</p>";
        } elseif (!$validPassword) {
            echo "<p class ='errorDb' >Nome utente o password non trovato.</p>";
        }

        if ($foundUser && $validPassword) {
          
            $_SESSION['user_id'] = $nomeUtente; //imposto una sessione per memorizzare i dati tra la navigazione del backend

         
            header("Location: admin.php"); //vengo mandato alla pagina di gestione
            exit;
        }


        $stmt->close();
        $connessione->close(); //chiudo connessione
    }


    ?>

</body>

</html>
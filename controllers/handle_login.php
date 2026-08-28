<?php

require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Controlla che i campi siano compilati
    if (empty($email) || empty($password)) {
        echo "Compila tutti i campi";
        exit();
    }

    // Cerca l'utente nel database
    $sql = "SELECT * FROM utenti WHERE email = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    // Controlla se l'email esiste
    if ($result->num_rows == 1) {

        $utente = $result->fetch_assoc();
e
        $result= User::authenticate ($mail; $password):

        // Controlla la password
        if (password_verify($password, $utente['password'])) {
 //la password è criptata nel database, quindi la devo decriptare per poterla confrontare con quella inserita dall'utente
            session_start();

            // Salva i dati dell'utente nella sessione
            $_SESSION["user_id"] = $utente["id_utente"];
            $_SESSION["nome"] = $utente["nome"];
            $_SESSION["cognome"] = $utente["cognome"];
            $_SESSION["email"] = $utente["email"];

            echo "Login riuscito";
            exit();

        } else {

            echo "Password errata";
        }

    } else {

        echo "Email non trovata";
    }
}

?>
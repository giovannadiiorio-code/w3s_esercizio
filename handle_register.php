<?php
session_start();

include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Controlla se l'email è già registrata
    $check = $conn->prepare("SELECT * FROM utenti WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        die("Email già registrata.");
    }

    // Inserisce il nuovo utente
    $stmt = $conn->prepare("INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $cognome, $email, $password);

    if ($stmt->execute()) {

        // Salva i dati nella sessione
        $_SESSION["id"] = $conn->insert_id;
        $_SESSION["nome"] = $nome;
        $_SESSION["email"] = $email;

        // Reindirizza alla dashboard
        header("Location: dashboard.php");
        exit();

    } else {

        echo "Errore durante la registrazione: " . $stmt->error;

    }

    $stmt->close();
    $check->close();
    $conn->close();
}
?>
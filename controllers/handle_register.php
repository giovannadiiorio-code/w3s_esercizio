```php
<?php

require_once __DIR__ . '/conn.php';
require_once __DIR__ . '/../models/user.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera i dati dal form
    $nome = trim($_POST["nome"] ?? "");
    $cognome = trim($_POST["cognome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $password_confirm = $_POST["password_confirm"] ?? "";

    // Controlla che tutti i campi siano compilati
    if (empty($nome) || empty($cognome) || empty($email) || empty($password) || empty($password_confirm)) {

        $_SESSION['campi_obbligatori'] = "Tutti i campi sono obbligatori";

        header("Location: /views/register.php");
        exit();
    }

    // Controlla che le password coincidano
    if ($password !== $password_confirm) {

        $_SESSION['errore_password'] = "Le password non coincidono";

        header("Location: /views/register.php");
        exit();
    }

    // Controlla se l'email è già registrata
    $result = user::checkRegister($email);

    if ($result) {

        $_SESSION['error_registrazione'] = "L'email è già registrata";

        header("Location: /views/register.php");
        exit();
    }

    // Crea l'hash della password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Inserisce il nuovo utente
    $stmt = $conn->prepare(
        "INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssss",
        $nome,
        $cognome,
        $email,
        $password_hash
    );

    if ($stmt->execute()) {

        // Salva i dati nella sessione
        $_SESSION["id"] = $conn->insert_id;
        $_SESSION["nome"] = $nome;
        $_SESSION["email"] = $email;

        // Reindirizza alla dashboard
        header("Location: /views/dashboard.php");
        exit();

    } else {

        $_SESSION['errore_registrazione'] = "Errore durante la registrazione";

        header("Location: /views/register.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}

?>
```

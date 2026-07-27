<?php

// Credenziali locale
$host = "localhost";
$user = "root";
$pass = "";
$db = "w3s";

// Creazione connessione
$conn = new mysqli($host, $user, $pass, $db);

// Controllo errori
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Imposta il charset
$conn->set_charset("utf8mb4");

?>
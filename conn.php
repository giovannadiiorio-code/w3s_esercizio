<?php
// Credenziali locale
$host = "localhost";
$user = "root";
$pass = ""; // In MAMP di solito è "root", in XAMPP lascia vuoto ""
$db   = "w3s"; // Nome del tuo database

// Creazione connessione
$conn = new mysqli($host, $user, $pass, $db);

// Controllo errori
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Imposta il charset per evitare problemi con gli accenti
$conn->set_charset("utf8mb4");
//serve per ricordare chi è loggato e chi non è loggato
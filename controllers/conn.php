<?php

// Credenziali locale
$host = "localhost";
$user = "root";
$pass = "";
$db = "w3s";

// Creazione connessione
$conn = new mysqli($host, $user, $pass, $db); //passi i parametri, gli attributi
//new my sqli è la nuova classe per la connessione al database
//mysqli sta richiamando questa funzione richiamata da qualche parte. non è nella lista di file è perchè è una funzione core, nativa. se non fosse stata così l'avrei dovuta creare (come fatto per user e argomenti)
// Controllo errori
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Imposta il charset
$conn->set_charset("utf8mb4");

?>
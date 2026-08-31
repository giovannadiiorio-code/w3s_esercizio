<?php
session_start();

// Controlla che l'utente sia loggato
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

require_once "conn.php";

// Recupera i dati del form
$titolo = $_POST["titolo"];
$descrizione = $_POST["descrizione"];
$privato = $_POST["privato"];

// Inserisce il nuovo articolo: qua devi inserire la classe
$conn->close();
?>
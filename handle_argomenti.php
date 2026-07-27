<?php
session_start();

// Controlla se l'utente è loggato
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Qui puoi recuperare gli argomenti dal database
// ...

// Mostra la pagina
require 'argomenti.php';
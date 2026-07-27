<?php
session_start();

// Se l'utente NON è loggato lo rimanda al login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Da qui in poi la sessione è valida.
// L'utente resta loggato.

// Recupera gli argomenti dal database
// ...

// Mostra la pagina
require 'argomenti.php';
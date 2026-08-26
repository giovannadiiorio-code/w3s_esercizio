<?php

session_start();

require_once "conn.php";
require_once "models/Argomenti.php";

// Controlla che l'utente sia loggato
if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();
}

// Controlla che il form sia stato inviato tramite POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: argomenti.php");
    exit();
}

// Recupera il nome dell'argomento
$nome = trim($_POST["nome"]);

// Controlla che il campo non sia vuoto
if (empty($nome)) {

    $_SESSION["messaggio"] = "Inserisci il nome dell'argomento.";

    header("Location: argomenti.php");
    exit();
}

// Controlla se l'argomento esiste già
$result = Argomenti::getArgomentoByNome($nome);

if ($result) {

    $_SESSION["messaggio"] = "Argomento già esistente";

    header("Location: argomenti.php");
    exit();
}

// Crea il nuovo argomento
$argomento = new Argomenti(null, $nome, $link);

if ($argomento->register()) {

    $_SESSION["messaggio"] = "Argomento inserito con successo";

} else {

    $_SESSION["messaggio"] = "Errore durante il salvataggio dell'argomento";
}

header("Location: argomenti.php");
exit();
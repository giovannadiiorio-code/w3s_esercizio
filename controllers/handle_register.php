<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/conn.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/user.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/config.php";


// Controlla che il form sia stato inviato tramite POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: register.php");
    exit();
}

session_start();

// Recupera i dati del form
$nome = trim($_POST["nome"]);
$cognome = trim($_POST["cognome"]);
$email = trim($_POST["email"]);
$telefono = trim($_POST["telefono"]);
$password = $_POST["password"];
$conferma_password = $_POST["conferma_password"];

// Controllo campi vuoti
if (empty($nome)||empty($cognome)||empty($email)|| empty($telefono)|| empty($password) ||empty($conferma_password))
    { 
        echo "entro nell'if dei campi vuoti";
        exit();
        // da sostituire con un messaggio chiaro per l'utente in pagina html
        $_SESSION['error_registrazione'] = "Tutti i campi sono obbligatori.";
        header("Location: /views/register.php");
        exit();
}
// Controllo password
if ($password !== $conferma_password) {
    Config::createAllert("error_registrazione", "Tutti i campi sono obbligatori.", "/views/register.php");
}

// Crea l'hash della password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$user = new User($nome, $cognome, $email, $telefono, $password_hash);
//prendere il risultato della funzione e mostrare l'errore
//utilizziamo il metodo checkRegister della classe User
$result = $user->checkRegister();
//se esiste uso la classe config per generare l'errore e il redirect
$allert = new Config ("error_registrazione", "l'email è già registrata", "/views/register.php");
if($result){
    $allert->createAllert("error_registrazione", "l'email è già registrata", "/views/register.php");
}

// Inserimento utente
$result = $user->register();
if ($result) {
    //messaggio di successo
    $_SESSION["registrazione_corretta"] = "Registrazione effettuata con successo.";
    header("Location: /views/login.php");
    exit();
} else {
    session_start();
    //messaggio di errore
    $_SESSION["register_error"] = "Errore durante la registrazione.";
    header("Location: /views/register.php");
    exit();
}
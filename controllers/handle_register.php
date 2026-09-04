<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/conn.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/user.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/config.php";//questa ti serve per gli allert


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
    //ricordati che || significa OR
    { 
        echo "entro nell'if dei campi vuoti";
        exit();
        // da sostituire con un messaggio chiaro per l'utente in pagina html
        $_SESSION['error_registrazione'] = "Tutti i campi sono obbligatori."; //chiave valore
        header("Location: /views/register.php"); //reindirizzi a registrazione.php
        exit();
}
// Controllo password
if ($password !== $conferma_password) { //se non sono uguali ti manda l'allert
    Config::createAllert("error_registrazione", "Tutti i campi sono obbligatori.", "/views/register.php");
    //questa è la classe config per generare l'errore
    //config è la classe instanziata.  la devi richamare sopra sopra. va istanziata. new config, gli passi i valori e gli dai il metodo.
} //però va bene anche come ce l'hai, un giorno Emanuele mi dirà perchè, forse c'entra con static e non static

// Crea l'hash della password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$user = new User($nome, $cognome, $email, $telefono, $password_hash); //qui stai leggendo la registrzione. ti sei prsi tutti i valori del post, li vai ad aggiungere qui
//prendere il risultato della funzione e mostrare l'errore
//utilizziamo il metodo checkRegister della classe User
//non utilizzi ID perchè è autoincrementale e non serve. ti basta l'email per controllare se è già registrata.


$result = $user->checkRegister();
//se esiste uso la classe config per generare l'errore e il redirect
$allert = new Config ("error_registrazione", "l'email è già registrata", "/views/register.php");
if($result){
    $allert->createAllert("error_registrazione", "l'email è già registrata", "/views/register.php");
}

// Inserimento utente TI DEVI METTERE L'ALLERT ANCHE QUI
$result = $user->register();
if ($result) { //che cos'è? devi andare a vedere il return sul modello. in questo caso è booleano. true: la mail è trovata, False se non è registrata, quindi è un nuovo utente.
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
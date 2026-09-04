<?php
//require_once __DIR__ . '/../conn.php'; qua non serve perchè non ti serve la connessione a db

// questa classe è di config per la gestione degli errori e componenti utili attraverso la variabile session
class Config {
    public $chiave;
    public $messaggio;
    public $redirect;

    public function __construct($chiave, $messaggio, $redirect){
        $this->chiave = $chiave;
        $this->messaggio = $messaggio;
        $this->redirect = $redirect;

    }

    // La sintassi $_SESSION[$chiave] è corretta
    // (assicurarsi solo che session_start() sia stato chiamato prima di usarla)
    public function createAllert($chiave, $messaggio, $redirect){ //questi sono i parametri che passiamo alla funzione 
        session_start(); //avvia la sessione
        $_SESSION[$chiave] = $messaggio; //assegna il valore alla chiave
        header("Location: $redirect"); //reindirizza alla pagina specificata
        exit(); //esce dalla funzione
    }

    public function PrintAllert($chiave)
{
    session_start();

    if (isset($_SESSION[$chiave])) {
        echo $_SESSION[$chiave];
        unset($_SESSION[$chiave]);
    }
}
 //RICORDATI CHE QUA TI DEVI CREARE PRINT ALLERT CHE POI TI RITROVI ANCHE IN REGISTER.PHP
}
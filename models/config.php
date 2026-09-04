<?php
 
// questa classe è di config per la gestione degli errori e componenti utili attraverso la variabile session
class Config {
    public $chiave;
    public $messaggio;
    public $redirect;
 
    public function __construct($chiave = null, $messaggio = null, $redirect = null){
        $this->chiave = $chiave;
        $this->messaggio = $messaggio;
        $this->redirect = $redirect;
    }
 
    // La sintassi $_SESSION[$chiave] è corretta
    // (assicurarsi solo che session_start() sia stato chiamato prima di usarla)
    public function createAllert($chiave, $messaggio, $redirect){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$chiave] = $messaggio;
        header("Location: $redirect");
        exit();
    }
 
    public function PrintAllert($chiave)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
 
        if (isset($_SESSION[$chiave])) {
            echo $_SESSION[$chiave];
            unset($_SESSION[$chiave]);
        }
    }
}
 
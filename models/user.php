<?php
require_once __DIR__ . '/../controllers/conn.php';


class User {

    public $id;
    public $nome;
    public $cognome;
    public $email;
    public $telefono;
    public $password;

    public function __construct($nome, $cognome, $email, $telefono, $password) { 
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->password = $password;
    }

    public function register() {
        global $conn;
        $sql = "INSERT INTO utenti (nome, cognome, email, numero_di_telefono, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $this->nome, $this->cognome, $this->email, $this->telefono, $this->password);
        $stmt->execute();
        return $stmt->affected_rows > 0;

    }

    public static function authenticate($email, $password) { //QUA é MEGLIO USARE IL THIS
        global $conn;
        $sql = "SELECT * FROM utenti WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        if ($user && password_verify($password, $user["password"])) {
            return $user; //che signifcia fare il login? nel caso che user è autenticato llora mi salvo i dati dell'utente nella sessione. a noi basta solo user Id, 
        }
        return false; //QUAL è IL RETURN? USER HA IL VALOE DELLìUTENTE, DENTRO USER AVRò IL RISULTATO DELLA QUERY, CIOè IL REUTRN USER, NON UN BOOLEANO, SE è AUTENTICATO, ALTRIMENTI MI RIDà FALSE
    }

    public function checkRegister() { //ricordati che questo è il metodo, User è la classe, non ti confondere.
        global $conn;
        $sql = "SELECT id_utente FROM utenti WHERE email = ?";//restituisci l'utente se trovi questa mail
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $this->email); //$this->email è l'email che stai passando alla funzione
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            //email già registrata
           return true;
        }else{
            //email libera
            return false;
        }

    }



}


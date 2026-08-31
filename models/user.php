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

    public static function authenticate($email, $password) {
        global $conn;
        $sql = "SELECT * FROM utenti WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        if ($user && password_verify($password, $user["password"])) {
            return $user;
        }
        return false;
    }

    public function checkRegister() {
        global $conn;
        $sql = "SELECT id_utente FROM utenti WHERE email = ?";//restituisci l'utente se trovi questa mail
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $this->email);
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


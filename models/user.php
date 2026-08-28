<?php
//qui ti stai stanziando la classe...
require_once __DIR__ . '/../conn.php';

class User {
//questi sono tutti attributi
    public $id;
    public $nome;
    public $cognome;
    public $email;
    public $telefono;
    public $password;
//questo è un metodo, che mi fa utilizzare ovunque questi attributi
    public function __construct($nome, $cognome, $email, $telefono, $password) {
        $this->nome = $nome; //questi sono attributi della classe, ci servono per creare dei parametri che il costruttore, lo puoi riutilizzare ovunque
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
            start_session();
            $_SESSION["user_id"] = $user["id_utente"];       
            return $user;
        }

        return false;

    }

        //adesso crei il metodo verifica se è gia registrato
    public function checkRegister ($email) //ci va public??
    $sql = "SELECT id_utente FROM utenti WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
       // die("Email già registrata.") è brutto
       //se true

        return true 
    else 
        //la mail nonn c'è
        return false
    }

}
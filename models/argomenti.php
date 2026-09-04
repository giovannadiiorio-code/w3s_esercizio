<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/conn.php';

//questa è una classe!!! così con delle semplici righe tu hai accesso a tutto
class Argomenti { //qua si istanzia la classe
//integra le info che qui ti manca con i commenti nella classe USER
    public $id_argomento;
    public $nome;
    public $link;
 
    public function __construct($id_argomento, $nome, $link) {
        $this->id_argomento = $id_argomento;
        $this->nome = $nome;
        $this->link = $link;
//qui le hai dichiarate, così te le puoi utilizzare altrove
    }

    public function register() {
        global $conn;
        $sql = "INSERT INTO argomenti (id_argomento, nome, link) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $this->id_argomento, $this->nome, $this->link);
        $stmt->execute();
        return $stmt->affected_rows > 0;

    }


    public static function getArgomenti() {

        global $conn;
        $sql = "SELECT * FROM argomenti";
        $stmt = $conn->prepare($sql);   //prepara la query
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //restituisce un array associativo
    }

    public static function getArgomentoByNome($nome) {
        global $conn;
        $sql = "SELECT * FROM argomenti WHERE nome = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();  //restituisce un array associativo
    }

    public function create() { 
        global $conn; 
        $sql = "INSERT INTO argomenti (id_argomento, nome, link) 
        VALUES (?, ?, ?)"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( 
            "iss", 
            $this->id_argomento, 
            $this->nome, 
            $this->link ); 
            $stmt->execute(); 
        return $stmt->affected_rows > 0; 
    }

    public function update() { 
        global $conn; 
        $sql = "UPDATE argomenti SET nome = ?, link = ? WHERE id_argomento = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( 
            "ssi", 
            $this->nome, 
            $this->link, 
            $this->id_argomento ); 
        $stmt->execute(); 
        return $stmt->affected_rows > 0; 
    }

    public function delete() { 
        global $conn; $sql = "DELETE FROM argomenti WHERE id_argomento = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( 
            "i", $this->id_argomento ); 
    $stmt->execute(); 
    return $stmt->affected_rows > 0; 
    }

    public static function getAll() { 
        global $conn; $sql = "SELECT * FROM argomenti"; 
        $stmt = $conn->prepare($sql); 
        $stmt->execute(); 
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); 
    }
    

    public static function getById($id_argomento) { 
    global $conn; $sql = "SELECT * FROM argomenti WHERE id_argomento = ?"; 
    $stmt = $conn->prepare($sql); 
    stmt->bind_param(   // ← manca $ prima di stmt!
        "i", $id_argomento ); 
    $stmt->execute(); 
    return $stmt->get_result()->fetch_assoc(); 
}

    public function getAllOrdered() {
        global $conn;
        $sql = "SELECT * FROM argomenti ORDER BY id_argomento DESC";
        return $conn->query($sql);
    }

//get all, get by id e Create
}
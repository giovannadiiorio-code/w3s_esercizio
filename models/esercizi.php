<?php
require_once __DIR__ . '/../conn.php';
//questa è una classe!!! così con delle semplici righe tu hai accesso a tutto
class Esercizi { //qua si istanzia la classe
//integra le info che qui ti manca con i commenti nella classe USER
    public $id_esercizio;
    public $domanda;
    public $link;
   
 
    
    public function __construct($id_esercizio, $domanda, $link) {
    $this->id_esercizio = $id_esercizio;
    $this->domanda = $domanda;
    $this->link = $link;
}

//qui le hai dichiarate, così te le puoi utilizzare altrove


    public function create() {
    global $conn;

    $sql = "INSERT INTO esercizi 
            (domanda, link) //l'id dell'esercizio non serve perchè è autoincrement
            VALUES (?, ?)"

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ss",
        $this->domanda,
        $this->link,
    
    );

    $stmt->execute();

    return $stmt->affected_rows > 0;
    }

    public static function update() { 
        global $conn; 
        $sql = "UPDATE esercizi SET domanda = ?, link = ? 
                WHERE id_esercizio = ?"; 
                
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param( 
        "ssi", 
        $this->domanda, 
        $this->link, 
        $this->id_esercizio ); 
    
    $stmt->execute(); 
    return $stmt->affected_rows > 0; 
    }

    public static delete() { 
        global $conn; 
        $sql = "DELETE FROM esercizi WHERE id_esercizio = ?"; 
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param( 
        "i", 
        $this->id_esercizio ); 
    $stmt->execute(); 
    return $stmt->affected_rows > 0; 
    }


    public static function getEsercizi() {

        global $conn;
        $sql = "SELECT * FROM Esercizi";
        $stmt = $conn->prepare($sql);   //prepara la query
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //restituisce un array associativo
    }
    public static static function getById($id_esercizio) { 
        global $conn; $sql = "SELECT * FROM esercizi WHERE id_esercizio = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( 
            "i", $id_esercizio ); 
        $stmt->execute(); 
        return $stmt->get_result()->fetch_assoc(); 
    }

    public static function getEserciziByDomanda($domanda) {
        global $conn;
        $sql = "SELECT * FROM articoli WHERE titolo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $domanda);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();  //restituisce un array associativo
    }

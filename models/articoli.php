<?php
require_once __DIR__ . '/../conn.php';
//questa è una classe!!! così con delle semplici righe tu hai accesso a tutto
class Articoli { //qua si istanzia la classe
//integra le info che qui ti manca con i commenti nella classe USER
    public $id_articolo;
    public $titolo;
    public $descrizione;
    public $id_argomento; //ma queste sotto vanno aggiunte oppure no perchè richiamo gli altri modelli?
    public $id_esecizio;
    public $link;
    public $privato;
 
    public function __construct($id_articolo, $titolo, $descrizione, $id_argomento; $id_esecizio; $link, $privato) {
        $this->id_articolo = $id_articolo;
        $this->titolo = $titolo;
        $this->descrizione = $descrizione;
        $this->id_argomento = $id_argomento;
        $this->id_esercizio = $id_esercizio;
        $this->link = $link;
        $this->privato = $privato;
//qui le hai dichiarate, così te le puoi utilizzare altrove
    }


    public function register() {
    global $conn;

    $sql = "INSERT INTO articoli 
            (id_articolo, titolo, descrizione, id_argomento, id_esercizio, link, privato) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "isssisi",
        $this->id_articolo,
        $this->titolo,
        $this->descrizione,
        $this->id_argomento,
        $this->id_esercizio,
        $this->link,
        $this->privato
    );

    $stmt->execute();

    return $stmt->affected_rows > 0;
}


    
public static function create() {

    global $conn;

    $sql = "INSERT INTO articoli
            (titolo, descrizione, id_argomento, id_esercizio, link, privato)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssiisi",
        $this->titolo,
        $this->descrizione,
        $this->id_argomento,
        $this->id_esercizio,
        $this->link,
        $this->privato
    );

    $stmt->execute();

    return $stmt->affected_rows > 0;
}


public static function update() {

    global $conn;

    $sql = "UPDATE articoli
            SET titolo = ?, descrizione = ?, id_argomento = ?,
                id_esercizio = ?, link = ?, privato = ?
            WHERE id_articolo = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssiisii",
        $this->titolo,
        $this->descrizione,
        $this->id_argomento,
        $this->id_esercizio,
        $this->link,
        $this->privato,
        $this->id_articolo
    );

    $stmt->execute();

    return $stmt->affected_rows > 0;
}


public static function delete() {

    global $conn;

    $sql = "DELETE FROM articoli WHERE id_articolo = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $this->id_articolo
    );

    $stmt->execute();

    return $stmt->affected_rows > 0;
}


public static function getById($id_articolo) {

    global $conn;

    $sql = "SELECT * FROM articoli WHERE id_articolo = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $id_articolo
    );

    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}


public static function getByArgomento($id_argomento) {

    global $conn;

    $sql = "SELECT * FROM articoli WHERE id_argomento = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $id_argomento
    );

    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


public static function getPubblici() {

    global $conn;

    $sql = "SELECT * FROM articoli WHERE privato = 0";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


}
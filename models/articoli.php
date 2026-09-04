<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/conn.php';
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
 
    public function __construct($id_articolo, $titolo, $descrizione, $id_argomento, $id_esercizio, $link, $privato) {
    $this->id_articolo = $id_articolo;
    $this->titolo = $titolo;
    $this->descrizione = $descrizione;
    $this->id_argomento = $id_argomento;
    $this->id_esercizio = $id_esercizio;
    $this->link = $link;
    $this->privato = $privato;
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


     public static function getPubblici($conn) {
    $risultato = $conn->query("SELECT * FROM articoli WHERE privato = 0");
    $lista = [];

    while ($riga = $risultato->fetch_assoc()) {
        $lista[] = new Articoli(
            $riga['id_articolo'],
            $riga['titolo'],
            $riga['descrizione'],
            $riga['id_argomento'],
            $riga['id_esercizio'],
            $riga['link'],
            $riga['privato']
        );
    }

    return $lista;

}

    public function getAllArticoliByIdDesc()
{
    $sql = "SELECT * FROM articoli ORDER BY id_articolo DESC";

    return $this->conn->query($sql);
}
public function getArticoloById($id_articolo)
{
    $sql = "SELECT
                a.id_articolo,
                a.titolo,
                a.corpo,
                ar.nome AS argomento
            FROM articoli a
            INNER JOIN argomenti ar
                ON a.id_argomento = ar.id_argomento
            WHERE a.id_articolo = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("i", $id_articolo);

    $stmt->execute();

    return $stmt->get_result();
}

}
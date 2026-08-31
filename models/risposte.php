<?php
require_once __DIR__ . '/../conn.php';
//questa è una classe!!! così con delle semplici righe tu hai accesso a tutto
class risposte { //qua si istanzia la classe
//integra le info che qui ti manca con i commenti nella classe USER
    public $id_risposta;
    public $id_esercizio;
    public $id_utente;
    public $valore_risposta;
    public $esito_corretto:
    public $data_invio
   
 
    
  
public function __construct(
    $id_risposta,
    $id_esercizio,
    $id_utente,
    $valore_risposta,
    $esito_corretto,
    $data_invio
) {
    $this->id_risposta = $id_risposta;
    $this->id_esercizio = $id_esercizio;
    $this->id_utente = $id_utente;
    $this->valore_risposta = $valore_risposta;
    $this->esito_corretto = $esito_corretto;
    $this->data_invio = $data_invio;
}



//qui le hai dichiarate, così te le puoi utilizzare altrove
    }


    public function register() {
    global $conn;

    $sql = "INSERT INTO risposte 
            (id_risposta, id_esercizio, 
            id_utente, 
            valore_risposta, 
            esito_corretto, 
            data_invio) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "iiisis", 
        $this->id_risposta, 
        $this->id_esercizio, 
        $this->id_utente, 
        $this->valore_risposta, 
        $this->esito_corretto, 
        $this->data_invio
    );

    $stmt->execute();

    return $stmt->affected_rows > 0;
}


    public static function getRisposte() {

        global $conn;
        $sql = "SELECT * FROM risposte";
        $stmt = $conn->prepare($sql);   //prepara la query
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //restituisce un array associativo
    }

    public static function getEserciziByDomanda($domanda) {
        global $conn;
        $sql = "SELECT * FROM risposte WHERE id_esercizio = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_esercizio);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();  //restituisce un array associativo
    }

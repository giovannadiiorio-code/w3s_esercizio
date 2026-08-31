<?php
require_once __DIR__ . '/../conn.php';
//questa è una classe!!! così con delle semplici righe tu hai accesso a tutto
class opzioni_esercizio { //qua si istanzia la classe
//integra le info che qui ti manca con i commenti nella classe USER
    public $id_opzione;
    public $id_esercizio
    public $$testo_opzione;
    public $id_corretta; //sul database c'è un typo, c'è scritto iS_corretta
   
 
    
    public function __construct($id_opzione, $id_esercizio, $testo_opzione, $id_corretta) { 
        $this->id_opzione = $id_opzione; 
        $this->id_esercizio = $id_esercizio; 
        $this->testo_opzione = $testo_opzione; 
        $this->id_corretta = $id_corretta;
}

//qui le hai dichiarate, così te le puoi utilizzare altrove
    

//quando ci va solo public e quando public static?
    public static function create() { 
        global $conn; 
        $sql = "INSERT INTO esercizi 
            (id_esercizio, domanda, link) 
            VALUES (?, ?, ?)"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( 
            "iss", 
            $this->id_esercizio, //ma questo è autoincremtne. non ci vuole?! vedi nel database
            $this->domanda, 
            $this->link 
        ); 
            
        $stmt->execute(); 
        return $stmt->affected_rows > 0; 
    }

    public function update() { 
        global $conn; 
        $sql = "UPDATE opzioni SET id_esercizio = ?, testo_opzione = ?, iS_corretta = ? 
            WHERE id_opzione = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( 
            "isii", 
            $this->id_esercizio, 
            $this->testo_opzione, 
            $this->id_corretta, 
            $this->id_opzione ); 
        $stmt->execute(); 
        return $stmt->affected_rows > 0; 
    }

    public function delete() { 
        global $conn; 
        $sql = "DELETE FROM opzioni WHERE id_opzione = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( 
            "i", 
            $this->id_opzione ); 
        $stmt->execute(); 
        return $stmt->affected_rows > 0; 
    }

    public static function getOpzioni_esercizio() { 
        global $conn; $sql = "SELECT * FROM opzioni"; 
        $stmt = $conn->prepare($sql); 
        $stmt->execute(); 
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); 
    }
    public static function getById($id_opzione) { 
        global $conn; 
        $sql = "SELECT * FROM opzioni WHERE id_opzione = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( "i", $id_opzione ); 
        $stmt->execute(); 
        return $stmt->get_result()->fetch_assoc(); 
    } 
    public static function getByEsercizio($id_esercizio) { 
        global $conn; $sql = "SELECT * FROM opzioni WHERE id_esercizio = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param( "i", $id_esercizio ); 
        $stmt->execute(); 
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); 
    }

     }




    
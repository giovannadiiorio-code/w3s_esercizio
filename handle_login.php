<?php

session_start();

include 'conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $email = $_POST['email'];
    $password = $_POST['password'];


    // Cerca l'utente nel database

    $sql = "SELECT * FROM utenti WHERE email = ?";//i punti interrogativi non sono associativi ma posizionali
    //fammi sapere se c'è nella tabella udenti una riga che ha questa mail

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email); //associia l'amil nel databse, e si chiama metodo della classe di my sqli

    $stmt->execute();

    $result = $stmt->get_result();//qua ti dice s eil risultato ci sta in base al numero di rows che ci sono che corrispondo


    if ($result->num_rows == 1) {


        $utente = $result->fetch_assoc(); //quando lo trova qui gli chiedo di associarlo


        // Verifica password criptata

        if (password_verify($password, $utente['password'])) {
//qui vinene cifrata la aprte in chiro e la confrolla con quella del databse

            // Salva i dati dell'utente nella sessione
             $_SESSION["user_id"] = $utente["id_utente"];
             $_SESSION["nome"] = $utente["nome"];
             $_SESSION["cognome"] = $utente["cognome"];
             $_SESSION["email"] = $utente["email"];
             $_SESSION['id'] = $utente['id'];
            //come faccio a sapere se devo usare user_id o id?
            






            echo "Login riuscito";
            exit();


        } else {

            echo "Password errata";

        }


    } else {

        echo "Email non trovata";

    }


}

?>

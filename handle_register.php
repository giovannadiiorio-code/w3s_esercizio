
<?php
//questo ci fa gestire la registrazione con l'include della connession, prendiamo i post, controlliamo se è uguale, aggiungi il password hash. se è tutto corretto mi manda al login
include 'conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Criptiamo la password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    // Controllo se l'email esiste già

    $check = "SELECT email FROM utenti WHERE email = ?";

    $stmt = $conn->prepare($check);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();


    if ($result->num_rows > 0) {

        echo "Email già registrata";


    } else {


        // Inserimento utente nel database

        $sql = "INSERT INTO utenti (nome, cognome, email, password)
                VALUES (?, ?, ?, ?)";


        $stmt = $conn->prepare($sql);


        $stmt->bind_param(
            "ssss",
            $nome,
            $cognome,
            $email,
            $password_hash
        );


        if ($stmt->execute()) {

            echo "Registrazione completata";

            header("Location: login.php");
            exit();


        } else {

            echo "Errore nella registrazione";

        }

    }

}

?>

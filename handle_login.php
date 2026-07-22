<?php

session_start();

include 'conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $email = $_POST['email'];
    $password = $_POST['password'];


    // Cerca l'utente nel database

    $sql = "SELECT * FROM utenti WHERE email = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();


    if ($result->num_rows == 1) {


        $utente = $result->fetch_assoc();


        // Verifica password criptata

        if (password_verify($password, $utente['password'])) {


            $_SESSION['email'] = $utente['email'];
            $_SESSION['id'] = $utente['id'];


            header("Location: dashboard.php");
            exit();


        } else {

            echo "Password errata";

        }


    } else {

        echo "Email non trovata";

    }


}

?>

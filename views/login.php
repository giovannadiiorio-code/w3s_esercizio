<?php

require_once '../controllers/conn.php';
session_start();
//se l'utente è autenticato, viene rediretto alla pagina di dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$title = 'Login';
include 'header.php';

?>

<main>

    <h1>LOGIN</h1>

    <form method="POST" action="controllers/handle_login.php">


        <label>Email</label>
        <br>

        <input 
        type="email" 
        name="email" 
        placeholder="Inserisci email"
        required>

        <br><br>

        <label>Password</label>
        <br>

        <input 
        type="password" 
        name="password"
        placeholder="Inserisci password"
        required>

        <br><br>

        <button type="submit">
            Accedi
        </button>

    </form>

    <br>

    <p>Non sei registrato?</p>

    <a href="register.php">
        <button>
            Registrati ora
        </button>
    </a>

</main>

<?<?php
//mettiamo il form con method post con for action
//creami la pagina di from di registrazione della mia pagina e poi il codice per "handle_register"
require_once  $_SERVER['DOCUMENT_ROOT'] . '/controllers/conn.php';
include 'header.php';
?>

<main>

    <h1>REGISTRAZIONE</h1>

    <form method="POST" action="handle_register.php">

        <label>Nome</label>
        <br>

        <input 
        type="text" 
        name="nome"
        placeholder="Inserisci nome"
        required>

        <br><br>


        <label>Cognome</label>
        <br>

        <input 
        type="text" 
        name="cognome"
        placeholder="Inserisci cognome"
        required>

        <br><br>


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
        
            Registrati
        </button>

    </form>


    <br>

    <p>Hai già un account?</p>

    <a href="login.php">
        <button>
            Accedi
        </button>
    </a>


</main>

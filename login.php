<?php

include 'header.php';

?>

<main>

    <h1>LOGIN</h1>

    <form method="POST" action="handle_login.php">

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

    <a href="registrazione.php">
        <button>
            Registrati ora
        </button>
    </a>

</main>

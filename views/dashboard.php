<?php
session_start();

// Se l'utente non è loggato torna al login
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

include 'header.php';
?>

<main>

    <h1>DASHBOARD</h1>

    <p>Benvenuto, <strong><?php echo $_SESSION["nome"]; ?></strong>!</p>

    <p>Email: <?php echo $_SESSION["email"]; ?></p>

    <br>

    <h2>Cosa vuoi fare?</h2>

    <a href="argomenti.php">
        <button>Nuovo argomento</button>
    </a>

    <br><br>

    <a href="esercizi.php">
        <button>Nuovo esercizio</button>
    </a>

    <br><br>

    <a href="articoli.php">
        <button>Visualizza articoli</button>
    </a>

    <br><br>

    <a href="logout.php">
        <button>Logout</button>
    </a>

</main>

<?php
include 'footer.php';
?>
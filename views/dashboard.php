<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/conn.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/user.php";


session_start();

// Se l'utente non è loggato torna al login
if (!isset($_SESSION["email"])) {
    header("Location: /login.php");
    exit();
}

include 'header.php';

?>

<style>

    body {
        background-color: #fff0f6;
    }

    .dashboard-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 20px;
    }

    .welcome-card {
        background: #e83e8c;
        color: white;
        border-radius: 20px;
        padding: 35px;
        margin-bottom: 35px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    .welcome-card h1 {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .welcome-card p {
        margin: 5px 0;
        font-size: 17px;
    }

    .section-title {
        text-align: center;
        margin-bottom: 25px;
        color: #c2185b;
        font-weight: bold;
    }

    .dashboard-card {
        border: none;
        border-radius: 18px;
        padding: 25px;
        height: 100%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.10);
        transition: 0.3s;
        background-color: white;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .dashboard-card h3 {
        color: #e83e8c;
        font-weight: bold;
    }

    .dashboard-card p {
        color: #666;
    }

    .btn-rosa {
        background-color: #e83e8c;
        border-color: #e83e8c;
        color: white;
        border-radius: 10px;
        padding: 10px 20px;
        text-decoration: none;
        display: inline-block;
        width: 100%;
    }

    .btn-rosa:hover {
        background-color: #d63384;
        border-color: #d63384;
        color: white;
    }

    .logout {
        margin-top: 30px;
        text-align: center;
    }

    .btn-logout {
        background-color: #6c757d;
        color: white;
        border-radius: 10px;
        padding: 10px 30px;
        text-decoration: none;
    }

    .btn-logout:hover {
        background-color: #5a6268;
        color: white;
    }

</style>


<main>

    <div class="dashboard-container">

        <!-- Benvenuto -->
        <div class="welcome-card">

            <h1>🌸 Dashboard</h1>

            <p>
                Benvenut@,
                <strong>
                    <?php echo htmlspecialchars($_SESSION["nome"]); ?>
                </strong>!
            </p>

            <p>
               
            </p>

        </div>


        <!-- Azioni -->
        <h2 class="section-title">
            Cosa vuoi fare?
        </h2>


        <div class="row g-4">

            <!-- Argomenti -->
            <div class="col-md-4">

                <div class="dashboard-card">

                    <h3>📚 Argomenti</h3>

                    <p>
                        Crea e gestisci gli argomenti del corso.
                    </p>

                    <a href="argomenti.php" class="btn-rosa">
                        Nuovo argomento
                    </a>

                </div>

            </div>


            <!-- Esercizi -->
            <div class="col-md-4">

                <div class="dashboard-card">

                    <h3>✏️ Esercizi</h3>

                    <p>
                        Crea e gestisci gli esercizi per gli utenti.
                    </p>

                    <a href="esercizi.php" class="btn-rosa">
                        Nuovo esercizio
                    </a>

                </div>

            </div>


            <!-- Articoli -->
            <div class="col-md-4">

                <div class="dashboard-card">

                    <h3>📖 Articoli</h3>

                    <p>
                        Visualizza e gestisci gli articoli disponibili.
                    </p>

                    <a href="articoli.php" class="btn-rosa">
                        Visualizza articoli
                    </a>

                </div>

            </div>

        </div>


        <!-- Logout -->
        <div class="logout">

            <a href="logout.php" class="btn-rosa">
                🚪 Logout
            </a>

        </div>

    </div>

</main>


<?php

include 'footer.php';

?>
```

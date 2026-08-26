<?php
// questa è la pagina che apri da XAMPP
// COSA DEVI FARE: accentrare in maniera CMV.

require_once  $_SERVER['DOCUMENT_ROOT'] . '/controllers/conn.php';

session_start();


$loggato = isset($_SESSION['utente']);

include "views/header.php";

// Recupera solo gli articoli pubblici
$sql = "SELECT * FROM articoli 
        WHERE privato = 0 
        ORDER BY id_articolo DESC";

$risultato = $conn->query($sql);
?>

<main class="pagina">

    <section class="hero">
        <h1>Benvenuto</h1>
        <p>Scopri gli ultimi articoli pubblicati</p>
    </section>

    <h2 class="titolo-sezione">Articoli Pubblici</h2>

    <section class="lista-articoli">

        <?php

        // Controlla se esiste almeno un articolo
        if ($risultato->num_rows > 0) {

            // Scorre tutti gli articoli
            while ($articolo = $risultato->fetch_assoc()) {

                echo "
                <article class='card-articolo'>
                    <div class='card-contenuto'>

                        <h3>{$articolo['titolo']}</h3>

                        <p>" . nl2br($articolo['descrizione']) . "</p>

                        <a href='articolo_pubblico.php?id={$articolo['id_articolo']}' class='btn-leggi'>
                            Leggi articolo →
                        </a>

                    </div>
                </article>";
            }

        } else {

            // Se non ci sono articoli
            echo "
            <div class='nessun-articolo'>
                Nessun articolo pubblico disponibile.
            </div>";
        }

        ?>

    </section>

</main>

<style>

body {
    background: #f7f8fc;
    font-family: 'Segoe UI', sans-serif;
}

.pagina {
    max-width: 1100px;
    margin: auto;
    padding: 40px 20px;
}

.hero {
    text-align: center;
    background: linear-gradient(135deg, #ff69b4, #d63384);
    color: white;
    padding: 50px 20px;
    border-radius: 25px;
    margin-bottom: 40px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.hero h1 {
    font-size: 45px;
    margin-bottom: 10px;
}

.hero p {
    font-size: 20px;
    opacity: 0.9;
}

.titolo-sezione {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.lista-articoli {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.card-articolo {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.card-articolo:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.card-contenuto {
    padding: 25px;
}

.card-contenuto h3 {
    color: #d63384;
    font-size: 24px;
    margin-bottom: 15px;
}

.card-contenuto p {
    color: #555;
    line-height: 1.6;
}

.btn-leggi {
    display: inline-block;
    margin-top: 15px;
    background: #ff69b4;
    color: white;
    padding: 12px 25px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.btn-leggi:hover {
    background: #d63384;
    transform: scale(1.05);
}

.nessun-articolo {
    background: white;
    padding: 25px;
    border-radius: 15px;
    text-align: center;
    color: #777;
}

</style>

<?php
include "views/footer.php";
?>
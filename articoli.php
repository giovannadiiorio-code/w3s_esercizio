<?php
session_start();

// Controlla se l'utente è loggato
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

include "conn.php";
include "header.php";

// Query per recuperare tutti gli articoli
$sql = "SELECT * FROM articoli ORDER BY id_articolo DESC";
$risultato = $conn->query($sql);
?>

<main>

    <h1>Nuovo Articolo</h1>

    <form method="POST" action="handle_articoli.php">

        <label for="titolo">Titolo</label>
        <br>

        <input
            type="text"
            id="titolo"
            name="titolo"
            placeholder="Inserisci il titolo"
            required>

        <br><br>

        <label for="descrizione">Testo dell'articolo</label>
        <br>

        <textarea
            id="descrizione"
            name="descrizione"
            rows="8"
            cols="60"
            placeholder="Scrivi il testo dell'articolo"
            required></textarea>

        <br><br>

        <label for="privato">Visibilità</label>
        <br>

        <select id="privato" name="privato" required>
            <option value="0">Pubblico</option>
            <option value="1">Privato</option>
        </select>

        <br><br>

        <button type="submit">
            Pubblica articolo
        </button>

    </form>

    <hr>

    <h2>Articoli pubblicati</h2>

    <?php
    if ($risultato->num_rows > 0) {

        while ($articolo = $risultato->fetch_assoc()) {
    ?>

        <article>

            <h3><?php echo $articolo["titolo"]; ?></h3>

            <p><?php echo nl2br($articolo["descrizione"]); ?></p>

            <p>
                <strong>Visibilità:</strong>
                <?php echo ($articolo["privato"] == 1) ? "Privato" : "Pubblico"; ?>
            </p>

            <hr>

        </article>

    <?php
        }

    } else {

        echo "<p>Nessun articolo presente.</p>";

    }
    ?>

</main>

<?php
include "footer.php";
?>
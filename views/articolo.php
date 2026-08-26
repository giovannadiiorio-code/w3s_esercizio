<?php
session_start();
include "conn.php";
include "header.php";

// Legge tutti gli articoli dal database
$sql = "SELECT * FROM articoli ORDER BY id_articolo DESC";
$risultato = $conn->query($sql);
?>

<main>

    <h1>Articoli</h1>

    <?php
    if ($risultato->num_rows > 0) {

        while ($articolo = $risultato->fetch_assoc()) {
    ?>

        <article>

            <h2><?php echo $articolo["titolo"]; ?></h2>

            <p>
                <?php echo nl2br($articolo["descrizione"]); ?>
            </p>

            <p>
                <strong>Visibilità:</strong>
                <?php
                if ($articolo["privato"] == 1) {
                    echo "Privato";
                } else {
                    echo "Pubblico";
                }
                ?>
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
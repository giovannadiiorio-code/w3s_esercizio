<?php
session_start();

include "conn.php";
include "header.php";

// Recupera solo gli articoli pubblici
$sql = "SELECT * FROM articoli
        WHERE privato = 0
        ORDER BY id_articolo DESC";

$risultato = $conn->query($sql);
?>

<main>

    <h1>Articoli Pubblici</h1>

    <?php
    if ($risultato->num_rows > 0) {

        while ($articolo = $risultato->fetch_assoc()) {
    ?>

        <article>

            <h2><?php echo $articolo["titolo"]; ?></h2>

            <p>
                <?php echo nl2br($articolo["descrizione"]); ?>
            </p>

            <hr>

        </article>

    <?php
        }

    } else {

        echo "<p>Nessun articolo pubblico disponibile.</p>";

    }
    ?>

</main>

<?php
include "footer.php";
?>
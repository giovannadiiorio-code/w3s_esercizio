<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/conn.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/articolo.php";

session_start();
//$titolo = "Visualizza Articolo";
include __DIR__ . "header.php";

// Controlla che sia stato passato l'id dell'articolo 

    if (!isset($_GET["id"])) {

    echo "<div class='container mt-5'>";
    echo "<div class='alert alert-danger'>";
    echo "Articolo non trovato.";
    echo "</div>";
    echo "</div>";

    include __DIR__. "/footer.php";
    exit();
}
// Recupera l'articolo tramite il metodo del Model 
$id_articolo = $_GET["id"]; 
$articolo = Articolo::getById($id_articolo); 
// Controlla se l'articolo esiste 
 if (!$articolo) { 
    echo "<div class='container mt-5'>"; 
    echo "<div class='alert alert-danger'>"; 
    echo "Articolo non trovato."; 
    echo "</div>"; 
    echo "</div>"; 
    
    include __DIR__ . "/footer.php"; exit(); 
} 
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h2>
                <?php echo htmlspecialchars($articolo["titolo"]); ?>
            </h2>

        </div>

        <div class="card-body">

            <p>
                <strong>Argomento:</strong>
                <?php echo htmlspecialchars($articolo["argomento"]); ?>
            </p>

            <hr>

            <p style="text-align: justify; white-space: pre-line;">
                <?php echo htmlspecialchars($articolo["descrizione"]); ?>
            </p>

        </div>

        <div class="card-footer">

            <a href="articoli.php" class="btn btn-secondary">
                Torna agli articoli
            </a>

        </div>

    </div>

</div>

<?php



include "footer.php";

?>

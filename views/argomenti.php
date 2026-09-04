<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/conn.php";

session_start();

// Controllo della sessione

if (!isset($_SESSION["user_id"])) {
    header("Location: /views/login.php");
    exit(); //se ho l'user Id so che c'è la session

}

$title = "Gestione Argomenti";

include __DIR__ . '/header.php';

// Recupera tutti gli argomenti
$sql = "SELECT * FROM argomenti ORDER BY id_argomento DESC";

$result = $conn->query($sql);

?>


<div class="container mt-5">

    <h1 class="mb-4 titolo-rosa">Gestione Argomenti</h1>

    <!-- Nuovo Argomento -->
    <div class="card shadow mb-5 card-rosa">

        <div class="card-header bg-rosa text-white">
            <h4>Nuovo Argomento</h4>
        </div>

        <div class="card-body">

            <form action="handle_argomenti.php" method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nome Argomento
                    </label>

                    <input
                        type="text"
                        name="nome"
                        class="form-control input-rosa"
                        placeholder="Inserisci il nome dell'argomento"
                        required>

                </div>

                <button
                    type="submit"
                    class="btn btn-rosa">

                    Aggiungi Argomento

                </button>

            </form>

        </div>

    </div>


    <!-- Elenco Argomenti -->
    <div class="card shadow card-rosa">

        <div class="card-header bg-rosa text-white">

            <h4>Elenco Argomenti</h4>

        </div>

        <div class="card-body">

            <?php if($result->num_rows > 0){ ?>

                <table class="table">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Nome</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while($row = $result->fetch_assoc()){ ?>

                            <tr>

                                <td>
                                    <?php echo $row["id_argomento"]; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["nome"]); ?>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } else { ?>

                <div class="alert alert-rosa">

                    Nessun argomento presente.

                </div>

            <?php } ?>

        </div>

    </div>

</div>


<style>
    .bg-rosa {
        background-color: #e83e8c !important;
    }

    .btn-rosa {
        background-color: #e83e8c;
        border-color: #e83e8c;
        color: white;
    }

    .btn-rosa:hover {
        background-color: #d63384;
        border-color: #d63384;
        color: white;
    }

    .card-rosa {
        border: 2px solid #e83e8c;
    }

    .titolo-rosa {
        color: #e83e8c;
    }

    .input-rosa:focus {
        border-color: #e83e8c;
        box-shadow: 0 0 0 0.2rem rgba(232, 62, 140, 0.25);
    }

    .alert-rosa {
        background-color: #fce4ec;
        border-color: #e83e8c;
        color: #c2185b;
    }
</style>


<?php
include __DIR__ . '/footer.php';
?>
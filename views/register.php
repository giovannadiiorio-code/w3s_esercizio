
<?php
$title = "Registrazione";
include "header.php";
session_start();
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">
            <?php //QUA TI PUOI UTILIZZARE UNA FUNZIONE COME pRINTaLLERT
            $this->PrintAllert('error');

            $this->PrintAllert('success');
            ?>
           
<style>
    .card-rosa {
        border: 2px solid #e83e8c;
    }

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

    .card-rosa .form-control:focus {
        border-color: #e83e8c;
        box-shadow: 0 0 0 0.2rem rgba(232, 62, 140, 0.25);
    }

    .card-rosa a {
        color: #e83e8c;
    }
</style>


<div class="card card-rosa shadow">

    <div class="card-header bg-rosa text-white">
        <h3 class="text-center">Registrazione</h3>
    </div>

    <div class="card-body">

        <form action="/controllers/handle_register.php" method="POST">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input
                    type="text"
                    class="form-control"
                    id="nome"
                    name="nome">
            </div>

            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome</label>
                <input
                    type="text"
                    class="form-control"
                    id="cognome"
                    name="cognome"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input
                    type="text"
                    class="form-control"
                    id="telefono"
                    name="telefono"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    required>
            </div>

            <div class="mb-3">
                <label for="conferma_password" class="form-label">
                    Conferma Password
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="conferma_password"
                    name="conferma_password"
                    required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-rosa w-100">
                    Registrati
                </button>
            </div>

        </form>

        <hr>

        <p class="text-center">
            Hai già un account?
            <a href="login.php">Accedi</a>
        </p>

    </div>
</div>

<?php
include "footer.php";
?>
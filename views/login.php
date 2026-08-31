<?php

require_once __DIR__ . "/../controllers/conn.php";
require_once __DIR__ . "/../models/user.php";

session_start();

// Se l'utente è già autenticato lo reindirizza alla dashboard
if (isset($_SESSION["user_id"])) {
    header("Location: /views/dashboard.php");
    exit();
}

$title = "Login";

include "header.php";

?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">
            <?php
            if (isset($_SESSION["register_success"])) {
                echo '<div class="alert alert-success">' . $_SESSION["register_success"] . '</div>';
                unset($_SESSION["register_success"]);
            }
            ?>
                <div class="card-header bg-rosa text-white">

                    <h2 class="text-center">
                        Login
                    </h2>

                </div>

                <div class="card-body">

                    <form action="/controllers/handle_login.php" method="POST"> <!-- vedi qua --!>

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-rosa w-100">

                            Accedi

                        </button>

                    </form>

                    <hr>

                    <p class="text-center">

                        Non hai ancora un account?

                        <a href="register.php">

                            Registrati

                        </a>

                    </p>

                </div>

            </div>

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
</style>

<?php

include "footer.php";

?>
<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . '/controllers/conn.php';
?>
<!DOCTYPE html>
<html lang="it">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>W3S</title>


<!-- Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>



<style>


body{

    background:#f8f9fa;
    font-family:'Segoe UI', sans-serif;

}



/* NAVBAR */

.navbar{

    background:linear-gradient(135deg,#ff69b4,#d63384);
    padding:15px 0;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);

}



/* LOGO */

.navbar-brand{

    color:white !important;
    font-size:32px;
    font-weight:800;
    letter-spacing:1px;
    transition:0.3s;

}


.navbar-brand:hover{

    transform:scale(1.05);

}



/* LINK MENU */

.nav-link{

    color:white !important;
    font-weight:600;
    margin:0 10px;
    position:relative;

}



.nav-link::after{

    content:"";
    position:absolute;
    width:0;
    height:3px;
    background:white;
    bottom:-5px;
    left:50%;
    transition:0.3s;

}


.nav-link:hover::after{

    width:100%;
    left:0;

}



/* BOTTONI */

.btn{

    border-radius:25px;
    padding:10px 22px;
    transition:0.3s;

}



.btn-login{

    background:white;
    color:#d63384;
    font-weight:bold;

}



.btn-login:hover{

    background:#ffe4ef;
    transform:translateY(-3px);

}



.btn-register{

    background:#9d174d;
    color:white;
    font-weight:bold;

}



.btn-register:hover{

    background:#70123a;
    color:white;
    transform:translateY(-3px);

}



/* MENU MOBILE */

.navbar-toggler{

    border:none;

}


.navbar-toggler:focus{

    box-shadow:none;

}



</style>


</head>


<body>


<header>


<nav class="navbar navbar-expand-lg">


<div class="container">


<!-- LOGO -->

<a class="navbar-brand" href="index.php">

    W3S

</a>



<!-- BOTTONE MOBILE -->

<button class="navbar-toggler bg-light" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#menu">


<span class="navbar-toggler-icon"></span>


</button>




<div class="collapse navbar-collapse" id="menu">



<ul class="navbar-nav mx-auto">



<li class="nav-item">

<a class="nav-link" href="index.php">

Home

</a>

</li>



<li class="nav-item">

<a class="nav-link" href="views/articolo_pubblico.php">

Articoli Pubblici

</a>

</li>



<?php if(isset($_SESSION["user_id"])) :  ?>

<li class="nav-item">

<a class="nav-link" href="views/articolo.php">

Articoli

</a>

</li>



<li class="nav-item">

<a class="nav-link" href="views/articoli.php">

Nuovo Articolo

</a>

</li>

<?php endif; ?>



</ul>





<div class="d-flex gap-2">


<?php if(isset($_SESSION["user_id"])) :  ?>

<a href="logout.php" class="btn btn-login">

Logout

</a>

<?php else: ?>

<a href="views/login.php" class="btn btn-login">

Login

</a>



<a href="register.php" class="btn btn-register">

Registrati

</a>

<?php endif; ?>


</div>



</div>


</div>


</nav>


</header>
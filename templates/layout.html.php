<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <title><?=$title?></title>
</head>
<body>    

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light shadow">
        <div class="container">
            <!-- logo e titolo -->
            <img src="../public/assets/img/logo.png" alt="logo" id="logo" class="img-fluid">
            <h2 class="text-dark fw-bold">INTERNET JOKE DATABASE</h2>
            <!-- navbar / navbar mobile -->
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon custom-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-uppercase fw-bold text-dark active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase fw-bold text-dark active" href="/joke/list">Lista</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase fw-bold text-dark" href="/joke/edit">Aggiungi Barzelletta</a></li>
                    <!-- <li class="nav-item"><a class="nav-link text-uppercase fw-bold text-dark" href="index.php?route=register">Registrati</a></li> -->
                </ul>
            </div>
    </nav>        
</header>

<section class="container-fluid" id="main">
    <?=$output?>
</section>

<?php 
    include 'footer.html.php';
?>

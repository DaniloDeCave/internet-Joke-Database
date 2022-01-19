<?php 
    include 'header.html.php';
?>

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
                    <li class="nav-item"><a class="nav-link text-uppercase fw-bold text-dark active" href="index.php?action=list">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-uppercase fw-bold text-dark" href="index.php?action=edit">Add New Joke</a></li>
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

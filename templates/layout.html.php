<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <title><?=$title?></title>
</head>
<body>
    <header>
        <h1>INTERNET JOKE DATABASE</h1>
    </header>
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-link"><a href="index.php">Home</a></li>
            <li class="nav-link"><a href="jokes.php">jokes List</a></li>
            <li class="nav-link"><a href="addjoke.php">Add Joke</a></li>
        </ul>
    </nav>
    <main id="main">
        <?=$output?>
    </main>

    <?php 
        include 'footer.html.php';
    ?>
</body>
</html>
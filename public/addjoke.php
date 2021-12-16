<?php
if(isset($_POST['joketext'])){
    try{
        // inclusione script connessione al database    
            include __DIR__.'/../includes/DatabaseConnection.php';
            include __DIR__.'/../includes/DatabaseFunctions.php';


            // function insertJoke($pdo, $joketext, $authorId)
            insertJoke($pdo,$_POST['joketext'], 1);

        header('location: jokes.php');
    }
    catch(PDOException $e){
        $message = 'impossibile connettersi : '. 
        $e->getMessage(). ' in '.
        $e->getFile().' : '.$e->getLine();
    }
}
else{
    $title = "Add a new Joke";
    ob_start();
    include __DIR__.'/../templates/addjoke.html.php';
    $output = ob_get_clean();
}
include __DIR__.'/../templates/layout.html.php';

?>
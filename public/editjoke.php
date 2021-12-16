<?php
// inclusione script connessione al database    
include __DIR__.'/../includes/DatabaseConnection.php';
include __DIR__.'/../includes/DatabaseFunctions.php';

try{
    if(isset($_POST['joketext'])){

        // function updateJoke($pdo, $jokeId, $joketext, $authorId)
        updateJoke($pdo, $_POST['jokeid'], $_POST['joketext'], 1);

        header('location: jokes.php');
    }
    else{

        // function getJoke($pdo,$id)
        $joke = getJoke($pdo,$_GET['id']);

        $title = "edit Joke";
        
        ob_start();
        include __DIR__.'/../templates/editjoke.html.php';
        $output = ob_get_clean();
    }
    
}
catch(PDOException $e){
    $message = 'impossibile connettersi : '. 
    $e->getMessage(). ' in '.
    $e->getFile().' : '.$e->getLine();
}
include __DIR__.'/../templates/layout.html.php';

?>
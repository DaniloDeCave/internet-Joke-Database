<?php
    try{
       // inclusione script connessione al database   
        include __DIR__.'/../includes/DatabaseConnection.php';
        include __DIR__.'/../includes/DatabaseFunctions.php';

        deleteJoke($pdo,$_POST['id']);

        header('location: jokes.php');
    }

    catch(PDOException $e){
        $message = 'impossibile connettersi : '. 
        $e->getMessage(). ' in '.
        $e->getFile().' : '.$e->getLine();
    }

include __DIR__.'/../templates/layout.html.php';

?>
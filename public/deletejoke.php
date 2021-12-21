<?php
    try{
       // inclusione script connessione al database   
        include __DIR__.'/../includes/DatabaseConnection.php';
        include __DIR__.'/../includes/DatabaseFunctions.php';
        
        // function delete($pdo, $table, $primaryKey, $id){
        delete($pdo,'joke', 'id', $_POST['id']);

        header('location: jokes.php');
    }

    catch(PDOException $e){
        $message = 'c\' è stato un errore nell\'operazione: '. 
        $e->getMessage(). ' in '.
        $e->getFile().' : '.$e->getLine();
    }

include __DIR__.'/../templates/layout.html.php';

?>
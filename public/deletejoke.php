<?php
    try{
       // inclusione script connessione al database   
        include __DIR__.'/../includes/DatabaseConnection.php';
        // include __DIR__.'/../includes/DatabaseFunctions.php';
        include __DIR__.'/../includes/DatabaseTable.php';

        $jokesTable = new DatabaseTable($pdo,'joke',$id);
        
        // function delete($pdo, $table, $primaryKey, $id){
        $jokesTable->delete($_POST['id']);

        header('location: jokes.php');
    }

    catch(PDOException $e){
        $message = 'c\' è stato un errore nell\'operazione: '. 
        $e->getMessage(). ' in '.
        $e->getFile().' : '.$e->getLine();
    }

include __DIR__.'/../templates/layout.html.php';

?>
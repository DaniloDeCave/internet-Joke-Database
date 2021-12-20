<?php
    try{
       // inclusione script connessione al database    
        include __DIR__.'/../includes/DatabaseConnection.php';

        // :id: scritto cosí rappresenta un placeholder per le prepare storage
        $sql = 'DELETE FROM `joke` WHERE `id` =:id';

        // avvia la prepare storage query
        $stmt = $pdo->prepare($sql);
        // bindvalue(), associa un valore al placeholder precedentemente usato 
        $stmt->bindValue(':id', $_POST['id']);
        // esegue la query
        $stmt->execute();

        header('location: jokes.php');
    }

    catch(PDOException $e){
        $message = 'impossibile connettersi : '. 
        $e->getMessage(). ' in '.
        $e->getFile().' : '.$e->getLine();
    }

include __DIR__.'/../templates/layout.html.php';

?>
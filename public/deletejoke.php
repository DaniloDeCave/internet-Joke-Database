<?php
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ijdb','root','');        
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

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
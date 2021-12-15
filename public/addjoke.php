<?php
if(isset($_POST['joketext'])){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ijdb','root','');        
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // CURDATE(): funzione nativa di MySQL che restituisce la data corrente
        // :joketext: scritto cosí rappresenta un placeholder per le prepare storage
        $sql = 'INSERT INTO `joke` SET 
                `joketext`= :joketext,
                `jokedate`= CURDATE()';

        // avvia la prepare storage query
        $stmt = $pdo->prepare($sql);
        // bindvalue(), associa un valore al placeholder precedentemente usato 
        $stmt->bindValue(':joketext', $_POST['joketext']);
        // esegue la query
        $stmt->execute();

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
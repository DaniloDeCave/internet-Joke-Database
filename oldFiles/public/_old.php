<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb','root','');
    
    // ATTR_ERRMODE costante della classe PDO che controlla la modalita di errore
    // ERRMODE_EXCEPTION permette impostare la modalitá che lancia eccezioni
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $message = 'connessione stabilita';

    // nb. la tabella gi esiste nel database
    $query = 'CREATE TABLE `joke` (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        joketext TEXT,
        jokedate DATE NOT NULL
    ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';

    // avvio della query con PDO
    $pdo->exec($query);

    $message = 'Tabella creata con successo';
    // Output atteso:

    /*impossibile connettersi : SQLSTATE[42S01]: 
    Base table or view already exists: 1050 Table 'joke' already exists 
    in C:\xampp\htdocs\PHP_Projects\internet Joke Database\public\index.php : 14 
    */ 
}




catch(PDOException $e){
    $message = 'impossibile connettersi : '. 
    $e->getMessage(). ' in '.
    $e->getFile().' : '.$e->getLine();
}

include __DIR__.'/../templates/output.html.php';

?>
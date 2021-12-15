<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ijdb','root','');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT `id`,`joketext` FROM `joke`';

    // avvio della query con PDO
    $jokes = $pdo->query($query);

    // vecchia Versione
    // // fetch del risultato della query
    // while($row = $result->fetch()){
    //     $jokes[] = [
    //         'id'      => $row['id'],
    //         'joketext'=> $row['joketext']
    //     ];
    // }    

    $title = 'joke List';

    // output buffering serve per memorizzare , all'interno di un buffer sul server
    // il contenuto resituito da un echo.
    // prevede due funzioni : ob_start() e ob_get_clean()
    // il primo ( ob_start() ) avvia il buffer e tutto ció    
    // che viene visualizzato con echo o html ,viene memorizzato 
    // invece di essere inviato al browser
    // il secondo ( ob_get_clean() ) restituisce il contenuto del buffer e svuota il buffer;

   ob_start();
   include __DIR__.'/../templates/jokes.html.php';
   $output = ob_get_clean();
}

catch(PDOException $e){
    $output = 'impossibile connettersi : '. 
    $e->getMessage(). ' in '.
    $e->getFile().' : '.$e->getLine();
}

include __DIR__.'/../templates/layout.html.php';

?>
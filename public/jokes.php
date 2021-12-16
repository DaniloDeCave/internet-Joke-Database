<?php

try{

    // inclusione script connessione al database    
    include __DIR__.'/../includes/DatabaseConnection.php';
    include __DIR__.'/../includes/DatabaseFunctions.php';

    $jokes = getAllJokes($pdo);

    $title = 'joke List';

    $totalJokes = totalJokes($pdo);
    
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
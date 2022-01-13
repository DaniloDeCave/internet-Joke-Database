<?php

try{

    // inclusione script connessione al database    
    include __DIR__.'/../includes/DatabaseConnection.php';
    include __DIR__.'/../includes/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo,'joke','id');
    $authorsTable = new DatabaseTable($pdo,'author','id');

    // function findAll($pdo, $table)
    $result = $jokesTable->findAll();

    $jokes = [];
    // Ricerca autore per ID 
    foreach($result as $joke){
        // function findById($pdo, $table,$primaryKey,$value)
        $author = $authorsTable->findById($joke['authorid']);
        
        $jokes[] = [
            'id'=>$joke['id'],
            'joketext'=>$joke['joketext'],
            'jokedate'=>$joke['jokedate'],
            'name'=>$author['name'],
            'email'=>$author['email']
        ];
    }

    $title = 'joke List';
    // function findAll($pdo, $table)
    $totalJokes = $jokesTable->totalJokes();
    
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
    $output = '<h3>Si è verificato un errore : </h3>    '. 
    $e->getMessage(). ' in '.
    $e->getFile().' : '.$e->getLine();
}

include __DIR__.'/../templates/layout.html.php';

?>
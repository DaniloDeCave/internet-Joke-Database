<?php
include_once __DIR__.'/../includes/DatabaseConnection.php';

function totalJokes($pdo){
    $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
    $row = $query->fetch();
    return $row[0];
}

function getJoke($pdo,$id){
    // Creo array per contenere i parametri da passare alla query
    $parameters = [':id' => $id];

    // alla funzione query passiamo : 
    // - la variabile contenente i parametri per la connessione al DB ($pdo) fornita dall' inclusione del file DatabaseConnection.php 
    // - i comandi sql da eseguire($sql)
    // - i parametri che useremo per legare i dati alla query($parameters)
    $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id',$parameters);
    return $query->fetch();
}

// Funzione per query v3: 
// sopprimiamo il ciclo foreach , perchè il metodo execute , accetta, opzionalmente, un argomento di parametri 
// e quindi ci permette di passare la variabile $parameters direttamente al metodo senza dover legare manualmente i parametri
function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);    
    return $query;
}

// funzione inserimento barzelletta
function insertJoke($pdo, $joketext, $authorId){

    $sql = 'INSERT INTO `joke` (`joketext`, `jokedate`, `authorid`) 
            VALUES (:joketext ,CURDATE(), :authorid);';

    $parameters = [
        ':joketext' => $joketext,
        ':authorid' => $authorId
    ];
    
    query($pdo,$sql,$parameters);  
}

// visualizza tutte Barzelletta
function getAllJokes($pdo){

    $sql = 'SELECT `joke`.`id`,`joketext`,`name`,`email` 
            FROM `joke`
            INNER JOIN `author`
            ON `authorid` = `author`.`id`';

    $query = query($pdo,$sql);

    return $query->fetchAll();
}

// Modifica Barzelletta
function updateJoke($pdo, $jokeId, $joketext, $authorId){

    $parameters = [
        ':joketext' => $joketext,
        ':authorid' => $authorId,
        ':id'       => $id
    ];

    $sql = 'UPDATE `joke` 
            SET `authorid` = :authorid, `joketext` = :joketext
            WHERE `id` = :id';

    $query = query($pdo,$sql,$parameters);

}


?>
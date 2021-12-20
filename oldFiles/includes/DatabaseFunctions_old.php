<?php
include_once __DIR__.'/../includes/DatabaseConnection.php';

// Vecchia versione funzione total jokes
// function totalJokes($pdo){
//     $query = $pdo->prepare('SELECT COUNT(*) FROM `joke`');
//     $query->execute();
//     $row = $query->fetch();
//     return $row[0];
// }

function totalJokes($pdo){
    $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
    $row = $query->fetch();
    return $row[0];
}

// versione 1 funzione getJokes senza uso della funzione query
// function getJokes($pdo, $id){
    //     $query = $pdo->prepare('SELECT * FROM `joke` WHERE `id` = :id');
    //     $query = $pdo->bindValue(':id',$id);
    //     $query->execute();
    //     return $query->fetch();
    // }
    
// versione 2 funzione getJokes con uso della funzione query ma senza bindValue();
// function getJokes($pdo,$id){
//     $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id');
//     return $query->fetch();
// }

function getJokes($pdo,$id){
    // Creo array per contenere i parametri da passare alla query
    $parameters = [':id' => $id];

    // alla funzione query passiamo : 
    // - la variabile contenente i parametri per la connessione al DB ($pdo) fornita dall' inclusione del file DatabaseConnection.php 
    // - i comandi sql da eseguire($sql)
    // - i parametri che useremo per legare i dati alla query($parameters)
    $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id',$parameters);
    return $query->fetch();
}

// funzione per query V1 : Problema.. la funzione query non prevede l'uso delle stored procedure,
//  perchè bisognerebbe aggiungere un argomento per farla funzionare con getJokes, ma genererebbe un errore con la funzione
// totalJokes , per la funzione si aspetterebbe tre argomenti , invece la funzione totalJokes, ne prevede soltanto uno.
// function query($pdo, $sql){
//     $query = $pdo->prepare($sql);
//     $query->execute();    
//     return $query;
// }

// Funzione per query v2: 
// per ovviare al problema della prima versione , utilizzo una variabile con valore predefinito. 
// in questo caso, un array vuoto. In questo modo se non viene passato nessun terzo parametro, la funzione utilizzerà di default
// l'array vuoto. quindi adesso, si può riutilizzare la funzione bindvalue();
// function query($pdo, $sql, $parameters = []){
//     $query = $pdo->prepare($sql);

    // il foreach si occuperà di scorrere l'array e lega alla query i parametri forniti. se non si passa nulla,
    // $parameters rimarrà vuoto, il ciclo foreach non avrà nessun elemento , ma comunque ci permetterà di utilizzare la funzione 
//     foreach($parameters as $name => $value){
//         $query->bindValue($name,$value);
//     }

//     $query->execute();    
//     return $query;
// }

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
<?php
include_once __DIR__.'/../includes/DatabaseConnection.php';

// Funzioni per le barzellette

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

// Funzione per query: 
// sopprimiamo il ciclo foreach , perchè il metodo execute , accetta, opzionalmente, un argomento di parametri 
// e quindi ci permette di passare la variabile $parameters direttamente al metodo senza dover legare manualmente i parametri
function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);    
    return $query;
}


function insertJoke($pdo, $fields){

    // genero la prima parte della query di inserimento.
    $sql = 'INSERT INTO `joke` (';

    //uso il foreach per associare l'array di parametri, ai campi della query.
    // i parametri che passeremo alla query sono : joketext, jokedate, authorid e saranno separati da virgola.
    foreach($fields as $key => $value){
        $sql .= '`' . $key . '` ,';
    }

    $sql = rtrim($sql, ',');
    $sql .=')VALUES(';

    // genero Seconda parte della query
    //uso secondo foreach viene utilizzato per popolare i campi che ci interessano, prevedendo  
    // l'uso di placeholder per la stored Procedure
    foreach($fields as $key => $value){
        $sql .= ':' .$key .',';
    }

    $sql = rtrim($sql, ',');
    $sql .=')';

    $fields = processDates($fields);

    query($pdo,$sql,$fields);
}

// visualizza tutte Barzelletta
function getAllJokes($pdo){

    $sql = 'SELECT `joke`.`id`,`joketext`,`jokedate`,`name`,`email` 
            FROM `joke`
            INNER JOIN `author`
            ON `authorid` = `author`.`id`';

    $query = query($pdo,$sql);

    return $query->fetchAll();
}

// Modifica Barzelletta
// in questa nuova versione della funzione di update, utilizziamo un array di nome fields per passare i parametri per
// generare la query.
function updateJoke($pdo, $fields){

    $query = 'UPDATE `joke` SET ';

    foreach($fields as $key => $value){
        $query .= '`' .$key. '` =:' .$key .',';
    }

    $query = rtrim($query, ',');

    $query .= ' WHERE `id` = :primaryKey';
        
    $fields['primaryKey'] = $fields['id'];
    
    //Funzione gestione della data e dell'orario attraverso un foreach (formattazione automatica della data)
    $fields = processDates($fields);   
    
    query($pdo,$query,$fields);

}

function deleteJoke($pdo,$id){

    $parameters = [
        ':id' => $id
    ];

    $sql = 'DELETE FROM `joke` WHERE `id` =:id;';
    
    query($pdo,$sql,$parameters);
}


function processDates($fields){
    foreach($fields as $key => $value){
        // controlla se ciascuno dei valori dell' Array è un'oggetto DateTime
        if($value instanceof DateTime){
            // se lo trova, ,sostituisce il valore nell'array con la data formattata in modo corretto
            $fields[$key] = $value->format('Y-m-d H:i:s');
        }
    }
    return $fields;
}



// funzioni per tabella autori

// Recupera tutti gli autori
function getAllAuthors($pdo,$table){
    
    $sql = 'SELECT * FROM `author`';

    $authors = query($pdo,$sql);

    return $authors->fetchAll();
}

function insertAuthor($pdo,$fields){

    // genero la prima parte della query di inserimento.
    $sql = 'INSERT INTO `author` (';

    //uso il foreach per associare l'array di parametri, ai campi della query.
    // i parametri che passeremo alla query sono : joketext, jokedate, authorid e saranno separati da virgola.
    foreach($fields as $key => $value){
        $sql .= '`' . $key . '` ,';
    }

    $sql = rtrim($sql, ',');
    $sql .=')VALUES(';

    // genero Seconda parte della query
    //uso secondo foreach viene utilizzato per popolare i campi che ci interessano, prevedendo  
    // l'uso di placeholder per la stored Procedure
    foreach($fields as $key => $value){
        $sql .= ':' .$key .',';
    }

    $sql = rtrim($sql, ',');
    $sql .=')';
    
    query($pdo,$sql,$fields); 
}


function deleteAuthor($pdo,$id){

    $parameters = [
        ':id' => $id
    ];

    $sql = 'DELETE FROM `author` WHERE `id` =:id;';

    query($pdo,$sql,$parameters);
}



















// Funzioni Generiche:
// con le funzioni generichesi evita di determinare a priori, la tabella nella quale si vuole operare per una determinata azione.
// in questo modo , si passa come parametro la tabella in cui operare

// funzione generica inserimento
function insert($pdo, $table, $fields){

    // genero la prima parte della query di inserimento.
    $sql = 'INSERT INTO '.'`' . $table . '`' . '(';

    //uso il foreach per associare l'array di parametri, ai campi della query.
    foreach($fields as $key => $value){
        $sql .= '`' . $key . '` ,';
    }

    $sql = rtrim($sql, ',');
    $sql .=')VALUES(';

    // genero Seconda parte della query
    //uso secondo foreach viene utilizzato per popolare i campi che ci interessano, prevedendo  
    // l'uso di placeholder per la stored Procedure
    foreach($fields as $key => $value){
        $sql .= ':' .$key .',';
    }

    $sql = rtrim($sql, ',');
    $sql .=')';

    $fields = processDates($fields);

    query($pdo,$sql,$fields);
}


// Funzione generica aggiornamento dati
function update($pdo, $table, $primaryKey, $fields){

    $query = 'UPDATE'.'`' . $table . '` ' . 'SET ';

    foreach($fields as $key => $value){
        $query .= '`' .$key. '` =:' .$key .',';
    }

    $query = rtrim($query, ',');

    $query .= ' WHERE `'.$primaryKey.'` = :primaryKey';

    // imposto la variabile :primaryKey
    $fields['primaryKey'] = $fields['id'];
    
    //Funzione gestione della data e dell'orario attraverso un foreach (formattazione automatica della data)
    $fields = processDates($fields);   
    
    query($pdo,$query,$fields);

}


// Funzione di ricerca per ID
function findById($pdo, $table,$primaryKey,$value){     

    $sql = 'SELECT * FROM ' .'`' . $table .'`';
    $query .= ' WHERE `'.$primaryKey.'` = :primaryKey';

    $parameters = [
        'value' => $value
    ];

    $query = query($pdo,$sql);

    return $query->fetch();

}


// funzione generica per estrazione dati. 
function findAll($pdo, $table){ 

    $sql = 'SELECT * FROM ' .'`' . $table .'`';

    $query = query($pdo,$sql);

    return $query->fetchAll();

}


// funzione generica per cancellazione dati
function delete($pdo, $table, $primaryKey, $id){

    $parameters = [
        ':id' => $id
    ];

    $sql = 'DELETE  FROM ' .'`' . $table .'`'. 'WHERE `'. $primaryKey .'`=:id';

    query($pdo,$sql,$parameters);
}



?>
<?php

// Modifica Barzelletta
// function updateJoke($pdo, $jokeId, $joketext, $authorId){

//     $parameters = [
//         ':joketext' => $joketext,
//         ':authorid' => $authorId,
//         ':id'       => $jokeId
//     ];

//     $sql = 'UPDATE `joke` 
//             SET `authorid` = :authorid, `joketext` = :joketext
//             WHERE `id` = :id';

//     $query = query($pdo,$sql,$parameters);

// }


// Modifica Barzelletta
// function updateJoke(){

//     $array  = [
//         'id' => 1,
//         'joketext' => 'Ciao sono danilo'
//     ];

//     $query = 'UPDATE `joke` SET ';

//     foreach($array as $key => $value){
//         $query .= '`' .$key. '` =:' .$key .',';
//     }

//     $query = rtrim($query, ',');

//     $query .= ' WHERE `id` = :primaryKey';

//      echo $query;

// }
function updateJoke($joketext,$date,$authorId){

    $fields= [
        'joketext'=> $joketext,
        'jokedate'=> $date,
        'authorid'=> $authorId
    ];

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
    
    echo $sql;

}


$date = new DateTime();
$date->format('d/m/Y H:i:s');
updateJoke('danilo',$date,1);




?>
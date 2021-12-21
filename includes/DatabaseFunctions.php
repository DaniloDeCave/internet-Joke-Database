<?php
include_once __DIR__.'/../includes/DatabaseConnection.php';

// Funzione query query: 
function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);    
    return $query;
}

// estrazione Barzellette
function totalJokes($pdo){
    $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
    $row = $query->fetch();
    return $row[0];
}

// funzione Formattazione Automatica Data
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



// Funzioni Generiche:



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

    $sql = 'SELECT * FROM ' .'`' . $table .'`WHERE `'.$primaryKey.'` = :value';

    $parameters = [
        'value' => $value
    ];

    $query = query($pdo,$sql,$parameters);

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

// funzione Salvataggio
function save($pdo, $table, $primaryKey, $record){
    // se la chiave presente nel campo , contenuto nella variabile $primaryKey, verrà avviata la funzione di inserimento.
    try{
        if($record[$primaryKey]== ''){
            $record[$primaryKey] = null;
        }
        insert($pdo, $table, $record);
    }
    // in caso di id già presente verrò avviata la funzione di aggiornamento
    catch(PDOException $e){
        update($pdo, $table, $primaryKey, $record);        
    }
}

?>